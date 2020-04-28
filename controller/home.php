<?php

     /*
    * Controleur de la page d'accueil
    */

    class Home extends Controller{
        
        public function process(){
            $message[] = "Page d'accueil en cours de travaux, bientot disponible";
            $this->notification = new Notification("info", $message);
            $this->render($this->notification);
        }

         /**
         * permet d'afficher les vues du module home
         * @param Notification notification : objet contenant le type et le message de notification à afficher en cas d'echec ou de reussite d'une opération
         */
        public function render($notification = null){
            require_once VIEW . 'infos/notifications.php';
        }
    }