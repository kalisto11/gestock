<?php

    /**
     * Classe Article 
    **/

    class Article {
        public $id;
        public $nom;
        public $idçbon;
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
                $this->idçbon = $article['idçbon'];
                $this->quantite = $article['quantite'];
                $this->seuil = $article['seuil'];
            }
            else{
                $this->nom = null;
                $this->id = null;
                $this->idçbon = null;
                $this->quantite = null;
                $this->seuil = null;
            }
        }

        public  function modif(){
        $pdo = Database::getPDO();
        $update = 'UPDATE article SET nom = :nom, idçbon = :idçbon, quantite = :quantite, seuil = :seuil WHERE id = :id';
        $sortie = $pdo->prepare($update) OR die(print_r($pdo->errorinfo()));
        $sortie->execute(array(
            'nom' => $this->nom,
            'idçbon' => $this->idçbon,
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
            $insert = 'INSERT INTO article (nom, id_bon, quantite, seuil) VALUES (:nom, :id_bon, :quantite, :seuil)';
            $retour = $pdo->prepare($insert);
            $retour->execute(array(
                'nom' => $this->nom,
                'id_bon' => $this->id_bon,
                'quantite' => $this->quantite,
                'seuil' => $this->seuil
            ));
        }
        public static function getList(){
            $pdo = Database::getPDO();
            $req = "SELECT id from article ";
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
        public static function getListTrans($perpage, $offset){
            $pdo = Database::getPDO();
            $req = "SELECT id from article LIMIT $perpage OFFSET $offset";
            $reponse = $pdo->query($req);
            $articles = array();
            while ($row = $reponse->fetch()){
                $article = new Article($row['id']);
                $articles[] = $article;
            }  
            return $articles;
        }
        public static function getNbrTransaction(){
            $pdo = Database::getPDO();
            $req = "SELECT COUNT(id) FROM  article";
            $reponse = $pdo->query($req);
            $count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
             return  $count;
        }
        
        public static function transaction($id_article, $id_bon, $quantite){
            $pdo = Database::getPDO();
            $req  = "INSERT INTO transactions (id_article, id_bon, quantite) VALUES (:id_article, :id_bon, :quantite)";
            $reponse = $pdo->prepare($req);
            $retour->execute(array(
                'id_article' => $this->id_article,
                'idçbon' => $this->idçbon,
                'quantite' => $this->quantite
            ));
            $req = "SELECT id FROM article WHERE id = id_article ";

        }
    }