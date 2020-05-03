<?php

    /*
    * Controleur du module nom personnel pour la gestion de la liste du personnel
    */

    require_once CONTROLLER . 'controller.php';
    class Personnels extends Controller{

         /**
         * permet de traiter les différentes requetes adressées au controleur personnels
         */
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                switch ($_POST['operation']){
                    case 'ajouter':
                        $this->traiterPersonnel($_POST['prenom'], $_POST['nom'], $_POST['poste1'], $_POST['poste2'], $_POST['poste3']);
                        $this->render($this->notification);
                    break;

                    case 'modifier': 
                        $this->traiterPersonnel($_POST['prenom'], $_POST['nom'], $_POST['poste1'], $_POST['poste2'], $_POST['poste3'], $_POST['id']);
                        $this->render($this->notification);
                    break;

                    default:
                    $message[] = "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.";
                    $this->notification = new Notification("danger", $message);
                    $this->request->action = 'liste';
                    $this->render($this->notification);
                }
            }
            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 

                if ($this->request->action === 'supprimer'){
                    $idPoste = intval($this->request->id);
                    $agent  = new Personnel($this->request->id);
                    $agent->delete();
                    $this->request->action = 'liste';
                    $message[] = "L'agent a été supprimé avec succès.";
                    $this->notification = new Notification("success", $message);
                }
                $this->render($this->notification);
            }
        } // fin méthode process

        /**
         * permet d'afficher la vue selon la valeur de $this->request->action
         * @param Notification notification : objet de type notification qui contient le type et le message
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

        /**
         * permet de traiter les infos saisies par l'utilisateur depuis un formulaire vers le controleur Personnels
         * @param String $prenom : prénom de l'agent
         * @param String $nom : nom de l'agent
         * @param int $poste1 : poste 1 de l'agent
         * @param int $poste2 : poste 2 de l'agent
         * @param int $poste3 : poste 3 de l'agent
         * @param int $idPersonnel : id de l'agent en cas de modification
         */
        public function traiterPersonnel($prenom, $nom, $poste1, $poste2, $poste3, $idPersonnel = null){
            $erreurs = false;
            if (empty($prenom)){
                $erreurs = true;
                $message[] = "Le prénom ne doit pas etre vide";
            }
            if (empty($nom)){
                $erreurs = true;
                $message[] = "Le nom ne doit pas etre vide";
            }

            if ($erreurs == false){ // cas sans erreur
                if ($idPersonnel == null){ // cas ajouter personnel
                    $agent = new Personnel();
                    $agent->prenom = mb_convert_case(strip_tags($prenom), MB_CASE_UPPER);
                    $agent->nom = mb_convert_case(strip_tags($nom), MB_CASE_UPPER);
                    $agent->poste = $this->ajouterPoste($poste1, $poste2, $poste3);
                    $agent->save();
                    $message[] = "L'agent a été bien ajouté.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'liste';
                }
                else{ // cas modifier personnel
                    $id = intval($idPersonnel);
                    $agent = new Personnel($id);
                    $agent->prenom = mb_convert_case(strip_tags($prenom), MB_CASE_UPPER);
                    $agent->nom = mb_convert_case(strip_tags($nom), MB_CASE_UPPER);
                    $agent->poste = self::ajouterPoste($poste1, $poste2, $poste3);
                    $agent->update();  
                    $message[] = "Les informations de l'agent ont été bien modifiées.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'consulter';
                    $this->request->id = $idPersonnel; 
                }
               
            }
            else{ // cas avec erreur(s)
                $this->notification = new Notification("danger", $message);
                if ($id == null){
                    $this->request->action = 'ajouter';
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $idPersonnel;
                }
            }
        } // fin méthode traiterPersonnel

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