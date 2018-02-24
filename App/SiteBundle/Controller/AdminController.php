<?php

namespace App\SiteBundle\Controller {

    class AdminController extends AppController
    {
        public function index($parametres = null)
        {
            $this->render('Admin/Index.twig');
        }

        public function model($parametres = null)
        {
            $ModeleManager   = new ModeleManager();

            if ($parametres[0] == "add") {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $donnees = array(

                        'titre' => $_POST['titre'],
                        'Description' => $_POST['Description']
                    );

                    $Modele        = new Modele($donnees);
                    $ModeleManager->create($Modele);
                }

                $variable['listeModel'] = $ModeleManager->liste();

                $this->render('Admin/modelAdd.twig', $variable);
            }
        }
    }
}
