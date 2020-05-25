<?php

     /*
    * Modele du module fournisseur pour la gestion de la liste des fournisseurs
    */

    class Fournisseur{
        public $id;
        public $nom;

        public function __construct($id = null){
            if ($id != null){
                $this->id = $id;
                $pdo = Database::getPDO();
                $req = 'SELECT * from fournisseur WHERE id = ?';
                $reponse = $pdo->prepare($req);
                $reponse->execute(array($id));
                $fournisseur = $reponse->fetch();
                $this->id = $fournisseur['id'];
                $this->nom = $fournisseur['nom'];
            }
            else{
                $this->id = null;
                $this->nom = null;
            }
        }

        /**
         * sauvegarde l'aobjet appelant dans la base de données
         */
        public function save(){
            $pdo = Database::getPDO();
            $req = 'INSERT INTO fournisseur (nom) VALUES (:nom)';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
            'nom' => $this->nom
            ));
        }

        /**
         * Met à jour dans la base les infos de l'objet appelant la méthode
         */
        public function update(){
            $pdo = Database::getPDO();
            $req = 'UPDATE fournisseur SET nom = :nom WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
            $resultat = $reponse->execute(array(
            'nom' => $this->nom,
            'id' => $this->id
            ));
        }

        /**
         * Supprime de la base l'objet appelant
         */
        public function delete(){
            $pdo = Database::getPDO();
            $req = 'DELETE from fournisseur WHERE id = ?';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($this->id));
        }

        /**
         * Retourne la liste de tous les fournisseurs
         * @return Fournisseur[] $fournisseurs : liste de tous les fournisseurs
         */
        public static function getListAll(){
            $pdo = Database::getPDO();
            $req = 'SELECT id from fournisseur ORDER BY nom';
            $reponse = $pdo->query($req);
            $fournisseurs = array();
            while ($row = $reponse->fetch()){
                $fournisseur = new Fournisseur($row['id']);
                $fournisseurs[] = $fournisseur;
            }
            return $fournisseurs;
        }

        /**
         * Retourne la liste des fournisseurs par le lot dont le nombre est défini par la valeur de $perPage
         * @param Int $perPage : nombre de fournisseurs affichés par page
         * @param int $offset : valeur de début du lot récupéré
         * @return Fournisseur[] $fournisseurs : liste des fournisseurs par lot
         */
        public static function getList($perPage, $offset) {
			$pdo = Database::getPDO();
            $req = "SELECT id FROM fournisseur ORDER BY nom LIMIT $perPage OFFSET $offset";
            $reponse = $pdo->query($req);
            $fournisseurs = array();
            while ($row = $reponse->fetch()){
                $fournisseur = new Fournisseur($row['id']);
                $fournisseurs[] = $fournisseur;
            }
            return $fournisseurs;
        }

        /**
         * retiurne le nombre de fournisseurs présent dans la base
         * @return Int $count : nombre de fournisseurs
         */
        public static function getNbrFournisseur(){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM fournisseur";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}
    }