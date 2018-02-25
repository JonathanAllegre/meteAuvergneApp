<?php

namespace Setup;

use \PDO as PDO;
use Symfony\Component\Yaml\Yaml;

class Config
{

    public function parseConfigFile()
    {
        return  Yaml::parseFile(__DIR__.'/../Config/General.yaml');
    }

    
    public function getPdo()
    {
        $config = $this->getConfig();
        
        $bddLocal = $config['bddLocal'];
        $bddProd  = $config['bddProd'];
        
        if ($config['mod'] == 1) {
            $pdoConf  = $bddLocal;
        } else {
            $pdoConf = $bddProd;
        }
        
        try {
            return new PDO('mysql:host='.$pdoConf['host'].';dbname='.$pdoConf['dbname'].'', ''.$pdoConf['utilisateur'].'', ''.$pdoConf['mdp'].'', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            echo 'Échec de la connexion : ' . $e->getMessage();
            exit;
        }
    }
    
    public function getTwigConf()
    {
        $config = $this->getConfig();
        
        $data['twigCache'] = $config['twigCache'];
        $data['cachePath'] = $config['cachePath'];

        return $data;
    }
    
    public function getPrefix()
    {
        $config = $this->getConfig();
    
        $prefixLocal = $config['prefixLocal'];
        $prefixProd  = $config['prefixProd'];
        
        if ($config['mod'] == 1) {
            $prefix = $prefixLocal;
        } else {
            $prefix = $prefixProd;
        }
        
        return $prefix;
    }
    
    public function getCss()
    {
        $prefix = $this->getPrefix();
        return 'http://' .$_SERVER['HTTP_HOST']  . $prefix .'/Webroot/Css';
    }
    
    public function getImg()
    {
        $prefix = $this->getPrefix();
        return 'http://' .$_SERVER['HTTP_HOST']  . $prefix .'/Webroot/Images';
    }
    
    public function getScript()
    {
        $prefix = $this->getPrefix();
        return 'http://' .$_SERVER['HTTP_HOST']  . $prefix .'/Webroot/Script';
    }
    
    public function getPng()
    {
        return 'http://fam8.net/meteauvergneData/Png';
    }

    public function getdataForecastJson()
    {
        return 'http://fam8.net//meteauvergneData/jsonData';
    }

    public function getInfoFileJson($parametre)
    {
        return 'http://fam8.net/meteauvergneData/Info/'.$parametre;
    }
    
    public function getPathRoot()
    {
        $prefix = $this->getPrefix();
        return 'http://' .$_SERVER['HTTP_HOST'] . $prefix;
    }
}
