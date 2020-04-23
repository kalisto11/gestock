<?php

    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class articles extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){
                if ($this->request->action === 'traitement-article'){
                    switch ($_POST['operation']){
                        case 'ajouter':
                            if(!empty($_POST['article'])){
                                $article = new Article();
                                $article->nom = $_POST['article'];   
                                $article->groupe = $_POST['groupe'];                                            
                                $article->ajoutArticle();
                                $this->notification = new Notification("success", "L'article a été ajouté avec succès.");
                            }
                            else{
                                $this->notification = new Notification("danger", "Le nom de l'article ne doit pas etre vide.");
                            }       
                            $this->request->action = 'liste';
                            $this->render($this->notification);
                        break;  

                        case 'modifier':          
                            $article = new Article();
                            $article->id = $_POST['idArticle'];
                            $article->nom = $_POST['article'];
                            $article->groupe = $_POST['groupe'];
                            if(!empty($_POST['article'])){
                            $article->modif();
                            $this->notification = new Notification("success", "L'article a été modifié avec succès.");
                            $this->request->action = 'liste';
                            }
                            else{
                            $this->notification = new Notification("danger", "Le nom de l'article ne doit pas etre vide.");
                            $this->request->action = 'modifier';
                            $this->request->id = $article->id;
                            }
                            $this->render($this->notification);
                        break;

                        default:
                        $this->notification = new Notification("danger", "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.");
                        $this->request->action = 'liste';
                        $this->render($this->notification);
                    }            
                }  
            }  // fin traitement de la méthode post
            elseif ($this->request->method === 'GET'){ //Si la requete vient d'un lien
                if ($this->request->action === 'supprimer'){
                    $idArticle = intval($this->request->id);
                    $article = new Article($idArticle);
                    $article->supprime(); 
                    $this->request->action = 'liste';
                    $this->notification = new Notification("success", "L'article a été supprimé avec succès.");
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
    } 