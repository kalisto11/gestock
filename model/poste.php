<?php

     /*
    * Modele du module poste pour la gestion de la liste des postes
    */

    class Poste{
        public $id;
        public $nom;
        public $statut;

        public function __construct($id = null){
            if ($id != null){
                $this->id = $id;
                $pdo = Database::getPDO();
                $req = 'SELECT * from poste WHERE id = ?';
                $reponse = $pdo->prepare($req);
                $reponse->execute(array($id));
                $poste = $reponse->fetch();
                $this->id = $poste['id'];
                $this->nom = $poste['nom'];
                $this->statut = self::getStatut($id);
            }
            else{
                $this->id = null;
                $this->nom = null;
                $this->statut = null;
            }
        }

        /**
         * sauvegarde l'onjet appelant dans la base
         */
        public function save(){
            $pdo = Database::getPDO();
            $req = 'INSERT INTO poste (nom) VALUES (:nom)';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
            'nom' => $this->nom
            ));
        }

        /**
         * Met à jour les infos de l'objet appelant
         */
        public function update(){
            $pdo = Database::getPDO();
            $req = 'UPDATE poste SET nom = :nom WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
            $resultat = $reponse->execute(array(
            'nom' => $this->nom,
            'id' => $this->id
            ));
        }

        /**
         * supprime l'objet appelant de la base de données
         */
        public function delete(){
            $pdo = Database::getPDO();
            $req = 'DELETE from poste WHERE id = ?';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($this->id));
            $sup = 'DELETE FROM personnel_poste WHERE id_poste = ?';
            $reponse = $pdo->prepare($sup);
            $reponse->execute(array($this->id));
        }

        /**
         * Retourne la liste de tous les postes
         * @return Poste $postes : liste de tous les postes présents dans la base
         */
        public static function getListAll(){
            $pdo = Database::getPDO();
            $req = 'SELECT * from poste ORDER BY nom';
            $reponse = $pdo->query($req);
            $postes = array();
            while ($row = $reponse->fetch()){
                $poste = new Poste($row['id']);
                $postes[] = $poste;
            }
            return $postes;
        }

        /**
         * Retourne la lsite des postes libres (non occupés par un personnel)
         * @return Poste $postes : liste des postes libres
         */
        public static function getListFree(){
            $pdo = Database::getPDO();
            $req = 'SELECT id FROM poste LEFT JOIN personnel_poste ON poste.id = personnel_poste.id_poste WHERE personnel_poste.id_poste IS NULL AND personnel_poste.id_personnel IS NULL ORDER BY nom';
            $reponse = $pdo->query($req);
            $postes = array();
            while ($row = $reponse->fetch()){
                $poste = new Poste($row['id']);
                $postes[] = $poste;
            }  
            return $postes;
        }

        public static function getStatut($idPoste){
            $pdo = Database::getPDO();
            $req = 'SELECT id_poste from personnel_poste';
            $reponse = $pdo->query($req);
            $ids = array();
            while ($row = $reponse->fetch()){
                $id = $row['id_poste'];
                $ids[] = $id;
            }
            if (in_array($idPoste, $ids)){
                return "Occupé";
            }
            else{
                return "Libre";
            }
        }

    }