<?php

namespace Ls\Replication\Controller\Adminhtml\Grids;

/**
 * Class Price
 * @package Ls\Replication\Controller\Adminhtml\Grids
 */
class Price extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Load the grid defined through grid component
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        //Set the header title of grid
        $resultPage->getConfig()->getTitle()->prepend(__('Item Price Replication'));
        return $resultPage;
    }
}
