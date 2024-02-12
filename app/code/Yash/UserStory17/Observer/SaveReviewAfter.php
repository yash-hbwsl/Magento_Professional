<?php

namespace Yash\UserStory17\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Psr\Log\LoggerInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Review\Model\ResourceModel\Review\CollectionFactory;
// use Magento\Framework\App\Action\Context $context;
// use Magento\Review\Model\ReviewFactory;
// use Magento\Review\Model\Rating ;
use Magento\Review\Model\Review;

class SaveReviewAfter implements ObserverInterface
{
    /**
     * @var ManagerInterface
     */
    private $_messageManager;

    /**
     * @param ManagerInterface $messageManager
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\App\ResourceConnection $resource
     */
    public function __construct(
        ManagerInterface $messageManager,
        ProductRepositoryInterface $productRepository,
        Review $review,
        CollectionFactory $reviewCollectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        LoggerInterface $logger,
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Review\Model\Rating $ratingFactory,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Eav\Api\AttributeRepositoryInterface $eavAttributeRepository,
        \Magento\Eav\Api\AttributeOptionManagementInterface $attributeOptionManagement
    ) {
        $this->_request        = $request;
        $this->productRepository= $productRepository;
        $this->view = $review;
        $this->_reviewFactory = $reviewFactory;
        $this->_ratingFactory = $ratingFactory;
        $this->logger = $logger;
        $this->reviewCollectionFactory = $reviewCollectionFactory;
        $this->_resource       = $resource;
        $this->_messageManager = $messageManager;
        $this->eavAttributeRepository = $eavAttributeRepository;
        $this->attributeOptionManagement = $attributeOptionManagement;
    }

    /**
     * Execute Method to save user id in review_detail record table
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $review = $observer->getEvent()->getDataObject();
        // dump($review->getData());
        echo $review->getData()['review_id'];
        $loadedProduct = $this->productRepository->getById($review->getData()['entity_pk_value']);

        $attr = $loadedProduct->getResource()->getAttribute('rating_custom2');
        dump($attr);
        if ($attr->usesSource()) {
            $option_id = $attr->getSource()->getOptionId(4);
      }
        $attribute = $this->eavAttributeRepository->get(\Magento\Catalog\Model\Product::ENTITY, 'rating_custom2');
        $attributeOptions = $this->attributeOptionManagement->getItems(\Magento\Catalog\Model\Product::ENTITY, 'rating_custom2');

        // Find the option value by label
        $optionValue = null;
        foreach ($attributeOptions as $option) {
            // dump($option);
            if ($option->getLabel() == $optionLabel) {
                $optionValue = $option->getValue();
                // break;
            }
        }


        // Set the custom attribute value
        $optionId = $loadedProduct->getResource()
                    ->getAttribute('rating_custom2')
                    ->getSource()
                    ->getOptionId(round($review->getData()['ratings']['4']/16));
                    $loadedProduct->setCustomAttribute('rating_custom2', 4);
        // $loadedProduct->setCustomAttribute('rating_custom2', round($review->getData()['ratings']['4']/16));
        // $loadedProduct->setCustomAttribute('rating_custom2', );

        // Save the product
        $this->productRepository->save($loadedProduct);

        // Now, you can work with $productId and $ratingSummary to get the rating count
        // ...



    }
}
