<?php

     /*
    * Modele du module poste pour la gestion de la liste des postes
    */

    class Poste{
        public $id;
        public $nom;

        public function __construct($id = null, $nom = null){
            if ($id === !null){
                $pdo = $bdd->getPDO();
                $req = 'SELECT * from poste WHERE id = ?';
                $reponse = $pdo->prepare($req);
                $reponse->execute(array($id));
                $poste = $reponse->fetch();
                $this->id = $poste['id'];
                $this->nom = $poste['nom'];
            }
          else{
                $this->nom = $nom;
            }
         }
        public function save(){
            $pdo = Database::getPDO();
            $req = 'INSERT INTO poste (nom) VALUES (:nom)';
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
            'nom' => $this->nom
            ));
        }

        public function update(){
            $pdo = $bdd->getPDO();
            $req = 'UPDATE poste SET nom = :nom, WHERE id = :id';
            $reponse = $pdo->prepare($req) OR die(print_r($pdo->errorinfo()));
            $resultat = $reponse->execute(array(
            'nom' => $this->nom,
            'id' => $this->id
            ));
        }

        public function delete($id){
            $pdo = $bdd->getPDO();
            $req = 'DELETE from poste WHERE id = ?';
            $reponse = $pdo->prepare('DELETE from poste WHERE id = ?');
            $reponse->execute(array($this->id));
        }

        public static function findAll(){
            $pdo = $bdd->getPDO();
            $req = 'SELECT * from poste';
            $reponse = $pdo->query($req);
            $postes = array();
            while ($row = $reponse->fetch()){
                $poste = new Poste();
                $poste->id = $row['id'];
                $poste->nom = $row['nom'];
                $postes[] = $poste;
            }
            return $postes;
        }
    }