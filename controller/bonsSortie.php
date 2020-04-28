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
                                $this->traitementBon_sortie($_POST['reference'], $_POST['beneficiaire'], $_POST['article1'],
                                    $_POST['article2'], $_POST['article3'],$_POST['article4'], 
                                    $_POST['article5'], $_POST['article6'],$_POST['article7'],
                                    $_POST['article8'], $_POST['article9'],$_POST['article10']);
                                    $this->render($this->notification);
                             break;
 
                             case 'modifier':
                                $this->traitementBon_sortie($_POST['reference'], $_POST['beneficiaire'], $_POST['article1'],
                                    $_POST['article2'], $_POST['article3'],$_POST['article4'], 
                                    $_POST['article5'], $_POST['article6'],$_POST['article7'],
                                    $_POST['article8'], $_POST['article9'],$_POST['article10'], $_POST['id']);
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
                    $bonsortie = new BonSortie($this->request->id);  
                    require_once VIEW . 'bons/infobonsortie.php';
                break;

                case 'ajouter':
                    $articles = Article::getListArticle();
                    $personnels = Personnel::getList();
                    require_once VIEW . 'bons/ajoutbonSortie.php';
                break;

                case 'modifier':
                    $bonsortie  = new BonSortie($this->request->id);
                    $articles = Article::getListArticle();
                    foreach ($bonsortie->article as $article){
                        $articles[] = $article;
                    }
                    require_once VIEW . 'bons/modifbonsortie.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        }
        public function traitementBon_sortie($reference, $beneficiaire, $article1, $article2, $article3, $article4, $article5,
                $article6, $article7, $article8, $article9, $article10, $id = null){
            $erreurs = false;
            if (empty($reference)){
                $erreurs = true;
                $message[] = "La référence ne doit pas etre vide";
            }
            if ($quantite <= 0 ){
                $erreur = true;
                $message[] = "La quantité ne doit pas etre inférieure ou égale à zéro."; 
            }
            if (empty($beneficiaire)){
                $erreurs = true;
                $message[] = "Le beneficiaire ne doit pas etre vide";
            }

            if ($erreurs == false){ // cas sans erreur
                if ($id == null){ // cas ajouter bon de sortie
                    $bonsortie = new BonSortie();
                    $bonsortie->reference = strip_tags($reference);
                    $bonsortie->beneficiaire= strip_tags($beneficiaire);
                    $bonsortie->article = $this->ajoutArticle(
                        $article1, $article2, $article3, $article4, $article5,
                        $article6, $article7, $article8, $article9, $article10);
                       
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
}