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

            $req = "SELECT quantite from article WHERE id = $this->id";
            $reponse = $pdo->query($req);
            $article = $reponse->fetch();
            $difference = $this->quantite - $article['quantite'];

            $update = 'UPDATE article SET nom = :nom, groupe = :groupe, quantite = :quantite, seuil = :seuil WHERE id = :id';
            $sortie = $pdo->prepare($update) OR die(print_r($pdo->errorinfo()));
            $sortie->execute(array(
                'nom' => $this->nom,
                'groupe' => $this->groupe,
                'quantite' => $this->quantite,
                'seuil' => $this->seuil,
                'id'  => $this->id
            ));
            if ($difference != 0){
                self::insertTransaction($this->id, $_SESSION['user']['id'], $_SESSION['user']['nomComplet'] , $difference, "modification");
            }
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
            $req = 'SELECT id FROM article Order By id Desc LIMIT 1';
        	$reponse = $pdo->query($req);
			$article = $reponse->fetch();
			$this->id = $article['id'];
            self::insertTransaction($this->id, $_SESSION['user']['id'], $_SESSION['user']['nomComplet'] , $this->quantite, "création");
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
        public static function getListTrans($perpage, $offset){
            $pdo = Database::getPDO();
            $req = "SELECT id from article  ORDER BY nom LIMIT $perpage OFFSET $offset";
            $reponse = $pdo->query($req);
            $articles = array();
            while ($row = $reponse->fetch()){
                $article = new Article($row['id']);
                $articles[] = $article;
            }  
            return $articles;
        }
    
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
        public static function insertTransaction($idArticle, $idBon, $numeroBon, $quantite, $typeTrans){
            $numeroBon = $numeroBon . "";
            $pdo = Database::getPDO();
            if ($typeTrans == "entrée" OR $typeTrans == "sortie"){
                $req = "DELETE FROM transactions WHERE idArticle = :idArticle AND idBon = :idBon AND typeTrans = :typeTrans";
                $reponse = $pdo->prepare($req);
                $reponse->execute(array(
                    'idArticle' => $idArticle,
                    'idBon'     => $idBon,
                    'typeTrans'     => $typeTrans,
                ));
            }

            $req  = "INSERT INTO transactions (dateTrans, idArticle, idBon, numeroBon, quantite, typeTrans) VALUES (CURDATE(), :idArticle, :idBon, :numeroBon, :quantite, :typeTrans)";
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
            $req = "SELECT id, DATE_FORMAT(dateTrans, '%d/%m/%Y') AS dateTrans, idArticle, idBon, numeroBon, quantite, typeTrans from transactions WHERE idArticle = ? ORDER BY id DESC";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($idArticle));
            $transactions = array();
            while ($row = $reponse->fetch()){
                $transactions[] = $row;
            }  
            return $transactions;
        }
        /**
         * 
         */
        public static function updateQuantity($idArticle, $quantite, $typeTrans){
            $pdo = Database::getPDO();
            if($typeTrans =="entrée"){
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
         * Annule la quantité précédente qui a été ajoutée ou supprimée par le bon qui est modifié
         */
        public static function removeQuantity($dotationIdArticle, $referenceBon, $typeTrans){
            $pdo = Database::getPDO();
            $req = "SELECT quantite FROM transactions WHERE numeroBon = :numeroBon AND idArticle = :idArticle";
			$reponse = $pdo->prepare($req);
			$reponse->execute(array(
				'numeroBon' => $referenceBon,
				'idArticle' => $dotationIdArticle
			));
			$row = $reponse->fetch();
            $oldQuantity = intval($row['quantite']);
            if ($typeTrans == "entrée"){
                $reponse = $pdo->prepare("UPDATE article SET quantite = quantite - :oldQuantity WHERE id = :idArticle");
            }
            else if ($typeTrans == "sortie"){
                $reponse = $pdo->prepare("UPDATE article SET quantite = quantite + :oldQuantity WHERE id = :idArticle");
            }
            $reponse->execute(array(
                'oldQuantity' => $oldQuantity,
                'idArticle' => $dotationIdArticle
            ));
        }
    }//fin de la classe Article