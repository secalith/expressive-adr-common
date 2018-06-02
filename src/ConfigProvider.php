<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon;

use Secalith\ExpressiveAdrCommon\View\Helper\GetFormAttached;
use Secalith\ExpressiveAdrCommon\Handler\StaticPageHandler;
use Secalith\ExpressiveAdrCommon\Handler\StaticPageHandlerFactory;
use Secalith\ExpressiveAdrCommon\Helper\CurrentRouteNameHelper;
use Secalith\ExpressiveAdrCommon\Helper\Factory\CurrentRouteNameHelperFactory;
use Secalith\ExpressiveAdrCommon\Middleware\CurrentRouteNameMiddleware;
use Secalith\ExpressiveAdrCommon\Middleware\CurrentUrlMiddleware;
use Secalith\ExpressiveAdrCommon\Middleware\Factory\CurrentRouteNameMiddlewareFactory;
use Secalith\ExpressiveAdrCommon\Middleware\Factory\CurrentUrlMiddlewareFactory;
use Secalith\ExpressiveAdrCommon\Middleware\Factory\HandlerCacheMiddlewareFactory;
use Secalith\ExpressiveAdrCommon\Middleware\Factory\StaticPageHandlerCacheMiddlewareFactory;
use Secalith\ExpressiveAdrCommon\Middleware\HandlerCacheMiddleware;
use Secalith\ExpressiveAdrCommon\Middleware\StaticPageHandlerCacheMiddleware;
use Secalith\ExpressiveAdrCommon\View\Helper\CurrentUrlHelper;
use Secalith\ExpressiveAdrCommon\View\Helper\Factory\CurrentUrlHelperFactory;
use Secalith\ExpressiveAdrCommon\View\Helper\Factory\DisplayLinkGroupHelperFactory;
use Secalith\ExpressiveAdrCommon\View\Helper\FlashMessage;
use Secalith\ExpressiveAdrCommon\View\Helper\IsFormSet;
use Whoops\Handler\Handler;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'delegators' => [],
        ];
    }

}
