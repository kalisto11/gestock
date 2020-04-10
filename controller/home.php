<?php

     /*
    * Controleur de la page d'accueil
    */

    class Home extends Controller{
        
        public function process(){
            $this->render();
        }

        public function render(){
            echo 'traiter les requetes sur l\'accueil ici';
        }
    }