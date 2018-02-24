<?php

namespace Setup;

class Twig extends Config
{
    private $_loader;
    private $_twig;

    public function __construct()
    {
        $conf = $this->getTwigConf();
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
                       'rootImg' => $this->getImg(),
                       'rootCss' => $this->getCss(),
                       'rootScript' => $this->getScript(),
                       'rootPng' => $this->getPng(),
                       'dataForecast' => $this->getdataForecastJson(),
                       'pathRoot' => $this->getPathRoot()
                       );
        
        if (!empty($var)) {
            $variable = array_merge($param, $var);
        } else {
            $variable = $param;
        }
        
        echo $this->_twig->render($template, $variable);
    }
}
