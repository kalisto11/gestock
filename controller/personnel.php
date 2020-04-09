<?php

    /*
    * Controleur du module nom personnel pour la gestion de la liste du personnel
    */

    require_once CONTROLLER . 'controller.php';
    class Personnel extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){
               if ($this->request->action != null){
                   switch ($this->request->action){
                       case 'ajouterposte':
                        $poste = new Poste(null, $_POST['nom']);
                        $poste->save();
                       break;
                   }
               }
            }
            $this->render($this->request->action);
        }

        public function render($view){
            if ($this->request->action === ''){
                echo 'afficher la liste du personnel ici';
            }
            else{
                switch ($view){

                    case 'voirpostes':
                    break;
    
                    case 'ajouterposte':
                        require_once VIEW . 'personnel/ajoutposte.php';
                    break;
    
                    case 'modifierposte':
                        echo 'Afficher formulaire de modification de poste ici';
                    break;
    
                    case 'supprimerposte':
                        echo 'supprimer le poste ici';
                    break;
                
                    default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                    $currentController = new Erreur($this->request);
                    $currentController->render();
                }
            }  
        }
    }