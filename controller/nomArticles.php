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
                case 'ajouterarticle':
                 $nomarticle = new Articles(null, $_POST['nom']);
                 $nomarticle->ajoutArticle();
                break;
                case 'modiferarticle':
                    $nomarticle = new Articles(null, $_POST['nom']);
                    $nomarticle->modifarticle();
                break;
            }
        }elseif ($this->request->method === 'GET'){
            if ($this->request->action != null){
                switch ($this->request->action){
                    case 'voirarticle':
                        $nomarticles = Articles::listarticles();
                    break;
                    case 'supprimerarticle':
                        $nomarticle = new Articles($id);
                        $nomarticle->supprimer();
                        $nomarticles = Articles::listArticles();
                    break;
                }
            }
        }
    }  
        $this->render($this->request->action);
        }
        public function render($view){
            if ($view === ''){
                // afficher la vue si action n'existe pas (vide)


                echo 'ok';
            }
            else{
                switch ($view){
                     // inclure les vues ici selon la valeur de $view
                    case 'voirarticle':
                        $nomarticles = Articles::listArticles();
                        require_once 'view/nomarticle/listnomArticles.php';
                    break;
                    case 'modifierarticle':
                        $id = intval($_POST['id']);
                        $nomarticle = new Articles($id);
                        $upgrade = $nomarticle->modif($_POST['nom']);
                        $upgrade = 0 ;
                        require 'view/nomarticles/modifnomArticles.php';
                    break;
                    case 'ajoutarticle':
                        $nomarticle = Articles::ajoutArticle($_POST['nom']);
                        $nomarticles = Articles::listArticles();
                         require_once 'view/nomarticles/ajoutnomArticles.php';
                    break;
                    case 'supprimerarticle':
                        require 'view/nomartciles/listnomArticles.php';
                    break;

                    default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                    $currentController = new Erreur($this->request);
                    $currentController->render();
                }
            }
        } 
    }
