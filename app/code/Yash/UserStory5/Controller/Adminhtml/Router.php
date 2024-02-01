<?php
namespace Yash\UserStory5\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

class Router implements \Magento\Framework\App\RouterInterface
{
    private $actionFactory;
    private $url;

    public function __construct(
        ActionFactory $actionFactory,
        UrlInterface $url
    ) {
        $this->actionFactory = $actionFactory;
        $this->url = $url;
    }

    public function match(RequestInterface $request)
    {
        $a = $request->getPathInfo();
        echo $a;
        echo $request->getPathInfo(); 
        $b = str_contains($request->getPathInfo(),'/hello/index/index');
        echo $b;
        if (str_contains($request->getPathInfo(),'/hello/index/index')) {
            $request->setModuleName('hello')
                    ->setControllerName('index')
                    ->setActionName('index');
        } else {
            return null;
        }

        return $this->actionFactory->create(Action::class, ['request' => $request]);
    }
}
