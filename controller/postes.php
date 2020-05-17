<?php
    /*
    * Controleur du module poste pour la gestion des postes
    */

    require_once CONTROLLER . 'controller.php';
    class Postes extends Controller{

        /**
         * permet de traiter les différentes requetes adressées au controleur postes
        */
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                if ($_SESSION['user']['niveau'] >= GESTIONNAIRE){
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
                }
                
                $this->render($this->notification);
            } // fin traitement POST

            else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                if ($this->request->action === 'supprimer'){
                    if ($_SESSION['user']['niveau'] >= GESTIONNAIRE){
                        $idPoste = intval($this->request->id);
                        $poste  = new Poste($idPoste, null);
                        $poste->delete();
                        $message[] = "Le poste a été supprimé avec succès.";
                        $this->notification = new Notification("success", $message);
                    }
                    $this->request->action = 'liste';
                }
                $this->render($this->notification);
            }
        } // fin méthode process


         /**
         * permet d'afficher les vues du module postes
         * @param Notification notification : objet contenant le type et le message de notification à afficher en cas d'echec ou de reussite d'une opération
         */
        public function render($notification = null){
            switch ($this->request->action){
                case 'liste':
                    $postes = Poste::getList();
                    require_once VIEW . 'personnel/listepostes.php';
                break;

                case 'modifier':
                    if ($_SESSION['user']['niveau'] >= GESTIONNAIRE){
                        $idPoste = intval($this->request->id);
                        $currentPoste = new Poste($idPoste);
                    }
                    $postes = Poste::getList();
                    require_once VIEW . 'personnel/listepostes.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de $this->request->action est inconnue 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        }

        public function traiterPoste($nomPoste, $idPoste = null){
            // mettre la premiere lettre du nom en majuscule
            $nomPoste = mb_convert_case($nomPoste, MB_CASE_UPPER);

            $erreurs = false;

            if (empty($nomPoste)){
                $erreurs = true;
                $message[] = "Le nom du poste ne doit pas être vide.";
            }

            $postes = Poste::getList();
            if ($idPoste == null){ // cas ajout
                foreach ($postes as $poste){
                    if ($poste->nom == $nomPoste){
                        $erreurs = true;
                        $message[] = "Le nom du poste existe déja. Veuillez choisir un autre nom.";
                    }
                }
            }
            else{ // cas modification
                $noms = [] ;
                foreach ($postes as $poste){
                    $noms[] = $poste->nom;
                }
                $poste = new poste($idPoste);
                foreach ($noms as $nom){
                    if ($nom == $poste->nom){
                        unset($noms[array_search($poste->nom, $noms)]);
                    }
                }
                if (in_array($nomPoste, $noms)){
                    $erreurs = true;
                    $message[] = "Le nom du poste existe déja. Veuillez choisir un autre nom.";
                }
            }

            if ($erreurs == false){ // cas ou on a pas d'erreur
                if ($idPoste == null){ // cas ajouter poste
                    $poste = new Poste();
                    $poste->nom = strip_tags($nomPoste);
                    $poste->save();
                    $message[] =  "Le poste a été bien ajouté.";
                    $this->notification = new Notification("success", $message);
                }
                else{
                    $poste = new Poste(intval($idPoste));
                    $poste->nom = strip_tags($nomPoste);
                    $poste->update();
                    $message[] = "Le poste a été bien modifié.";
                    $this->notification = new Notification("success", $message);
                }
                $this->request->action = 'liste';
            }
            else{ // cas ou il y a un ou plusieurs erreurs
                $this->notification = new Notification("danger", $message);
                if ($idPoste == null){ // cas ajout poste
                    $this->request->action = 'liste';
                }
                else{ // cas modification poste
                    $this->request->action = 'modifier';
                    $this->request->id = $idPoste;
                }
            }   
        } // fin méthode traiterPoste
    } // fin classe