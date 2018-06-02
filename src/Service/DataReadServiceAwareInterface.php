<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\StaticPages\Service;

interface DataReadServiceAwareInterface
{
    public function getAll();
    public function getItem();
    public function getItems();
}