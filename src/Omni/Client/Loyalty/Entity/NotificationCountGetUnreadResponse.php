<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use \Ls\Omni\Client\ResponseInterface;

class NotificationCountGetUnreadResponse implements ResponseInterface
{

    /**
     * @property NotificationUnread $NotificationCountGetUnreadResult
     */
    protected $NotificationCountGetUnreadResult = null;

    /**
     * @param NotificationUnread $NotificationCountGetUnreadResult
     * @return $this
     */
    public function setNotificationCountGetUnreadResult($NotificationCountGetUnreadResult)
    {
        $this->NotificationCountGetUnreadResult = $NotificationCountGetUnreadResult;
        return $this;
    }

    /**
     * @return NotificationUnread
     */
    public function getNotificationCountGetUnreadResult()
    {
        return $this->NotificationCountGetUnreadResult;
    }

    /**
     * @return NotificationUnread
     */
    public function getResult()
    {
        return $this->NotificationCountGetUnreadResult;
    }


}
