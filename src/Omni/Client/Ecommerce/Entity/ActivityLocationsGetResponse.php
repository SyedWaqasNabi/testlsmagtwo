<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 * @codingStandardsIgnoreFile
 */


namespace Ls\Omni\Client\Ecommerce\Entity;

use Ls\Omni\Client\ResponseInterface;

class ActivityLocationsGetResponse implements ResponseInterface
{

    /**
     * @property ArrayOfActivityLocation $ActivityLocationsGetResult
     */
    protected $ActivityLocationsGetResult = null;

    /**
     * @param ArrayOfActivityLocation $ActivityLocationsGetResult
     * @return $this
     */
    public function setActivityLocationsGetResult($ActivityLocationsGetResult)
    {
        $this->ActivityLocationsGetResult = $ActivityLocationsGetResult;
        return $this;
    }

    /**
     * @return ArrayOfActivityLocation
     */
    public function getActivityLocationsGetResult()
    {
        return $this->ActivityLocationsGetResult;
    }

    /**
     * @return ArrayOfActivityLocation
     */
    public function getResult()
    {
        return $this->ActivityLocationsGetResult;
    }


}
