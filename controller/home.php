<?php

     /*
    * Controleur de la page d'accueil
    */

    class Home extends Controller{
        
        public function process(){
            $this->render($this->notification);
        }

         /**
         * permet d'afficher les vues du module home
         * @param Notification notification : objet contenant le type et le message de notification à afficher en cas d'echec ou de reussite d'une opération
         */
        public function render($notification = null){
            $articles = Article::getList();
            $users = User::getList();
            $bonsentrees = BonEntree::getListHome();
            $bonssorties = BonSortie::getListHome();
            require_once VIEW . 'home/home.php';
        }
    }