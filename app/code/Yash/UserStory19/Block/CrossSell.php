<?php

namespace Yash\UserStory19\Block;

use Magento\Framework\View\Element\Template;

class CrossSell extends Template
{
    protected $_cart;
    public function __construct(

        \Magento\Checkout\Model\Cart $cart,

    ) {

        $this->_cart = $cart;
    }


    public function getMinicart()
    {
        $cartProductList = $this->_cart->getQuote()->getAllItems();
        foreach ($cartProductList as $item) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->create('Magento\Catalog\Api\ProductRepositoryInterface')->getById( $item->getProductId());
        $crossSell = $product->getCrossSellProducts();
        dump($crossSell);
        foreach($crossSell as $item1){
            $data=$item1->getData();
            dump($data);
        }
            // dump($item);
            echo 'ID: ' . $item->getProductId() . '<br />';
            echo 'Name: ' . $item->getName() . '<br />';
            echo 'Sku: ' . $item->getSku() . '<br />';
            echo 'Quantity: ' . $item->getQty() . '<br />';
            echo 'Price: ' . $item->getPrice() . '<br />';
            echo "<br />";
        }
    }
}
