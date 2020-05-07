<?php

class Connection{
    public function __construct(){
        $pdo = Database::getPDO();
    }
    /**
     * @param $username
     * @param $password
     * @return boolean
     */
    public function login($username,  $password){
        $user = $this->$pdo->prepare('SELECT * FROM users WHERE username = ?', [$username], null, true);
        var_dump($user);
    }

    public function est_connecte(){
        return isset($_SESSION['user']);
    }
}