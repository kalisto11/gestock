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
            while ($row = $reponse->fetch()){
                $poste = new Poste($row['id']);
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

    /**
     * sauvegarde l'objet appelant dans la base
     */
    public function save(){ // fonction d'ajout d'un agent
        $pdo = Database::getPDO();
        $req = 'INSERT INTO personnel (prenom, nom) VALUES (:prenom, :nom)';
        $reponse = $pdo->prepare($req);
        $reponse->execute(array(
            'prenom' => $this->prenom,
            'nom'    => $this->nom
        ));

        $req = 'SELECT id FROM personnel ORDER BY id DESC LIMIT 1';
        $reponse = $pdo->query($req);
        $personnel = $reponse->fetch();
        $this->id = $personnel['id'];
        foreach ($this->poste as $poste){
        $req = 'INSERT INTO personnel_poste (id_personnel, id_poste) VALUES (:id_personnel, :id_poste)';
        $reponse = $pdo->prepare($req);
        $reponse->execute(array(
            'id_personnel' => $this->id,
            'id_poste'    => $poste
        ));
        }
    }
    
    /**
     * Met à jour les infos de l'objet appelant
     */
    public function update(){
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
       foreach ($this->poste as $poste){
       $req = 'INSERT INTO personnel_poste (id_personnel, id_poste) VALUES (:id_personnel, :id_poste)';
       $reponse = $pdo->prepare($req);
       $reponse->execute(array(
           'id_personnel' => $this->id,
           'id_poste'    => $poste
        ));
        }
    }  

    /** 
     * supprime l'objet appelant de la base de données
    */
    public function delete(){
        $pdo = Database::getPDO();
        $sup = 'DELETE from personnel WHERE id = ?';
        $reponse = $pdo->prepare($sup);
        $reponse->execute(array($this->id));

        $sup = 'DELETE FROM personnel_poste WHERE id_personnel = ?';
        $reponse = $pdo->prepare($sup);
        $reponse->execute(array($this->id));
    }

    /**
     * retourne la liste du personnel par lot dont le nombre est défini par $perPage
     * @param Int $perPage : définit le nombre de personnel affiché par page
     * @param Int $offset : valeur de départ pour récuperer un lot dans la base
     */
    public static function getList($perPage, $offset) {
        $pdo = Database::getPDO();
        $req = "SELECT id from personnel ORDER BY nom LIMIT $perPage OFFSET $offset";
        $reponse = $pdo->query($req);
        $personnels = array();
        while ($row = $reponse->fetch()){
            $personnel = new Personnel($row['id']);
            $personnels[] = $personnel;
        }
        return $personnels;
    }

    /**
     * Retourne la liste de tous le personnel
     * @param Personnel[] $personnel : lot de liste du personnel
     */
    public static function getListAll(){ //Fonction permettant d'obtenir la liste du personnel
        $pdo = Database::getPDO();
        $get = 'SELECT id from personnel ORDER BY nom';
        $reponse = $pdo->query($get);
        $personnels  = array();
        while ($row = $reponse->fetch()){
            $personnel = new Personnel($row['id']);
            $personnels[] = $personnel;
        }
        return $personnels;
    }

    /**
     * Retourne le nombre de personnel présent dans la base de données
     * @param Int $count : nombre de personnel
     */
    public static function getNbrAll(){
        $pdo = Database::getPDO();
        $req = "SELECT COUNT(id) FROM personnel";
        $reponse = $pdo->query($req);
        $count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
        return  $count;
    }
} // fin classe Personnel