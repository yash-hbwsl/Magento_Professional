<?php

namespace Yash\UserStory21\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\UrlInterface;
use Psr\Log\LoggerInterface;

class RemoveBlock implements ObserverInterface
{
    protected LoggerInterface $logger;
    protected UrlInterface $url;
    public function __construct(LoggerInterface $logger, UrlInterface $url)
    {
        $this->logger = $logger;
        $this->url = $url;
    }
    public function execute(Observer $observer)
    {
        $currentUrl = $this->url->getCurrentUrl();
        $layout = $observer->getLayout();
        if (!str_contains($currentUrl, 'affiliate=true')) {
            $this->logger->info('TRUE');
            $layout->unsetElement('product.info.review');
        }
    }
}
