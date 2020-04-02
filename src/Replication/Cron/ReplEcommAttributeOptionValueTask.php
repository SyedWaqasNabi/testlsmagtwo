<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Replication\Cron;

use Ls\Replication\Logger\Logger;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Config\Model\ResourceModel\Config;
use Ls\Core\Helper\Data as LsHelper;
use Ls\Replication\Helper\ReplicationHelper;
use Ls\Omni\Client\Ecommerce\Entity\ReplRequest;
use Ls\Omni\Client\Ecommerce\Operation\ReplEcommAttributeOptionValue;
use Ls\Replication\Api\ReplAttributeOptionValueRepositoryInterface as ReplAttributeOptionValueRepository;
use Ls\Replication\Model\ReplAttributeOptionValueFactory;
use Ls\Replication\Api\Data\ReplAttributeOptionValueInterface;

class ReplEcommAttributeOptionValueTask extends AbstractReplicationTask
{

    const JOB_CODE = 'replication_repl_attribute_option_value';

    const CONFIG_PATH = 'ls_mag/replication/repl_attribute_option_value';

    const CONFIG_PATH_STATUS = 'ls_mag/replication/status_repl_attribute_option_value';

    const CONFIG_PATH_LAST_EXECUTE = 'ls_mag/replication/last_execute_repl_attribute_option_value';

    const CONFIG_PATH_MAX_KEY = 'ls_mag/replication/max_key_repl_attribute_option_value';

    /**
     * @property ReplAttributeOptionValueRepository $repository
     */
    protected $repository = null;

    /**
     * @property ReplAttributeOptionValueFactory $factory
     */
    protected $factory = null;

    /**
     * @property ReplAttributeOptionValueInterface $data_interface
     */
    protected $data_interface = null;

    /**
     * @param ReplAttributeOptionValueRepository $repository
     * @return $this
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return ReplAttributeOptionValueRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param ReplAttributeOptionValueFactory $factory
     * @return $this
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * @return ReplAttributeOptionValueFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param ReplAttributeOptionValueInterface $data_interface
     * @return $this
     */
    public function setDataInterface($data_interface)
    {
        $this->data_interface = $data_interface;
        return $this;
    }

    /**
     * @return ReplAttributeOptionValueInterface
     */
    public function getDataInterface()
    {
        return $this->data_interface;
    }

    public function __construct(ScopeConfigInterface $scope_config, Config $resource_config, Logger $logger, LsHelper $helper, ReplicationHelper $repHelper, ReplAttributeOptionValueFactory $factory, ReplAttributeOptionValueRepository $repository, ReplAttributeOptionValueInterface $data_interface)
    {
        parent::__construct($scope_config, $resource_config, $logger, $helper, $repHelper);
        $this->repository = $repository;
        $this->factory = $factory;
        $this->data_interface = $data_interface;
    }

    public function makeRequest($lastKey, $fullReplication = false, $batchSize = 100, $storeId = '', $maxKey = '', $baseUrl = '')
    {
        $request = new ReplEcommAttributeOptionValue($baseUrl);
        $request->getOperationInput()
                 ->setReplRequest( ( new ReplRequest() )->setBatchSize($batchSize)
                                                        ->setFullReplication($fullReplication)
                                                        ->setLastKey($lastKey)
                                                        ->setMaxKey($maxKey)
                                                        ->setStoreId($storeId));
        return $request;
    }

    public function getConfigPath()
    {
        return self::CONFIG_PATH;
    }

    public function getConfigPathStatus()
    {
        return self::CONFIG_PATH_STATUS;
    }

    public function getConfigPathLastExecute()
    {
        return self::CONFIG_PATH_LAST_EXECUTE;
    }

    public function getConfigPathMaxKey()
    {
        return self::CONFIG_PATH_MAX_KEY;
    }

    public function getMainEntity()
    {
        return $this->data_interface;
    }


}

