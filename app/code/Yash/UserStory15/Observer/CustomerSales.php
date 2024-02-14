<?php

namespace Yash\UserStory15\Observer;

use Magento\Customer\Model\Group;
use Magento\Framework\App\ResourceConnection;
use Psr\Log\LoggerInterface;

class CustomerSales implements \Magento\Framework\Event\ObserverInterface
{
    protected LoggerInterface $logger;
    protected Group $customerGroup;
    private ResourceConnection $resourceConnection;
    const ORDER_STATUS_TABLE = 'customer_group_sales';
    const STATUS_FIELD = 'customer_group_id';
    const STATUS_LABEL_FIELD = 'customer_group_name';
    const SALES = 'sales';

    public function __construct(
        LoggerInterface $logger,
        ResourceConnection $resourceConnection,
        Group $customerGroup
    ) {
        $this->logger = $logger;
        $this->resourceConnection = $resourceConnection;
        $this->customerGroup = $customerGroup;
    }

    public function getCustomerGroupNameById(int $groupId):string
    {
        $group = $this->customerGroup->load($groupId);
        return $group->getCode();
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // throw new LocalizedException(__('Test event is firing'));
        // get order from observer
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $order = $observer->getEvent()->getOrder();
        // $logger->info(dump($order->getItems(), true));
        // $logger->info(dump($order->getData()));

        $connection  = $this->resourceConnection->getConnection();
        $customerGroupName = $this->getCustomerGroupNameById((int)$order->getData()['customer_group_id']);

        $data = [
            self::STATUS_FIELD => $order->getData()['customer_group_id'],
            self::STATUS_LABEL_FIELD => __($customerGroupName),
            self::SALES => $order->getData()['base_grand_total']
        ];

        $select = $connection->select()
            ->from(
                ['c' => self::ORDER_STATUS_TABLE],
                ['*']
            )->where(
                'c.customer_group_id = ?',
                $order->getData()['customer_group_id']
            );
        $records = $connection->fetchAll($select);
        // $logger->info(print_r(count($records), true));
        if (count($records)) {
            $sql = "Update customer_group_sales set sales=sales+{$order->getData()['base_grand_total']} where customer_group_id={$order->getData()['customer_group_id']}";
            $result = $connection->exec($sql);
        } else {
            $connection->insert(self::ORDER_STATUS_TABLE, $data);
        }

    }
}
