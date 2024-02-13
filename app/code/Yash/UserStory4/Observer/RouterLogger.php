<?php

namespace Yash\UserStory4\Observer;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RouterList;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class RouterLogger implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * @var RouterList
     */
    protected $_routerList;

    /**
     * @param Context $context
     * @param RouterList $routerList
     */
    public function __construct(
        RouterList $routerList,
        protected LoggerInterface $logger
    ) {
        $this->_routerList = $routerList;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $this->logger->info('Router Logger Executed');
    }

    protected function getRoutersString()
    {
        $ret = '';
        foreach ($this->_routerList as $router) {
            $ret .= get_class($router) . "\n";
            $this->logger->info($ret);
        }
        return $ret;
    }
}
