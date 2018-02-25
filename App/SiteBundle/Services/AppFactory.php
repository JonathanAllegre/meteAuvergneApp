<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 25/02/2018
 * Time: 18:10
 */

namespace App\SiteBundle\Services;

use Setup\Config;
use \PDO as PDO;
use App\SiteBundle\Manager as Manager;


class AppFactory extends Config
{
    private static $config;
    private static $bdd;


    private static function getConfig()
    {
        if(self::$config === null){
            self::$config = Config::parseConfigFile();
            return self::$config;
        }else{
            return self::$config;
        }
    }

    private static function getBdd()
    {

        $config = self::getConfig();

        $bddLocal = $config['bddLocal'];
        $bddProd  = $config['bddProd'];

        if ($config['mod'] == 1) {
            $pdoConf  = $bddLocal;
        } else {
            $pdoConf = $bddProd;
        }

        if(self::$bdd === null){
            try {
                self::$bdd =  new PDO('mysql:host='.$pdoConf['host'].';dbname='.$pdoConf['dbname'].'', ''.$pdoConf['utilisateur'].'', ''.$pdoConf['mdp'].'', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            } catch (PDOException $e) {
                echo 'Échec de la connexion : ' . $e->getMessage();
            }
           return self::$bdd;
        }else{
            return self::$bdd;
        }

    }

    public static function getManager($manager)
    {
        $manager = "App\\SiteBundle\\Manager\\".$manager;
        return new $manager(self::getBdd());
    }

    public static function getTwigConf()
    {
        $config = self::getConfig();
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

    public static function getCss()
    {
        $prefix = self::getPrefix();
        return 'http://' .$_SERVER['HTTP_HOST']  . $prefix .'/Webroot/Css';
    }

    public static function getImg()
    {
        $prefix = self::getPrefix();
        return 'http://' .$_SERVER['HTTP_HOST']  . $prefix .'/Webroot/Images';
    }

    public static function getScript()
    {
        $prefix = self::getPrefix();
        return 'http://' .$_SERVER['HTTP_HOST']  . $prefix .'/Webroot/Script';
    }

    public static function getPng()
    {
        return 'http://fam8.net/meteauvergneData/Png';
    }

    public static function getdataForecastJson()
    {
        return 'http://fam8.net//meteauvergneData/jsonData';
    }

    public static function getInfoFileJson($parametre)
    {
        return 'http://fam8.net/meteauvergneData/Info/'.$parametre;
    }

    public static function getPathRoot()
    {
        $prefix = self::getPrefix();
        return 'http://' .$_SERVER['HTTP_HOST'] . $prefix;
    }


}
