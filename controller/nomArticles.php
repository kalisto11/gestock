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
                case 'ajouter-nom-article':
                 $nomarticle = new Article(null, $_POST['nom']);
                 $nomarticle->ajoutArticle();
                 $nomarticle = Article::ajoutArticle($_POST['nom']);
                 $nomarticles = Article::listArticles();
                break;
                case 'modifer-article':
                    $nomarticle = new Article(null, $_POST['nom']);
                    $nomarticle->modif();
                    $id = intval($_POST['id']);
                    $nomarticle = new Article($id);
                    $upgrade = $nomarticle->modif($_POST['nom']);
                    $upgrade = 0 ;
                break;
            }
        }elseif ($this->request->method === 'GET'){
            if ($this->request->action != null){
                switch ($this->request->action){
                    case 'liste-nom-article':
                        $nomarticles = Article::listArticles();
                    break;
                    case 'supprimerarticle':
                        $nomarticle = new Article($id);
                        $nomarticle->supprime();
                        $nomarticles = Article::listArticles();
                        
                    break;
                }
            }
        }
    }  
        $this->render($this->request->action);
        }
        public function render($view){
            if ($this->request->action === ''){
                
                // afficher la vue si action n'existe pas (vide)
                echo 'Afficher la listes des articles';
            }
            else{
                switch ($view){
                     // inclure les vues ici selon la valeur de $view
                    case 'list-nom-article':
                          echo 'Liste des articles';
                        require_once VIEW . 'nomarticle/listnomarticles.php';
                    break;
                    case 'modifier-article':
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
    }
