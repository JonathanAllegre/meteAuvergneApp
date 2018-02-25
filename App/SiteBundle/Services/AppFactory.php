<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 25/02/2018
 * Time: 18:10
 */

namespace App\SiteBundle\Services;

use Setup\Config;


class AppFactory extends Config
{
    private static $config;


    public static function getConfig()
    {
        if(self::$config === null){
            self::$config = Config::parseConfigFile();
            return self::$config;
        }else{
            return self::$config;
        }
    }

    public function getPdo()
    {
        $config = $this->parseConfigFile();

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
        $config = $this->parseConfigFile();
        $data['twigCache'] = $config['twigCache'];
        $data['cachePath'] = $config['cachePath'];

        return $data;
    }

    public static function getPrefix()
    {
        $config = self::getConfig();
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
