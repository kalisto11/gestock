<?php

    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class NomArticles extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){
               if $this->request->action 
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
                        require 'view/nomarticle/listnomArticles.php';
                    break;
    
                    case 'modifierarticle':
                        $id = intval($_POST['id']);
                        $nomarticle = new Articles($id);
                        $upgrade = $nomarticle->modif($_POST['nom']);
                        $upgrade = 0 ;
                        require 'view/nomarticles/modifnomArticles.php';
                    break;
                     
                    case 'ajoutarticle':
                        Articles::ajoutnomArticle($_POST['nom']);
                        $nomarticles = Articles::getlistArticles();
                         require 'view/nomarticles/listnomArticles.php';
                    break;
                    
                    case 'supprimerarticle':
                        $nomarticle = new Articles($id);
                        $nomarticle->supprimer();
                        $nomarticles = Articles::listArticles();
                        require 'view/nomartciles/listnomArticles.php';
                    break;

                    default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                    $currentController = new Erreur($this->request);
                    $currentController->render();
                }
            }
        } 
    }
