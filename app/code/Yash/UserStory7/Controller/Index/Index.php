<?php
namespace Yash\UserStory7\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    protected PageFactory $resultPageFactory;

    public function __construct(
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        // Create a new page instance
        $resultPage = $this->resultPageFactory->create();

        // Set the page layout
        $resultPage->getConfig()->setPageLayout('2columns-left');

        return $resultPage;
    }
}
