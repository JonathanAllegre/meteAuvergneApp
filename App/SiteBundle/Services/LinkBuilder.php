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

    public function test($name, $parametres)
    {
        $explode = explode(";", $parametres);

        var_dump($explode);
        $routes = $this->Routes;
        var_dump($routes);
        return $routes[$name]['url'];
    }
}
