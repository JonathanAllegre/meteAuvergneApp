<?php

namespace App\SiteBundle\Controller;


class ErrorController extends AppController
{
    public function notFound()
    {
    	$this->renderView('Errors/404');

    }
}
