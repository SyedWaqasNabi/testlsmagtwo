<?php

namespace Ls\Replication\Ui\DataProvider;

use Exception;
use \Ls\Core\Model\LSR;
use \Ls\Replication\Helper\ReplicationHelper;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Module\Dir\Reader;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProviderInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Reporting;
use Magento\Framework\Xml\Parser;
use Magento\Store\Model\System\Store as StoreManager;
use Magento\Ui\DataProvider\AddFieldToCollectionInterface;
use Magento\Ui\DataProvider\AddFilterToCollectionInterface;

/**
 * Class ProductDataProvider
 */
class CronsProvider extends DataProvider implements DataProviderInterface
{

    /**
     * @var AddFieldToCollectionInterface[]
     */
    public $addFieldStrategies;

    /**
     * @var AddFilterToCollectionInterface[]
     */
    public $addFilterStrategies;

    /**
     * @var Http
     */
    public $request;
    /**
     * @var Reader
     */
    public $moduleDirReader;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    public $storeManager;

    /** @var LSR */
    public $lsr;

    /**
     * @var Parser
     */
    private $parser;

    /** @var ReplicationHelper */
    public $rep_helper;

    /**
     * CronsProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Reporting $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param Reader $moduleDirReader
     * @param Parser $parser
     * @param FilterBuilder $filterBuilder
     * @param StoreManager $storeManager
     * @param LSR $lsr
     * @param ReplicationHelper $repHelper
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Reporting $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        Reader $moduleDirReader,
        Parser $parser,
        FilterBuilder $filterBuilder,
        StoreManager $storeManager,
        LSR $lsr,
        ReplicationHelper $repHelper,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
        $this->request         = $request;
        $this->moduleDirReader = $moduleDirReader;
        $this->parser          = $parser;
        $this->lsr             = $lsr;
        $this->filterBuilder   = $filterBuilder;
        $this->rep_helper      = $repHelper;
        $this->storeManager    = $storeManager;
    }

    /**
     * @return array|mixed
     * @throws Exception
     */
    public function getData()
    {
        $cronsGroupListing = $this->readCronFile();
        $items             = [];
        $counter           = 1;
        $this->rep_helper->flushByTypeCode('config');
        $storeId = $this->request->getParam('store');
        if (empty($storeId)) {
            $storeId = 1;
        }
        foreach ($cronsGroupListing as $cronlist) {
            $path = '';
            if (array_key_exists('_value', $cronlist['_value']['job'])) {
                $cronlist['_value']['job'] = [$cronlist['_value']['job']];
            }
            if ($cronlist['_attribute']['id'] == "replication" || $cronlist['_attribute']['id'] == "sync_operations") {
                $condition = __('Flat to Magento');
            } elseif ($cronlist['_attribute']['id'] == "flat_replication") {
                $condition = __('Omni to Flat');
                $path      = LSR::CRON_STATUS_PATH_PREFIX;
            } else {
                $condition = '';
            }
            foreach ($cronlist['_value']['job'] as $joblist) {
                $fullReplicationStatus = 0;
                $cronName              = $joblist['_attribute']['name'];
                if ($path != '') {
                    $pathNew               = $path . $cronName;
                    $fullReplicationStatus = $this->lsr->getStoreConfig($pathNew, $storeId);
                }
                if ($cronName == 'repl_attributes') {
                    $cronAttributeCheck        = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_ATTRIBUTE, $storeId);
                    $cronAttributeVariantCheck = $this->lsr->getStoreConfig(
                        LSR::SC_SUCCESS_CRON_ATTRIBUTE_VARIANT,
                        $storeId
                    );
                    if ($cronAttributeCheck && $cronAttributeVariantCheck) {
                        $fullReplicationStatus = 1;
                    }
                }
                if ($cronName == 'repl_category') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_CATEGORY, $storeId);
                }
                if ($cronName == 'repl_products') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_PRODUCT, $storeId);
                }
                if ($cronName == 'repl_discount_create') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_DISCOUNT, $storeId);
                }
                if ($cronName == 'repl_data_translation_to_magento') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_DATA_TRANSLATION_TO_MAGENTO, $storeId);
                }
                if ($cronName == 'repl_price_sync') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_PRODUCT_PRICE, $storeId);
                }
                if ($cronName == 'repl_inventory_sync') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(
                        LSR::SC_SUCCESS_CRON_PRODUCT_INVENTORY,
                        $storeId
                    );
                }
                if ($cronName == 'repl_item_updates_sync') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_ITEM_UPDATES, $storeId);
                }
                if ($cronName == 'repl_item_images_sync') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(LSR::SC_SUCCESS_CRON_ITEM_IMAGES, $storeId);
                }
                if ($cronName == 'repl_attributes_value_sync') {
                    $fullReplicationStatus = $this->lsr->getStoreConfig(
                        LSR::SC_SUCCESS_CRON_ATTRIBUTES_VALUE,
                        $storeId
                    );
                }
                $lastExecute = $this->rep_helper->convertDateTimeIntoCurrentTimeZone(
                    $this->lsr->getStoreConfig('ls_mag/replication/last_execute_' . $cronName, $storeId),
                    'd M, Y h:i:s A'
                );
                $statusStr   = ($fullReplicationStatus == 1) ?
                    '<div class="flag-green custom-grid-flag">Complete</div>' :
                    '<div class="flag-yellow custom-grid-flag">Pending</div>';
                if (strpos($cronName, '_reset') !== false || $cronName == "sync_version" ||
                    $cronName == "sync_orders" || $cronName == "sync_customers") {
                    $condition = $statusStr = '';
                }
                $items[] = [
                    'id'                    => $counter,
                    'store'                 => $this->storeManager->getStoreName($storeId),
                    'storeId'               => $storeId,
                    'fullreplicationstatus' => $statusStr,
                    'label'                 => $cronName,
                    'lastexecuted'          => $lastExecute,
                    'value'                 => $joblist['_attribute']['instance'],
                    'condition'             => $condition
                ];
                $counter++;
            }
        }
        // @codingStandardsIgnoreStart
        $pageSize    = (int)$this->request->getParam('paging')['pageSize'];
        $pageCurrent = (int)$this->request->getParam('paging')['current'];
        // @codingStandardsIgnoreEnd
        $pageOffset = ($pageCurrent - 1) * $pageSize;

        return [
            'totalRecords' => count($items),
            'items'        => array_slice($items, $pageOffset, $pageOffset + $pageSize)
        ];
    }

    /**
     * @return mixed
     */
    public function readCronFile()
    {
        try {
            $filePath    = $this->moduleDirReader->getModuleDir('etc', 'Ls_Replication') . '/crontab.xml';
            $parsedArray = $this->parser->load($filePath)->xmlToArray();
            return $parsedArray['config']['_value']['group'];
        } catch (Exception $e) {
        }
    }

    public function prepareUpdateUrl()
    {
        if (!isset($this->data['config']['filter_url_params'])) {
            return;
        }
        foreach ($this->data['config']['filter_url_params'] as $paramName => $paramValue) {
            if ('*' == $paramValue) {
                $paramValue = $this->request->getParam($paramName);
            }
            if ($paramValue) {
                $this->data['config']['update_url'] = sprintf(
                    '%s%s/%s',
                    $this->data['config']['update_url'],
                    $paramName,
                    $paramValue
                );
                $this->addFilter(
                    $this->filterBuilder->setField($paramName)->setValue($paramValue)->setConditionType('eq')->create()
                );
            }
        }
    }
}
