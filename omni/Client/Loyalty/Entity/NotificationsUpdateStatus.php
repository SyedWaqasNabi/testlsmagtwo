<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Entity;

use Ls\Omni\Client\Loyalty\Entity\Enum\NotificationStatus;
use Ls\Omni\Exception\InvalidEnumException;
use Ls\Omni\Client\IRequest;

class NotificationsUpdateStatus implements IRequest
{

    /**
     * @property string $contactId
     */
    protected $contactId = null;

    /**
     * @property ArrayOfstring $notificationIds
     */
    protected $notificationIds = null;

    /**
     * @property NotificationStatus $notificationStatus
     */
    protected $notificationStatus = null;

    /**
     * @param string $contactId
     * @return $this
     */
    public function setContactId($contactId)
    {
        $this->contactId = $contactId;
        return $this;
    }

    /**
     * @return string
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @param ArrayOfstring $notificationIds
     * @return $this
     */
    public function setNotificationIds($notificationIds)
    {
        $this->notificationIds = $notificationIds;
        return $this;
    }

    /**
     * @return ArrayOfstring
     */
    public function getNotificationIds()
    {
        return $this->notificationIds;
    }

    /**
     * @param NotificationStatus|string $notificationStatus
     * @return $this
     * @throws InvalidEnumException
     */
    public function setNotificationStatus($notificationStatus)
    {
        if ( NotificationStatus::isValid( $notificationStatus) ) 
            $this->notificationStatus = new NotificationStatus( $notificationStatus );
        elseif ( NotificationStatus::isValidKey( $notificationStatus) ) 
            $this->notificationStatus = new NotificationStatus( constant( "NotificationStatus::$notificationStatus" ) );
        else 
            throw new InvalidEnumException();
        return $this;
    }

    /**
     * @return NotificationStatus
     */
    public function getNotificationStatus()
    {
        return $this->notificationStatus;
    }


}
