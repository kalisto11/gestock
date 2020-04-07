<?php

/*
* Front Controller du site
* toutes les requetes passent par cette page
* qui analyse chaque requete et appelle le controller necessaire
*/
    require_once '../core/Config.php';
    Myautoload::start();
    $dispatcher = new Dispatcher();



