<?php

namespace App\SiteBundle\Controller;

use Setup\Config;
use Setup\Twig;
use App\SiteBundle\Manager as Manager;

class AppController extends Config
{
    #### MANAGER #####

    public function getModelManager()
    {
        return new Manager\Model();
    }

    public function getCityManager()
    {
        return new Manager\City();
    }

    public function getDataSourceManager()
    {
        return new Manager\DataSource();
    }

    public function getParametreManager()
    {
        return new Manager\Parametre();
    }


    ### TWIG #####
    public function renderView($path, $variables = null)
    {
        $twig = new Twig();
        $twig->goTwig('SiteBundle/Views/'.$path.'.twig', $variables);
    }
}
