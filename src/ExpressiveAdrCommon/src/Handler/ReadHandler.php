<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Secalith\ExpressiveAdrCommon\Handler\DataAwareInterface;
use Secalith\ExpressiveAdrCommon\Handler\DataAwareTrait;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Paginator\Paginator;
use Zend\Paginator\ScrollingStyle\Sliding;

class ReadHandler implements RequestHandlerInterface, DataAwareInterface
{
    use DataAwareTrait;

    private $containerName;

    private $router;

    private $template;

    private $urlHelper;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        UrlHelper $urlHelper = null
    ) {
        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->urlHelper = $urlHelper;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        return new HtmlResponse($this->template->render($this->getData('template'), $this->getData()));
    }
}
