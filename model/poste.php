<?php

     /*
    * Modele du module poste pour la gestion de la liste des postes
    */

    class Poste{
        public $id;
        public $nom;

        public function __construct($id = null){
            if ($id === !null){
                $pdo = $bdd->getPDO();
                $req = 'SELECT * from poste WHERE id = ?';
                $reponse = $pdo->prepare($req);
                $reponse->execute(array($id));
                $poste = $reponse->fetch();
                $this->id = $poste['id'];
                $this->nom = $poste['nom'];
            } 
        }

        public function save($nom){

        }

        public function update($id){

        }

        public function delete($id){

        }

        public function findOne(){

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