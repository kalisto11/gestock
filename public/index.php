<?php

/*
* Front Controller du site
* toutes les requetes passent par cette page
* qui analyse chaque requete et appelle le controller necessaire
*/
    ob_start();
    require_once '../core/config.php';
    Myautoload::start();
    $dispatcher = new Dispatcher();
    $content = ob_get_clean();
    require 'default.php';



