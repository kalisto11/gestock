<?php
     /*
    * Controleur de la gesstion des erreurs
    */
    
    class Erreur extends Controller{

        public function process(){
            $this->render($this->request->action);
        }

        public function render($view){
            echo 'Page introuvable';
        }
    }