<?php

namespace Yash\UserStory15\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Yash\UserStory15\Model\ResourceModel\Customer\Collection;
use Yash\UserStory15\Model\CustomerFactory;
use Magento\Framework\App\Request\Http;

class GetData extends Template
{

    public $collection;

    public function __construct(Context $context, Http $request, Collection $collection, CustomerFactory $customerFactory, array $data = [])
    {
        $this->collection = $collection;
        $this->request = $request;
        $this->customerFactory = $customerFactory;
        parent::__construct($context, $data);
    }

    public function getCollection()
    {
        return $this->collection->getItems();
    }

    public function saveData()
    {
        $data = $this->request->getParams(); // all params
        print_r($data);
        $model = $this->customerFactory->create();
    }
}
