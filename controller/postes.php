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
                        if (!empty($_POST['nomPoste'])){
                            $poste = new Poste();
                            $poste->nom = strip_tags($_POST['nomPoste']);
                            $poste->save();
                            $message[] =  "Le poste a été ajouté avec succès.";
                            $this->notification = new Notification("success", $message);
                        }
                        else{
                            $message[] = "Le nom du poste ne doit pas etre vide.";
                            $this->notification = new Notification("danger", $message);
                        }
                        $this->request->action = 'liste';
                        $this->render($this->notification);
                    break;

                    case 'modifier': // cas ou on modifie un poste existant
                        if (!empty($_POST['nomPoste'])){
                            $poste = new Poste(intval($_POST['id']));
                            $poste->nom = strip_tags($_POST['nomPoste']);
                            $poste->update();
                            $message[] = "Le poste a été modifié avec succès.";
                            $this->notification = new Notification("success", $message);
                            $this->request->action = 'liste';
                        }
                        else{
                            $message[] = "Le nom du poste ne doit pas etre vide.";
                            $this->notification = new Notification("danger", $message);
                            $this->request->action = 'modifier';
                            $this->request->id = $_POST['id'];
                        }
                        
                        $this->render($this->notification);
                    break;

                    default:
                    $message[] =  "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.";
                    $this->notification = new Notification("danger", $message);
                    $this->request->action = 'liste';
                    $this->render($this->notification);
                } // fin switch sur $_POST['operation']
            }
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
    } // fin classe