<?php

namespace Setup;

use Symfony\Component\Yaml\Yaml;

class Config
{
    protected $mod;
    protected $dbHost;
    protected $dbName;
    protected $dbUser;
    protected $dbMdp;
    protected $prefix;
    protected $twigCache;
    protected $cachePath;

    public function __construct()
    {
        $config = Yaml::parseFile(__DIR__.'/../Config/General.yaml');
        if ($config['mod'] == 1) {
            $this->mod = $config['mod'];
            $this->dbHost = $config['bddLocal']['host'];
            $this->dbName = $config['bddLocal']['dbname'];
            $this->dbUser = $config['bddLocal']['utilisateur'];
            $this->dbMdp = $config['bddLocal']['mdp'];
            $this->prefix = $config['prefixLocal'];
        } else {
            $this->mod = $config['mod'];
            $this->dbHost = $config['bddProd']['host'];
            $this->dbName = $config['bddProd']['dbname'];
            $this->dbUser = $config['bddProd']['utilisateur'];
            $this->dbMdp = $config['bddProd']['mdp'];
            $this->prefix = $config['prefixProd'];
        }

        $this->twigCache = $config['twigCache'];
        $this->cachePath = $config['cachePath'];
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getDbHost()
    {
        return $this->dbHost;
    }

    public function getDbName()
    {
        return $this->dbName;
    }

    public function getDbUser()
    {
        return $this->dbUser;
    }

    public function getDbMdp()
    {
        return $this->dbMdp;
    }

    public function getTwigCache()
    {
        return $this->twigCache;
    }

    public function getCachePath()
    {
        return $this->cachePath;
    }
}
