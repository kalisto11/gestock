<?php

<<<<<<< HEAD
    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class NomArticles extends Controller{

        public function process(){
            if ($this->request->method === 'POST'){
               // traitement des donnees des formulaires ici
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
                    case '':
                       
                    break;
    
                    case '':
                        
                    break;

                    default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                    $currentController = new Erreur($this->request);
                    $currentController->render();
                }
            }
        } 
    }
=======
require 'controller.php';

class ArticlesController extends Controller{
    public function __construct(){
        if (isset($_GET['action'])){
            $action = $_GET['action'];
            if ($action === 'consulter')
            $nomarticles = Articles::getlistArticles();
            require 'view/nomarticle/listnomArticles.php';
    }elseif
        ($action === 'ajouter'){
            require 'view/nomarticles/ajoutnomArticle.php';
        
    }elseif
        ($action === 'supprimer'){
            if (isset($_GET['id'])){
                $id = intval($_GET['id']);
                $nomarticle = new Articles($id);
                $nomarticle->supprimer();
                $nomarticles = Articles::getlistArticles();
                require 'view/nomartciles/listnomArticles.php';
        
    }
    }else if (isset($_POST['action'])){
        $action = $_POST['action'];
        switch($action){
            case 'ajouter':
                Articles::ajoutnomArticle($_POST['nom']);
                $nomarticles = Articles::getlistArticles();
                require 'view/nomarticles/listnomArticles.php';
            break;
            case 'modifier':
                $id = intval($_POST['id']);
                $nomarticle = new Articles($id);
                $upgrade = $nomarticle->modif($_POST['nom']);
                $upgrade = 0 ;
                require 'view/nomarticles/listnomArticles.php';
            break;
            default:
        }
    }
}
    public function render(){
     echo 'traiter les requetes sur les articles ici';
    }
}
>>>>>>> articles
