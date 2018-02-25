<?php

namespace App\SiteBundle\Controller;

use App\SiteBundle\Services\AppFactory;


class HomeController
{
    public function index($parametres)
    {
        
        ### GET MODEL MF
        
        $modelManager = AppFactory::getManager('Model');
        $modelMF = $modelManager->getModelMf(1);
   
        $variables['modelMF'] = $modelMF;
        
        AppFactory::getView('Home/Index', $variables);
    }
}
