<?php

namespace App\SiteBundle\Controller;


use App\SiteBundle\Services\ForecastController\DynamicCss as Css;
use Zend\Diactoros\ServerRequestFactory as ServerRequestFactory;

class ForecastController extends AppController
{
    public function index($parametres = null)
    {
        $villesManager      = parent::getCityManager();
        $modelManager       = parent::getModelManager();
        $activeCities       = $villesManager->readActive();

        $view['activeCities']   = $activeCities;
        $view['request']        = ServerRequestFactory::fromGlobals($_SERVER, $_GET);
        $view['infoModel']      = $modelManager->getInfoModel($parametres['model']);

        parent::renderView('Forecast/Index', $view);
    }

    /**
     * @param $parametres array
     */
    public function forecast($parametres)
    {
        $idVille    = $parametres['idVille'];
        $model      = $parametres['model'];

        #### Recuperation des infos Model ####

        $modeleManager = parent::getModelManager();
        $cityManager   = parent::getCityManager();

        $infoModel     = $modeleManager->getInfoModel($model);
        $infoCity      = $cityManager->read($idVille);

        #### Reecriture du path selon model #####
        if ($model == "arome0025") {
            $urlJson = $this->getdataForecastJson()."/arome0.025/data.json";
        }

        ### Get et DEcode Json ########
        $json = file_get_contents($urlJson);
        $data = json_decode($json);
        $villeJson = 'V-'.$idVille;
        $forecast = $data->$villeJson;


        ### traitement pour pluie ####
        foreach ($forecast as $value) {
            $tprate[] = $value->TPRATE;
        }

        $i = 0;
        foreach ($forecast as $key => $value) {
            $iM1 = abs($i - 1);

            ### Pour Graphique ########
            $date = new \DateTime($key);
            $date = $date->format('d - H').'h';
            $tmp = round($value->TMP - 273.15, 2);
            $precip = abs(round($value->TPRATE - $tprate[$iM1], 1));

            $donneesTmp[] = array('date' => $date, 'visits' => $tmp);
            $donnesPrecip[] =  array('date' => $date, 'visits' => $precip);
            $donnesWind[] =  array('date' => $date,
                'wind' => round($value->WIND * 3.6),
                "gust" => abs(round($value->GUST * 3.6)));
            $donnesPression[] =  array('date' => $date, 'pres' => round($value->Pression / 100));


            ### Pour Tableaux ######
            $csnow = round($value->SNOM);
            $apcp = abs(round($value->TPRATE - $tprate[$iM1], 1));
            $tcdc = $value->TCDC;
            $precip1 = round($value->TPRATE - $tprate[$iM1], 1);
            $frcst[$key] = array(
                'PRES'      => round($value->Pression / 100),
                'TMP'       => round($value->TMP - 273.15),
                'CSSTMP'    => CSS::cssTemp(round($value->TMP - 273.15)),
                'TCDC'      => $value->TCDC,
                'RH'        => round($value->RH),
                'WDIR'      => $value->WDIR,
                'CSSWDIR'   => CSS::cssWdir($value->WDIR),
                'WIND'      => round($value->WIND * 3.6),
                'CSSWIND'   => CSS::cssWind($value->WIND),
                'GUST'      => abs(round($value->GUST * 3.6)),
                'CSSGUST'   => CSS::cssWind($value->GUST),
                'PRECIP'    => abs(round($value->TPRATE - $tprate[$iM1], 1)),
                'CSSPRECIP' => CSS::cssApcp($precip1),
                'TPRATE'    => abs(round($value->TPRATE, 1)),
                'SNOM'      => round($value->SNOM),
                'GPRATE'    => round($value->GPRATE),
                'weather'   => CSS::weather($tcdc, $csnow, $apcp)
            );
            $i++;
        }

        $forecastJson['Tmp'] = json_encode($donneesTmp, JSON_HEX_QUOT);
        $forecastJson['Precip'] = json_encode($donnesPrecip, JSON_HEX_QUOT);
        $forecastJson['Wind'] = json_encode($donnesWind, JSON_HEX_QUOT);
        $forecastJson['Pres'] = json_encode($donnesPression, JSON_HEX_QUOT);

        $view['frcst'] = $frcst;
        $view['infoModel'] = $infoModel;
        $view['infoCity'] = $infoCity;
        $view['forecastJson'] = $forecastJson;


        parent::renderView('Forecast/Forecast', $view);
    }

    public function search($parametres)
    {
        $view = ServerRequestFactory::fromGlobals($_SERVER, $_GET);
        $data = $view->getParsedBody();
        $ville = $data['ville'];

        $variable['searchFor'] = $ville;

        $cityManager = parent::getCityManager();

        $result = $cityManager->search($ville);

        $variable['results'] = $result;

        parent::renderView('Forecast/Search', $variable);
    }
}
