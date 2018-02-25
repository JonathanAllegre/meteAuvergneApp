<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 25/02/2018
 * Time: 18:10
 */

namespace App\SiteBundle\Services;


class AppFactory extends Config
{
    private $config;

    public function getConfig()
    {
        if($this->config === null){
            $this->config = $this->parseConfigFile();
            return this->config;
        }else{
            return $this->config;
        }
    }


}
