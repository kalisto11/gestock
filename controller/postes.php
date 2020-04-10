<?php

    /*
    * Controleur du module nom personnel pour la gestion de la liste du personnel
    */

    require_once CONTROLLER . 'controller.php';
    class Postes extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
               if ($this->request->action != null){
                   switch ($this->request->action){
                       case 'traitement-poste':
                        switch ($_POST['operation']){
                            case 'ajouter':
                                $poste = new Poste();
                                $poste->nom = $_POST['nomPoste'];
                                $poste->save();
                                $this->request->action = 'liste-postes';
                                $this->render();
                               break;
                            break;

                            case 'modifier':
                                $poste = new Poste($_POST['idPoste']);
                                $poste->nom = $_POST['nomPoste'];
                                $poste->update();
                                $this->request->action = 'liste-postes';
                                $this->render();
                               break;
                            break;

                            default;
                        }
                   }
               }
            }
            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                
                switch ($this->request->action){

                    case 'liste-postes':
                        $this->render();
                    break;

                    case 'supprimer-poste':
                        $idPoste = intval($this->request->id);
                        $poste  = new Poste($idPoste, null);
                        $poste->delete();
                        $this->request->action = 'liste-postes';
                        $this->render();
                    break;

                    case 'modifier-poste':
                        $this->render();
                    break;
                }   
            }
        } // fin méthode process

        public function render(){
            switch ($this->request->action){

                case 'liste-postes':
                    $postes = Poste::findAll();
                    require_once VIEW . 'personnel/listepostes.php';
                break;

                case 'modifier-poste':
                    $idPoste = intval($this->request->id);
                    $currentPoste = new Poste($idPoste);
                    $postes = Poste::findAll();
                    require_once VIEW . 'personnel/listepostes.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->render();
            }
        }
    }