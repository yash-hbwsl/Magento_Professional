<?php
namespace Yash\UserStory21\Observer;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Yash\UserStory20\Block\Quantity;

class SendNotification implements \Magento\Framework\Event\ObserverInterface
{
    protected LoggerInterface $logger;
    public function __construct(
        LoggerInterface $logger,
        protected ProductRepository $productRepository,
        protected Quantity $quantity
    ) {
        $this->logger = $logger;

    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // throw new LocalizedException(__('Test event is firing'));
        // get order from observer
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $order = $observer->getEvent()->getOrder();
        $items = $order->getAllVisibleItems();

        // Now, you have the list of all items in the order
        foreach ($items as $item) {
            $productId = $item->getProductId();
            $product = $this->productRepository->getById($productId);
            $sku = $product->getSku();
            $q = $this->quantity->getSalableQuantityBySku($sku);
            $productName = $item->getName();
            // Add your logic here to process each item
            $logger->info(dump($q[0]['qty']));
            $logger->info($productName);
        }
        //  $this->logger->info($order);
        //    var_dump($order);
        //    $this->logger->info("PRODUCT QUANTITY");
        //    $this->logger->info($order);

        // loop over order items
        //    foreach ($order->getAllItems() as $item) {
        //        // get product
        //        $product = $item->getProduct();

        //        // check quantity
        //        if ($product->getStockItem()->getQty() < 100) {

        //        }
        //    }
    }
}
