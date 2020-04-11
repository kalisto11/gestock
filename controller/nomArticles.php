<?php

    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class NomArticles extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){
                if ($this->request->action != null){
                    switch ($this->request->action){
                        case 'traitement-article':
                            switch ($_POST['operation']){
                                case 'ajouter-nom-article':
                                    if(!empty($_POST['nomArticle'])){
                                        $nomarticle = new Article();
                                        $nomarticle->nom = $_POST['nomArticle'];                                            
                                        $nomarticle->ajoutArticle();
                                        $this->message['type'] = 'success';
                                        $this->message['contenu'] = 'L\'article a été ajouté avec succès.';
                                    }
                                    else{
                                        $this->message['type'] = 'danger';
                                        $this->message['contenu'] = "Le nom de l\'article ne doit pas etre vide.";
                                    }       
                                    $this->request->action = 'list-nom-article';
                                    $this->render($this->message);
                                break;  
                                case 'modifier-article':
                                    if(!empty($_POST['nomArticle'])){
                                        $nomarticle = new Article();
                                        $nomarticle->nom = $_POST['nomArticle'];
                                        $nomarticle->id = $_POST['idArticle'];
                                        $nomarticle->modif();
                                        $this->message['type'] = 'success';
                                        $this->message['contenu'] = 'L\'article a été modifié avec succès.';
                                    }
                                    else{
                                        $this->message['type'] = 'danger';
                                        $this->message['contenu'] = 'Le nom de l\'article ne doit pas etre vide.';
                                    }
                                    $this->request->action = 'list-nom-article';
                                    $this->request->id = $nomarticle->id;
                                    $this->render($this->message);
                                break;
                                default:
                                    $this->message['type'] = 'danger';
                                    $this->message['contenu'] = 'Une erreur s\'est produite pendant le traitement des données. Veuillez rééssayer svp.';
                                    $this->request->action = 'liste-postes';
                                    $this->render($this->message);
                            }
                    }
                }
            } elseif ($this->request->method === 'GET'){ //Si la requete vient d'un lien
                switch ($this->request->action){
                    case 'list-nom-article':
                        $this->render();
                    break;
                    case 'supprimer-article':
                        $idArticle = intval($this->request->id);
                        $nomarticle = new Article($idArticle);
                        $nomarticle->supprime(); 
                        $this->request->action = 'list-nom-article';
                        $this->message['type'] = 'success';
                        $this->message['contenu'] = 'L\article a été supprimé avec succès.';
                        $this->render($this->message);
                    break;
                    case 'modifier-article':
                        $this->render();
                    break;
                }
            }
        } 
         // fin méthode process
        public function render($message = null){
             switch ($this->request->action){
                // inclure les vues ici selon la valeur de $view
                case 'list-nom-article':
                     $nomarticles = Article::listArticles();
                     require_once VIEW . 'nomarticle/listnomArticles.php';
                break;
                case 'modifier-article':
                     $idArticle = intval($this->request->id);
                     $currentArticle = new Article($idArticle);
                     $nomarticles = Article::listArticles();
                     require_once VIEW . 'nomarticle/listnomArticles.php';
                break;
                case 'ajouter-nom-article':
                    require_once   VIEW . 'nomarticle/listnomArticles.php';
                 break;
                case 'supprimer-article':
                    require_once VIEW . 'nomarticle/listnomArticles.php';
                 break;

                default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                $currentController = new Erreur($this->request);
                $currentController->process();
                    
            }
        }
    } 
    

