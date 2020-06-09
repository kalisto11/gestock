<?php

     /*
    * Controleur du module des Bons d'netrée pour la gestion des bons d'entrée
    */
    
    class BonsEntree extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                    if ($this->request->action != null){
                        switch ($this->request->action){
                            case 'traitement-bonentree':
                            switch ($_POST['operation']){
                                case 'ajouter':
                                    $statutTraitement = $this->traiterBonEntree($_POST['reference'], $_POST['numeroFacture'], $_POST['dateFacture'], $_POST['fournisseur']);
                                    $this->render($this->notification, $statutTraitement);
                                break;                           
                                case 'modifier':
                                    $this->traiterBonEntree($_POST['reference'], $_POST['numeroFacture'], $_POST['dateFacture'], $_POST['fournisseur'], $_POST['id']);
                                    $this->render($this->notification);
                                break;
                                default:
                                    $message[] = "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.";
                                    $this->notification = new Notification("danger", $message);
                            }
                        }
                    }
                }
                $this->render($this->notification);
            }
            elseif ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                if ($this->request->action === 'supprimer'){
                    if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                        $idBonEntree = intval($this->request->id);
                        $bonentree  = new BonEntree($idBonEntree);
                        $bonentree->delete();
                        $message[] = "Le bon a été supprimé avec succès.";
                        $this->notification = new Notification("success", $message);
                    }
                    $this->request->action = 'liste';
                }
                $this->render($this->notification);
            }
        } // fin méthode process

        /**
         * Permet d'afficher les vues du module bons d'entrée
         * @param Notification permet de stocker les messgaes de notification s à afficher dans la vue en cas de reussite ou d'echec d'une opération
        **/
        public function render($notification = null, $statutTraitement = true){
            switch ($this->request->action){

                case 'liste':
                    $count = BonEntree::getNbrBon();
                    if ($count > 0){
                        $pagination = new Pagination($count);
                        if (!$pagination){
                            $message[] = "Cette page n'existe pas";
                            $this->notification = new Notification("danger", $message);
                        }
                        else{
                            $bonsentrees = BonEntree::getList($pagination->perPage, $pagination->offset);
                        }
                    }
                    require_once VIEW . 'bons/listbonentree.php';
                break;

                case 'consulter':
                    $bonentree = new BonEntree($this->request->id);  
                    require_once VIEW . 'bons/infobonentree.php';
                break;

                case 'ajouter':
                    if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                        $articles = Article::getListAll();
                        $fournisseurs = Fournisseur::getListAll();
                        if ($statutTraitement == false){
                            $bonentree = new BonEntree();
                            $bonentree->reference = $_POST['reference'];
                            $bonentree->numeroFacture = $_POST['numeroFacture'];
                            $bonentree->dateFacture = $_POST['dateFacture'];    
                            $bonentree->fournisseur = $_POST['fournisseur'];  
                        }
                        require_once VIEW . 'bons/ajoutbonentree.php';
                    }
                break;

                case 'modifier':
                    if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                        $bonentree  = new BonEntree($this->request->id);
                        $articles = Article::getListAll();
                        $fournisseurs = Fournisseur::getListAll();
                        require_once VIEW . 'bons/modifbonentree.php';
                    }
                break;
                
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        } //fin méthode render
        
        /**
         * 
         */
        public function traiterBonEntree($reference, $numeroFacture, $dateFacture, $fournisseur, $id = null){
            $articles = $this->ajoutArticles($_POST);
            $erreur = false;
            if ($articles == false){
                $erreur = true;
                $message[] = "Les valeurs négatives ou vides ne peuvent pas être utilisées.";
            }
            // Verifier si reference n'est pas vide
            if (empty($reference)){
                $erreur = true;
                $message[] = "La référence ne doit pas être vide.";
            }
            // Vérifier si la date de la facture n'est pas vide
            if (empty($dateFacture)){
                $erreur = true;
                $message[] = "La date de la facture ne doit pas être vide.";
            }
            //Verifier si fournisseur n'est pas vide
            if ($fournisseur == "null"){
                $erreur = true;
                $message[] = "Il faut choisir un fournisseur sur la liste de fournisseurs."; 
            }
            //Verifier si au moins un article et sa quantité ont été choisis
            if($articles != false){
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

            if ($id == null){
                $bonsentrees = BonEntree::getListAll();
                foreach ($bonsentrees as $bonentree){
                    if ($bonentree->reference == $_POST['reference']){
                        $erreur = true;
                        $message[] = "le numéro du bon est déja utilisé.";
                        break;
                    }
                }
            }
          
            if ($erreur == false){ // si pas d'erreur
                if ($id == null){ // cas ajouter
                    $modificateur = $_SESSION['user']['prenom']. ' ' .$_SESSION['user']['nom'];
                    $bonentree = new BonEntree();
                    $bonentree->reference = strip_tags($reference);
                    $bonentree->numeroFacture = strip_tags($numeroFacture);
                    $bonentree->dateFacture = strip_tags($dateFacture);
                    $idFournisseur = intval(strip_tags($fournisseur));
                    $fournisseur = new Fournisseur($idFournisseur);
                    $bonentree->idFournisseur = $fournisseur->id;
                    $bonentree->nomFournisseur = $fournisseur->nom;
                    $bonentree->idModificateur = $_SESSION['user']['id'];
                    $bonentree->nomModificateur = $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom'];
                    $dotations = [];
                    foreach ($articles as $article){
                        $art = new Article($article['id']);
                        $dotation = new Dotation($art->id, $art->nom, $article['quantite'], $article['prix']);
                        $dotations[] = $dotation;
                    }
                    $bonentree->dotations= $dotations;
                    $bonentree->save();
                    $message[] = "Le bon a été bien ajouté.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'consulter';
                    $this->request->id = $bonentree->id;
                }
                else{ // cas modifier 
                    $modificateur = $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; // prenom et nom du créateur ou modificateur du bon
                    $id = intval($id);
                    $idFournisseur = intval(strip_tags($fournisseur));
                    $fournisseur = new Fournisseur($idFournisseur);       
                    $bonentree  = new BonEntree();
                    $bonentree->id = $id;
                    $bonentree->reference = strip_tags($reference);
                    $bonentree->numeroFacture = strip_tags($numeroFacture);
                    $bonentree->dateFacture = strip_tags($dateFacture);
                    $bonentree->idFournisseur = $fournisseur->id;
                    $bonentree->nomFournisseur = $fournisseur->nom;
                    $bonentree->idModificateur = $_SESSION['user']['id'];
                    $bonentree->nomModificateur = $modificateur ;
                    $dotations = [];
                    foreach ($articles as $article){
                        $art = new Article($article['id']);
                        $dotation = new Dotation($art->id, $art->nom, $article['quantite'], $article['prix']);
                        $dotations[] = $dotation;
                    }
                    $bonentree->dotations = $dotations;
                    $bonentree->update();
                    $message[] = "Le bon a été bien modifié.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'consulter';
                    $this->request->id = $bonentree->id;
                }
            }
            else{ // En cas d'erreur
                $this->notification = new Notification("danger", $message);
                if ($id == null){
                    $this->request->action = 'ajouter';
                    return false;
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $id;
                    return false;
                }     
            }
        } // fin méthode traiterBonEntree

        /**
         * retourne les artciles du formulaires
         * @param Array $post : données issues du formulaire
         * @return Array $articles : liste des articles avec l'id, la quantité et le prix
         */
        public function ajoutArticles($post){
            $inputs = [];
            foreach ($_POST as $post){
                $inputs[] = $post;
            }

            $articles = [];
            $tailleTab = count($inputs) - 2;
            $i = 4;
            while ($i < $tailleTab){
                $id = $inputs[$i];
                $quantite = $inputs[$i + 1];
                $prix = $inputs[$i + 2];
                if ($id == "null" OR $quantite <= 0 OR $prix <= 0 OR $quantite == null OR $prix == null ){
                    return false;
                }

                if (empty($quantite) OR empty($prix)){
                   return false;
                }

                $articles[] = [
                    'id' => intval(strip_tags($id)),
                    'quantite' => intval(strip_tags($quantite)),
                    'prix' => intval(strip_tags($prix)),
                    'total' => intval($quantite * $prix) 
                ];

                if ($i > ($tailleTab - 3)){
                    break;
                }
                else{
                    $i += 3;
                }
            }
            return $articles;
        }//Fin méthode ajoutArticles!!!
    } // fin class