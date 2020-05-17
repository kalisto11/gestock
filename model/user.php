<?php
   
class User{
    public $id;
    public $prenom;
    public $nom;
    public $username;
    public $pasword;
    public $niveau;
    public $changePassword;

    public function __construct($id = null){
        $pdo = Database::getPDO();
        $req = 'SELECT * FROM users WHERE id = ?';
        $reponse = $pdo->prepare($req);
        $reponse->execute(array($id));
        $user =  $reponse->fetch();
        $this->id = $user['id'];
        $this->prenom = $user['prenom'];
        $this->nom = $user['nom'];
        $this->username = $user['username'];
        $this->pasword = $user['pasword'];
        $this->niveau = $user['niveau'];
        $this->changePassword = $user['changePassword'];
    }
    public static function getList(){
        $pdo = Database::getPDO();
        $req = 'SELECT * from users';
        $reponse = $pdo->query($req);
        $users = array();
        while ($row = $reponse->fetch()){
            $user = new User($row['id']);  
            $users[] = $user;
        }
        return $users;
    }

    public function save(){
        $pdo = Database::getPDO();
        $req = "INSERT INTO users (prenom, nom, username, pasword, niveau) VALUES (:prenom, :nom, :username, :pasword, :niveau)";
        $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
        $reponse->execute(array(
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'username' => $this->username,
            'pasword' => $this->pasword,
            'niveau' => $this->niveau,
        ));
    }

    public function update(){
        $pdo = Database::getPDO();
        $req = 'UPDATE users SET prenom = :prenom, nom = :nom, username = :username, pasword = :pasword, niveau = :niveau, changePassword = :changePassword WHERE id = :id';
        $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
        $reponse->execute(array(
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'username' => $this->username,
            'pasword' => $this->pasword,
            'niveau' => $this->niveau,
            'changePassword' => $this->changePassword,
            'id'  => $this->id
        ));
    }

    public function delete(){
        $pdo = Database::getPDO();
        $req = 'DELETE from users WHERE id = ?';
        $retour = $pdo->prepare($req);
        $retour->execute(array($this->id));
    }
} 

