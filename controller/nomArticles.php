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
                                                $nomarticle = new Article();
                                             
                                                $nomarticle->nom = $_POST['nomArticle'];
                                            
                                                $nomarticle->ajoutArticle();
                                                $this->request->action = 'list-nom-article';
                                                $this->render();
                                            break;
                                            break;
                                            
                                            case 'modifier-article':
                                                $nomarticle = new Article();
                                                $nomarticle->nom = $_POST['nomArticle'];
                                                $nomarticle->id = $_POST['idArticle'];
                                                $nomarticle->modif();
                                                $this->request->action = 'list-nom-article';
                                                $this->render();
                                            break;
                                        }default;
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
                                    $this->render();
                                break;

                                case 'modifier-article':
                                    $this->render();
                                break;
                            }
                        }
        } 
         // fin méthode process
        public function render(){
            
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
    

