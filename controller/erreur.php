<?php
     /*
    * Controleur de la gesstion des erreurs
    */

    class Erreur extends Controller{

        public function process(){
            $this->notification = new Notification("danger", "Désolé la page à laquelle vous tentez d'accéder est introuvable");
            $this->render($this->notification);
        }

        public function render($notification = null){
            require_once VIEW . 'infos/default.php';
        }
    }