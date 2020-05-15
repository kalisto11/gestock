<?php
   
class Users{
    public $id;
    public $nomComplet;
    public $username;
    public $pasword;
    public $niveau;

    public function __construct($id = null){
        $pdo = Database::getPDO();
        $req = 'SELECT * FROM users WHERE id = ?';
        $reponse = $pdo->prepare($req);
        $reponse->execute(array($id));
        $user =  $reponse->fetch();
        $this->id = $user['id'];
        $this->nomComplet = $user['nomComplet'];
        $this->username = $user['username'];
        $this->pasword = $user['pasword'];
        $this->niveau = $user['niveau'];
    }
    public static function getList(){
        $pdo = Database::getPDO();
        $req = 'SELECT * from users';
        $reponse = $pdo->query($req);
        $users = array();
        while ($row = $reponse->fetch()){
            $user = new Users($row['id']);  
            $users[] = $user;
        }
        return $users;
    }
} 

