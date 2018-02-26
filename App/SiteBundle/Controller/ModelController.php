<?php

namespace App\SiteBundle\Controller;

use App\SiteBundle\Entity\Model;
use App\SiteBundle\Services\AppFactory;

class ModelController
{

    private function getVar($parametres, $model, $definition)
    {
        ### PARAMETRES ####
        $paramMeteo         = $parametres['parametre'];

        ### MANAGER ####
        $modeleManager     = AppFactory::getManager('Model');
        $parametresManager = AppFactory::getManager('Parametre');
        $sourcesManager    = AppFactory::getManager('DataSource');

        ### INFO ####
        $infoModel          = $modeleManager->getInfoModel($model);
        $infoParametreMeteo = $parametresManager->getInfoParametres($infoModel->getIdModel(), $paramMeteo, $definition);
        $infoSource         = $sourcesManager->read($infoModel->getDataSourceId());
        $listeParam         = $parametresManager->getAllParamByModel($infoModel->getIdModel(), $definition);

        $urlJson    = AppFactory::getInfoFileJson($infoParametreMeteo->getInfoFile());
        $json       = file_get_contents($urlJson);
        $infoMaj    = json_decode($json, true);

        if (isset($infoMaj)) {
            $data = array(
                'infoModel' => $infoModel,
                'infoParametreMeteo' => $infoParametreMeteo,
                'infoSource' => $infoSource,
                'infoMaj' => $infoMaj,
                'listeParam' => $listeParam);

            return $data;
        }
    }

    private function getEcheancesArome0025($dateMaj, $run, Model $infoModel)
    {
        if ($run == "12") {
            $maj = date("d-m-Y", strtotime($dateMaj));
            for ($i = 0; $i < $infoModel->getNumberOfDates(); $i++) {
                $depart   = $i + 19;
                $begin    = date("H", strtotime($maj . ' +' . $depart . ' Hours +30 Minutes'));
                $end      = $begin + 1;
                $echBar[] = array(
                            'begin' => $begin,
                            'end' => $end
                            );
            }
        }
        if ($run == "06") {
            $maj = date("d-m-Y", strtotime($dateMaj));
            for ($i = 0; $i < $infoModel->getNumberOfDates(); $i++) {
                $depart   = $i + 13;
                $begin    = date("H", strtotime($maj . ' +' . $depart . ' Hours +30 Minutes'));
                $end      = $begin + 1;
                $echBar[] = array(
                            'begin' => $begin,
                            'end' => $end
                            );
            }
        }
        if ($run == "00") {
            $maj = date("d-m-Y", strtotime($dateMaj));
            for ($i = 0; $i < $infoModel->getNumberOfDates(); $i++) {
                $depart   = $i + 7;
                $begin    = date("H", strtotime($maj . ' +' . $depart . ' Hours +30 Minutes'));
                $end      = $begin + 1;
                $echBar[] = array(
                            'begin' => $begin,
                            'end' => $end
                            );
            }
        }
        if (isset($echBar)) {
            return $echBar;
        }
    }

    private function getEcheancesArpege01($dateMaj, $run, Model $infoModel)
    {
        $pasEcheance = 6;
        if ($run == "00") {
            $maj = date("d-m-Y", strtotime($dateMaj));
            $nbEchPlus1 = $infoModel->getNumberOfDates() + 1;
            for ($i = 1; $i < $nbEchPlus1; $i++) {
                $depart   = $i * $pasEcheance;
                $begin    = date("D d H:i", strtotime($maj . ' +' . $depart . ' Hours'));
                $echBar[] = array(
                                'begin' => $begin,
                        );
            }
        }

        if (isset($echBar)) {
            return $echBar;
        }
    }


    public function arome0025Ld($parametres)
    {
        $infos      = $this->getVar($parametres, 'arome0025', 'LD');

        $dateMaj    = $infos['infoMaj']['dateMaj'];
        $run        = $infos['infoMaj']['Run'];
        $infoModel  = $infos['infoModel'];

        $echeances  = $this->getEcheancesArome0025($dateMaj, $run, $infoModel);
        
        ### Variables DE Vues ###
                    
        $variable['echBar']             = $echeances;
        $variable['dateMaj']            = $infos['infoMaj']['dateMaj'];
        $variable['run']                = $infos['infoMaj']['Run'];
        $variable['Source']             = $infos['infoSource'];
        $variable['infoParametreMeteo'] = $infos['infoParametreMeteo'];
        $variable['infoModel']          = $infos['infoModel'];
        $variable['listeParam']         = $infos['listeParam'];
        $variable['definition']         = 'LD';
                    
        if (!empty($variable['infoParametreMeteo'])) {
            AppFactory::getView('Model/Arome0025Ld', $variable);
        } else {
            $error = new ErrorController();
            $error->notFound();
        }
    }

    public function arome0025Hd($parametres)
    {
        $infos = $this->getVar($parametres, 'arome0025', 'HD');

        $dateMaj = $infos['infoMaj']['dateMaj'];
        $run = $infos['infoMaj']['Run'];
        $infoModel = $infos['infoModel'];

        $echeances = $this->getEcheancesArome0025($dateMaj, $run, $infoModel);
        
        ### Variables DE Vues ###
                    
        $variable['echBar']             = $echeances;
        $variable['dateMaj']            = $infos['infoMaj']['dateMaj'];
        $variable['run']                = $infos['infoMaj']['Run'];
        $variable['Source']             = $infos['infoSource'];
        $variable['infoParametreMeteo'] = $infos['infoParametreMeteo'];
        $variable['infoModel']          = $infos['infoModel'];
        $variable['listeParam']         = $infos['listeParam'];
        $variable['definition']         = 'HD';

        if (!empty($variable['infoParametreMeteo'])) {
            AppFactory::getView('Model/Arome0025Hd', $variable);
        } else {
            $error = new ErrorController();
            $error->notFound();
        }
    }
    
    public function arpege01Hd($parametres)
    {
        $infos = $this->getVar($parametres, 'arpege01', 'HD');

        $dateMaj = $infos['infoMaj']['dateMaj'];
        $run = $infos['infoMaj']['Run'];
        $infoModel = $infos['infoModel'];

        $echeances = $this->getEcheancesArpege01($dateMaj, $run, $infoModel);
        
        ### Variables DE Vues ###
                    
        $variable['echBar']             = $echeances;
        $variable['dateMaj']            = $infos['infoMaj']['dateMaj'];
        $variable['run']                = $infos['infoMaj']['Run'];
        $variable['Source']             = $infos['infoSource'];
        $variable['infoParametreMeteo'] = $infos['infoParametreMeteo'];
        $variable['infoModel']          = $infos['infoModel'];
        $variable['listeParam']         = $infos['listeParam'];
        $variable['definition']         = 'HD';

        if (!empty($variable['infoParametreMeteo'])) {
            AppFactory::getView('Model/Arpege01Hd', $variable);
        } else {
            $error = new ErrorController();
            $error->notFound();
        }
    }
}
