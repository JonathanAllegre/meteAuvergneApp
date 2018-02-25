<?php

namespace Setup;

use App\SiteBundle\Services\AppFactory;

class Twig
{
    private static $loader;
    private static $twig;
    private static $instance;

    private static function setEnv()
    {
        $conf = AppFactory::getTwigConf();
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../App');

        if ($conf['twigCache']) {
            $twig = new \Twig_Environment($loader, array('cache' => __DIR__.'/../'.$conf['cachePath']));
        } else {
            $twig = new \Twig_Environment($loader, array('cache' => false));
        }
        
        self::$loader = $loader;
        self::$twig = $twig;
        self::$instance = 1;
    }

    public static function goTwig($template, $var = null)
    {
        if(self::$instance === null)
        {
           self::setEnv();
        }
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
        
        echo self::$twig->render($template, $variable);
    }
}
