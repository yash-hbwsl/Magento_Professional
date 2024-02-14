<?php
namespace Yash\UserStory14\Observer;

use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ProductSaveObserver implements ObserverInterface
{
    protected ProductFactory $productFactory;
    protected ManagerInterface $eventManager;

    public function __construct(
        ProductFactory $productFactory,
        ManagerInterface $eventManager
    ) {
        $this->productFactory = $productFactory;
        $this->eventManager = $eventManager;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();
        $newQuantity = $product->getQty();
        // Check if the new quantity is below a specified threshold
        $threshold = 10;

        if ($newQuantity < $threshold) {
            // Dispatch your custom event only when the condition is met
            $this->eventManager->dispatch(
                'product_quantity_below_threshold',
                ['product' => $product]
            );
        }
    }
}
