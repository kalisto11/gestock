<?php
class Articles {
    public $id;
    public $nom;

    public function __construct($id = null){
        if ($id === !null){
            $pdo = $bdd->getPDO();
        $req = 'SELECT * FROM gestock WHERE id= ?';
        $reponse = $pdo->prepare($req);
        $reponse -> execute(array($id));
        $nomarticle = $reponse->fetch();
        $this->id = $nomarticle['id'];
        $this->nom = $nomarticle['nom'];
        }
    }
    public function modif($id){
        if ($id === !null){
       $pdo = $bdd->getPDO();
    }
    $this->nom = $nom;
    $update = 'UPDATE article SET nom = :nom WHERE id = id';
    $sortie = $pdo->prepare($update);
    $sortie->execute(array(
        'nom' => $this->nom
    ));
}
    public function supprime($id){
    if ($id === !null){
        $pdo = $bdd->getPDO();
    }
    $delete = 'DELETE from etudiants WHERE id = ?';
    $retour = $pdo->prepare($delete);
    $retour->execute(array($this->id));
}
    public function ajoutArticle($nom){
        if ($id === !null){
            $pdo = $bdd->getPDO();
        }
        $insert = 'INSERT INTO nomarticle (nom) VALUES (:nom)';
        $retour = $pdo->prepare($insert);
        $retour->execute(array(
            'nom'=> $this->nom));
    }
    public function listArticles(){
        $pdo = $bdd->getPDO();
            $req = 'SELECT * from nomarticle';
            $reponse = $pdo->query($req);
            $nomarticles = array();
            while ($row = $reponse->fetch()){
                $nomarticle = new Articles();
                $nomarticle->id = $row['id'];
                $nomarticle->nom = $row['nom'];
                $nomarticles[] = $nomarticle;
    }
        return $nomarticle;
}










?>


