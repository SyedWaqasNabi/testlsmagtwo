<?php

namespace Ls\Replication\Cron;

use \Ls\Core\Model\LSR;
use \Ls\Replication\Helper\ReplicationHelper;
use \Ls\Omni\Helper\ContactHelper;
use Magento\CatalogRule\Api\CatalogRuleRepositoryInterface;
use Magento\CatalogRule\Model\RuleFactory;
use Magento\CatalogRule\Model\Rule\Job;
use \Ls\Replication\Model\ResourceModel\ReplDiscount\CollectionFactory;
use \Ls\Replication\Api\ReplDiscountRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Class DiscountCreateTask
 * @package Ls\Replication\Cron
 * This cron will create catalog rules in order to integrate the preactive
 * discounts which are independent of any Member Limitation
 * One Sales Rule  = All discounts based on Published Offer.
 * Condition will be to have any of the value equal to the SKUS found in it.
 * Priority will be same for published offer as it was created in Nav.
 *
 */
class DiscountCreateTask
{
    /**
     * @var CatalogRuleRepositoryInterface
     */
    public $catalogRule;

    /**
     * @var RuleFactory
     */
    public $ruleFactory;

    /**
     * @var Job
     */
    public $jobApply;

    /**
     * @var ReplDiscountRepositoryInterface
     */
    public $replDiscountRepository;

    /**
     * @var LSR
     */
    public $lsr;

    /**
     * @var LoggerInterface
     */

    public $logger;

    /**
     * @var ReplicationHelper
     */
    public $replicationHelper;

    /**
     * @var ContactHelper
     */
    public $contactHelper;

    /**
     * @var CollectionFactory
     */
    public $replDiscountCollection;

    /**
     * DiscountCreateTask constructor.
     * @param RuleFactory $ruleFactory
     * @param RuleRepository $ruleRepository
     * @param Rule $rule
     * @param ReplDiscountRepository $replDiscountRepository
     * @param ReplicationHelper $replicationHelper
     * @param LSR $LSR
     * @param LoggerInterface $logger
     */
    public function __construct(
        CatalogRuleRepositoryInterface $catalogRule,
        RuleFactory $ruleFactory,
        Job $jobApply,
        ReplDiscountRepositoryInterface $replDiscountRepository,
        ReplicationHelper $replicationHelper,
        LSR $LSR,
        CollectionFactory $replDiscountCollection,
        ContactHelper $contactHelper,
        LoggerInterface $logger
    ) {
        $this->catalogRule = $catalogRule;
        $this->ruleFactory = $ruleFactory;
        $this->jobApply = $jobApply;
        $this->replDiscountRepository = $replDiscountRepository;
        $this->replicationHelper = $replicationHelper;
        $this->contactHelper = $contactHelper;
        $this->lsr = $LSR;
        $this->replDiscountCollection = $replDiscountCollection;
        $this->logger = $logger;
    }

    /**
     * Discount Creation
     */
    public function execute()
    {
        /**
         * Get all Unique Publish offer so that we can create catalog rules based on that.
         * Only gonna work if everything is good to go.
         * And the web store is being set in the Magento.
         * And we need to apply only those rules which are associated to the store assigned to it.
         */
        $CronProductCheck = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_PRODUCT);
        if ($CronProductCheck == 1) {
            if ($this->lsr->isLSR()) {
                $store_id = $this->lsr->getDefaultWebStore();
                $publishedOfferCollection = $this->getUniquePublishedOffers();
                if (!empty($publishedOfferCollection)) {
                    /** @var \Ls\Replication\Model\ReplDiscount $item */
                    foreach ($publishedOfferCollection as $item) {
                        $filters = [
                            ['field' => 'OfferNo', 'value' => $item->getOfferNo(), 'condition_type' => 'eq']
                        ];

                        $criteria = $this->replicationHelper->buildCriteriaForArray($filters, 100);

                        /** @var \Ls\Replication\Model\ReplDiscountSearchResults $replDiscounts */
                        $replDiscounts = $this->replDiscountRepository->getList($criteria);

                        $skuArray = [];

                        if ($item->getLoyaltySchemeCode() == '' ||
                            $item->getLoyaltySchemeCode() == null
                        ) {
                            $useAllGroupIds = true;
                            $customerGroupIds = $this->contactHelper->getAllCustomerGroupIds();
                        } else {
                            $useAllGroupIds = false;
                            $customerGroupIds = [];
                        }

                        /** @var \Ls\Replication\Model\ReplDiscount $replDiscount */
                        foreach ($replDiscounts->getItems() as $replDiscount) {
                            // To check if discounts groups are specific for any Member Scheme.
                            if (!$useAllGroupIds &&
                                !in_array($this->contactHelper
                                    ->getCustomerGroupIdByName($replDiscount->getLoyaltySchemeCode()),
                                    $customerGroupIds)
                            ) {
                                $customerGroupIds[] = $this->contactHelper->getCustomerGroupIdByName(
                                    $replDiscount->getLoyaltySchemeCode()
                                );
                            }
                            if ($replDiscount->getVariantId() == '' ||
                                $replDiscount->getVariantId() == null
                            ) {
                                $skuArray[] = $replDiscount->getItemId();
                            } else {
                                $skuArray[] = $replDiscount->getItemId() . '-' . $replDiscount->getVariantId();
                            }
                            $replDiscount->setData('processed', '1');
                            // @codingStandardsIgnoreStart
                            $this->replDiscountRepository->save($replDiscount);
                            // @codingStandardsIgnoreEnd
                        }
                        if (!empty($skuArray)) {
                            $this->addSalesRule($item, $skuArray, $customerGroupIds);
                        }
                        $this->jobApply->applyAll();
                    }
                    $criteriaTotal = $this->replicationHelper->buildCriteriaForArray([], 100);
                    /** @var \Ls\Replication\Model\ReplDiscountSearchResults $replDiscounts */
                    $replDiscountsTotal = $this->replDiscountRepository->getList($criteriaTotal);
                    if (count($replDiscountsTotal->getItems()) == 0) {
                        $this->replicationHelper->updateCronStatus(true, LSR::SC_SUCCESS_CRON_DISCOUNT);
                    } else {
                        $this->replicationHelper->updateCronStatus(false, LSR::SC_SUCCESS_CRON_DISCOUNT);
                    }
                }
            }
        } else {
            $this->logger->debug("Discount Replication cron fails because product 
            replication cron not executed successfully.");
        }
    }

    /**
     * @return array
     */
    public function executeManually()
    {
        $discountsLeftToProcess = 0;
        $this->execute();
        return [$discountsLeftToProcess];
    }

    /**
     * @param \Ls\Replication\Model\ReplDiscount $replDiscount
     * @param array $skuArray
     * @param $customerGroupIds
     */
    public function addSalesRule(\Ls\Replication\Model\ReplDiscount $replDiscount, array $skuArray, $customerGroupIds)
    {

        if ($replDiscount instanceof \Ls\Replication\Model\ReplDiscount) {
            $websiteIds = $this->replicationHelper->getAllWebsitesIds();
            $rule = $this->ruleFactory->create();

            // create root conditions to match with all child conditions
            $conditions["1"] =
                [
                    "type" => "Magento\CatalogRule\Model\Rule\Condition\Combine",
                    "aggregator" => "all",
                    "value" => 1,
                    "new_child" => ""
                ];

            $conditions["1--1"] =
                [
                    "type" => "Magento\CatalogRule\Model\Rule\Condition\Product",
                    "attribute" => "sku",
                    "operator" => "()",
                    "value" => implode(',', $skuArray)
                ];

            $rule->setName($replDiscount->getOfferNo())
                ->setDescription($replDiscount->getOfferNo())
                ->setIsActive(1)
                ->setCustomerGroupIds($customerGroupIds)
                ->setWebsiteIds($websiteIds)
                ->setFromDate($replDiscount->getFromDate());

            // Discounts for aspecific time.
            if (strtolower($replDiscount->getToDate()) != strtolower('1753-01-01T00:00:00')) {
                $rule->setToDate($replDiscount->getToDate());
            }
            $rule->setSimpleAction('by_percent')//THis is fixed from Omni so we dont have to change
            ->setDiscountAmount($replDiscount->getDiscountValue())
                ->setStopRulesProcessing(1)
                // NAV only allow one preactive discount at the time,
                // so yes we dont need this dynamic from Nav.
                ->setSortOrder($replDiscount->getPriorityNo());

            /**
             * Default Values for Action Types.
             * by_percent
             * by_fixed
             * to_percent
             * to_fixed.
             *
             */
            $rule->setData('conditions', $conditions);
            // @codingStandardsIgnoreStart
            $validateResult = $rule->validateData(new \Magento\Framework\DataObject($rule->getData()));
            // @codingStandardsIgnoreEnd
            if ($validateResult !== true) {
                foreach ($validateResult as $errorMessage) {
                    $this->logger->debug($errorMessage);
                }
                return;
            }
            try {
                $rule->loadPost($rule->getData());
                $rule->save();
            } catch (\Exception $e) {
                $this->logger->debug($e->getMessage());
            }
        }
    }

    /**
     * @return array|\Ls\Replication\Model\ResourceModel\ReplDiscount\Collection
     */
    public function getUniquePublishedOffers()
    {

        $publishedOfferIds = [];
        /** @var  \Ls\Replication\Model\ResourceModel\ReplDiscount\Collection $collection */
        $collection = $this->replDiscountCollection->create();
        $collection->getSelect()
            ->columns('OfferNo')
            ->group('OfferNo');
        if ($collection->getSize() > 0) {
            return $collection;
        }
        return $publishedOfferIds;
    }
}
