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

        public function render($notification = null){
            require_once VIEW . 'infos/notifications.php';
        }
    }