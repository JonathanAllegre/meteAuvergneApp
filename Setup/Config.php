<?php

namespace Setup;

use \PDO as PDO;
use Symfony\Component\Yaml\Yaml;

class Config
{

    public static function parseConfigFile()
    {
        return  Yaml::parseFile(__DIR__.'/../Config/General.yaml');
    }

}
