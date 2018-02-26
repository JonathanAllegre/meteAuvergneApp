<?php

namespace App\SiteBundle\Manager;

use App\SiteBundle\Entity\Model as EntityModel;
use \PDO as PDO;


class Model
{
    private $_db;
    
    public function __construct(PDO $bdd)
    {
        $this->_db = $bdd;
    }
    

    public function getModelMf($data_source_id)
    {
        $req = $this->_db->prepare('	SELECT *
										FROM model
										WHERE data_source_id = :data_source_id
										ORDER BY show_order ASC');

        $req->bindValue(':data_source_id', $data_source_id);
        $req->execute();
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $data[] = new EntityModel($donnees);
        }

        if (!empty($data)) {
            return $data;
        }
    }

    /**
     * @param $code_title
     * @return \App\SiteBundle\Entity\Model
     */
    public function getInfoModel($code_title)
    {
        $req = $this->_db->prepare('	SELECT *
										FROM model
										WHERE code_title = :code_title');

        $req->bindValue(':code_title', $code_title);
        $req->execute();

        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        if (!empty($donnees)) {
            $data = new EntityModel($donnees);
            return $data;
        }
    }
}
