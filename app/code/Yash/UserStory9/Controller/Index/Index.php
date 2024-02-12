<?php

namespace Yash\UserStory9\Controller\Index;

use Yash\Mod1\Test\Data;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var Data
     */
    protected $test;
    /**
     * @param Data $data
     * 
     */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        // echo 'hello world';
        return $this->pageFactory->create();
    }
}
