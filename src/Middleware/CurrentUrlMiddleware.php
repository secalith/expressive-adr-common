<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Secalith\ExpressiveAdrCommon\View\Helper\CurrentUrlHelper;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Session\Container;

/**
 * Middleware to implement the PRG Pattern in a Zend Expressive app
 */
class CurrentUrlMiddleware  implements MiddlewareInterface
{

    private $currentUrlHelper;

    public function __construct(CurrentUrlHelper $currentUrlHelper) {
        $this->currentUrlHelper = $currentUrlHelper;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : Response
    {
        $result = $request->getAttribute(\Zend\Expressive\Router\RouteResult::class);
        $this->currentUrlHelper->setRouteResult($result);

        return $handler->handle($request);
    }

}
