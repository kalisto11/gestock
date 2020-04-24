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
                        $this->render($this->notification);
                    break;  

                    case 'modifier':          
                        $this->traiterArticle($_POST['groupe'], $_POST['article'], $_POST['idArticle']);
                        $this->render($this->notification);
                    break;

                    default:
                    $this->notification = new Notification("danger", "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.");
                    $this->request->action = 'liste';
                    $this->render($this->notification);
                }            
            }  // fin traitement de la méthode post
            elseif ($this->request->method === 'GET'){ //Si la requete vient d'un lien
                if ($this->request->action === 'supprimer'){
                    $idArticle = intval($this->request->id);
                    $article = new Article($idArticle);
                    $article->supprime(); 
                    $this->request->action = 'liste';
                    $notification[] = "L'article a été supprimé avec succès.";
                    $this->notification = new Notification("success", $notification);
                }
                $this->render($this->notification); 
            } // fin traitement de la méthode GET
        } // fin méthode process
         
        public function render($notification = null){
             switch ($this->request->action){
                // inclure les vues ici selon la valeur de $view
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

        public function traiterArticle($groupeArticle, $nomArticle, $id = null){
            $erreurs = false;
            $articles = Article::getList();
            foreach ($articles as $article){
                if ($article->nom == $nomArticle){
                    $erreurs = true;
                    $notification[] = "Le nom de l'article existe déja. Veuillez choisir un autre nom.";
                }   
            }
            if (empty($nomArticle)){
                $erreurs = true;
                $notification[] = "Le nom de l'article ne doit pas etre vide.";
            }

            if ($erreurs == false){
                if ($id == null){ // cas ajouter article
                    $article = new Article();
                    $article->nom = strip_tags($nomArticle);   
                    $article->groupe = strip_tags($groupeArticle);                                            
                    $article->ajoutArticle();
                    $notification[] = "L'article a été ajouté avec succès.";
                    $this->notification = new Notification("success", $notification);
                    $this->request->action = 'liste';
                }
                else{ // cas modifier article
                    $article = new Article();
                    $article->id = (int) $id;
                    $article->nom = strip_tags($nomArticle);
                    $article->groupe = strip_tags($groupeArticle);
                    $article->modif();
                    $notification[] = "L'article a été modifié avec succès.";
                    $this->notification = new Notification("success", $notification);
                    $this->request->action = 'liste';
                    $this->request->id = $id;
                }
            }
            else{ // cas ou il y a des erreurs
                $this->notification = new Notification("danger", $notification);
                if ($id == null){
                    $this->request->action = 'liste';
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $id;
                }
            }
        } //fin méthode traiterArticle
    } // fin class