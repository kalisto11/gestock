<?php

     /*
    * Controleur du module des Bons d'netrée pour la gestion des bons d'entrée
    */
    
    class BonsEntree extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                switch ($_POST['operation']){
                    case 'ajouter':
                        $this->traiterBonEntree($_POST['reference'], $_POST['article'], $_POST['quantite'], $_POST['fournisseur']);
                    break;
                    
                    case 'modifier':
                        $this->traiterBonEntree($_POST['reference'], $_POST['article'], $_POST['quantite'], $_POST['fournisseur'], $_POST['id']);
                    break;

                    default:
                        $this->notification = new Notification("danger", "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.");
                }
                $this->request->action = 'liste';
                $this->render($this->notification);
            }
            elseif ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                if ($this->request->action === 'supprimer'){
                    $idBonEntree = intval($this->request->id);
                    $bonEntree  = new BonEntree($idBonEntree);
                    $bonEntree->delete();
                    $this->request->action = 'liste';
                    $this->notification = new Notification("success", "Le bon a été supprimé avec succès.");
                }
                $this->render($this->notification);
            }
        } // fin méthode process

        /**
         * Permet d'afficher les vues du module bons d'entrée
         * @param Notification permet de stocker les messgaes de notification s à afficher dans la vue en cas de reussite ou d'echec d'une opération
        **/
        public function render($notification = null){
            switch ($this->request->action){

                case 'liste':
                    $bons_entrees = BonEntree::getList();
                    require_once VIEW . 'bons/listbonentree.php';
                break;

                case 'consulter':
                    $agent = new Personnel($this->request->id);
                    require_once VIEW . 'personnel/infoagent.php';
                break;

                case 'ajouter':
                    $articles = article::getList();
                    require_once VIEW . 'bons/ajoutbonentree.php';
                break;

                case 'modifier':
                    $idBonEntree = intval($this->request->id);
                    $bonEntree  = new BonEntree($idBonEntree);
                    $articles = article::getList();
                    require_once VIEW . 'bons/modifbonentree.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        } //fin méthode render

        public function traiterBonEntree($reference, $article, $quantite, $fournisseur, $id =null){
            $erreur = false;
            $notification = [];
            if (empty($reference)){
                $erreur = true;
                $notification [] = "La référence ne doit pas etre vide.";
            }
            if ($article == 'null'){
                $erreur = true;
                $notification [] = "Vous devez choisir un article.";
            }
            if ($quantite <= 0 ){
                $erreur = true;
                $notification [] = "La quantité ne doit pas etre inférieure ou égale à zéro."; 
            }
            if (empty($fournisseur)){
                $erreur = true;
                $notification [] = "Le nom du fournisseur ne doit pas etre vide."; 
            }
            if ($erreur == false){
                if ($id == null){
                    if ($erreur == false){
                        $bonEntree = new BonEntree();
                        $bonEntree->reference = strip_tags($reference);
                        $bonEntree->article = strip_tags($article);
                        $bonEntree->quantite = intval(strip_tags($quantite));
                        $bonEntree->fournisseur = strip_tags($fournisseur);
                        $bonEntree->save();
                        $this->notification = new Notification("success", "Le bon a été ajouté avec succès.");
                        $this->request->action = 'liste';
                    }
                    else{
                        $this->notification = new Notification("danger", "afficher tab notifs");
                    } 
                }
                else{ // cas modifier 
                $id = intval($id);
                $bonEntree  = new BonEntree();
                $bonEntree->id = $id;
                $bonEntree->reference = strip_tags($reference);
                $bonEntree->article = strip_tags($article);
                $bonEntree->quantite = intval(strip_tags($quantite));
                $bonEntree->fournisseur = strip_tags($fournisseur);
                $bonEntree->modify();
                $this->notification = new Notification("success", "Le bon a été modifié avec succès.");
                }
            }
            else{
                $this->notification = new Notification("danger", "Afficher les erreurs ici");
            }
           
        } // fin méthode traiterBonEntree
    } // fin class