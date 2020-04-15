<?php
 class Personnel{
    /* 
    * Model du module  Personnel pour la gestion du personnel
    */
    public $id;
    public $prenom;
    public $nom;
    public $poste;

    public function __construct(){
        if ($id != null){
            $this->id = $id;
            $pdo = Database::getPDO();
            $req = 'SELECT * from personnel WHERE id = ?';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($id));
            $personnel = $reponse->fetch();
            $this->id = $personnel['id'];
            $this->prenom = $personnel['prenom'];
            $this->nom = $personnel['nom'];
            $this->poste = $personnel['poste'];
        }
        else{
            $this->id     = null;
            $this->prenom = null;
            $this->nom    = null;
            $this->poste  = null;
        }
    }
    public function save(){ // fonction d'ajout d'un personnel
        $pdo = Database::getPDO();
        $req = 'INSERT INTO personnel (prenom, nom, poste) VALUES (:prenom, :nom, :poste)';
        $reponse = $pdo->prepare($req);
        $reponse->execute(array(
        'prenom' => $this->prenom,
        'nom'    => $this->nom,
        'poste'  => $this->poste
        ));
    }  
    public function update(){ //fonction permettant de modifier les données d'un personnel
        $pdo = Database::getPDO();
        $req = 'UPDATE personnel SET prenom = :prenom, nom = :nom, poste = :poste WHERE id = :id';
        $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
        $resultat = $reponse->execute(array(
        'prenom' => $this->prenom,
        'nom'    => $this->nom,
        'poste'  => $this->poste,
        'id'     => $this->id
        ));
    }  
    public function delete(){ //Fonction de suppresssion d'un personnel
        $pdo = Database::getPDO();
        $sup = 'DELETE from personnel WHERE id = ?';
        $reponse = $pdo->prepare($sup);
        $reponse->execute(array($this->id));
    }
    public static function getList(){ //Fonction permettant d'obtenir la liste du personnel
        $pdo = Database::getPDO();
        $get = 'SELECT * from personnel';
        $reponse = $pdo->query($get);
        $personnels = array();
        while ($row = $reponse->fetch()){
            $personnel = new Personnel();
            $personnel->id     = $row['id'];
            $personnel->prenom = $row['prenom'];
            $personnel->nom    = $row['nom'];
            $personnel->poste  = $row['poste'];
            $personnels[]      = $personnel;
        }
        return $personnels;
    }

}