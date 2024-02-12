<?php

namespace Yash\UserStory21\Observer;

use Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class RemoveBlock implements ObserverInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\View\Layout $layout */
        $urlInterface = \Magento\Framework\App\ObjectManager::getInstance()
            ->get(\Magento\Framework\UrlInterface::class);
        $currentUrl = $urlInterface->getCurrentUrl();
        $this->logger->info("CURRENT URL" . $currentUrl);

        $layout = $observer->getLayout();
        // $block = $layout->getBlock('product.info.description');

        if (str_contains($currentUrl, 'affiliate=true')) {
            $this->logger->info('TRUE');
            $layout->unsetElement('product.info.review');
        }
    }
}
