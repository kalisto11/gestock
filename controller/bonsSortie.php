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
                    $currentPage = (int)( $_GET['page'] ?? 1) ? :1;
                    $perpage = 10;
                    $count = BonSortie::getNbrBon();
                    $pages = ceil($count/$perpage);
                    if ($currentPage > $pages){
                        $message[] = "Cette page n'existe pas";
                            $this->notification = new Notification("success", $message);
                    }
                    $offset = $perpage * ($currentPage - 1);
                    $bonssorties = BonSortie::getList($perpage, $offset);
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

            $articles = $this->ajoutArticle($_POST['article1'], $_POST['quantite1'], $_POST['prix1'],
            $_POST['article2'], $_POST['quantite2'], $_POST['prix2'], $_POST['article3'], $_POST['quantite3'], $_POST['prix3'], $_POST['article4'], $_POST['quantite4'], $_POST['prix4'], $_POST['article5'], $_POST['quantite5'], $_POST['prix5'], $_POST['article6'], $_POST['quantite6'], $_POST['prix6'], $_POST['article7'], $_POST['quantite7'], $_POST['prix7'], $_POST['article8'], $_POST['quantite8'], $_POST['prix8'], $_POST['article9'], $_POST['quantite9'], $_POST['prix9'], $_POST['article10'], $_POST['quantite10'], $_POST['prix10']);

            $erreur = false;

             // verifier si reference n'est pas vide
            if (empty($reference)){
                $erreur = true;
                $message[] = "La référence ne doit pas etre vide.";
            }
            // Verifier si bénéficiaire n'est pas vide
            if ($beneficiaire == "null"){
                $erreur = true;
                $message[] = "Il faut choisir un bénéficiaire";
            }
            // Verifier si au moins un article et sa quantité ont été choisis
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

            if ($erreur == false){ // cas sans erreur
                if ($id == null){ // cas ajouter bon de sortie
                    $bonsortie = new BonSortie();
                    $bonsortie->reference = strip_tags($reference);
                    $bonsortie->beneficiaire= strip_tags($beneficiaire);
                    $dotations = [];
                    foreach ($articles as $article){
                        $dotation = new Dotation($article['id'], $article['quantite'], $article['prix'], $article['total']);
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
                    $bonsortie = new BonSortie();
                    $bonsortie->id = $id;
                    $bonsortie->reference = strip_tags($reference);
                    $bonsortie->beneficiaire= strip_tags($beneficiaire);
                    $dotations = [];
                    foreach ($articles as $article){
                        $dotation = new Dotation($article['id'], $article['quantite'], $article['prix'], $article['total']);
                        $dotations[] = $dotation;
                    }
                    $bonsortie->dotations =  $dotations;
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

        public function ajoutArticle($article1, $quantite1, $prix1, $article2, $quantite2, $prix2, $article3, $quantite3, $prix3, $article4, $quantite4, $prix4, $article5, $quantite5, $prix5, $article6, $quantite6, $prix6, $article7, $quantite7, $prix7, $article8, $quantite8, $prix8, $article9, $quantite9, $prix9, $article10, $quantite10, $prix10){

            if ($prix1 == null){
                $prix1 = 0;
            }
            if ($prix2 == null){
                $prix2 = 0;
            }
            if ($prix3 == null){
                $prix3 = 0;
            }
            if ($prix4 == null){
                $prix4 = 0;
            }
            if ($prix5 == null){
                $prix5 = 0;
            }
            if ($prix6 == null){
                $prix6 = 0;
            }
            if ($prix7 == null){
                $prix7 = 0;
            }
            if ($prix8 == null){
                $prix8 = 0;
            }
            if ($prix9 == null){
                $prix9 = 0;
            }
            if ($prix10 == null){
                $prix10 = 0;
            }

            if ($quantite1 == null){
                $quantite1 = 0;
            }
            if ($quantite2 == null){
                $quantite2 = 0;
            }
            if ($quantite3 == null){
                $quantite3 = 0;
            }
            if ($quantite4 == null){
                $quantite4 = 0;
            }
            if ($quantite5 == null){
                $quantite5 = 0;
            }
            if ($quantite6 == null){
                $quantite6 = 0;
            }
            if ($quantite7 == null){
                $quantite7 = 0;
            }
            if ($quantite8 == null){
                $quantite8 = 0;
            }
            if ($quantite9 == null){
                $quantite9 = 0;
            }
            if ($quantite10 == null){
                $quantite10 = 0;
            }

            $articles = [];
            if ($article1 != "null" AND !empty($quantite1)){
                $articles[] = [
                    'id' => intval(strip_tags($article1)),
                    'quantite' => intval(strip_tags($quantite1)),
                    'prix' => intval(strip_tags($prix1)),
                    'total' => $quantite1 * $prix1 
                ];
            }
            if ($article2 != "null" AND !empty($quantite2)){
                $articles[] = [
                    'id' => intval(strip_tags($article2)),
                    'quantite' => intval(strip_tags($quantite2)),
                    'prix' => intval(strip_tags($prix2)),
                    'total' => $quantite2 * $prix2 
                ];
            }
            if ($article3 != "null" AND !empty($quantite3)){
                $articles[] = [
                    'id' => intval(strip_tags($article3)),
                    'quantite' => intval(strip_tags($quantite3)),
                    'prix' => intval(strip_tags($prix2)),
                    'total' => $quantite3 * $prix3 
                ];
            }
            if ($article4 != "null" AND !empty($quantite4)){
                $articles[] = [
                    'id' => intval(strip_tags($article4)),
                    'quantite' => intval(strip_tags($quantite4)),
                    'prix' => intval(strip_tags($prix4)),
                    'total' => $quantite4 * $prix4 
                ];
            }
            if ($article5 != "null" AND !empty($quantite5)){
                $articles[] = [
                    'id' => intval(strip_tags($article5)),
                    'quantite' => intval(strip_tags($quantite5)),
                    'prix' => intval(strip_tags($prix5)),
                    'total' => $quantite5 * $prix5 
                ];
            }
            if ($article6 != "null" AND !empty($quantite6)){
                $articles[] = [
                    'id' => intval(strip_tags($article6)),
                    'quantite' => intval(strip_tags($quantite6)),
                    'prix' => intval(strip_tags($prix6)),
                    'total' => $quantite6 * $prix6 
                ];
            }
            if ($article7 != "null" AND !empty($quantite7)){
                $articles[] = [
                    'id' => intval(strip_tags($article7)),
                    'quantite' => intval(strip_tags($quantite7)),
                    'prix' => intval(strip_tags($prix7)),
                    'total' => $quantite7 * $prix7 
                ];
            }
            if ($article8 != "null" AND !empty($quantite8)){
                $articles[] = [
                    'id' => intval(strip_tags($article8)),
                    'quantite' => intval(strip_tags($quantite8)),
                    'prix' => intval(strip_tags($prix8)),
                    'total' => $quantite8 * $prix8 
                ];
            }
            if ($article9 != "null" AND !empty($quantite9)){
                $articles[] = [
                    'id' => intval(strip_tags($article9)),
                    'quantite' => intval(strip_tags($quantite9)),
                    'prix' => intval(strip_tags($prix9)),
                    'total' => $quantite9 * $prix9 
                ];
            }
            if ($article10 != "null" AND !empty($quantite10)){
                $articles[] = [
                    'id' => intval(strip_tags($article10)),
                    'quantite' => intval(strip_tags($quantite10)),
                    'prix' => intval(strip_tags($prix10)),
                    'total' => $quantite10 * $prix10 
                ];
            }
           
            return $articles;
        }//Fin méthode ajoutArticle!!!
    } // fin class