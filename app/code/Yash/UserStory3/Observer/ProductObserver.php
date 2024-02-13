<?php

namespace Yash\UserStory3\Observer;

use Psr\Log\LoggerInterface;

class ProductObserver implements \Magento\Framework\Event\ObserverInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer): void
    {
        $product = $observer->getProduct();
        $productName = $product->getName();
        $SKU = $product->getSKU();
        $this->logger->info("Product Viewed:" . $productName . ' ' . $SKU . ' ' . $product->getId());
        $this->logger->info($product->getFinalPrice());
        $this->logger->info($product->getQty());
    }
}
