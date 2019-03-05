<?php

namespace Ls\Omni\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class DataAssignObserver
 * @package Ls\Omni\Observer
 */
class DataAssignObserver implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this|void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getQuote();
        $order = $observer->getOrder();

        $order->setPickupDate($quote->getPickupDate());
        if ($quote->getPickupStore()) {
            $order->setPickupStore($quote->getPickupStore());
        }
        $order->setLsPointsSpent($quote->getLsPointsSpent());
        $order->setLsPointsEarn($quote->getLsPointsEarn());
        return $this;
    }
}
