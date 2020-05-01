<?php

     /*
    * Controleur du module des Bons d'netrée pour la gestion des bons d'entrée
    */
    
    class BonsEntree extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                if ($this->request->action != null){
                    switch ($this->request->action){
                        case 'traitement-bonentree':
                        switch ($_POST['operation']){
                            case 'ajouter':
                                $this->traiterBonEntree($_POST['reference'], $_POST['fournisseur']);
                                $this->render($this->notification);
                            break;                           
                            case 'modifier':
                                $this->traiterBonEntree($_POST['reference'], $_POST['fournisseur'], $_POST['id']);
                                $this->render($this->notification);
                            break;
                            default:
                                $message[] = "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.";
                                $this->notification = new Notification("danger", $message);
                        }
                    }
                }
                $this->render($this->notification);
            }
            elseif ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                if ($this->request->action === 'supprimer'){
                    $idBonEntree = intval($this->request->id);
                    $bonentree  = new BonEntree($idBonEntree);
                    $bonentree->delete();
                    $this->request->action = 'liste';
                    $message[] = "Le bon a été supprimé avec succès.";
                    $this->notification = new Notification("success", $message);
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
                    $bonsentrees = BonEntree::getList();
                    require_once VIEW . 'bons/listbonentree.php';
                break;

                case 'consulter':
                    $articles = Article::getListArticle();
                    $bonentree = new BonEntree($this->request->id);  
                    require_once VIEW . 'bons/infobonentree.php';
                break;

                case 'ajouter':
                    $articles = Article::getList();
                    $fournisseurs = Fournisseur::getList();
                    require_once VIEW . 'bons/ajoutbonentree.php';
                break;

                case 'modifier':
                    $bonentree  = new BonEntree($this->request->id);
                    $articles = Article::getList();
                    $fournisseurs = Fournisseur::getList();
                    require_once VIEW . 'bons/modifbonentree.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        } //fin méthode render

        public function traiterBonEntree($reference, $fournisseur, $id =null){

            $articles = $this->ajoutArticle($_POST['article1'], $_POST['quantite1'],
            $_POST['article2'], $_POST['quantite2'], $_POST['article3'], $_POST['quantite3'], $_POST['article4'], $_POST['quantite4'], $_POST['article5'], $_POST['quantite5'], $_POST['article6'], $_POST['quantite6'], $_POST['article7'], $_POST['quantite7'], $_POST['article8'], $_POST['quantite8'], $_POST['article9'], $_POST['quantite9'], $_POST['article10'], $_POST['quantite10']);

            $erreur = false;

            // Verifier si reference n'est pas vide
            if (empty($reference)){
                $erreur = true;
                $message[] = "La référence ne doit pas etre vide.";
            }
            //Verifier si fournisseur n'est pas vide
            if ($fournisseur == "null"){
                $erreur = true;
                $message[] = "Il faut choisir un fournisseur sur la liste de fournisseurs."; 
            }
            //Verifier si au moins un article et sa quantité ont été choisis
            if (empty($articles)){
                $erreur = true;
                $message[] = "Il faut choisir au minimum un article et sa quantité.";
            }
            // Verifier si un article n'a pas été choisi 2 fois (doublons)
            $idArticles = [];
            foreach ($articles as $article){
                $idArticles[] = $article['id'];
            }
            $noDoublons = array_unique($idArticles);
            if (count($noDoublons) < count($idArticles)){
                $erreur = true;
                $message[] = "Il y a eu doublon sur les articles choisis.";
            }
           
            
            if ($erreur == false){ // si pas d'erreur
                if ($id == null){ // cas ajouter
                    $bonentree = new BonEntree();
                    $bonentree->reference = strip_tags($reference);
                    $bonentree->fournisseur = intval($fournisseur);
                    $dotations = [];
                    foreach ($articles as $article){
                        $dotation = new Dotation($article['id'], $article['quantite']);
                        $dotations[] = $dotation;
                    }
                    $bonentree->dotations= $dotations;
                    $bonentree->save();
                    $message[] = "Le bon a été ajouté avec succès.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'liste';
                }
                else{ // cas modifier 
                    $id = intval($id);
                    $bonentree  = new BonEntree();
                    $bonentree->id = $id;
                    $bonentree->reference = strip_tags($reference);
                    $bonentree->fournisseur = strip_tags($fournisseur);
                    $dotations = [];
                    foreach ($articles as $article){
                        $dotation = new Dotation($article['id'], $article['quantite']);
                        $dotations[] = $dotation;
                    }
                    $bonentree->dotations =  $dotations;
                    $bonentree->modify();
                    $message[] = "Le bon a été modifié avec succès.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'consulter';
                    $this->request->id = $bonentree->id;
                }
            }
            else{ // En cas d'erreur
                $this->notification = new Notification("danger", $message);
                if ($id == null){
                    $this->request->action = 'ajouter';
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $id;
                }     
            }
        } // fin méthode traiterBonEntree
        
        public function ajoutArticle($article1, $quantite1, $article2, $quantite2, $article3, $quantite3, $article4, $quantite4, $article5, $quantite5, $article6, $quantite6, $article7, $quantite7, $article8, $quantite8, $article9, $quantite9, $article10, $quantite10){
            $articles = [];
            if ($article1 != "null" AND !empty($quantite1)){
                $articles[] = [
                    'id' => strip_tags($article1),
                    'quantite' => strip_tags($quantite1)
                ];
            }
            if ($article2 != "null" AND !empty($quantite2)){
                $articles[] = [
                    'id' => strip_tags($article2),
                    'quantite' => strip_tags($quantite2)
                ];
            }
            if ($article3 != "null" AND !empty($quantite3)){
                $articles[] = [
                    'id' => strip_tags($article3),
                    'quantite' => strip_tags($quantite3)
                ];
            }
            if ($article4 != "null" AND !empty($quantite4)){
                $articles[] = [
                    'id' => strip_tags($article4),
                    'quantite' => strip_tags($quantite4)
                ];
            }
            if ($article5 != "null" AND !empty($quantite5)){
                $articles[] = [
                    'id' => strip_tags($article5),
                    'quantite' => strip_tags($quantite5)
                ];
            }
            if ($article6 != "null" AND !empty($quantite6)){
                $articles[] = [
                    'id' => strip_tags($article6),
                    'quantite' => strip_tags($quantite6)
                ];
            }
            if ($article7 != "null" AND !empty($quantite7)){
                $articles[] = [
                    'id' => strip_tags($article7),
                    'quantite' => strip_tags($quantite7)
                ];
            }
            if ($article8 != "null" AND !empty($quantite8)){
                $articles[] = [
                    'id' => strip_tags($article8),
                    'quantite' => strip_tags($quantite8)
                ];
            }
            if ($article9 != "null" AND !empty($quantite9)){
                $articles[] = [
                    'id' => strip_tags($article9),
                    'quantite' => strip_tags($quantite9)
                ];
            }
            if ($article10 != "null" AND !empty($quantite10)){
                $articles[] = [
                    'id' => strip_tags($article10),
                    'quantite' => strip_tags($quantite10)
                ];
            }
           
            return $articles;
        }//Fin méthode ajoutArticle!!!
    } // fin class