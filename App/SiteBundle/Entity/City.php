<?php

namespace App\SiteBundle\Entity;

use Setup\Config as Config;

class City extends Config
{
    private $_idCity;
    private $_department;
    private $_slug;
    private $_name;
    private $_simpleName;
    private $_realName;
    private $_zipCode;
    private $_longitude;
    private $_latitude;
    private $_minimalAltitude;
    private $_maximalAltitude;
    private $_activeArome0025;
    private $_activeArome001;
    private $_activeArpege;
    private $_activeGfs;


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

    public function getIdCity()
    {
        return $this->_idCity;
    }

    public function getDepartment()
    {
        return $this->_department;
    }

    public function getSlug()
    {
        return $this->_slug;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getSimpleName()
    {
        return $this->_simpleName;
    }

    public function getRealName()
    {
        return $this->_realName;
    }

    public function getZipCode()
    {
        return $this->_zipCode;
    }

    public function getLongitude()
    {
        return $this->_longitude;
    }

    public function getLatitude()
    {
        return $this->_latitude;
    }

    public function getMinimalAltitude()
    {
        return $this->_minimalAltitude;
    }

    public function getMaximalAltitude()
    {
        return $this->_maximalAltitude;
    }

    public function getActiveArome0025()
    {
        return $this->_activeArome0025;
    }

    public function getActiveArome001()
    {
        return $this->_activeArome001;
    }

    public function getActiveArpege()
    {
        return $this->_activeArpege;
    }

    public function getActiveGfs()
    {
        return $this->_activeGfs;
    }


    // SETTERS

    public function setIdCity($idCity)
    {
        $this->_idCity = $idCity;
    }

    public function setDepartment($department)
    {
        $this->_department = $department;
    }

    public function setSlug($slug)
    {
        $this->_slug = $slug;
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function setSimpleName($simpleName)
    {
        $this->_simpleName = $simpleName;
    }

    public function setRealName($realName)
    {
        $this->_realName = $realName;
    }

    public function setZipCode($zipCode)
    {
        $this->_zipCode = $zipCode;
    }

    public function setLongitude($longitude)
    {
        $this->_longitude = $longitude;
    }

    public function setLatitude($latitude)
    {
        $this->_latitude = $latitude;
    }

    public function setMinimalAltitude($minimalAltitude)
    {
        $this->_minimalAltitude = $minimalAltitude;
    }

    public function setMaximalAltitude($maximalAltitude)
    {
        $this->_maximalAltitude = $maximalAltitude;
    }

    public function setActiveArome0025($activeArome0025)
    {
        $this->_activeArome0025 = $activeArome0025;
    }

    public function setActiveArome001($activeArome001)
    {
        $this->_activeArome001 = $activeArome001;
    }

    public function setActiveArpege($activeArpege)
    {
        $this->_activeArpege = $activeArpege;
    }

    public function setActiveGfs($activeGfs)
    {
        $this->_activeGfs = $activeGfs;
    }
}
