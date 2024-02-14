<?php

namespace Yash\UserStory15\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Customer extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer_group_sales', 'customer_group_id');
    }
}
