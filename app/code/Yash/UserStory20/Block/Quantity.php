<?php

namespace Yash\UserStory20\Block;

use Magento\Framework\View\Element\Template;
use Magento\InventorySalesAdminUi\Model\GetSalableQuantityDataBySku;

class Quantity extends Template
{
    protected $getSalableQuantityDataBySku;

    public function __construct(
        Template\Context $context,
        GetSalableQuantityDataBySku $getSalableQuantityDataBySku,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getSalableQuantityDataBySku = $getSalableQuantityDataBySku;
    }

    public function getSalableQuantityBySku($sku)
    {
        return $this->getSalableQuantityDataBySku->execute($sku);
    }
}
