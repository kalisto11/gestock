<?php

/*
* Front Controller du site
* toutes les requetes passent par cette page
* qui charge les fichiers necessaires, appelle le dispatcher et affiche le template
*/  if (!isset($_SESSION)){
    session_start();
    }
   
    // inclure le fichier de configuration
    require_once '../core/config.php';
    // chargement de l'autoload
    Myautoload::start();

    if(isset($_SESSION['user'])){
        if ($_SESSION['user']['changePassword'] == false){
            require_once VIEW . 'acces/changepassword.php';
        }
        else{
            // temporisation de la sortie
            ob_start();
    
            // instanciation du dispatcher
            $dispatcher = new Dispatcher();

            // recueil de la sortie dans $content
            $content = ob_get_clean();

            // inclure le template par defaut
            require 'default.php';
        }
         
    }else{
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $dispatcher = new Dispatcher();
        }
        else{
            unset($_SESSION['notification']);
            require_once VIEW . 'authentification/login.php';
        }
    }
   


