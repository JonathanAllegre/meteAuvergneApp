<?php

namespace App\SiteBundle\Entity;

use Setup\Config;

class DataSource extends Config
{
    private $_idDataSource;
    private $_htmlTitle;
    private $_codeTitle;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            ### transformation camelCase ####
            $spacing = trim(str_replace("_", " ", $key));
            $spacing = ucwords($spacing);
            $spacing = str_replace(" ", "", $spacing);
            $key = lcfirst($spacing);

            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            } //method_exists( $this, $method )
        } //$donnees as $key => $value
    }

    // GETTERS

    public function getIdDataSource()
    {
        return $this->_idDataSource;
    }

    public function getHtmlTitle()
    {
        return $this->_htmlTitle;
    }

    public function getCodeTitle()
    {
        return $this->_codeTitle;
    }


    // SETTERS

    public function setIdDataSource($idDataSource)
    {
        $this->_idDataSource = $idDataSource;
    }

    public function setHtmlTitle($htmlTitle)
    {
        $this->_htmlTitle = $htmlTitle;
    }

    public function setCodeTitle($codeTitle)
    {
        $this->_codeTitle = $codeTitle;
    }
}
