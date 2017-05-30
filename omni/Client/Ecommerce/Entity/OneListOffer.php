<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

class OneListOffer
{

    /**
     * @property string $CreateDate
     */
    protected $CreateDate = null;

    /**
     * @property int $DisplayOrderId
     */
    protected $DisplayOrderId = null;

    /**
     * @property Offer $Offer
     */
    protected $Offer = null;

    /**
     * @param string $CreateDate
     * @return $this
     */
    public function setCreateDate($CreateDate)
    {
        $this->CreateDate = $CreateDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreateDate()
    {
        return $this->CreateDate;
    }

    /**
     * @param int $DisplayOrderId
     * @return $this
     */
    public function setDisplayOrderId($DisplayOrderId)
    {
        $this->DisplayOrderId = $DisplayOrderId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDisplayOrderId()
    {
        return $this->DisplayOrderId;
    }

    /**
     * @param Offer $Offer
     * @return $this
     */
    public function setOffer($Offer)
    {
        $this->Offer = $Offer;
        return $this;
    }

    /**
     * @return Offer
     */
    public function getOffer()
    {
        return $this->Offer;
    }


}
