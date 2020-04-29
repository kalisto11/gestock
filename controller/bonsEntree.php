<?php

     /*
    * Controleur du module des Bons d'netrée pour la gestion des bons d'entrée
    */
    
    class BonsEntree extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                switch ($_POST['operation']){
                    case 'ajouter':
                        $this->traiterBonEntree($_POST['reference'], $_POST['fournisseur'], $_POST['article1'],
                            $_POST['article2'], $_POST['article3'],$_POST['article4'], 
                            $_POST['article5'], $_POST['article6'],$_POST['article7'],
                            $_POST['article8'], $_POST['article9'],$_POST['article10']);
                        $this->render($this->notification);
                    break;
                    
                    case 'modifier':
                        $this->traiterBonEntree($_POST['reference'], $_POST['fournisseur'], $_POST['article1'],
                            $_POST['article2'], $_POST['article3'],$_POST['article4'], 
                            $_POST['article5'], $_POST['article6'],$_POST['article7'],
                            $_POST['article8'], $_POST['article9'],$_POST['article10'], $_POST['id']);
                        $this->render($this->notification);
                    break;

                    default:
                        $message[] = "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.";
                        $this->notification = new Notification("danger", $message);
                }
                $this->render($this->notification);
            }
            elseif ($this->request->method === 'GET'){ // si la requete vient d'un lien 
                if ($this->request->action === 'supprimer'){
                    $idBonEntree = intval($this->request->id);
                    $bonEntree  = new BonEntree($idBonEntree);
                    $bonEntree->delete();
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
                    $bons_entrees = BonEntree::getList();
                    require_once VIEW . 'bons/listbonentree.php';
                break;

                case 'consulter':
                    $bonEntree = new BonEntree($this->request->id);
                    require_once VIEW . 'bons/infobonentree.php';
                break;

                case 'ajouter':
                    $articles = Article::getList();
                    require_once VIEW . 'bons/ajoutbonentree.php';
                break;

                case 'modifier':
                    $bonEntree  = new BonEntree($this->request->id);
                    $articles = Article::getList();
                    foreach ($bonEntree->article as $article){
                        $articles[] = $article;
                    }
                    require_once VIEW . 'bons/modifbonentree.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        } //fin méthode render

        public function traiterBonEntree($reference, $fournisseur, $article1, $article2, $article3, $article4, $article5,
        $article6, $article7, $article8, $article9, $article10, $id = null){
            $erreur = false;
            if (empty($reference)){
                $erreur = true;
                $message[] = "La référence ne doit pas etre vide.";
            }
            if ($article == 'null'){
                $erreur = true;
                $message[] = "Vous devez choisir un article.";
            }
            if ($quantite <= 0 ){
                $erreur = true;
                $message[] = "La quantité ne doit pas etre inférieure ou égale à zéro."; 
            }
            if (empty($fournisseur)){
                $erreur = true;
                $message[] = "Le nom du fournisseur ne doit pas etre vide."; 
            }
            if ($erreur == false){
                if ($id == null){ // cas ajouter
                    $bonEntree = new BonEntree();
                    $bonEntree->reference = strip_tags($reference);
                    $bonEntree->fournisseur= strip_tags($fournisseur);
                    $bonEntree->article = $this->ajoutArticle(
                        $article1, $article2, $article3, $article4, $article5,
                        $article6, $article7, $article8, $article9, $article10);
                       
                    $bonEntree->save();
                    $message[] = "Le bon d'entrée a été bien ajouté.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'liste';

                }
                else{ // cas modifier 
                    $id = intval($id);
                    $bonEntree = new BonEntree($id);
                    $bonEntree->reference = strip_tags($reference);
                    $bonEntree->fournisseur = strip_tags($fournisseur);
                    $bonEntree->article = self::ajoutArticle(
                        $article1, $article2, $article3, $article4, $article5,
                        $article6, $article7, $article8, $article9, $article10);
                    $bonEntree->modify();  
                    $message[] = "Les données du bon d'entrée ont été bien modifiées.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'consulter';
                    $this->request->id = $id; 
                }
            }
            else{ // cas ou $erreur egale a true
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
        public function ajoutArticle($article1, $article2, $article3,$article4, $article5, 
        $article6, $article7, $article8, $article9, $article10){
            $articles = array();
            if ($article1 != "null"){
                $articles[] = strip_tags($article1);
            }
            if ($article2 != "null"){
                $articles[] = strip_tags($article2);
            }
            if ($article3 != "null"){
                $articles[] = strip_tags ($article3);
            }
            if ($article4 != "null"){
                $articles[] = strip_tags($article4);
            }
            if ($article5 != "null"){
                $articles[] = strip_tags($article5);
            }
            if ($article6 != "null"){
                $articles[] = strip_tags($article6);
            }
            if ($article7 != "null"){
                $articles[] = strip_tags($article7);
            }
            if ($article8 != "null"){
                $articles[] = strip_tags($article8);
            }
            if ($article9 != "null"){
                $articles[] = strip_tags($article9);
            }
            if ($article10 != "null"){
                $articles[] = strip_tags($article10);
            }
            
            return $articles;
    }//Fin méthode ajouterArticle!!!
    } // fin class