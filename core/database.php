<?php
    class Database{

        private $name;
        private $user;
        private $pass;
        private $host;
        private $pdo;

        public function __construct($name, $user = 'root', $pass = '', $host = 'localhost'){
            $this->name = $name;
            $this->user = $user;
            $this->pass = $pass;
            $this->host = $host;
        }

        private function getPDO(){
            $pdo = new PDO('mysql:dbname=gestock;host=localhost', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            return $pdo;
        }
    }