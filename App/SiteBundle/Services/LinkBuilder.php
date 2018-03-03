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

    public function __construct()
    {
        if ($this->Routes === null) {
            $this->Routes = Yaml::parseFile('Config/Routes.yaml');
        }
    }

    public function getLink($name, $parametres = null)
    {
        $route = $name;
        $parametres = $parametres;

        $allRoutes = $this->Routes;

        if (array_key_exists($name, $allRoutes)) {
            $foundRoute = $allRoutes[$route];
        }

        if (isset($foundRoute)) {
            $urlRoute = $foundRoute['url'];
            foreach ($parametres as $key => $value) {
                if (preg_match("/{" . $key . "}/", $urlRoute)) {
                    $urlRoute = str_replace("{" . $key . "}", $value, $urlRoute);
                } else {
                    $urlRoute = "kjmklj";
                }
            }
            return $urlRoute;
        }
    }
}
