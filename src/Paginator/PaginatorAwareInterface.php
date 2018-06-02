<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Paginator;

use Zend\Paginator\Paginator;

interface PaginatorAwareInterface
{

    public function setPaginator(Paginator $paginator);

    public function getPaginator() : Paginator;

}