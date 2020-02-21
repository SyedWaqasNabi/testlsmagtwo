<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Replication\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Ls\Replication\Api\Data\ReplLoyVendorItemMappingInterface;

class ReplLoyVendorItemMapping extends AbstractModel implements ReplLoyVendorItemMappingInterface, IdentityInterface
{

    const CACHE_TAG = 'ls_replication_repl_loy_vendor_item_mapping';

    protected $_cacheTag = 'ls_replication_repl_loy_vendor_item_mapping';

    protected $_eventPrefix = 'ls_replication_repl_loy_vendor_item_mapping';

    /**
     * @property boolean $Deleted
     */
    protected $Deleted = null;

    /**
     * @property int $DisplayOrder
     */
    protected $DisplayOrder = null;

    /**
     * @property boolean $IsDeleted
     */
    protected $IsDeleted = null;

    /**
     * @property boolean $IsFeaturedProduct
     */
    protected $IsFeaturedProduct = null;

    /**
     * @property string $NavManufacturerId
     */
    protected $NavManufacturerId = null;

    /**
     * @property string $NavManufacturerItemId
     */
    protected $NavManufacturerItemId = null;

    /**
     * @property string $NavProductId
     */
    protected $NavProductId = null;

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
        $this->_init( 'Ls\Replication\Model\ResourceModel\ReplLoyVendorItemMapping' );
    }

    public function getIdentities()
    {
        return [ self::CACHE_TAG . '_' . $this->getId() ];
    }

    /**
     * @param boolean $Deleted
     * @return $this
     */
    public function setDeleted($Deleted)
    {
        $this->setData( 'Deleted', $Deleted );
        $this->Deleted = $Deleted;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->getData( 'Deleted' );
    }

    /**
     * @param int $DisplayOrder
     * @return $this
     */
    public function setDisplayOrder($DisplayOrder)
    {
        $this->setData( 'DisplayOrder', $DisplayOrder );
        $this->DisplayOrder = $DisplayOrder;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return int
     */
    public function getDisplayOrder()
    {
        return $this->getData( 'DisplayOrder' );
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
     * @param boolean $IsFeaturedProduct
     * @return $this
     */
    public function setIsFeaturedProduct($IsFeaturedProduct)
    {
        $this->setData( 'IsFeaturedProduct', $IsFeaturedProduct );
        $this->IsFeaturedProduct = $IsFeaturedProduct;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsFeaturedProduct()
    {
        return $this->getData( 'IsFeaturedProduct' );
    }

    /**
     * @param string $NavManufacturerId
     * @return $this
     */
    public function setNavManufacturerId($NavManufacturerId)
    {
        $this->setData( 'NavManufacturerId', $NavManufacturerId );
        $this->NavManufacturerId = $NavManufacturerId;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getNavManufacturerId()
    {
        return $this->getData( 'NavManufacturerId' );
    }

    /**
     * @param string $NavManufacturerItemId
     * @return $this
     */
    public function setNavManufacturerItemId($NavManufacturerItemId)
    {
        $this->setData( 'NavManufacturerItemId', $NavManufacturerItemId );
        $this->NavManufacturerItemId = $NavManufacturerItemId;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getNavManufacturerItemId()
    {
        return $this->getData( 'NavManufacturerItemId' );
    }

    /**
     * @param string $NavProductId
     * @return $this
     */
    public function setNavProductId($NavProductId)
    {
        $this->setData( 'NavProductId', $NavProductId );
        $this->NavProductId = $NavProductId;
        $this->setDataChanges( TRUE );
        return $this;
    }

    /**
     * @return string
     */
    public function getNavProductId()
    {
        return $this->getData( 'NavProductId' );
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

