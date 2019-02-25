<?php

namespace Ls\Omni\Helper;

use \Ls\Omni\Client\Ecommerce\Entity;
use \Ls\Omni\Client\Ecommerce\Operation;
use \Ls\Core\Model\LSR;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class LoyaltyHelper
 * @package Ls\Omni\Helper
 */
class LoyaltyHelper extends \Magento\Framework\App\Helper\AbstractHelper
{

    const SERVICE_TYPE = 'ecommerce';

    /** @var \Magento\Framework\Api\FilterBuilder */
    public $filterBuilder;

    /** @var \Magento\Framework\Api\SearchCriteriaBuilder */
    public $searchCriteriaBuilder;

    /** @var \Magento\Store\Model\StoreManagerInterface */
    public $storeManager;

    /** @var \Magento\Customer\Api\CustomerRepositoryInterface */
    public $customerRepository;

    /** @var \Magento\Customer\Model\CustomerFactory */
    public $customerFactory;

    /**
     * @var \Magento\Customer\Model\Session\Proxy
     */
    public $customerSession;

    /** @var null */
    public $ns = null;

    /** @var \Magento\Framework\Filesystem */
    public $filesystem;

    /**
     * LoyaltyHelper constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Customer\Model\CustomerFactory $customerFactory
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param \Magento\Framework\Filesystem $Filesystem
     */

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        \Magento\Framework\Filesystem $Filesystem
    ) {
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storeManager = $storeManager;
        $this->customerRepository = $customerRepository;
        $this->customerFactory = $customerFactory;
        $this->customerSession = $customerSession;
        $this->filesystem = $Filesystem;

        parent::__construct(
            $context
        );
    }

    /**
     * @return Entity\ArrayOfProfile|Entity\ProfilesGetAllResponse|\Ls\Omni\Client\ResponseInterface|null
     */
    public function getAllProfiles()
    {
        $response = null;
        // @codingStandardsIgnoreStart
        $request = new Operation\ProfilesGetAll();
        $entity = new Entity\ProfilesGetAll();
        // @codingStandardsIgnoreEnd
        try {
            $response = $request->execute($entity);
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return $response ? $response->getResult() : $response;
    }

    /**
     * @return Entity\ArrayOfPublishedOffer|Entity\PublishedOffersGetByCardIdResponse|\Ls\Omni\Client\ResponseInterface|null
     */
    public function getOffers()
    {

        $response = null;
        $customer = $this->customerSession->getCustomer();
        // @codingStandardsIgnoreLine
        $request = new Operation\PublishedOffersGetByCardId();
        $request->setToken($customer->getData('lsr_token'));
        // @codingStandardsIgnoreLine
        $entity = new Entity\PublishedOffersGetByCardId();
        $entity->setCardId($customer->getData('lsr_cardid'));

        try {
            $response = $request->execute($entity);
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return $response ? $response->getResult() : $response;
    }

    /**
     * @param null $image_id
     * @param null $image_size
     * @return Entity\ImageGetByIdResponse|Entity\ImageView|\Ls\Omni\Client\ResponseInterface|null
     */
    public function getImageById($image_id = null, $image_size = null)
    {

        $response = null;
        if ($image_id == null || $image_size == null) {
            return $response;
        }
        // @codingStandardsIgnoreStart
        $request = new Operation\ImageGetById();
        $entity = new Entity\ImageGetById();
        // @codingStandardsIgnoreEnd
        $entity->setId($image_id)
            ->setImageSize($image_size);

        try {
            $response = $request->execute($entity);
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return $response ? $response->getResult() : $response;
    }

    /**
     * @return float|int
     */
    public function convertPointsIntoValues()
    {

        $points = $pointrate = $value = 0;

        /* \Ls\Omni\Client\Ecommerce\Entity\MemberContact $memberProfile */
        $memberProfile = $this->getMemberInfo();
        $pointrate = $this->getPointRate();

        // check if we have something in there.
        if ($memberProfile!=null and $pointrate!=null) {
            $points = $memberProfile->getAccount()->getPointBalance();
            $value = $points * $pointrate;
            return $value;
        } else {
            // if no then just return 0 value
            return 0;
        }
    }

    /**
     * @return Entity\ContactGetByIdResponse|Entity\MemberContact|\Ls\Omni\Client\ResponseInterface|null
     */
    public function getMemberInfo()
    {

        $response = null;
        $customer = $this->customerSession->getCustomer();
        $lsrId = $this->customerSession->getData(LSR::SESSION_CUSTOMER_LSRID);
        // if not set in seesion then get it from customer database.
        if (!$lsrId) {
            $lsrId = $customer->getData('lsr_id');
        }
        // @codingStandardsIgnoreLine
        $request = new Operation\ContactGetById();
        $request->setToken($customer->getData('lsr_token'));
        // @codingStandardsIgnoreLine
        $entity = new Entity\ContactGetById();
        $entity->setContactId($lsrId);

        try {
            $response = $request->execute($entity);
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return $response ? $response->getResult() : $response;
    }

    /*
     * Convert Point Rate into Values
     */

    /**
     * @return float|Entity\GetPointRateResponse|\Ls\Omni\Client\ResponseInterface|null
     */
    public function getPointRate()
    {
        $response = null;
        // @codingStandardsIgnoreStart
        $request = new Operation\GetPointRate();
        $entity = new Entity\GetPointRate();
        // @codingStandardsIgnoreEnd
        try {
            $response = $request->execute($entity);
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
        }
        return $response ? $response->getResult() : $response;
    }

    /**
     * @param null $size
     * @return Entity\ImageSize
     */
    public function getImageSize($size = null)
    {
        // @codingStandardsIgnoreLine
        $imagesize = new Entity\ImageSize();
        $imagesize->setHeight($size['height'])
            ->setWidth($size['width']);
        return $imagesize;
    }

    /**
     * @return string
     */
    public function getMediaPathtoStore()
    {
        return $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
    }
}
