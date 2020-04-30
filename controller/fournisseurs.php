<?php
    /*
    * Controleur du module fournisseur pour la gestion des fournisseurs
    */

    require_once CONTROLLER . 'controller.php';
    class Fournisseurs extends Controller{

        /**
         * permet de traiter les différentes requetes adressées au controleur fournisseurs
        */
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                switch ($_POST['operation']){
                    case 'ajouter': // cas ou on ajoute un nouveau fournisseur
                        $this->traiterFournisseur($_POST['nom']);
                    break;

                    case 'modifier': // cas ou on modifie un fournisseur existant
                        $this->traiterFournisseur($_POST['nom'], $_POST['id']);
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
                    $idFournisseur = intval($this->request->id);
                    $Fournisseur  = new Fournisseur($idFournisseur, null);
                    $Fournisseur->delete();
                    $this->request->action = 'liste';
                    $message[] = "Le Fournisseur a été supprimé avec succès.";
                    $this->notification = new Notification("success", $message);
                }
                $this->render($this->notification);
            }
        } // fin méthode process


         /**
         * permet d'afficher les vues du module Fournisseurs
         * @param Notification notification : objet contenant le type et le message de notification à afficher en cas d'echec ou de reussite d'une opération
         */
        public function render($notification = null){
            switch ($this->request->action){
                case 'liste':
                    $fournisseurs = Fournisseur::getList();
                    require_once VIEW . 'fournisseur/listefournisseurs.php';
                break;

                case 'modifier':
                    $idFournisseur = intval($this->request->id);
                    $currentFournisseur = new Fournisseur($idFournisseur);
                    $fournisseurs = Fournisseur::getList();
                    require_once VIEW . 'fournisseur/listefournisseurs.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de $this->request->action est inconnue 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        }

        public function traiterFournisseur($nomFournisseur, $idFournisseur = null){
            // mettre la premiere lettre du nom en majuscule
            $nomFournisseur = mb_convert_case($nomFournisseur, MB_CASE_UPPER);

            $erreurs = false;

            if (empty($nomFournisseur)){
                $erreurs = true;
                $message[] = "Le nom du Fournisseur ne doit pas etre vide.";
            }

            $fournisseurs = Fournisseur::getList();
            if ($idFournisseur == null){ // cas ajout
                foreach ($fournisseurs as $fournisseur){
                    if ($fournisseur->nom == $nomFournisseur){
                        $erreurs = true;
                        $message[] = "Le nom du fournisseur existe déja. Veuillez choisir un autre nom.";
                    }
                }
            }
            else{ // cas modification
                $noms = [] ;
                foreach ($fournisseurs as $fournisseur){
                    $noms[] = $fournisseur->nom;
                }
                $fournisseur = new Fournisseur($idFournisseur);
                foreach ($noms as $nom){
                    if ($nom == $fournisseur->nom){
                        unset($noms[array_search($fournisseur->nom, $noms)]);
                    }
                }
                if (in_array($nomFournisseur, $noms)){
                    $erreurs = true;
                    $message[] = "Le nom du fournisseur existe déja. Veuillez choisir un autre nom.";
                }
            }

            if ($erreurs == false){ // cas ou on a pas d'erreur
                if ($idFournisseur == null){ // cas ajouter Fournisseur
                    $fournisseur = new Fournisseur();
                    $fournisseur->nom = strip_tags($nomFournisseur);
                    $fournisseur->save();
                    $message[] =  "Le fournisseur a été ajouté avec succès.";
                    $this->notification = new Notification("success", $message);
                }
                else{
                    $fournisseur = new Fournisseur(intval($idFournisseur));
                    $fournisseur->nom = strip_tags($nomFournisseur);
                    $fournisseur->update();
                    $message[] = "Le fournisseur a été modifié avec succès.";
                    $this->notification = new Notification("success", $message);
                }
                $this->request->action = 'liste';
            }
            else{ // cas ou il y a un ou plusieurs erreurs
                $this->notification = new Notification("danger", $message);
                if ($idFournisseur == null){ // cas ajout Fournisseur
                    $this->request->action = 'liste';
                }
                else{ // cas modification Fournisseur
                    $this->request->action = 'modifier';
                    $this->request->id = $idFournisseur;
                }
            }   
        } // fin méthode traiterFournisseur
    } // fin classe