<?php

namespace Yash\UserStory8\Controller\Index;

use Magento\Framework\View\Result\PageFactory;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        PageFactory $resultPageFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Yash\UserStory8\Model\EmployeeFactory $employeeFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->employeeFactory = $employeeFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = (array)$this->getRequest()->getPost();

        try {
            $employeeModel = $this->employeeFactory->create();
            $employeeModel->setData('first_name', $data['first_name']);
            $employeeModel->setData('last_name', $data['last_name']);
            $employeeModel->setData('email_id', $data['email_id']);
            $employeeModel->save();
            $this->messageManager->addSuccessMessage(__('Data saved successfully'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while saving data!'));
        }
        return $this->_redirect('block/index/index');
    }
}
