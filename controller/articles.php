<?php

    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class articles extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){
                switch ($_POST['operation']){
                    case 'ajouter':
                        $this->traiterArticle($_POST['groupe'], $_POST['article']);
                    break;  

                    case 'modifier':          
                        $this->traiterArticle($_POST['groupe'], $_POST['article'], $_POST['idArticle']);
                    break;

                    default:
                    $this->notification = new Notification("danger", "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.");
                    $this->request->action = 'liste';
                }  
                $this->render($this->notification);          
            }  // fin traitement de la méthode POST

            elseif ($this->request->method === 'GET'){ //Si la requete vient d'un lien
                if ($this->request->action === 'supprimer'){
                    $idArticle = intval($this->request->id);
                    $article = new Article($idArticle);
                    $article->supprime(); 
                    $this->request->action = 'liste';
                    $message[] = "L'article a été supprimé avec succès.";
                    $this->notification = new Notification("success", $message);
                }
                $this->render($this->notification); 
            } // fin traitement de la méthode GET
        } // fin méthode process
        
        /**
         * permet d'afficher les vues du module articles
         * @param Notification notification : objet contenant le type et le message de notification à afficher en cas d'echec ou de reussite d'une opération
         */
        public function render($notification = null){
             switch ($this->request->action){
                // inclure les vues ici selon la valeur de $this->request->action
                case 'liste':
                     $articles = Article::getList();
                     require_once VIEW . 'article/listarticles.php';
                break;
                case 'modifier':
                     $idArticle = intval($this->request->id);
                     $currentArticle = new Article($idArticle);
                     $articles = Article::getList();
                     require_once VIEW . 'article/listarticles.php';
                break;
                case 'ajouter':
                    require_once   VIEW . 'article/listarticles.php';
                 break;
                case 'supprimer':
                    require_once VIEW . 'article/listarticles.php';
                 break;

                default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                $currentController = new Erreur($this->request);
                $currentController->process();
                    
            }
        }

        public function traiterArticle($groupeArticle, $nomArticle, $idArticle = null){
            // mettre la premiere lettre du nom en majuscule
            $nomArticle = ucfirst(mb_convert_case($nomArticle, MB_CASE_LOWER));

            $erreurs = false;

            
            if (empty($nomArticle)){
                $erreurs = true;
                $message[] = "Le nom de l'article ne doit pas etre vide.";
            }

            $articles = Article::getList();
            if ($idArticle == null){ // cas ajout
                foreach ($articles as $article){
                    if ($article->nom == $nomArticle){
                        $erreurs = true;
                        $message[] = "Le nom de l'article existe déja. Veuillez choisir un autre nom.";
                    }
                }
            }
            else{ // cas modification
                $noms = array() ;
                foreach ($articles as $article){
                    $noms[] = $article->nom;
                }
                $article = new Article($idArticle);
                foreach ($noms as $nom){
                    if ($nom == $article->nom){
                        unset($noms[array_search($article->nom, $noms)]);
                    }
                }
                if (in_array($nomArticle, $noms)){
                    $erreurs = true;
                    $message[] = "Le nom de l'article existe déja. Veuillez choisir un autre nom.";
                }
            }
                
            if ($erreurs == false){ // si pas d'erreurs
                if ($idArticle == null){ // cas ajouter article
                    $article = new Article();
                    $article->nom = strip_tags($nomArticle);   
                    $article->groupe = strip_tags($groupeArticle);                                            
                    $article->ajoutArticle();
                    $message[] = "L'article a été ajouté avec succès.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'liste';
                }
                else{ // cas modifier article
                    $article = new Article();
                    $article->id = (int) $idArticle;
                    $article->nom = strip_tags($nomArticle);
                    $article->groupe = strip_tags($groupeArticle);
                    $article->modif();
                    $message[] = "L'article a été modifié avec succès.";
                    $this->notification = new Notification("success", $message);
                    $this->request->action = 'liste';
                    $this->request->id = $idArticle;
                }
            }
            else{ // cas ou il y a des erreurs
                $this->notification = new Notification("danger", $message);
                if ($idArticle == null){
                    $this->request->action = 'liste';
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $idArticle;
                }
            }
        } //fin méthode traiterArticle
    } // fin class