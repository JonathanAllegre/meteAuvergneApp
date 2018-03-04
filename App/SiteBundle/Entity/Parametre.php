<?php

namespace App\SiteBundle\Entity;

use Setup\Config as Config;

class Parametre extends Config
{
    private $_idParametre;
    private $_modelId;
    private $_definition;
    private $_slug;
    private $_htmlTitle;
    private $_codeTitle;
    private $_buttonTitle;
    private $_description;
    private $_url;
    private $_infoFile;
    private $_mapFile;
    private $_active;
    private $_numberOfDates;
    private $_echeance;
    private $_delay;


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

    public function getIdParametre()
    {
        return $this->_idParametre;
    }

    public function getModelId()
    {
        return $this->_modelId;
    }

    public function getDefinition()
    {
        return $this->_definition;
    }

    public function getSlug()
    {
        return $this->_slug;
    }

    public function getHtmlTitle()
    {
        return $this->_htmlTitle;
    }

    public function getCodeTitle()
    {
        return $this->_codeTitle;
    }

    public function getButtonTitle()
    {
        return $this->_buttonTitle;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function getInfoFile()
    {
        return $this->_infoFile;
    }

    public function getMapFile()
    {
        return $this->_mapFile;
    }

    public function getActive()
    {
        return $this->_active;
    }

    public function getNumberOfDates()
    {
        return $this->_numberOfDates;
    }

    public function getEcheance()
    {
        return $this->_echeance;
    }

    public function getDelay()
    {
        return $this->_delay;
    }




    // SETTERS

    public function setIdParametre($idParametre)
    {
        $this->_idParametre = $idParametre;
    }

    public function setModelId($modelId)
    {
        $this->_modelId = $modelId;
    }

    public function setDefinition($definition)
    {
        $this->_definition = $definition;
    }

    public function setSlug($slug)
    {
        $this->_slug = $slug;
    }

    public function setHtmlTitle($htmlTitle)
    {
        $this->_htmlTitle = $htmlTitle;
    }

    public function setCodeTitle($codeTitle)
    {
        $this->_codeTitle = $codeTitle;
    }

    public function setButtonTitle($buttonTitle)
    {
        $this->_buttonTitle = $buttonTitle;
    }

    public function setDescription($description)
    {
        $this->_description = $description;
    }

    public function setUrl($url)
    {
        $this->_url = $url;
    }

    public function setInfoFile($infoFile)
    {
        $this->_infoFile = $infoFile;
    }

    public function setMapFile($mapFile)
    {
        $this->_mapFile = $mapFile;
    }

    public function setActive($active)
    {
        $this->_active = $active;
    }

    public function setNumberOfDates($numberOdDates)
    {
        $this->_numberOfDates = $numberOdDates;
    }

    public function setEcheance($echeance)
    {
        $this->_echeance = $echeance;
    }

    public function setDelay($delay)
    {
        $this->_delay = $delay;
    }
}
