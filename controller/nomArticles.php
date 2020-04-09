<?php

    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class NomArticles extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){
               // traitement des donnees des formulaires ici
            }
            $this->render($this->request->action);
        }

        public function render($view){
            if ($view === ''){
                // afficher la vue si action n'existe pas (vide)
                echo 'ok';
            }
            else{
                switch ($view){
                     // inclure les vues ici selon la valeur de $view
                    case '':
                       
                    break;
    
                    case '':
                        
                    break;

                    default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                    $currentController = new Erreur($this->request);
                    $currentController->render();
                }
            }
        } 
    }