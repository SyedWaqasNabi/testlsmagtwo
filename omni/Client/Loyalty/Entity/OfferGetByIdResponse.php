<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\IResponse;

class OfferGetByIdResponse implements IResponse
{

    /**
     * @property Offer $OfferGetByIdResult
     */
    protected $OfferGetByIdResult = null;

    /**
     * @param Offer $OfferGetByIdResult
     * @return $this
     */
    public function setOfferGetByIdResult($OfferGetByIdResult)
    {
        $this->OfferGetByIdResult = $OfferGetByIdResult;
        return $this;
    }

    /**
     * @return Offer
     */
    public function getOfferGetByIdResult()
    {
        return $this->OfferGetByIdResult;
    }

    /**
     * @return Offer
     */
    public function getResult()
    {
        return $this->OfferGetByIdResult;
    }


}
