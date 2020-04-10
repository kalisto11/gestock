<?php
     /*
    * Controleur de la gesstion des erreurs
    */
    
    class Erreur extends Controller{

        public function process(){
            $this->render();
        }

        public function render(){
            echo 'Page introuvable';
        }
    }