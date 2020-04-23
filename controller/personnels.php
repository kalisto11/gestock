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
                            if(!empty(($_POST['prenom']) && ($_POST['nom']) )){
                                $agent = new Personnel();
                                $agent->prenom = $_POST['prenom'];
                                $agent->nom = $_POST['nom'];
                                $agent->poste = (int) $_POST['poste'];
                                $agent->save();
                                $this->notification = new Notification("success", "L'agent a été bien ajouté avec succès.");
                                $this->request->action = 'liste';
                            }
                            else{
                                if(empty($_POST['prenom']) && empty($_POST['nom'])){ 
                                    $this->notification = new Notification("danger", "Le prénom et le nom de l'agent n'ont pas été renseignés.");
                                }elseif(empty($_POST['prenom'])){ 
                                    $this->notification = new Notification("danger", "Le prénom de l'agent ne doit pas etre vide.");
                                }elseif(empty($_POST['nom'])){
                                    $this->notification = new Notification("danger", "Le nom de l'agent ne doit pas etre vide.");
                                }
                                $this->request->action = 'ajouter';
                                $this->render($this->notification);
                            }  
                               
                                $this->render($this->notification);
                              
                            break;

                            case 'modifier': 
                                if(!empty(($_POST['prenom']) && ($_POST['nom']))){
                                    $agent = new Personnel($_POST['id']);
                                    $agent->prenom = $_POST['prenom'];
                                    $agent->nom = $_POST['nom'];
                                    $agent->poste = $_POST['poste'];
                                    $agent->update();  
                                    $this->notification = new Notification("success", "Les informations de l'agent ont été bien modifiées.");
                                    $this->request->action = 'consulter';
                                    $this->request->id = (int) $_POST['id']; 
                                }
                                else{
                                    $this->notification = new Notification("danger", "Les informations de l'agent ne doivent pas etre vide.");
                                    $this->request->action = 'modifier';
                                    $this->request->id = (int) $_POST['id']; 
                                }
                                $this->render($this->notification);
                            break;

                            default:
                            $this->notification = new Notification("danger", "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.");
                            $this->request->action = 'liste';
                           $this->render($this->notification);
                        }
                    }
                }
            }
            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 

                if ($this->request->action === 'supprimer'){
                    $idPoste = intval($this->request->id);
                    $agent  = new Personnel($this->request->id);
                    $agent->delete();
                    $this->request->action = 'liste';
                    $this->notification = new Notification("success", "L'agent a été supprimé avec succès.");
                }
                $this->render($this->notification);
            }
        } // fin méthode process

        public function render($notification = null){
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