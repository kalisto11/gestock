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

        public function save(){
            $pdo = Database::getPDO();
            $req = 'INSERT INTO fournisseur (nom) VALUES (:nom)';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
            'nom' => $this->nom
            ));
        }

        public function update(){
            $pdo = Database::getPDO();
            $req = 'UPDATE fournisseur SET nom = :nom WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
            $resultat = $reponse->execute(array(
            'nom' => $this->nom,
            'id' => $this->id
            ));
        }

        public function delete(){
            $pdo = Database::getPDO();
            $req = 'DELETE from fournisseur WHERE id = ?';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($this->id));
        }

        public static function getList(){
            $pdo = Database::getPDO();
            $req = 'SELECT * from fournisseur';
            $reponse = $pdo->query($req);
            $fournisseurs = array();
            while ($row = $reponse->fetch()){
                $fournisseur = new Fournisseur($row['id']);
                $fournisseurs[] = $fournisseur;
            }
            return $fournisseurs;
        }
    }