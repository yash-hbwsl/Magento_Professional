<?php

namespace Yash\UserStory15\Model\ResourceModel\Customer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Yash\UserStory15\Model\Customer;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Customer::class, \Yash\UserStory15\Model\ResourceModel\Customer::class);
    }
}
