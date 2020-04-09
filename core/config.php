<?php

/*
* Fichier de configuration globale du site
*/

ini_set('display_errors', 'on');
error_reporting(E_ALL);

class Myautoload{
    public static function start(){

        spl_autoload_register(array(__CLASS__, 'autoload'));

        define('HOST', $_SERVER['HTTP_HOST'] . '/gestock/');
        define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/gestock/');
        define('CONTROLLER', ROOT . 'controller/');
        define('MODEL', ROOT . 'model/');
        define('VIEW', ROOT . 'view/');
        define('CORE', ROOT . 'core/');
    }

    public static function autoload($class){
        if (file_exists(CORE . $class . '.php')){
            require_once CORE . $class . '.php';
        }else if (file_exists(MODEL . $class . '.php')){
            require_once MODEL . $class. '.php';
        }else if (file_exists(CONTROLLER . $class . '.php')){
            require_once CONTROLLER . $class . '.php';
        }
    }
}




