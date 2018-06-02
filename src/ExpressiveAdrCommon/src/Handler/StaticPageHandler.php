<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Secalith\ExpressiveAdrCommon\Model\StaticPageViewModel;
use Zend\Cache\Storage\Adapter\Memcached;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Flash\FlashMessageMiddleware;
use Zend\Expressive\Helper\UrlHelper;
use Zend\Expressive\Router;
use Zend\Expressive\Template;

class StaticPageHandler implements RequestHandlerInterface
{
    private $containerName;

    private $router;

    private $template;

    private $urlHelper;

    private $viewTemplateModel;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template = null,
        string $containerName,
        UrlHelper $urlHelper = null,
        StaticPageViewModel $viewTemplateModel = null
    ) {

        $this->router        = $router;
        $this->template      = $template;
        $this->containerName = $containerName;
        $this->urlHelper = $urlHelper;
        $this->viewTemplateModel = $viewTemplateModel;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $data = null;

        $data['layout'] = $this->viewTemplateModel->getLayout();

        return new HtmlResponse($this->template->render($this->viewTemplateModel->getTemplate(), $data));
    }

}
