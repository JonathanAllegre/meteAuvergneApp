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
use Setup\Twig;

class AppFactory
{
    private static $config;
    private static $bdd;


    private static function getConfig()
    {
        if (self::$config === null) {
            self::$config = new Config();
            return self::$config;
        } else {
            return self::$config;
        }
    }

    private static function getBdd()
    {
        if (self::$bdd === null) {
            $config = self::getConfig();
            $optPdo =  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

            self::$bdd =  new PDO(
                'mysql:host='.$config->getDbHost().';dbname='.$config->getDbName().'',
                ''.$config->getDbUser().'',
                ''.$config->getDbMdp().'',
                $optPdo
            );

            return self::$bdd;
        } else {
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

        $data['twigCache'] = $config->getTwigCache();
        $data['cachePath'] = $config->getCachePath();

        return $data;
    }

    public static function getPrefix()
    {
        $config = self::getConfig();
        return $config->getPrefix();
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

    ### TWIG #####
    public static function getView($path, $variables = null)
    {
        Twig::goTwig('SiteBundle/Views/'.$path.'.twig', $variables);
    }
}
