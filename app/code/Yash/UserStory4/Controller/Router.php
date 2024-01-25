<?php

declare(strict_types=1);

namespace Yash\UserStory4\Controller;

use Magento\Framework\App\Action\Redirect;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ResponseFactory;

/**
 * Class Router
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Router constructor.
     *
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        protected ResultFactory $resultFactory,
        ActionFactory $actionFactory,
        ResponseInterface $response,
        protected ResponseFactory $responseFactory,
    ) {
        $this->actionFactory = $actionFactory;
        $this->resultFactory = $resultFactory;
        $this->response = $response;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');
        $string = $identifier;
        // Use preg_match to find capital letters as delimiters
        preg_match_all('/[A-Z][^A-Z]*/', $string, $matches);
        // $matches[0] will contain an array of substrings
        $result = $matches[0];


        if (count($result) == 3) {
            [$frontName, $controller, $action] = [strtolower($result[0]), strtolower($result[1]), strtolower($result[2])];
            $this->response->setRedirect("$frontName/$controller/$action");
            return $this->actionFactory->create(Redirect::class);
        }
        if ($identifier === 'contactuspage.html') {
            $this->response->setRedirect("/contact");
            return $this->actionFactory->create(Redirect::class);
        }

        return null;
    }
}
