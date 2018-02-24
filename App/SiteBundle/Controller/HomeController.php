<?php

namespace App\SiteBundle\Controller;

class HomeController extends AppController
{
    public function index($parametres)
    {
        
        ### GET MODEL MF
        
        $modelManager = parent::getModelManager();
        $modelMF = $modelManager->getModelMf(1);
   
        $variables['modelMF'] = $modelMF;
        
        $this->renderView('Home/Index', $variables);
    }
}
