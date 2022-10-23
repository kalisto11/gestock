<?php
    class Database{

        public static $pdo;  
        public function __construct(){
        }

        /**
         * permet de recuperer un objet de type pdo
         *@return PDO un objet PDO
        **/
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