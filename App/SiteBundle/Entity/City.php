<?php

namespace App\SiteBundle\Entity;

use Setup\Config as Config;

class City extends Config
{
    private $idCity;
    private $department;
    private $slug;
    private $name;
    private $simpleName;
    private $realName;
    private $zipCode;
    private $longitude;
    private $latitude;
    private $minimalAltitude;
    private $maximalAltitude;
    private $activeArome0025;
    private $activeArome001;
    private $activeArpege;
    private $activeGfs;


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
        return $this->idCity;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSimpleName()
    {
        return $this->simpleName;
    }

    public function getRealName()
    {
        return $this->realName;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getMinimalAltitude()
    {
        return $this->minimalAltitude;
    }

    public function getMaximalAltitude()
    {
        return $this->maximalAltitude;
    }

    public function getActiveArome0025()
    {
        return $this->activeArome0025;
    }

    public function getActiveArome001()
    {
        return $this->activeArome001;
    }

    public function getActiveArpege()
    {
        return $this->activeArpege;
    }

    public function getActiveGfs()
    {
        return $this->activeGfs;
    }


    // SETTERS

    public function setIdCity($idCity)
    {
        $this->idCity = $idCity;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSimpleName($simpleName)
    {
        $this->simpleName = $simpleName;
    }

    public function setRealName($realName)
    {
        $this->realName = $realName;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setMinimalAltitude($minimalAltitude)
    {
        $this->minimalAltitude = $minimalAltitude;
    }

    public function setMaximalAltitude($maximalAltitude)
    {
        $this->maximalAltitude = $maximalAltitude;
    }

    public function setActiveArome0025($activeArome0025)
    {
        $this->activeArome0025 = $activeArome0025;
    }

    public function setActiveArome001($activeArome001)
    {
        $this->activeArome001 = $activeArome001;
    }

    public function setActiveArpege($activeArpege)
    {
        $this->activeArpege = $activeArpege;
    }

    public function setActiveGfs($activeGfs)
    {
        $this->activeGfs = $activeGfs;
    }
}
