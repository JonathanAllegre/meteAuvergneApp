<?php

namespace App\SiteBundle\Manager;

use App\SiteBundle\Entity\City as EntityVille;
use \PDO as PDO;
use Setup\Config as Config;

class City extends Config
{
    private $_db;
    
    public function __construct()
    {
        $this->setdb();
    }
    
    public function setdb()
    {
        $this->_db = $this->getPdo(); // on suppose que pdo est dans Config
    }

    public function readActive()
    {
        $req = $this->_db->prepare('SELECT *
									FROM city
									WHERE active_arome0025 = :active');

        $req->bindValue(':active', 1);
        $req->execute();

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $data[] = new EntityVille($donnees);
        }

        if (!empty($data)) {
            return $data;
        }
    }

    public function search($search)
    {
        $req = $this->_db->prepare('SELECT *
                                    FROM city
                                    WHERE simple_name LIKE :simple_name
                                    AND department in (63,43,03,15)
                                    ORDER BY zip_code');

        $req->bindValue(':simple_name', '%'.$search.'%');
        $req->execute();

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $data[] = new EntityVille($donnees);
        }

        if (!empty($data)) {
            return $data;
        }
    }

    public function read($id)
    {
        $req = $this->_db->prepare('  SELECT *
                                    FROM city
                                    WHERE id_city = :id');

        $req->bindValue(':id', $id);
        $req->execute();

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        if (!empty($donnees)) {
            $data = new EntityVille($donnees);
            return $data;
        }
    }
}
