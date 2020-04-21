<?php

    /**
     * Classe Article 
    **/

    class Article {
        public $id;
        public $nom;
        public $groupe;

        public function __construct($id = null){
            if ($id != null){
                $this->id = $id;
                $pdo = Database::getPDO();
                $req = 'SELECT * FROM article WHERE id= ?';
                $reponse = $pdo->prepare($req);
                $reponse -> execute(array($id));
                $article = $reponse->fetch();
                $this->id = $article['id'];
                $this->nom = $article['nom'];
                $this->groupe = $article['groupe'];
            }
            else{
                $this->nom = null;
                $this->id = null;
                $this->groupe = null;
            }
        }

        public  function modif(){
        $pdo = Database::getPDO();
        $update = 'UPDATE article SET nom = :nom, groupe = :groupe WHERE id = :id';
        $sortie = $pdo->prepare($update) OR die(print_r($pdo->errorinfo()));
        $sortie->execute(array(
            'nom' => $this->nom,
            'groupe' => $this->groupe,
            'id'  => $this->id
        ));
    }
        public  function supprime(){
        $pdo = Database::getPDO();
        
        $delete = 'DELETE from article WHERE id = ?';
        $retour = $pdo->prepare($delete);
        $retour->execute(array($this->id));
    }
        public  function ajoutArticle(){
            $pdo = Database::getPDO();
            $insert = 'INSERT INTO article (nom, groupe) VALUES (:nom, :groupe)';
            $retour = $pdo->prepare($insert);
            $retour->execute(array(
                'nom' => $this->nom,
                'groupe' => $this->groupe
            ));
        }
        public static function getList(){
            $pdo = Database::getPDO();
                $req = 'SELECT id from article';
                $reponse = $pdo->query($req);
                $articles = array();
                while ($row = $reponse->fetch()){
                    $article = new Article($row['id']);
                    $articles[] = $article;
                }  
                return $articles;
        }
    }