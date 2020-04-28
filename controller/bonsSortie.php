<?php

     /*
    * Controleur du module des Bons d'netrée pour la gestion des bons d'entrée
    */
    
    class BonsSortie extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                if ($this->request->action != null){
                    switch ($this->request->action){
                        case 'traitement-bonsortie':
                         switch ($_POST['operation']){
                             case 'ajouter':
                                $this->traitementBon_sortie($_POST['reference'], $_POST['beneficiaire']);
                                $this->render($this->notification);
                            break;
 
                             case 'modifier': 
                                $this->traitementBon_sortie($_POST['reference'], $_POST['beneficiaire'], $_POST['id']);
                                $this->render($this->notification);
                            break;
 
                             default:
                             $message[] = "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.";
                             $this->notification = new Notification("danger", $message);
                        }
                    }
                }
            }
             else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 
 
                 if ($this->request->action === 'supprimer'){
                     $idbonSortie = intval($this->request->id);
                     $bonsortie  = new BonSortie($this->request->id);
                     $bonsortie->delete();
                     $this->request->action = 'liste';
                     $message[] = "Le bon de sortie a été supprimé avec succès.";
                     $this->notification = new Notification("success", $message);
                 }
                 $this->render($this->notification);
             }
        } // fin méthode process

        /**
         * Permet d'afficher les vues du module bons de sortie
         * @param array permet de stocker les messgaes de notification s à afficher dans la vue en cas de reussite ou d'echec d'une opération
        **/
        public function render($notification = null){
            switch ($this->request->action){

                case 'liste':
                    $bonssorties = BonSortie::getList();
                    require_once VIEW . 'bons/listbonSortie.php';
                break;

                case 'consulter':
                    $articles = Article::getListArticle();
                    $bonsortie = new BonSortie($this->request->id);  
                    require_once VIEW . 'bons/infobonsortie.php';
                break;

                case 'ajouter':
                    $articles = Article::getList();
                    $personnels = Personnel::getList();
                    require_once VIEW . 'bons/ajoutbonSortie.php';
                break;

                case 'modifier':
                    $bonsortie  = new BonSortie($this->request->id);
                    $articles = Article::getList();
                    $personnels = Personnel::getList();
                    require_once VIEW . 'bons/modifbonsortie.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        }
        public function traitementBon_sortie($reference, $beneficiaire, $id = null){

            $articles = $this->ajoutArticle($_POST['article1'], $_POST['quantite1'],
                $_POST['article2'], $_POST['quantite2'], $_POST['article3'], $_POST['quantite3'], $_POST['article4'], $_POST['quantite4'], $_POST['article5'], $_POST['quantite5'], $_POST['article6'], $_POST['quantite6'], $_POST['article7'], $_POST['quantite7'], $_POST['article8'], $_POST['quantite8'], $_POST['article9'], $_POST['quantite9'], $_POST['article10'], $_POST['quantite10']);

            $erreurs = false;
            if (empty($reference)){
                $erreurs = true;
                $message[] = "La référence ne doit pas etre vide.";
            }
            if (empty($beneficiaire)){
                $erreurs = true;
                $message[] = "Le bénéficiaire ne doit pas etre vide.";
            }
            if (empty($articles)){
                $erreurs = true;
                $message[] = "Il faut choisir au minimum un article et sa quantité.";
            }
            if ($erreurs == false){ // cas sans erreur
                if ($id == null){ // cas ajouter bon de sortie
                    $bonsortie = new BonSortie();
                    $bonsortie->reference = strip_tags($reference);
                    $bonsortie->beneficiaire= strip_tags($beneficiaire);
                    $dotations = [];
                    foreach ($articles as $article){
                        $dotation = new Dotation($article['id'], $article['quantite']);
                        $dotations[] = $dotation;
                    }
                    $bonsortie->dotations =  $dotations;
                    
                    $bonsortie->save();
                    $message[] = "Le bon de sortie a été bien ajouté.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'liste';
                }
                else{ // cas modifier bon de sortie
                    $id = intval($id);
                    $bonsortie = new Bonsortie($id);
                    $bonsortie->reference = strip_tags($reference);
                    $bonsortie->beneficiaire = strip_tags($beneficiaire);
                    $bonsortie->article = self::ajoutArticle(
                        $article1, $article2, $article3, $article4, $article5,
                        $article6, $article7, $article8, $article9, $article10);
                    $bonsortie->modify();  
                    $message[] = "Les données du bon de sortie ont été bien modifiées.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'consulter';
                    $this->request->id = $id; 
                }
               
            }
            else{ // cas avec erreur(s)
                $this->notification = new Notification("danger", $message);
                if ($id == null){
                    $this->request->action = 'ajouter';
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $id;
                }
            }
        } // fin méthode traitementBon_sortie

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
        }//Fin méthode ajouterArticle!!!
    } // fin class