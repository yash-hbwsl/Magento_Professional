<?php

namespace Yash\UserStory4\Plugin;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Redirect;

class Noroute
{
    public function __construct(
        protected ResponseInterface $response,
        protected ActionFactory $actionFactory
    ) {
    }
    public function aroundExecute(\Magento\Cms\Controller\Noroute\Index $subject, callable $proceed)
    {
        $this->response->setRedirect("/contact");
        return $this->actionFactory->create(Redirect::class);
        $result = $proceed;
        return $result;
    }
}
