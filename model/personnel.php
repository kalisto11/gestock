<?php
 class Personnel{
    /* 
    * Model du module  agent  pour la gestion du agent
    */
    public $id;
    public $prenom;
    public $nom;
    public $poste;

    public function __construct($id = null){
        if ($id != null){
            $this->id = $id;
            $pdo = Database::getPDO();
            $req = 'SELECT * from personnel WHERE id = ?';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($id));
            $agent = $reponse->fetch();
            $this->id = $agent['id'];
            $this->prenom = $agent['prenom'];
            $this->nom = $agent['nom'];
            $this->poste = null;
        }
        else{
            $this->id     = null;
            $this->prenom = null;
            $this->nom    = null;
            $this->poste  = null;
        }
    }
    public function save(){ // fonction d'ajout d'un agent
        $pdo = Database::getPDO();
        $req = 'INSERT INTO personnel (prenom, nom) VALUES (:prenom, :nom)';
        $reponse = $pdo->prepare($req);
        $reponse->execute(array(
        'prenom' => $this->prenom,
        'nom'    => $this->nom
        ));
    }  
    public function update(){ //fonction permettant de modifier les données d'un agent

        $pdo = Database::getPDO();
        $req = 'UPDATE personnel SET prenom = :prenom, nom = :nom WHERE id = :id';
        $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
        $resultat = $reponse->execute(array(
        'prenom' => $this->prenom,
        'nom'    => $this->nom,
        'id'     => $this->id
        ));
    }  
    public function delete(){ //Fonction de suppresssion d'un agent

        $pdo = Database::getPDO();
        $sup = 'DELETE from personnel WHERE id = ?';
        $reponse = $pdo->prepare($sup);
        $reponse->execute(array($this->id));
    }
    public static function getList(){ //Fonction permettant d'obtenir la liste du agent
        $pdo = Database::getPDO();
        $get = 'SELECT * from personnel';
        $reponse = $pdo->query($get);
        $agents  = array();
        while ($row = $reponse->fetch()){
            $agent = new Personnel();
            $agent->id     = $row['id'];
            $agent->prenom = $row['prenom'];
            $agent->nom    = $row['nom'];
            $agents[]      = $agent;
        }
        return $agents;
    }

}