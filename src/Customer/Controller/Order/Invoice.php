<?php

namespace Ls\Customer\Controller\Order;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Invoice
 * @package Ls\Customer\Controller\Order
 */
class Invoice extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    public $messageManager;

    /**
     * @var ResultFactory
     */
    public $resultRedirect;

    /** @var PageFactory */
    public $resultPageFactory;

    /**
     * @var Http $request
     */
    public $request;

    /**
     * @var \Ls\Omni\Helper\OrderHelper
     */
    public $orderHelper;

    /**
     * @var \Magento\Framework\Registry
     */
    public $registry;

    /**
     * Invoice constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Http $request
     * @param \Ls\Omni\Helper\OrderHelper $orderHelper
     * @param \Magento\Framework\Registry $registry
     * @param ResultFactory $result
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Http $request,
        \Ls\Omni\Helper\OrderHelper $orderHelper,
        \Magento\Framework\Registry $registry,
        ResultFactory $result,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->resultRedirect = $result;
        $this->messageManager = $messageManager;
        $this->request = $request;
        $this->registry = $registry;
        $this->orderHelper = $orderHelper;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $response = null;
        if ($this->request->getParam('order_id')) {
            $orderId = $this->request->getParam('order_id');
            $response = $this->setCurrentOrderInRegistry($orderId);
            if ($response === null || !$this->orderHelper->isAuthorizedForOrder($response)) {
                return $this->_redirect('sales/order/history/');
            }
            $this->setCurrentMagOrderInRegistry($orderId);
            $this->setInvoiceId();
            $this->setPrintInvoiceOption();
        }
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    /**
     * @param $orderId
     * @return \Ls\Omni\Client\Ecommerce\Entity\Order|\Ls\Omni\Client\Ecommerce\Entity\OrderGetByIdResponse|\Ls\Omni\Client\ResponseInterface|null
     */
    public function setCurrentOrderInRegistry($orderId)
    {
        $response = $this->orderHelper->getOrderDetailsAgainstId($orderId);
        if ($response) {
            $this->setOrderInRegistry($response);
        }
        return $response;
    }

    /**
     * @param $order
     */
    public function setOrderInRegistry($order)
    {
        $this->registry->register('current_order', $order);
    }

    /**
     * @param $orderId
     */
    public function setCurrentMagOrderInRegistry($orderId)
    {
        $order = $this->orderHelper->getOrderByDocumentId($orderId);
        $this->registry->register('current_mag_order', $order);
    }

    /**
     * @param $orderId
     */
    public function setInvoiceId()
    {
        $order = $this->registry->registry('current_mag_order');
        foreach ($order->getInvoiceCollection() as $invoice) {
            $this->registry->register('current_invoice_id', $invoice->getIncrementId());
        }
    }

    /**
     *  Print Invoice Option
     */
    public function setPrintInvoiceOption()
    {
        $order = $this->registry->registry('current_mag_order');
        if (!empty($order)) {
            if (!empty($order->getInvoiceCollection())) {
                $this->registry->register('current_invoice_option', true);
            } else {
                $this->registry->register('current_invoice_option', false);
            }
        }
    }
}