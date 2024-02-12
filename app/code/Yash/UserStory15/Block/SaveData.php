<?php

namespace Yash\UserStory15\Block;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\Template;

class SaveData extends Template
{

  const ORDER_STATUS_TABLE = 'customer_group_sales';
  const STATUS_FIELD = 'customer_group_id';
  const STATUS_LABEL_FIELD = 'customer_group_name';
  const SALES = 'sales';

  /**
   * @var ResourceConnection
   */
  private $resourceConnection;

  public function __construct(
    ResourceConnection $resourceConnection
  ) {
    $this->resourceConnection = $resourceConnection;
  }

  /**
   * insert Sql Query
   */
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
    $select = $connection->select()
      ->from(
        ['c' => $tableName],
        ['*']
      );
    $records = $connection->fetchAll($select);
    dump($records);
  }
}
