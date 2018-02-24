<?php

namespace App\SiteBundle\Services\ForecastController;

class DynamicCss
{

    /**
     * @param $dir float
     * @return string
     */
    public static function cssWdir($dir)
    {
        $dirVent = $dir;
        $dirVent = $dirVent + 90;
        return "
        max-width: 20px;
        transform : rotate(" . $dirVent . "deg);
        -webkit-transform: rotate(" . $dirVent . "deg); ";
    }

    /**
     * @param $windMoy float
     * @return string
     */
    public static function cssWind($windMoy)
    {
        $ventMoy = $windMoy;

        // $temp = $temp*10;
        // $temp = $temp*2;

        $ventMoyCss = round(($ventMoy * 10));
        $ventMoycss = "background-color: rgba(" . $ventMoyCss . ", 150, 107, 0.9); color:white";
        return $ventMoycss;
    }

    /**
     * @param $temp float
     * @return string
     */
    public static function cssTemp($temp)
    {
        if ($temp >= 0) {
            $tempMax = 45;
            $couleurMax = 230;
            $couleurMin = 76;
            $ecart = $couleurMax - $couleurMin;
            $totalPossibilite = $ecart * 4; // 154 * 4 = 616
                $possiParDeg = $totalPossibilite / $tempMax; // possibilite de nuance par pas de 1Ã‚Â° ( 616/45 = 13,7 )
                $score = round($temp * $possiParDeg);
            if ($score <= 154) {
                // base = R->76 V->230 B->230
                    
                $valeur = $couleurMax - ($score);
                $cssTemp = "background-color: rgba(76, 230, " . $valeur . ", 1); color:black";
            }

            if ($score > 154 && $score <= 308) {
                // base = R->76 V->230 B->76

                $score2 = $score - 154;
                $valeur = 76 + ($score2);
                $cssTemp = "background-color: rgba(" . $valeur . ", 230, 76, 1); color:black";
            }

            if ($score > 308 && $score <= 462) {
                // base = R=230 V=230 B=76

                $score2 = $score - 308;
                $valeur = 230 - ($score2);
                $cssTemp = "background-color: rgba(230," . $valeur . ", 76, 1); color:black";
            }

            if ($score > 462 && $score <= 616) {
                // base = R=230 V=230 B=76

                $score2 = $score - 462;
                $valeur = 230 - ($score2);
                $cssTemp = "background-color: rgba(" . $valeur . ",76, 76, 1); color:white";
            }

            if ($score > 616) {
                $cssTemp = "background-color: rgba(0,0, 0, 1); color:white";
            }
        }

        if ($temp < 0) {
            $temp = abs($temp);
            $tempMax = 45;
            $couleurMax = 230;
            $couleurMin = 76;
            $ecart = $couleurMax - $couleurMin;
            $totalPossibilite = $ecart * 4; // 154 * 4 = 616
                $possiParDeg = $totalPossibilite / $tempMax; // possibilite de nuance par pas de 1Ã‚Â° ( 616/45 = 13,7 )
                $score = round($temp * $possiParDeg);
            $cssTemp = "background-color: rgba(0,0, 0, 1); color:white";
            if ($score <= 154) {
                // base = R->76 V->230 B->230
                // on baisse les verts

                $valeur = $couleurMax - ($score);
                if ($score > 82) {
                    $cssTemp = "background-color: rgba(76," . $valeur . ",230, 1); color:white";
                } else {
                    $cssTemp = "background-color: rgba(76," . $valeur . ",230, 1); color:black";
                }
            }

            if ($score > 154 && $score <= 308) {
                // base = R->76 V->230 B->76
                // On Augmente les Rouges

                $score2 = $score - 154;
                $valeur = 76 + ($score2);
                $cssTemp = "background-color: rgba(" . $valeur . ", 76, 230, 1); color:white";
            }

            if ($score > 308 && $score <= 462) {
                // base = R=230 V=230 B=76
                // On Baisse les bleus

                $score2 = $score - 308;
                $valeur = 230 - ($score2);
                $cssTemp = "background-color: rgba(230,76," . $valeur . ", 1); color:black";
            }
        }

        if (isset($cssTemp)) {
            return $cssTemp;
        } else {
            return "Erreur";
        }
    }

    /**
     * @param $precip
     * @return string
     */
    public static function cssApcp($precip)
    {

        $precip = $precip / 4;
        $precip = round($precip, 1);
        if ($precip < 0.5) {
            $cssprecip = "background-color: rgba(0, 77, 103, " . $precip . "); color:black";
        } else {
            $cssprecip = "background-color: rgba(0, 77, 103, " . $precip . "); color:white";
        }

        return $cssprecip;
    }


    /**
     * @param $tcdc integer % de luminosité
     * @param $csnow float
     * @param $apcp float
     * @return string
     */
    public static function weather($tcdc, $csnow, $apcp)
    {

        if ($tcdc <= 5) {
            $icon = "32.png";
        } elseif ($tcdc >= 6 and $tcdc <=25) {
            $icon = "34.png";
        } elseif ($tcdc >= 26 and $tcdc <=60) {
            if ($apcp > 0) {
                $icon = "39.png";
                if ($csnow >= 0.1) {
                    $icon = "13.png";
                }
            } else {
                $icon = "30.png";
            }
        } elseif ($tcdc >= 61 and $tcdc <=85) {
            if ($apcp <= 0.03) {
                $icon = "28.png";
            } else {
                if ($csnow >= 0.1) {
                    $icon = "15.png";
                } else {
                    $icon = "39.png";
                }
            }
        } elseif ($tcdc >= 86 and $tcdc <=100) {
            if ($apcp == 0) {
                $icon = "26.png";
            } elseif ($apcp > 0 and $apcp <= 0.2) {
                if ($csnow > 0) {
                    $icon = "13.png";
                } else {
                    $icon = "11.png";
                }
            } else {
                if ($csnow > 0) {
                    $icon = "14.png";
                } else {
                    $icon = "12.png";
                }
            }
        } else {
            $icon = "h";
        }
        return $icon;
    }
}
