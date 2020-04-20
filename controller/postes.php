<?php
    /*
    * Controleur du module poste pour la gestion des postes
    */

    require_once CONTROLLER . 'controller.php';
    class Postes extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
               if ($this->request->action != null){
                   if ($this->request->action === 'traitement-poste'){
                        switch ($_POST['operation']){
                            case 'ajouter': // cas ou on ajoute un nouveau poste
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
                                $this->request->action = 'liste';
                                $this->render($this->message);
                            break;

                            case 'modifier': // cas ou on modifie un poste existant
                                if (!empty($_POST['nomPoste'])){
                                    $poste = new Poste($_POST['id']);
                                    $poste->nom = $_POST['nomPoste'];
                                    $poste->update();
                                    $this->message['type'] = 'success';
                                    $this->message['contenu'] = 'Le poste a été modifié avec succès.';
                                    $this->request->action = 'liste';
                                }
                                else{
                                    $this->message['type'] = 'danger';
                                    $this->message['contenu'] = 'Le nom du poste ne doit pas etre vide.';
                                    $this->request->action = 'modifier';
                                    $this->request->id = $_POST[id];
                                }
                               
                                $this->render($this->message);
                            break;

                            default:
                            $this->message['type'] = 'danger';
                            $this->message['contenu'] = 'Une erreur s\'est produite pendant le traitement des données. Veuillez rééssayer svp.';
                            $this->request->action = 'liste-postes';
                            $this->render($this->message);
                        } // fin switch sur $_POST['operation']
                   } // fin if sur $this->request->action
               }
            }
            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                if ($this->request->action === 'supprimer'){
                    $idPoste = intval($this->request->id);
                    $poste  = new Poste($idPoste, null);
                    $poste->delete();
                    $this->request->action = 'liste';
                    $this->message['type'] = 'success';
                    $this->message['contenu'] = 'Le poste a été supprimé avec succès.';
                }
                $this->render($this->message);
            }
        } // fin méthode process

        public function render($message = null){
            switch ($this->request->action){

                case 'liste':
                    $postes = Poste::findAll();
                    require_once VIEW . 'personnel/listepostes.php';
                break;

                case 'modifier':
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
    } // fin classe