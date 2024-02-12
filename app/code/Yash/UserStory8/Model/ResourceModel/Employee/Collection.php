<?php

namespace Yash\UserStory8\Model\ResourceModel\Employee;

use Yash\UserStory8\Model\Employee;
// use NewVendor\CustomModule\Model\ResourceModel\Employee;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    protected function _construct(){
        $this->_init(Employee::class, \Yash\UserStory8\Model\ResourceModel\Employee::class);
    }
}