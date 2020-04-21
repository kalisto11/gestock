<?php
     /*
    * Controleur de la gesstion des erreurs
    */

    class Erreur extends Controller{

        public function process(){
            $this->message = "Désolé la page à laquelle vous tentez d'accéder est introuvable";
            $this->render();
        }

        public function render($message = null){
            require_once VIEW . 'infos/default.php';
        }
    }