<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Replication\Cron;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Config\Model\ResourceModel\Config;
use Ls\Core\Helper\Data as LsHelper;
use Ls\Replication\Helper\ReplicationHelper;
use Ls\Omni\Client\Ecommerce\Entity\ReplRequest;
use Ls\Omni\Client\Ecommerce\Operation\ReplEcommDiscounts;
use Ls\Replication\Api\ReplDiscountRepositoryInterface as ReplDiscountRepository;
use Ls\Replication\Model\ReplDiscountFactory;
use Ls\Replication\Api\Data\ReplDiscountInterface;

class ReplEcommDiscountsTask extends AbstractReplicationTask
{

    const JOB_CODE = 'replication_repl_discount';

    const CONFIG_PATH = 'ls_mag/replication/repl_discount';

    const CONFIG_PATH_STATUS = 'ls_mag/replication/status_repl_discount';

    const CONFIG_PATH_LAST_EXECUTE = 'ls_mag/replication/last_execute_repl_discount';

    /**
     * @property ReplDiscountRepository $repository
     */
    protected $repository = null;

    /**
     * @property ReplDiscountFactory $factory
     */
    protected $factory = null;

    /**
     * @property ReplDiscountInterface $data_interface
     */
    protected $data_interface = null;

    /**
     * @param ReplDiscountRepository $repository
     * @return $this
     */
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return ReplDiscountRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param ReplDiscountFactory $factory
     * @return $this
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * @return ReplDiscountFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param ReplDiscountInterface $data_interface
     * @return $this
     */
    public function setDataInterface($data_interface)
    {
        $this->data_interface = $data_interface;
        return $this;
    }

    /**
     * @return ReplDiscountInterface
     */
    public function getDataInterface()
    {
        return $this->data_interface;
    }

    public function __construct(ScopeConfigInterface $scope_config, Config $resource_config, LoggerInterface $logger, LsHelper $helper, ReplicationHelper $repHelper, ReplDiscountFactory $factory, ReplDiscountRepository $repository, ReplDiscountInterface $data_interface)
    {
        parent::__construct($scope_config, $resource_config, $logger, $helper, $repHelper);
        $this->repository = $repository;
        $this->factory = $factory;
        $this->data_interface = $data_interface;
    }

    public function makeRequest($last_key, $full_replication = false, $batchsize = 100, $storeId = '')
    {
        $request = new ReplEcommDiscounts();
        $request->getOperationInput()
                 ->setReplRequest( ( new ReplRequest() )->setBatchSize($batchsize)
                                                        ->setFullReplication($full_replication)
                                                        ->setLastKey($last_key)
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

    public function getMainEntity()
    {
        return $this->data_interface;
    }


}

