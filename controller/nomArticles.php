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
                            $nomarticle->nom = $_POST['nom'];
                            $nomarticle->ajoutArticle();
                            $this->request->action = 'liste-nom-article';
                            $this->render();
                           break;
                        break;
                           
                        case 'modifer-article':
                            $nomarticle = new Article($_POST['id']);
                            $nomarticle->nom = $_POST['nom'];
                            $nomarticle->modif();
                            $this->request->action = 'liste-nom-article';
                            $this->render();
                        break;
                    default;
                }
            }
        }
    }
        elseif ($this->request->method === 'GET'){
            if ($this->request->action != null){
                switch ($this->request->action){
                    case 'list-nom-article':
                       $this->render();
                    break;
                    case 'supprimerarticle':
                        $idarticle = intval($this->request->id);
                        $nomarticle = new Article($idarticle, null);
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
    }  
         // fin méthode process
        public function render($view){
            
                switch ($this->request->action){
                     // inclure les vues ici selon la valeur de $view
                    case 'list-nom-article':
                          $nomarticles = Article::listArticles();
                        require_once VIEW . 'nomarticle/listnomarticles.php';
                    break;
                    case 'modifier-article':
                        $idarticle = intval($this->request->id);
                        $currentArticle = new Article($idarticle);
                        $nomarticles = Article::listArticles();
                        require_once VIEW . 'nomarticle/modifnomarticle.php';
                    break;
                    case 'ajouter-nom-article':
                        echo 'Formulaire d\'ajout';
                         require_once   VIEW . 'nomarticle/ajoutnomarticle.php';
                    break;
                    case 'supprimer-article':
                        require_once VIEW . 'nomarticle/listnomarticles.php';
                    break;

                    default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                    $currentController = new Erreur($this->request);
                    $currentController->process();
                   
                }
            }
        } 
    

