<?php

namespace App\SiteBundle\Entity;

use Setup\Config as Config;

class Model extends Config
{
    private $_idModel;
    private $_title;
    private $_showOrder;
    private $_codeTitle;
    private $_description;
    private $_smallDescription;
    private $_thumbnail;
    private $_dataSourceId;
    private $_url;
    private $_active;
    private $_numberOfDates;


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

    public function getIdModel()
    {
        return $this->_idModel;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getShowOrder()
    {
        return $this->_showOrder;
    }

    public function getCodeTitle()
    {
        return $this->_codeTitle;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getSmallDescription()
    {
        return $this->_smallDescription;
    }

    public function getThumbnail()
    {
        return $this->_thumbnail;
    }

    public function getDataSourceId()
    {
        return $this->_dataSourceId;
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function getActive()
    {
        return $this->_active;
    }

    public function getNumberOfDates()
    {
        return $this->_numberOfDates;
    }


    // SETTERS

    public function setIdModel($idModel)
    {
        $this->_idModel = $idModel;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
    }

    public function setShowOrder($showOrder)
    {
        $this->_showOrder = $showOrder;
    }

    public function setCodeTitle($codeTitle)
    {
        $this->_codeTitle = $codeTitle;
    }

    public function setDescription($description)
    {
        $this->_description = $description;
    }

    public function setSmallDescription($smallDescription)
    {
        $this->_smallDescription = $smallDescription;
    }

    public function setThumbnail($thumbnail)
    {
        $this->_thumbnail = $thumbnail;
    }

    public function setDataSourceId($dataSourceId)
    {
        $this->_dataSourceId = $dataSourceId;
    }

    public function setUrl($url)
    {
        $this->_url = $url;
    }

    public function setActive($active)
    {
        $this->_active = $active;
    }

    public function setNumberOfDates($numberOfDates)
    {
        $this->_numberOfDates = $numberOfDates;
    }
}
