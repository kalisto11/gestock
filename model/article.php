<?php
class Article {
    public $id;
    public $nom;

    public function __construct($id = null){
       if ($id != null){
        $this->id = $id;
        $pdo = Database::getPDO();
        $req = 'SELECT * FROM nomarticle WHERE id= ?';
        $reponse = $pdo->prepare($req);
        $reponse -> execute(array($id));
        $nomarticle = $reponse->fetch();
        $this->id = $nomarticle['id'];
        $this->nom = $nomarticle['nom'];
       }else{
            $this->nom = null;
           $this->id = null;
           
             
        }
    }
    public  function modif(){
    $pdo = Database::getPDO();
    $update = 'UPDATE nomarticle SET nom = :nom WHERE id = :id';
    $sortie = $pdo->prepare($update) OR die(print_r($pdo->errorinfo()));
    $sortie->execute(array(
        'nom' => $this->nom,
        'id'  => $this->id
    ));
}
    public  function supprime(){
    $pdo = Database::getPDO();
    
    $delete = 'DELETE from nomarticle WHERE id = ?';
    $retour = $pdo->prepare($delete);
    $retour->execute(array($this->id));
}
    public  function ajoutArticle(){
        $pdo = Database::getPDO();
        $insert = 'INSERT INTO nomarticle (nom) VALUES (:nom)';
        $retour = $pdo->prepare($insert);
        $retour->execute(array(
            'nom'=>$this->nom));
    }
    public static function listArticles(){
        $pdo = Database::getPDO();
            $req = 'SELECT * from nomarticle';
            $reponse = $pdo->query($req);
            $nomarticles = array();
            while ($row = $reponse->fetch()){
                $nomarticle = new Article();
                $nomarticle->id = $row['id'];
                $nomarticle->nom = $row['nom'];
                $nomarticles[] = $nomarticle;
            }  
             return $nomarticles;
    }
}