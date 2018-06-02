<?php



namespace Secalith\ExpressiveAdrCommon\View\Helper\Factory;

use Psr\Container\ContainerInterface;
use Secalith\ExpressiveAdrCommon\View\Helper\CurrentUrlHelper;
use Secalith\ExpressiveAdrCommon\View\Helper\DisplayLinkGroupHelper;
use Zend\Expressive\Helper\UrlHelper;

class DisplayLinkGroupHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $currentUrlHelper = $container->get(CurrentUrlHelper::class);
        $urlHelper = $container->get(UrlHelper::class);

        return new DisplayLinkGroupHelper($urlHelper,$currentUrlHelper);
    }
}