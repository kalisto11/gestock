<?php

    /**
     * Classe Article 
    **/

    class Article {
        public $id;
        public $nom;
        public $groupe;
        public $quantite;
        public $seuil;

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
                $this->quantite = $article['quantite'];
                $this->seuil = $article['seuil'];
            }
            else{
                $this->nom = null;
                $this->id = null;
                $this->groupe = null;
                $this->quantite = null;
                $this->seuil = null;
            }
        }

        public  function modif(){
        $pdo = Database::getPDO();
        $update = 'UPDATE article SET nom = :nom, groupe = :groupe, quantite = :quantite, seuil = :seuil WHERE id = :id';
        $sortie = $pdo->prepare($update) OR die(print_r($pdo->errorinfo()));
        $sortie->execute(array(
            'nom' => $this->nom,
            'groupe' => $this->groupe,
            'quantite' => $this->quantite,
            'seuil' => $this->seuil,
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
            $insert = 'INSERT INTO article (nom, groupe, quantite, seuil) VALUES (:nom, :groupe, :quantite, :seuil)';
            $retour = $pdo->prepare($insert);
            $retour->execute(array(
                'nom' => $this->nom,
                'groupe' => $this->groupe,
                'quantite' => $this->quantite,
                'seuil' => $this->seuil
            ));
        }
        public static function getList(){
            $pdo = Database::getPDO();
            $req = 'SELECT id from article ORDER BY nom';
            $reponse = $pdo->query($req);
            $articles = array();
            while ($row = $reponse->fetch()){
                $article = new Article($row['id']);
                $articles[] = $article;
            }  
            return $articles;
        }
        public static function getListArticle(){
            $pdo = Database::getPDO();
            $req = 'SELECT id FROM article LEFT JOIN sortie_article ON article.id = sortie_article.id_article WHERE sortie_article.id_article IS NULL AND sortie_article.id_bon_sortie IS NULL';
            $reponse = $pdo->query($req);
            $articles = array();
            while ($row = $reponse->fetch()){
                $article = new Article($row['id']);
                $articles[] = $article;
            }  
            return $articles;
        }
    }