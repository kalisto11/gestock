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
                                $agent->prenom = strip_tags($_POST['prenom']);
                                $agent->nom = strip_tags($_POST['nom']);
                                $agent->poste = self::ajouterPoste($_POST['poste1'], $_POST['poste2'], $_POST['poste3']);
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
                                    $agent->prenom = strip_tags($_POST['prenom']);
                                    $agent->nom = strip_tags($_POST['nom']);
                                    $agent->poste = self::ajouterPoste($_POST['poste1'], $_POST['poste2'], $_POST['poste3']);
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

        /**
         * permet d'afficher la vue selon la valeur de $this->request->action
         * @param String action à fournir à la méthode pour savoir quelle vue il faut afficher
        **/
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
                    $postes = Poste::getListFree();
                    require_once VIEW . 'personnel/ajoutagent.php';
                break;

                case 'modifier': // gestion du cas ou l'utilisateur veut modifier les infos d'un agent
                    $agent = new Personnel($this->request->id);
                    $postes = Poste::getListFree();
                    foreach ($agent->poste as $poste){
                        $postes[] = $poste;
                    }
                    require_once VIEW . 'personnel/ajoutagent.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        } // fin méthode render

        public function ajouterPoste($poste1, $poste2, $poste3){
            $postes = array();
            if ($poste1 != "null"){
                $postes[] = strip_tags($poste1);
            }
            if ($poste2 != "null"){
                $postes[] = strip_tags($poste2);
            }
            if ($poste3 != "null"){
                $postes[] = strip_tags($poste3);
            }
            return $postes;
        }
    } // fin class