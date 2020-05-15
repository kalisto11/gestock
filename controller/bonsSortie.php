<?php

     /*
    * Controleur du module des Bons d'netrée pour la gestion des bons d'entrée
    */
    
    class BonsSortie extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
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
            }
             else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 
 
                 if ($this->request->action === 'supprimer'){
                    if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                        $idbonSortie = intval($this->request->id);
                        $bonsortie  = new BonSortie($this->request->id);
                        $bonsortie->delete();
                        $message[] = "Le bon de sortie a été supprimé avec succès.";
                        $this->notification = new Notification("success", $message);
                    }
                     $this->request->action = 'liste';
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
                    $bonsortie = new BonSortie($this->request->id);  
                    require_once VIEW . 'bons/infobonsortie.php';
                break;
                case 'ajouter':
                    if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                        $articles = Article::getList();
                        $personnels = Personnel::getList();
                        require_once VIEW . 'bons/ajoutbonSortie.php';
                    }
                break;
                case 'modifier':
                    if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                        $bonsortie  = new BonSortie($this->request->id);
                        $articles = Article::getList();
                        $personnels = Personnel::getList();
                        require_once VIEW . 'bons/modifbonsortie.php';
                    }
                break;
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        }
        /**
         * 
         */
        public function traitementBon_sortie($reference, $beneficiaire, $id = null){
            $articles = $this->ajoutArticles($_POST['article1'], $_POST['quantite1'], $_POST['prix1'],
            $_POST['article2'], $_POST['quantite2'], $_POST['prix2'], $_POST['article3'], $_POST['quantite3'], $_POST['prix3'], $_POST['article4'], $_POST['quantite4'], $_POST['prix4'], $_POST['article5'], $_POST['quantite5'], $_POST['prix5'], $_POST['article6'], $_POST['quantite6'], $_POST['prix6'], $_POST['article7'], $_POST['quantite7'], $_POST['prix7'], $_POST['article8'], $_POST['quantite8'], $_POST['prix8'], $_POST['article9'], $_POST['quantite9'], $_POST['prix9'], $_POST['article10'], $_POST['quantite10'], $_POST['prix10']);
            $erreur = false;
            if ($articles == false){
                $erreur = true;
                $message[] = "Les valeurs négatives ou vides ne peuvent pas etre utilisées.";
            }
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
            if ($articles != false){
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
            }
            if ($erreur == false){ // cas sans erreur
                if ($id == null){ // cas ajouter bon de sortie
                    $bonsortie = new BonSortie();
                    $bonsortie->reference = strip_tags($reference);
                    $idPersonnel = intval(strip_tags($beneficiaire));
                    $beneficiaire = new Personnel($idPersonnel);
                    $bonsortie->idBeneficiaire = (int)$beneficiaire->id;
                    $bonsortie->nomBeneficiaire = $beneficiaire->prenom . " " . $beneficiaire->nom;
                    $bonsortie->idModificateur = $_SESSION['user']['id'];
                    $bonsortie->nomModificateur = $_SESSION['user']['nomComplet'];
                    $dotations = [];
                    foreach ($articles as $article){
                        $idArticle = intval(strip_tags($article['id']));
                        $art = new Article($idArticle);
                        $dotation = new Dotation($art->id, $art->nom, $article['quantite'], $article['prix']);
                        $dotations[] = $dotation;
                    }
                    $bonsortie->dotations =  $dotations;
                    $bonsortie->save();
                    $message[] = "Le bon de sortie a été bien ajouté.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'consulter';
                    $this->request->id = $bonsortie->id;
                }
                else{ // cas modifier bon de sortie
                    $id = intval($id);
                    $bonsortie = new BonSortie();
                    $bonsortie->id = $id;
                    $bonsortie->reference = strip_tags($reference);
                    $idPersonnel = intval(strip_tags($beneficiaire));
                    $beneficiaire = new Personnel($idPersonnel);
                    $bonsortie->idBeneficiaire = (int)$beneficiaire->id;
                    $bonsortie->nomBeneficiaire = $beneficiaire->prenom . " " . $beneficiaire->nom;
                    $bonsortie->idModificateur = (int)$_SESSION['user']['id'];
                    $bonsortie->nomModificateur = $_SESSION['user']['nomComplet'];
                    $dotations = [];
                    foreach ($articles as $article){
                        $idArticle = intval(strip_tags($article['id']));
                        $art = new Article($idArticle);
                        $dotation = new Dotation($art->id, $art->nom, $article['quantite'], $article['prix']);
                        $dotations[] = $dotation;
                    }
                    $bonsortie->dotations =  $dotations;
                    $bonsortie->modify();  
                    $message[] = "Le bon de sortie a été bien modifié.";
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
        /**
         * 
         */
        public function ajoutArticles($article1, $quantite1, $prix1, $article2, $quantite2, $prix2, $article3, $quantite3, $prix3, $article4, $quantite4, $prix4, $article5, $quantite5, $prix5, $article6, $quantite6, $prix6, $article7, $quantite7, $prix7, $article8, $quantite8, $prix8, $article9, $quantite9, $prix9, $article10, $quantite10, $prix10){
            $articles = [];
            $varArticle = "article";
            $varQuantite = "quantite";
            $varPrix = "prix";
            for ($i = 1; $i <= 10; $i++){
                if (${$varPrix . $i} < 0 OR ${$varQuantite . $i} < 0){
                    return false;
                }
                if (empty(${$varPrix . $i})){
                    ${$varPrix . $i} = 0 ;
                }
                if (${$varArticle . $i} != 'null' AND !empty(${$varQuantite . $i})){
                    $articles[] = [
                        'id' => intval(strip_tags(${$varArticle . $i})),
                        'quantite' => intval(strip_tags(${$varQuantite . $i})),
                        'prix' => intval(strip_tags(${$varPrix . $i})),
                        'total' => intval(${$varQuantite . $i} * ${$varPrix . $i})
                    ];
                } 
            }
            return $articles;
        }//Fin méthode ajoutArticles!!!
    } // fin class