<?php

namespace Yash\UserStory5\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action{
    protected $urlinterface;
    public function __construct(
    protected \Magento\Framework\App\Action\Context $context, 
    protected \Magento\Framework\View\Result\PageFactory $pageFactory, 
    ){
        $this->pageFactory=$pageFactory;
        return parent::__construct($context);        
    }

    public function execute(){ 
        return $this->pageFactory->create();
    }
}