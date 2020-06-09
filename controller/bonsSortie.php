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
                                    $statutTraitement = $this->traiterBonSortie($_POST['reference'], $_POST['beneficiaire']);
                                    $this->render($this->notification, $statutTraitement);
                                break;
     
                                 case 'modifier': 
                                    $this->traiterBonSortie($_POST['reference'], $_POST['beneficiaire'], $_POST['id']);
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
        public function render($notification = null, $statutTraitement = true){
            switch ($this->request->action){
                case 'liste':
                    $count = BonSortie::getNbrBon();
                    if ($count){
                        $pagination = new Pagination($count);
                        if (!$pagination){
                            $message[] = "Cette page n'existe pas";
                            $this->notification = new Notification("danger", $message);
                        }
                        else{
                            $bonssorties = BonSortie::getList($pagination->perPage, $pagination->offset);
                        } 
                    }
                    require_once VIEW . 'bons/listbonSortie.php';  
                break;

                case 'consulter':
                    $bonsortie = new BonSortie($this->request->id);  
                    require_once VIEW . 'bons/infobonsortie.php';
                break;

                case 'ajouter':
                    if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                        $articles = Article::getListAll();
                        $personnels = Personnel::getListAll();
                        if ($statutTraitement == false){
                            $bonsortie = new BonSortie();
                            $bonsortie->reference = $_POST['reference'];
                            $bonsortie->beneficiaire = $_POST['beneficiaire'];  
                        }
                        require_once VIEW . 'bons/ajoutbonSortie.php';
                    }
                break;

                case 'modifier':
                    if ($_SESSION['user']['niveau'] == GESTIONNAIRE){
                        $bonsortie  = new BonSortie($this->request->id);
                        $articles = Article::getListAll();
                        $personnels = Personnel::getListAll();
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
        public function traiterBonSortie($reference, $beneficiaire, $id = null){
            $articles = $this->ajoutArticles($_POST);
            $erreur = false;
            if ($articles == false){
                $erreur = true;
                $message[] = "Les valeurs négatives ou vides ne peuvent pas être utilisées.";
            }

            if($articles != false){
                foreach ($articles as $article){
                    $art = new Article($article['id']);
                    if ($art->quantite <= 0){
                        $erreur = true;
                        $message[] = "Un des articles choisis n'est plus disponible dans le stock: " . $art->nom;
                    }
                }
            }
            
             // verifier si reference n'est pas vide
            if (empty($reference)){
                $erreur = true;
                $message[] = "La référence ne doit pas être vide.";
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

            if ($id == null){
                $bonssorties = BonSortie::getListAll();
                foreach ($bonssorties as $bonsortie){
                    if ($bonsortie->reference == $_POST['reference']){
                        $erreur = true;
                        $message[] = "le numéro du bon est déja utilisé.";
                        break;
                    }
                }
            }

            if ($erreur == false){ // cas sans erreur
                if ($id == null){ // cas ajouter bon de sortie
                    $modificateur = $_SESSION['user']['prenom']. ' ' .$_SESSION['user']['nom'];
                    $bonsortie = new BonSortie();
                    $bonsortie->reference = strip_tags($reference);
                    $idPersonnel = intval(strip_tags($beneficiaire));
                    $beneficiaire = new Personnel($idPersonnel);
                    $bonsortie->idBeneficiaire = (int)$beneficiaire->id;
                    $bonsortie->nomBeneficiaire = $beneficiaire->prenom . " " . $beneficiaire->nom;
                    $bonsortie->idModificateur = $_SESSION['user']['id'];
                    $bonsortie->nomModificateur =$modificateur;
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
                    $modificateur = $_SESSION['user']['prenom']. ' ' .$_SESSION['user']['nom'];
                    $id = intval($id);
                    $bonsortie = new BonSortie();
                    $bonsortie->id = $id;
                    $bonsortie->reference = strip_tags($reference);
                    $idPersonnel = intval(strip_tags($beneficiaire));
                    $beneficiaire = new Personnel($idPersonnel);
                    $bonsortie->idBeneficiaire = (int)$beneficiaire->id;
                    $bonsortie->nomBeneficiaire = $beneficiaire->prenom . " " . $beneficiaire->nom;
                    $bonsortie->idModificateur = (int)$_SESSION['user']['id'];
                    $bonsortie->nomModificateur =$modificateur;
                    $dotations = [];
                    foreach ($articles as $article){
                        $idArticle = intval(strip_tags($article['id']));
                        $art = new Article($idArticle);
                        $dotation = new Dotation($art->id, $art->nom, $article['quantite'], $article['prix']);
                        $dotations[] = $dotation;
                    }
                    $bonsortie->dotations =  $dotations;
                    $bonsortie->update();  
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
                    return false;
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $id;
                }
            }
        } // fin méthode traiterBonSortie
        /**
         * 
         */
        public function ajoutArticles($post){
            $inputs = [];
            foreach ($_POST as $post){
                $inputs[] = $post;
            }

            $articles = [];
            $tailleTab = count($inputs) - 2;
            $i = 2;
            while ($i < $tailleTab){
                $id = $inputs[$i];
                $quantite = $inputs[$i + 1];
                $prix = $inputs[$i + 2];
                if ($id == "null" OR $quantite <= 0 OR $prix <= 0){
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