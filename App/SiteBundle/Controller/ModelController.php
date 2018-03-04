<?php

namespace App\SiteBundle\Controller;

use App\SiteBundle\Entity\Parametre;
use App\SiteBundle\Services\AppFactory;
use App\SiteBundle\Services\LinkBuilder;

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
        if (empty($infoParametreMeteo)) {
            $notFound = new LinkBuilder();
            $notFound->notFound();
        } else {
            $infoSource = $sourcesManager->read($infoModel->getDataSourceId());
            $listeParam = $parametresManager->getAllParamByModel($infoModel->getIdModel(), $definition);

            $urlJson = AppFactory::getInfoFileJson($infoParametreMeteo->getInfoFile());
            $json = file_get_contents($urlJson);
            $infoMaj = json_decode($json, true);

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
    }


    private function getEcheancesParam(Parametre $infoParam, $run, $dateMaj)
    {
        $pasEcheance = $infoParam->getEcheance();
        $decalage = 1;

        $maj = date("d-m-Y", strtotime($dateMaj));
        for ($i = 1; $i < $infoParam->getNumberOfDates() +1; $i++) {
            $depart   =  $i * $pasEcheance + $decalage + $run + $infoParam->getDelay();
            $begin    = date("D d H:i", strtotime($maj . ' +' . $depart . ' Hours'));
            $echBar[] = array(
                    'begin' => $begin,
                );
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
        $infoParam = $infos['infoParametreMeteo'];

        $echeances = $this->getEcheancesParam($infoParam, $run, $dateMaj);
        
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
        $infoParam = $infos['infoParametreMeteo'];

        $echeances = $this->getEcheancesParam($infoParam, $run, $dateMaj);
        
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
    
    public function arpege01EuropeHd($parametres)
    {
        $infos = $this->getVar($parametres, 'arpege01', 'HD');

        $dateMaj = $infos['infoMaj']['dateMaj'];
        $run = $infos['infoMaj']['Run'];
        $infoParam = $infos['infoParametreMeteo'];

        $echeances = $this->getEcheancesParam($infoParam, $run, $dateMaj);


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

    public function arpege01FranceLd($parametres)
    {
        $infos = $this->getVar($parametres, 'arpege01', 'LD');

        $dateMaj = $infos['infoMaj']['dateMaj'];
        $run = $infos['infoMaj']['Run'];
        $infoParam = $infos['infoParametreMeteo'];

        $echeances = $this->getEcheancesParam($infoParam, $run, $dateMaj);


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
            AppFactory::getView('Model/Arpege01FranceLd', $variable);
        } else {
            $error = new ErrorController();
            $error->notFound();
        }
    }
}
