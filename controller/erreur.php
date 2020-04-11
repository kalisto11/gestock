<?php
     /*
    * Controleur de la gesstion des erreurs
    */
    
    class Erreur extends Controller{

        public function process(){
            $this->render();
        }

        public function render($message = null){
            if ($message === null){
                echo 'Page introuvable';
            }
            else{
                require_once VIEW . 'erreur/default.php';
            }
            
        }
    }