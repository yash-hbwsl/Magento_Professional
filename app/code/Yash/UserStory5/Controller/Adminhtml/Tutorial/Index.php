<?php

namespace Yash\UserStory5\Controller\Adminhtml\Tutorial;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $accessParam = $this->getRequest()->getParam('access');
        // if (!($accessParam!=='true')) {
        //     $this->_redirect('hello/index/index');
        // }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Page'));
        return $resultPage;
    }
}
