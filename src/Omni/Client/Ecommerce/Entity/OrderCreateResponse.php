<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\ResponseInterface;

class OrderCreateResponse implements ResponseInterface
{

    /**
     * @property SalesEntry $OrderCreateResult
     */
    protected $OrderCreateResult = null;

    /**
     * @param SalesEntry $OrderCreateResult
     * @return $this
     */
    public function setOrderCreateResult($OrderCreateResult)
    {
        $this->OrderCreateResult = $OrderCreateResult;
        return $this;
    }

    /**
     * @return SalesEntry
     */
    public function getOrderCreateResult()
    {
        return $this->OrderCreateResult;
    }

    /**
     * @return SalesEntry
     */
    public function getResult()
    {
        return $this->OrderCreateResult;
    }


}

