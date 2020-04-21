<?php

    /*
    * Controleur du module nom personnel pour la gestion de la liste du personnel
    */

    require_once CONTROLLER . 'controller.php';
    class Personnels extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
               if ($this->request->action != null){
                   switch ($this->request->action){
                       case 'traitement-agent':
                        switch ($_POST['operation']){
                            case 'ajouter':
                                $agent = new Personnel();
                                $agent->prenom = $_POST['prenom'];
                                $agent->nom = $_POST['nom'];
                                $agent->poste = (int) $_POST['poste'];
                                $agent->save();
                                $this->request->action = 'liste';
                            break;

                            case 'modifier':
                                $agent = new Personnel($_POST['id']);
                                $agent->prenom = $_POST['prenom'];
                                $agent->nom = $_POST['nom'];
                                $agent->poste = $_POST['poste'];
                                $agent->update();
                                $this->request->action = 'consulter';
                                $this->request->id = $_POST['id'];
                            break;

                            default:
                            $this->message['type'] = 'danger';
                            $this->message['contenu'] = 'Une erreur s\'est produite pendant le traitement des données. Veuillez rééssayer svp.';
                            $this->request->action = 'liste';
                           
                        }
                        $this->render($this->message);
                   }
               }
            }
            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 

                if ($this->request->action === 'supprimer'){
                    $idPoste = intval($this->request->id);
                    $agent  = new Personnel($this->request->id);
                    $agent->delete();
                    $this->request->action = 'liste';
                    $this->message['type'] = 'success';
                    $this->message['contenu'] = 'L\'a été supprimé avec succès.';
                }
                $this->render($this->message);
            }
        } // fin méthode process

        public function render($message = null){
            switch ($this->request->action){

                case 'liste':
                    $agents = Personnel::getList();
                    require_once VIEW . 'personnel/listagent.php';
                break;

                case 'consulter':
                    $agent = new Personnel($this->request->id);
                    require_once VIEW . 'personnel/infoagent.php';
                break;

                case 'ajouter':
                    $postes = Poste::findAll();
                    require_once VIEW . 'personnel/ajoutagent.php';
                break;

                case 'modifier':
                    $agent = new Personnel($this->request->id);
                    $postes = Poste::findAll();
                    require_once VIEW . 'personnel/ajoutagent.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        } // fin méthode render
    } // fin class