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
    public function modif($nom){
        if ($id === !null){
       $pdo = $bdd->getPDO();
    }
    $this->nom = $nom;

    $sortie = $pdo->prepare('UPDATE article SET nom = :nom WHERE id = id');
    $sortie->execute(array(
        'nom' => $this->nom
    ));
}
    public function ajoutArticle($nom){
        if ($id === !null){
            $pdo = $bdd->getPDO();
        }
        $retour = $pdo->prepare('INSERT INTO nomarticle (nom) VALUES (:nom)');
        $retour->execute(array(
            'nom'=> $this->nom));
    }
    public function 
}










?>


