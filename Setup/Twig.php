<?php

namespace Setup;

use App\SiteBundle\Services\AppFactory;

class Twig
{
    private $_loader;
    private $_twig;

    public function __construct()
    {
        $conf = AppFactory::getTwigConf();
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../App');

        if ($conf['twigCache']) {
            $twig = new \Twig_Environment($loader, array('cache' => __DIR__.'/../'.$conf['cachePath']));
        } else {
            $twig = new \Twig_Environment($loader, array('cache' => false));
        }
        
        $this->_loader = $loader;
        $this->_twig = $twig;
    }

    public function goTwig($template, $var = null)
    {
        ### RACOURCI ####
        $param = array(
                       'rootImg' => AppFactory::getImg(),
                       'rootCss' => AppFactory::getCss(),
                       'rootScript' => AppFactory::getScript(),
                       'rootPng' => AppFactory::getPng(),
                       'dataForecast' => AppFactory::getdataForecastJson(),
                       'pathRoot' => AppFactory::getPathRoot()
                       );
        
        if (!empty($var)) {
            $variable = array_merge($param, $var);
        } else {
            $variable = $param;
        }
        
        echo $this->_twig->render($template, $variable);
    }
}
