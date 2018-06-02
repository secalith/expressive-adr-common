<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Handler;

interface ApplicationConfigAwareInterface
{
    public function setHandlerConfig($configData=null) : ApplicationConfigAwareInterface;
    public function getHandlerConfig(string $index=null);
}
