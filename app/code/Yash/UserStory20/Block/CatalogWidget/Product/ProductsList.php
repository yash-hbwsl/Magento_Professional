<?php
namespace Yash\UserStory20\Block\CatalogWidget\Product;
class ProductsList extends \Magento\CatalogWidget\Block\Product\ProductsList
{
    protected function _construct()
    {
        $this->setTemplate('Yash_UserStory20::product/widget/content/grid.phtml');
    }
}
