<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon;

use Secalith\ExpressiveAdrCommon\ExpressiveAdrCommon\View\Helper\GetFormAttached;
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
use Secalith\ExpressiveAdrCommon\Middleware\PostRedirectGet;
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
            'templates'    => $this->getTemplates(),
            'view_helpers'  => [
                'invokables' => [
                    'isFormSet' => IsFormSet::class,
                    'getFormAttached' => GetFormAttached::class,
                    'flashMessage' => FlashMessage::class,
                ],
                'factories' => [
                    'currentRoute' => CurrentUrlHelperFactory::class,
                    'displayLinkGroup' => DisplayLinkGroupHelperFactory::class,
                ],
            ],
            'session_config' => [
                'cookie_lifetime' => 60*60*10,
                'gc_maxlifetime' => 60*60*24*30,
            ],
            'session_manager' => [
                'validators' => [
                    RemoteAddr::class,
                    HttpUserAgent::class,
                ]
            ],
            'session_storage' => [
                'type' => SessionArrayStorage::class
            ],
            'cache' => [
                'enabled' => true,
                'path' => 'data/cache/',
                'lifetime' => 3600
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
                CurrentUrlHelper::class => CurrentUrlHelper::class,

            ],
            'factories' => [
                CurrentUrlMiddleware::class => CurrentUrlMiddlewareFactory::class,
                StaticPageHandler::class => StaticPageHandlerFactory::class,
                CurrentRouteNameMiddleware::class => CurrentRouteNameMiddlewareFactory::class,
                CurrentRouteNameHelper::class => CurrentRouteNameHelperFactory::class,
                StaticPageHandlerCacheMiddleware::class => StaticPageHandlerCacheMiddlewareFactory::class,
            ],
            'abstract_factories' => [
                \Common\Handler\Factory\ListHandlerAbstractFactory::class,
                \Common\Handler\Factory\CreateHandlerAbstractFactory::class,
                \Common\Handler\Factory\ReadHandlerAbstractFactory::class,
                Service\GatewayAbstractFactory::class,
                Service\TableServiceAbstractFactory::class,
                \Zend\Cache\Service\StorageCacheAbstractServiceFactory::class,
            ],
            'delegators' => [],
        ];
    }

    public function getTemplates()
    {
        return [
            'paths' => [
                'common' => [__DIR__ . '/../templates/common'],
            ],
        ];
    }

}
