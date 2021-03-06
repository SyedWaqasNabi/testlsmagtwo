<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class OrderHospDealLineItem extends Entity
{

    /**
     * @property ArrayOfOrderHospModifierLine $ModifierLines
     */
    protected $ModifierLines = null;

    /**
     * @property ArrayOfOrderHospTextModifierLine $TextModifierLines
     */
    protected $TextModifierLines = null;

    /**
     * @property string $DealModLine
     */
    protected $DealModLine = null;

    /**
     * @property string $Description
     */
    protected $Description = null;

    /**
     * @property float $DiscountAmount
     */
    protected $DiscountAmount = null;

    /**
     * @property float $DiscountPercent
     */
    protected $DiscountPercent = null;

    /**
     * @property string $ExternalIdRO
     */
    protected $ExternalIdRO = null;

    /**
     * @property string $ExternalLineNumberRO
     */
    protected $ExternalLineNumberRO = null;

    /**
     * @property string $KitchenStatusCodeRO
     */
    protected $KitchenStatusCodeRO = null;

    /**
     * @property string $KitchenStatusRO
     */
    protected $KitchenStatusRO = null;

    /**
     * @property int $LineNumber
     */
    protected $LineNumber = null;

    /**
     * @property float $NetAmount
     */
    protected $NetAmount = null;

    /**
     * @property float $NetPrice
     */
    protected $NetPrice = null;

    /**
     * @property float $Price
     */
    protected $Price = null;

    /**
     * @property float $PriceAdjustment
     */
    protected $PriceAdjustment = null;

    /**
     * @property float $Quantity
     */
    protected $Quantity = null;

    /**
     * @property float $TAXAmount
     */
    protected $TAXAmount = null;

    /**
     * @param ArrayOfOrderHospModifierLine $ModifierLines
     * @return $this
     */
    public function setModifierLines($ModifierLines)
    {
        $this->ModifierLines = $ModifierLines;
        return $this;
    }

    /**
     * @return ArrayOfOrderHospModifierLine
     */
    public function getModifierLines()
    {
        return $this->ModifierLines;
    }

    /**
     * @param ArrayOfOrderHospTextModifierLine $TextModifierLines
     * @return $this
     */
    public function setTextModifierLines($TextModifierLines)
    {
        $this->TextModifierLines = $TextModifierLines;
        return $this;
    }

    /**
     * @return ArrayOfOrderHospTextModifierLine
     */
    public function getTextModifierLines()
    {
        return $this->TextModifierLines;
    }

    /**
     * @param string $DealModLine
     * @return $this
     */
    public function setDealModLine($DealModLine)
    {
        $this->DealModLine = $DealModLine;
        return $this;
    }

    /**
     * @return string
     */
    public function getDealModLine()
    {
        return $this->DealModLine;
    }

    /**
     * @param string $Description
     * @return $this
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param float $DiscountAmount
     * @return $this
     */
    public function setDiscountAmount($DiscountAmount)
    {
        $this->DiscountAmount = $DiscountAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountAmount()
    {
        return $this->DiscountAmount;
    }

    /**
     * @param float $DiscountPercent
     * @return $this
     */
    public function setDiscountPercent($DiscountPercent)
    {
        $this->DiscountPercent = $DiscountPercent;
        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountPercent()
    {
        return $this->DiscountPercent;
    }

    /**
     * @param string $ExternalIdRO
     * @return $this
     */
    public function setExternalIdRO($ExternalIdRO)
    {
        $this->ExternalIdRO = $ExternalIdRO;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalIdRO()
    {
        return $this->ExternalIdRO;
    }

    /**
     * @param string $ExternalLineNumberRO
     * @return $this
     */
    public function setExternalLineNumberRO($ExternalLineNumberRO)
    {
        $this->ExternalLineNumberRO = $ExternalLineNumberRO;
        return $this;
    }

    /**
     * @return string
     */
    public function getExternalLineNumberRO()
    {
        return $this->ExternalLineNumberRO;
    }

    /**
     * @param string $KitchenStatusCodeRO
     * @return $this
     */
    public function setKitchenStatusCodeRO($KitchenStatusCodeRO)
    {
        $this->KitchenStatusCodeRO = $KitchenStatusCodeRO;
        return $this;
    }

    /**
     * @return string
     */
    public function getKitchenStatusCodeRO()
    {
        return $this->KitchenStatusCodeRO;
    }

    /**
     * @param string $KitchenStatusRO
     * @return $this
     */
    public function setKitchenStatusRO($KitchenStatusRO)
    {
        $this->KitchenStatusRO = $KitchenStatusRO;
        return $this;
    }

    /**
     * @return string
     */
    public function getKitchenStatusRO()
    {
        return $this->KitchenStatusRO;
    }

    /**
     * @param int $LineNumber
     * @return $this
     */
    public function setLineNumber($LineNumber)
    {
        $this->LineNumber = $LineNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getLineNumber()
    {
        return $this->LineNumber;
    }

    /**
     * @param float $NetAmount
     * @return $this
     */
    public function setNetAmount($NetAmount)
    {
        $this->NetAmount = $NetAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getNetAmount()
    {
        return $this->NetAmount;
    }

    /**
     * @param float $NetPrice
     * @return $this
     */
    public function setNetPrice($NetPrice)
    {
        $this->NetPrice = $NetPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getNetPrice()
    {
        return $this->NetPrice;
    }

    /**
     * @param float $Price
     * @return $this
     */
    public function setPrice($Price)
    {
        $this->Price = $Price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->Price;
    }

    /**
     * @param float $PriceAdjustment
     * @return $this
     */
    public function setPriceAdjustment($PriceAdjustment)
    {
        $this->PriceAdjustment = $PriceAdjustment;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceAdjustment()
    {
        return $this->PriceAdjustment;
    }

    /**
     * @param float $Quantity
     * @return $this
     */
    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }

    /**
     * @param float $TAXAmount
     * @return $this
     */
    public function setTAXAmount($TAXAmount)
    {
        $this->TAXAmount = $TAXAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTAXAmount()
    {
        return $this->TAXAmount;
    }


}

