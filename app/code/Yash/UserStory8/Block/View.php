<?php

namespace Yash\UserStory8\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Yash\UserStory8\Model\ResourceModel\Employee\Collection as EmployeeCollection;

class View extends Template
{
    protected $collection;

    public function __construct(
        Context $context,
        EmployeeCollection $collection
    ) {
        $this->collection = $collection;
        parent::__construct($context);
    }

    public function getCollection()
    {
        return $this->collection->getData();
    }
}
