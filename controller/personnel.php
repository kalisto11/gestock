<?php

    /*
    * Controleur du module nom personnel pour la gestion de la liste du personnel
    */

    require_once CONTROLLER . 'controller.php';
    class Personnel extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
               if ($this->request->action != null){
                   switch ($this->request->action){
                       case 'traitement-poste':
                        switch ($_POST['operation']){
                            case 'ajouter':
                                if (!empty($_POST['nomPoste'])){
                                    $poste = new Poste();
                                    $poste->nom = $_POST['nomPoste'];
                                    $poste->save();
                                    $this->message['type'] = 'success';
                                    $this->message['contenu'] = 'Le poste a été ajouté avec succès.';
                                }
                                else{
                                    $this->message['type'] = 'danger';
                                    $this->message['contenu'] = "Le nom du poste ne doit pas etre vide.";
                                }
                                $this->request->action = 'liste-postes';
                                $this->render($this->message);
                            break;

                            case 'modifier':
                                $poste = new Poste($_POST['idPoste']);
                                $poste->nom = $_POST['nomPoste'];
                                if (!empty($_POST['nomPoste'])){
                                    $poste->update();
                                    $this->message['type'] = 'success';
                                    $this->message['contenu'] = 'Le poste a été modifié avec succès.';
                                    $this->request->action = 'liste-postes';
                                }
                                else{
                                    $this->message['type'] = 'danger';
                                    $this->message['contenu'] = 'Le nom du poste ne doit pas etre vide.';
                                    $this->request->action = 'modifier-poste';
                                    $this->request->id = $poste->id;
                                }
                               
                                $this->render($this->message);
                            break;

                            default:
                            $this->message['type'] = 'danger';
                            $this->message['contenu'] = 'Une erreur s\'est produite pendant le traitement des données. Veuillez rééssayer svp.';
                            $this->request->action = 'liste-postes';
                            $this->render($this->message);
                        }
                   }
               }
            }
            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                
                switch ($this->request->action){

                    case 'liste-personnel':
                        $this->render();
                    break;

                    case 'supprimer-personnel':
                        $idPoste = intval($this->request->id);
                        $poste  = new Poste($idPoste, null);
                        $poste->delete();
                        $this->request->action = 'liste-postes';
                        $this->message['type'] = 'success';
                        $this->message['contenu'] = 'Le poste a été supprimé avec succès.';
                        $this->render($this->message);
                    break;

                    case 'modifier-personnel':
                        $this->render();
                    break;
                }   
            }
        } // fin méthode process

        public function render($message = null){
            switch ($this->request->action){

                case 'liste-personnel':
                    $personnels = Personnels::getList();
                    require_once VIEW . 'personnel/listagent.php';
                break;

                case 'modifier-poste':
                    $idPoste = intval($this->request->id);
                    $currentPoste = new Poste($idPoste);
                    $postes = Poste::findAll();
                    require_once VIEW . 'personnel/listepostes.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        }
    }