<?php

namespace App\SiteBundle\Manager;

use App\SiteBundle\Entity\DataSource as dataSourceEntity;
use Setup\Config as Config;
use \PDO as PDO;

class DataSource extends Config
{
    private $_db;
    
    public function __construct()
    {
        $this->setdb();
    }
    
    public function setdb()
    {
        // on suppose que pdo est dans Config
        $this->_db = $this->getPdo();
    }

    public function read($id_data_source)
    {
        $req = $this->_db->prepare('	SELECT *
									FROM dataSource
									WHERE id_data_source = :id_data_source');

        $req->bindValue(':id_data_source', $id_data_source);
        $req->execute();

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        if (!empty($donnees)) {
            $data = new dataSourceEntity($donnees);
            return $data;
        }
    }
}
