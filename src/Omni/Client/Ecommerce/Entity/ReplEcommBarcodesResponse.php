<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\ResponseInterface;

class ReplEcommBarcodesResponse implements ResponseInterface
{

    /**
     * @property ReplBarcodeResponse $ReplEcommBarcodesResult
     */
    protected $ReplEcommBarcodesResult = null;

    /**
     * @param ReplBarcodeResponse $ReplEcommBarcodesResult
     * @return $this
     */
    public function setReplEcommBarcodesResult($ReplEcommBarcodesResult)
    {
        $this->ReplEcommBarcodesResult = $ReplEcommBarcodesResult;
        return $this;
    }

    /**
     * @return ReplBarcodeResponse
     */
    public function getReplEcommBarcodesResult()
    {
        return $this->ReplEcommBarcodesResult;
    }

    /**
     * @return ReplBarcodeResponse
     */
    public function getResult()
    {
        return $this->ReplEcommBarcodesResult;
    }


}
