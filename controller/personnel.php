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
                       case 'traitement-ajouter-poste':
                        $poste = new Poste(null, $_POST['nom']);
                        $poste->save();
                        $this->request->action = 'liste-postes';
                        $this->render();
                       break;
                   }
               }
            }
            else if ($this->request->method === 'GET'){
                $this->render($this->request->action);
            }
        } // fin méthode process

        public function render(){
            if ($this->request->action === ''){
                $this->request->action = 'liste-personnel';
                // recupere et afficher liste personnel
            }
            else{
                switch ($this->request->action){

                    case 'liste-postes':
                        $postes = Poste::findAll();
                        require_once VIEW . 'personnel/listeposte.php';
                    break;
    
                    case 'ajouter-poste':
                        require_once VIEW . 'personnel/ajoutposte.php';
                    break;
    
                    case 'modifier-poste':
                        $idPoste = intval($this->request->id);
                        $poste  = new Poste($idPoste);
                        require_once VIEW . 'personnel/modifposte.php';
                    break;
    
                    case 'supprimer-poste':
                        $idPoste = intval($this->request->id);
                        $poste  = new Poste($idPoste);
                        $poste->delete();
                        $postes = Poste::findAll();
                        require_once VIEW . 'personnel/listeposte.php';
                    break;
                
                    default: // gestion des erreurs au cas ou la valeur de action 
                        $currentController = new Erreur($this->request);
                        $currentController->render();
                }
            }
        }
    }