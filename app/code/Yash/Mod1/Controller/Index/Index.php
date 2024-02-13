<?php

namespace Yash\Mod1\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Yash\Mod1\Test\Data;

class Index implements HttpGetActionInterface
{
    protected Data $test;
    public function __construct(Data $test, protected \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->test = $test;
    }

    public function execute()
    {
        $this->test->displayParams();
        return $this->pageFactory->create();
        // dump(json_encode($this->test->displayParams()));
    }
}
