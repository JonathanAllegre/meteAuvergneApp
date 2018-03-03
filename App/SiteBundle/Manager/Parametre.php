<?php

namespace App\SiteBundle\Manager;

use App\SiteBundle\Entity\Parametre as EntityParametre;
use \PDO as PDO;
use Setup\Config as Config;

class Parametre extends Config
{
    private $_db;
    
    public function __construct(PDO $bdd)
    {
        $this->_db = $bdd;
    }

    
    public function getInfoParametres($model_id, $slug, $definition)
    {
        $req = $this->_db->prepare('	SELECT *
										FROM parametre
										WHERE model_id = :model_id
										AND slug = :slug
                                        AND definition = :definition');

        $req->bindValue(':model_id', $model_id);
        $req->bindValue(':slug', $slug);
        $req->bindValue(':definition', $definition);
        $req->execute();
        $donnees = $req->fetch(PDO::FETCH_ASSOC);


        if (!empty($donnees)) {
            $data = new EntityParametre($donnees);
            return $data;
        }
    }
    
    public function getAllParamByModel($model_id, $definition)
    {
        $req = $this->_db->prepare('	SELECT *
										FROM parametre
										WHERE model_id = :model_id
                                        AND definition = :definition
										ORDER BY id_parametre ASC');
            
        $req->bindValue(':model_id', $model_id);
        $req->bindValue(':definition', $definition);
        $req->execute();
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC)) {
            $data[] = new EntityParametre($donnees);
        }

        if (!empty($data)) {
            return $data;
        }
    }
}
