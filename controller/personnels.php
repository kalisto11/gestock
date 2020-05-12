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
                if ($_SESSION['user']['niveau'] >= GESTIONNAIRE){
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
            }
            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 

                if ($this->request->action === 'supprimer'){
                    if ($_SESSION['user']['niveau'] >= GESTIONNAIRE){
                        $idPoste = intval($this->request->id);
                        $agent  = new Personnel($this->request->id);
                        $agent->delete();
                        $message[] = "L'agent a été supprimé avec succès.";
                        $this->notification = new Notification("success", $message);
                    }
                    $this->request->action = 'liste';
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
                    if ($_SESSION['user']['niveau'] >= GESTIONNAIRE){
                        $postes = Poste::getListFree();
                        require_once VIEW . 'personnel/ajoutagent.php';
                    }
                break;

                case 'modifier': // gestion du cas ou l'utilisateur veut modifier les infos d'un agent
                    if ($_SESSION['user']['niveau'] >= GESTIONNAIRE){
                        $agent = new Personnel($this->request->id);
                        $postes = Poste::getListFree();
                        foreach ($agent->poste as $poste){
                            $postes[] = $poste;
                        }
                        require_once VIEW . 'personnel/ajoutagent.php';
                    }
                    else{
                        $agents = Personnel::getList();
                        require_once VIEW . 'personnel/listagent.php';
                    }
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
            $erreur = false;

            // Verifier si prénom n'est pas vide
            if (empty($prenom)){
                $erreur = true;
                $message[] = "Le prénom ne doit pas etre vide.";
            }
            // verifier si nom n'est pas vide
            if (empty($nom)){
                $erreur = true;
                $message[] = "Le nom ne doit pas etre vide.";
            }
            // Verifier s'il n y a pas de doublon de poste (un poste slectionné 2 fois)
            $postes = $this->ajouterPoste($poste1, $poste2, $poste3);
            if ($postes != null){
                $doublon =false;
                $nbPostes = count($postes);
                if ($nbPostes == 2){
                    if ($postes[0] == $postes[1]){
                        $doublon = true;
                    }
                }
                elseif ($nbPostes == 3){
                    if ($postes[0] == $postes[1] OR $postes[1] == $postes[2] OR $postes[0] == $postes[2]){
                       $doublon = true;
                    }
                }
                if ($doublon == true){
                    $erreur = true;
                    $message[] = "Il y a eu doublon de postes.";
                }
            }

            if ($erreur == false){ // cas sans erreur
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
                    $agent->poste = $postes;
                    $agent->update();  
                    $message[] = "Les informations de l'agent ont été bien modifiées.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'consulter';
                    $this->request->id = $idPersonnel; 
                }
               
            }
            else{ // cas avec erreur(s)
                $this->notification = new Notification("danger", $message);
                if ($idPersonnel == null){
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