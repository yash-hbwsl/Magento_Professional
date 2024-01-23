<?php

namespace Yash\UserStory19\Block\Cart;

use Magento\Catalog\Api\ProductRepositoryInterface;

class Sidebar extends \Magento\Checkout\Block\Cart\Sidebar
{

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Customer\CustomerData\JsLayoutDataProviderPoolInterface $jsLayoutDataProvider,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Serialize\Serializer\Json $serializer = null,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        parent::__construct($context, $customerSession, $checkoutSession, $imageHelper, $jsLayoutDataProvider, $data, $serializer);
    }

    public function getProductById($entityId)
    {
        $entityId = (int)$entityId;
        return $this->productRepository->getById($entityId);
    }
}
