<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 27/02/2018
 * Time: 20:26
 */

namespace App\SiteBundle\Services;

use Symfony\Component\Yaml\Yaml;

class LinkBuilder
{
    private $Routes;
    private $prefix;



    public function __construct()
    {
        if ($this->Routes === null) {
            $this->Routes = Yaml::parseFile('Config/Routes.yaml');
        }
        if ($this->prefix === null) {
            $this->prefix = AppFactory::getPrefix();
        }
    }

    public function getLink($routeName, $parametres = null)
    {
        $route = $routeName;

        $allRoutes = $this->Routes;

        if (array_key_exists($routeName, $allRoutes)) {
            $foundRoute = $allRoutes[$route];
        }

        if (isset($foundRoute)) {
            $urlRoute = $foundRoute['url'];
            if (!empty($parametres)) {
                foreach ($parametres as $key => $value) {
                    if (preg_match("/{" . $key . "}/", $urlRoute)) {
                        $urlRoute = str_replace("{" . $key . "}", $value, $urlRoute);
                    } else {
                        $urlRoute = "";
                    }
                }
                $urlRoute = $this->prefix . $urlRoute;
            } else {
                $urlRoute =  $this->prefix.$foundRoute['url'];
            }
            return $urlRoute;
        } else {
            return "";
        }
    }

    public function notFound()
    {
        $allRoutes = $this->Routes;
        $foundRoute = $allRoutes[404];
        $url = $this->prefix . $foundRoute['url'];
        header('Location: '.$url);
        exit;
    }
}
