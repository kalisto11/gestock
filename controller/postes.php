<?php
    /*
    * Controleur du module poste pour la gestion des postes
    */

    require_once CONTROLLER . 'controller.php';
    class Postes extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                switch ($_POST['operation']){
                    case 'ajouter': // cas ou on ajoute un nouveau poste
                        $this->traiterPoste($_POST['nomPoste']);
                    break;

                    case 'modifier': // cas ou on modifie un poste existant
                        $this->traiterPoste($_POST['nomPoste'], $_POST['id']);
                    break;

                    default:
                    $message[] =  "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.";
                    $this->notification = new Notification("danger", $message);
                    $this->request->action = 'liste';
                    
                } // fin switch sur $_POST['operation']
                $this->render($this->notification);
            } // fin traitement POST
            
            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                if ($this->request->action === 'supprimer'){
                    $idPoste = intval($this->request->id);
                    $poste  = new Poste($idPoste, null);
                    $poste->delete();
                    $this->request->action = 'liste';
                    $message[] = "Le poste a été supprimé avec succès.";
                    $this->notification = new Notification("success", $message);
                }
                $this->render($this->notification);
            }
        } // fin méthode process

        public function render($notification = null){
            switch ($this->request->action){

                case 'liste':
                    $postes = Poste::getList();
                    require_once VIEW . 'personnel/listepostes.php';
                break;

                case 'modifier':
                    $idPoste = intval($this->request->id);
                    $currentPoste = new Poste($idPoste);
                    $postes = Poste::getList();
                    require_once VIEW . 'personnel/listepostes.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        }

        public function traiterPoste($nomPoste, $idPoste = null){
            $erreurs = false;
            if (empty($nomPoste)){
                $erreurs = true;
                $message[] = "Le nom du poste ne doit pas etre vide.";
            }
            $postes = Poste::getList();
            foreach ($postes as $poste){
                if ($poste->nom == $nomPoste){
                    $erreurs = true;
                    $message[] = "Le nom du poste existe déja. Veuillez choisir un autre nom.";
                }
            }
            if ($erreurs == false){
                if ($idPoste == null){ // cas ajouter poste
                    $poste = new Poste();
                    $poste->nom = strip_tags($nomPoste);
                    $poste->save();
                    $message[] =  "Le poste a été ajouté avec succès.";
                    $this->notification = new Notification("success", $message);
                }
                else{
                    $poste = new Poste(intval($idPoste));
                    $poste->nom = strip_tags($nomPoste);
                    $poste->update();
                    $message[] = "Le poste a été modifié avec succès.";
                    $this->notification = new Notification("success", $message);
                }
                $this->request->action = 'liste';
            }
            else{
                $this->notification = new Notification("danger", $message);
                if ($idPoste == null){
                    $this->request->action = 'liste';
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $idPoste;
                }
            }   
        } // fin méthode traiterPoste
    } // fin classe