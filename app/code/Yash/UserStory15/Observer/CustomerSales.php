<?php

namespace Yash\UserStory15\Observer;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\ResourceConnection;

class CustomerSales implements \Magento\Framework\Event\ObserverInterface
{
    protected LoggerInterface $logger;
    private $resourceConnection;
    const ORDER_STATUS_TABLE = 'customer_group_sales';
    const STATUS_FIELD = 'customer_group_id';
    const STATUS_LABEL_FIELD = 'customer_group_name';
    const SALES = 'sales';

    public function __construct(
        LoggerInterface $logger,
        ResourceConnection $resourceConnection
    ) {
        $this->logger = $logger;
        $this->resourceConnection = $resourceConnection;
    }


    public function insertStatus()
    {
        $connection  = $this->resourceConnection->getConnection();
        $tableName = $connection->getTableName(self::ORDER_STATUS_TABLE);

        $data = [
            self::STATUS_FIELD => '8',
            self::STATUS_LABEL_FIELD => __("General2"),
            self::SALES => '7000'
        ];

        $connection->insert(self::ORDER_STATUS_TABLE, $data);

        dump($records);
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // throw new LocalizedException(__('Test event is firing'));
        // get order from observer
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $order = $observer->getEvent()->getOrder();
        $logger->info(dump($order->getItems(), true));

        // $logger->info(print_r($order->getData()['customer_group_id'], true));

        // $logger->info(print_r($order->getData()['base_grand_total'], true));

        $connection  = $this->resourceConnection->getConnection();
        // $tableName = $connection->getTableName(self::ORDER_STATUS_TABLE);

        $data = [
            self::STATUS_FIELD => $order->getData()['customer_group_id'],
            self::STATUS_LABEL_FIELD => __("General2"),
            self::SALES => $order->getData()['base_grand_total']
        ];
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $groupRepository  = $objectManager->create('\Magento\Customer\Api\GroupRepositoryInterface');
        $group = $groupRepository->getById((int)$order->getData()['customer_group_id']);
        dump($group->getData());
        dump(gettype($group));

        // var_dump($group->getData());
        // echo $group->getCode();
        $select = $connection->select()
            ->from(
                ['c' => self::ORDER_STATUS_TABLE],
                ['*']
            )->where(
                'c.customer_group_id = ?',
                $order->getData()['customer_group_id']
            );
        $records = $connection->fetchAll($select);
        $logger->info(print_r(count($records), true));
        if (count($records)) {
            $sql = "Update customer_group_sales set sales=sales+{$order->getData()['base_grand_total']} where customer_group_id={$order->getData()['customer_group_id']}";
            $result = $connection->exec($sql);
            //$result = $connection->exec($sql);
            $logger->info(print_r($result, true));
            // print_r($result);
        } else {
            $connection->insert(self::ORDER_STATUS_TABLE, $data);
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
