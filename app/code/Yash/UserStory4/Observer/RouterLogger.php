<?php

namespace Yash\UserStory4\Observer;

use Magento\Framework\App\RouterList;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Event\Observer;

class RouterLogger  implements \Magento\Framework\Event\ObserverInterface {

    /**
     * @var RouterList
     */
    protected $_routerList;

    /**
     * @param Context $context
     * @param RouterList $routerList
     */
    public function __construct(
        RouterList $routerList
    ) {
        $this->_routerList = $routerList;
    }

     
    public function execute(Observer $observer)
    {
        echo ($this->getRoutersString());
        // die("All routers have been printed");
    }

    protected function getRoutersString()
    {
        $ret = '';
        foreach ($this->_routerList as $router) {
            $ret .= get_class($router)."\n";
        }
        return $ret;
    }
}