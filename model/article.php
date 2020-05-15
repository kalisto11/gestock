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
            $req = "SELECT id from article  ";
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
            $req = "SELECT id from article  LIMIT $perpage OFFSET $offset";
            $reponse = $pdo->query($req);
            $articles = array();
            while ($row = $reponse->fetch()){
                $article = new Article($row['id']);
                $articles[] = $article;
            }  
            return $articles;
        }
      /* public static function getListArticle(){
            $pdo = Database::getPDO();
            $req = 'SELECT id FROM article LEFT JOIN sortie_article ON article.id = sortie_article.idArticle WHERE sortie_article.idArticle IS NULL AND sortie_article.id_bon_sortie IS NULL';
            $reponse = $pdo->query($req);
            $articles = array();
            while ($row = $reponse->fetch()){
                $article = new Article($row['id']);
                $articles[] = $article;
            }  
            return $articles;
        }*/
        public static function getNbrArticle(){
            $pdo = Database::getPDO();
            $req = "SELECT COUNT(id) FROM  article";
            $reponse = $pdo->query($req);
            $count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
             return  $count;
        }
        /**
         * 
         */
        public static function transaction($idArticle, $idBon, $numeroBon, $quantite, $typeTrans){
            $pdo = Database::getPDO();
            $req  = "INSERT INTO transactions (dateTrans,idArticle, idBon, numeroBon, quantite, typeTrans) VALUES (CURDATE(),:idArticle, :idBon, :numeroBon, :quantite, :typeTrans)";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'idArticle' => $idArticle,
                'idBon'     => $idBon,
                'numeroBon' => $numeroBon,
                'quantite'  => $quantite,
                'typeTrans' =>$typeTrans
            ));
        }
        public static function requireTransaction($idArticle){
            $pdo = Database::getPDO();
            $req = "SELECT * from transactions WHERE idArticle = ?";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($idArticle));
            while ($row = $reponse->fetch()){
                $transaction = $row;
                $transactions[] = $transaction;
            }  
            return $transactions;
        }
        /**
         * 
         */
        public static function updateQuantity($idArticle, $quantite, $typeTrans){
            $pdo = Database::getPDO();
            if($typeTrans =="entree"){
                $req  = "UPDATE article SET  quantite = quantite + :quantite WHERE id= :idArticle";
            }elseif($typeTrans == "sortie"){
                $req  = "UPDATE article SET  quantite = quantite - :quantite WHERE id= :idArticle";
            }
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'idArticle' => $idArticle,
                'quantite'  => $quantite
            ));
        }
        /**
         * 
         */
        public static function difQuantity($dotationIdArticle, $referenceBon){
            $pdo = Database::getPDO();
            $req = "SELECT quantite FROM transactions WHERE numeroBon = :numeroBon AND idArticle = :idArticle";
			$reponse = $pdo->prepare($req);
			$reponse->execute(array(
				'numeroBon' => $referenceBon,
				'idArticle' => $dotationIdArticle
			));
			$row = $reponse->fetch();
			$oldquantite = $row['quantite'];
            $reponse = $pdo->prepare("UPDATE article SET quantite = quantite + :oldquantite WHERE id = :idArticle");
            $reponse->execute(array(
                'oldquantite' => $oldquantite,
                'idArticle' => $dotationIdArticle
            ));
        }
    }//fin de la classe Article