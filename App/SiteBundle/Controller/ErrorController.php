<?php

namespace App\SiteBundle\Controller;

use App\SiteBundle\Services\AppFactory;


class ErrorController
{
    public function notFound()
    {
        AppFactory::getView('Errors/404');

    }
}
