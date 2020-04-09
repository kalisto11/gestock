<?php

    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class NomArticles extends Controller{

        public function render(){
            if ($this->request->method === 'GET'){
                if ($this->request->action === ''){
                    // afficher la liste des articles ici
                }
                else{
                    switch ($this->request->action){

                        case 'voirpostes':
                        break;

                        case 'ajouterposte':
                            echo 'Afficher formulaire d\'ajout de poste ici';
                        break;
                    
                        default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                        $currentController = new Erreur($this->request);
                        $currentController->render();
                    }
                }
            }
            else if($this->request->method === 'POST'){
                echo 'traitement des donnees des formulaires ici';
            }  
        } 
    }