<?php

namespace Yash\UserStory17\Setup\Patch\Data;

use Magento\Catalog\Api\ProductAttributeRepositoryInterface as ProductAttributeRepository;
use Magento\Catalog\Api\ProductRepositoryInterface as ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Review\Model\Rating;

class UpgradeCustomRatingAverage implements DataPatchInterface
{
    private $moduleDataSetup;
    protected $productAttributeRepository;
    protected $productRepository;
    protected $searchCriteriaBuilder;
    protected $rating;
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ProductAttributeRepository $productAttributeRepository,
        ProductRepository $productRepository,
        Rating $rating,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->rating=$rating;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function apply()
    {
        $connection = $this->moduleDataSetup->getConnection();
        $attributeCode = 'rating_custom2';
        $attribute = $this->productAttributeRepository->get($attributeCode);
        $attribute_id = $attribute->getAttributeId();

        // Get all products
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $allProducts = $this->productRepository->getList($searchCriteria)->getItems();
        // dump($RatingOb);
        // echo $RatingOb->getSum()."\n". $RatingOb->getCount()."\n";
        foreach ($allProducts as $product) {
            $RatingOb = $this->rating->getEntitySummary($product->getID());
            $ratings = $RatingOb->getCount() > 0 ? round($RatingOb->getSum() / $RatingOb->getCount() / 20) : 0;
            // Calculate discount percentage
            $rating = $product->getId();

            $connection->insert(
                $connection->getTableName('catalog_product_entity_int'),
                [
                    'value' => $ratings,
                    'entity_id' => $product->getId(),
                    'attribute_id' => $attribute_id
                ]
            );
        }

        // Add the discount percentage attribute

    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
