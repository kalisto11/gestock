<?php

/*
* Front Controller du site
* toutes les requetes passent par cette page
* qui charge les fichiers necessaires, appelle le dispatcher et affiche le template
*/
    
    // temporisation de la sortie
    ob_start();

    // inclure le fichier de configuration
    require_once '../core/config.php';

    // chargement de l'autoload
    Myautoload::start();

    // instanciation du dispatcher
    $dispatcher = new Dispatcher();

    // recueil de la sortie dans $content
    $content = ob_get_clean();

    // inclure le template par defaut
    require 'default.php';



