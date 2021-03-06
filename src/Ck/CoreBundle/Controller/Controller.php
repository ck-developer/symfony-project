<?php

/*
 * This file is part of the Smartparking package.
 *
 * (c) Claude Khedhiri <claude@khedhiri.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ck\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected function paginate($query)
    {
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $this->get('request_stack')->getMasterRequest()->query->getInt('page', 1)
        );

        return $pagination;
    }
}
