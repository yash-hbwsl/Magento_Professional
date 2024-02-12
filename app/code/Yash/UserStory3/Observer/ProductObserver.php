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
        $this->logger->info("Product Viewed:" . $productName . ' ' . $SKU. ' '. $product->getId());
        $productPrice = $product->getPrice();
        // dump($product->getExtensionAttributes()->getStockItem());
        // $quantityPerSource = $product->getExtensionAttributes()->getStockItem()->getQty();

        // $salableQuantity = $product->getExtensionAttributes()->getStockItem()->getSalableQty();

        // $logMessage = "Product Details:\nName: $productName\n \nPrice: $productPrice\nQuantity per Source: $quantityPerSource\nSalable Quantity: $salableQuantity";

        // $this->logger->info($logMessage);
    }
}
