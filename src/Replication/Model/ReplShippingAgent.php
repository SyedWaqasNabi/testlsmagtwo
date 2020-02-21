<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Replication\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Ls\Replication\Api\Data\ReplShippingAgentInterface;

class ReplShippingAgent extends AbstractModel implements ReplShippingAgentInterface, IdentityInterface
{

    const CACHE_TAG = 'ls_replication_repl_shipping_agent';

    protected $_cacheTag = 'ls_replication_repl_shipping_agent';

    protected $_eventPrefix = 'ls_replication_repl_shipping_agent';

    /**
     * @property ArrayOfShippingAgentService $Services
     */
    protected $Services = null;

    /**
     * @property string $AccountNo
     */
    protected $AccountNo = null;

    /**
     * @property string $nav_id
     */
    protected $nav_id = null;

    /**
     * @property string $InternetAddress
     */
    protected $InternetAddress = null;

    /**
     * @property boolean $IsDeleted
     */
    protected $IsDeleted = null;

    /**
     * @property string $Name
     */
    protected $Name = null;

    /**
     * @property string $scope
     */
    protected $scope = null;

    /**
     * @property int $scope_id
     */
    protected $scope_id = null;

    /**
     * @property boolean $processed
     */
    protected $processed = null;

    /**
     * @property boolean $is_updated
     */
    protected $is_updated = null;

    /**
     * @property boolean $is_failed
     */
    protected $is_failed = null;

    /**
     * @property string $created_at
     */
    protected $created_at = null;

    /**
     * @property string $updated_at
     */
    protected $updated_at = null;

    /**
     * @property string $processed_at
     */
    protected $processed_at = null;

    public function _construct()
    {
        $this->_init( 'Ls\Replication\Model\ResourceModel\ReplShippingAgent' );
    }

    public function getIdentities()
    {
        return [ self::CACHE_TAG . '_' . $this->getId() ];
    }

    /**
     * @param ArrayOfShippingAgentService $Services
     * @return $this
     */
    public function setServices($Services)
    {
        $this->setData( 'Services', $Services );
        $this->Services = $Services;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return ArrayOfShippingAgentService
     */
    public function getServices()
    {
        return $this->getData( 'Services' );
    }

    /**
     * @param string $AccountNo
     * @return $this
     */
    public function setAccountNo($AccountNo)
    {
        $this->setData( 'AccountNo', $AccountNo );
        $this->AccountNo = $AccountNo;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNo()
    {
        return $this->getData( 'AccountNo' );
    }

    /**
     * @param string $nav_id
     * @return $this
     */
    public function setNavId($nav_id)
    {
        $this->setData( 'nav_id', $nav_id );
        $this->nav_id = $nav_id;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getNavId()
    {
        return $this->getData( 'nav_id' );
    }

    /**
     * @param string $InternetAddress
     * @return $this
     */
    public function setInternetAddress($InternetAddress)
    {
        $this->setData( 'InternetAddress', $InternetAddress );
        $this->InternetAddress = $InternetAddress;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getInternetAddress()
    {
        return $this->getData( 'InternetAddress' );
    }

    /**
     * @param boolean $IsDeleted
     * @return $this
     */
    public function setIsDeleted($IsDeleted)
    {
        $this->setData( 'IsDeleted', $IsDeleted );
        $this->IsDeleted = $IsDeleted;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->getData( 'IsDeleted' );
    }

    /**
     * @param string $Name
     * @return $this
     */
    public function setName($Name)
    {
        $this->setData( 'Name', $Name );
        $this->Name = $Name;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData( 'Name' );
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->setData( 'scope', $scope );
        $this->scope = $scope;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->getData( 'scope' );
    }

    /**
     * @param int $scope_id
     * @return $this
     */
    public function setScopeId($scope_id)
    {
        $this->setData( 'scope_id', $scope_id );
        $this->scope_id = $scope_id;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return int
     */
    public function getScopeId()
    {
        return $this->getData( 'scope_id' );
    }

    /**
     * @param boolean $processed
     * @return $this
     */
    public function setProcessed($processed)
    {
        $this->setData( 'processed', $processed );
        $this->processed = $processed;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return boolean
     */
    public function getProcessed()
    {
        return $this->getData( 'processed' );
    }

    /**
     * @param boolean $is_updated
     * @return $this
     */
    public function setIsUpdated($is_updated)
    {
        $this->setData( 'is_updated', $is_updated );
        $this->is_updated = $is_updated;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsUpdated()
    {
        return $this->getData( 'is_updated' );
    }

    /**
     * @param boolean $is_failed
     * @return $this
     */
    public function setIsFailed($is_failed)
    {
        $this->setData( 'is_failed', $is_failed );
        $this->is_failed = $is_failed;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsFailed()
    {
        return $this->getData( 'is_failed' );
    }

    /**
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->setData( 'created_at', $created_at );
        $this->created_at = $created_at;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData( 'created_at' );
    }

    /**
     * @param string $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->setData( 'updated_at', $updated_at );
        $this->updated_at = $updated_at;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData( 'updated_at' );
    }

    /**
     * @param string $processed_at
     * @return $this
     */
    public function setProcessedAt($processed_at)
    {
        $this->setData( 'processed_at', $processed_at );
        $this->processed_at = $processed_at;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getProcessedAt()
    {
        return $this->getData( 'processed_at' );
    }


}

