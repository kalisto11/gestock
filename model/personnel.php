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
            $personnel = $reponse->fetch();
            $this->id = $personnel['id'];
            $this->prenom = $personnel['prenom'];
            $this->nom = $personnel['nom'];

            $req = 'SELECT id, nom FROM poste RIGHT JOIN personnel_poste ON poste.id = personnel_poste.id_poste WHERE personnel_poste.id_personnel = ?';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($id));
            $postes = array();
            while ($poste = $reponse->fetch()){
                $postes[] = $poste;
            }
            $this->poste = $postes;
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

        $req = 'SELECT id FROM personnel Order By ID Desc';
        $reponse = $pdo->query($req);
        $personnel = $reponse->fetch();
        $this->id = $personnel['id'];

        $req = 'INSERT INTO personnel_poste (id_personnel, id_poste) VALUES (:id_personnel, :id_poste)';
        $reponse = $pdo->prepare($req);
        $reponse->execute(array(
            'id_personnel' => $this->id,
            'id_poste'    => $this->poste
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


       $sup = 'DELETE FROM personnel_poste WHERE id_personnel = ?';
       $reponse = $pdo->prepare($sup);
       $reponse->execute(array($this->id));

       $req = 'INSERT INTO personnel_poste (id_personnel, id_poste) VALUES (:id_personnel, :id_poste)';
       $reponse = $pdo->prepare($req);
       $reponse->execute(array(
           'id_personnel' => $this->id,
           'id_poste'    => $this->poste
       ));
    }  
    public function delete(){ //Fonction de suppresssion d'un agent

        $pdo = Database::getPDO();
        $sup = 'DELETE from personnel WHERE id = ?';
        $reponse = $pdo->prepare($sup);
        $reponse->execute(array($this->id));

        $sup = 'DELETE FROM personnel_poste WHERE id_personnel = ?';
        $reponse = $pdo->prepare($sup);
        $reponse->execute(array($this->id));
    }
    public static function getList(){ //Fonction permettant d'obtenir la liste du personnel
        $pdo = Database::getPDO();
        $get = 'SELECT id from personnel';
        $reponse = $pdo->query($get);
        $personnels  = array();
        while ($row = $reponse->fetch()){
            $personnel = new Personnel($row['id']);
            $personnels[] = $personnel;
        }
        return $personnels;
    }

}