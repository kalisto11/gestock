<?php

     /*
    * Controleur de la page d'accueil
    */

    class Home extends Controller{
        
        public function process(){
            $this->notification = new Notification("info", "Page d'accueil en cours de travaux, bientot disponible");
            $this->render($this->notification);
        }

        public function render($notification = null){
            require_once VIEW . 'infos/notifications.php';
        }
    }