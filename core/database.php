<?php
    class Database{

        public static $pdo;

        public function __construct(){
           
        }

        public static function getPDO(){
            if (self::$pdo === null){
                self::$pdo = new pdo('mysql:host=localhost; dbname=gestock', 'root', '');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return self::$pdo; 
            }
            else{
                return self::$pdo;
            }
        }
    }