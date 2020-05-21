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

        public  function save(){
            $pdo = Database::getPDO();
            $insert = 'INSERT INTO article (nom, groupe, quantite, seuil) VALUES (:nom, :groupe, :quantite, :seuil)';
            $retour = $pdo->prepare($insert);
            $retour->execute(array(
                'nom' => $this->nom,
                'groupe' => $this->groupe,
                'quantite' => $this->quantite,
                'seuil' => $this->seuil
            ));
            $req = 'SELECT * FROM article ORDER BY id DESC LIMIT 1';
        	$reponse = $pdo->query($req);
			$article = $reponse->fetch();
            $this->id = $article['id'];
            $nomComplet = $_SESSION['user']['prenom'] . " " . $_SESSION['user']['nom'] ;
            self::insertTransaction($this->id, $this->nom, $this->quantite, $_SESSION['user']['id'] , $nomComplet, $this->quantite, "création");
        }

        public function update(){
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
                $nomComplet = $_SESSION['user']['prenom']. ' ' .$_SESSION['user']['nom'];  
                self::insertTransaction($this->id, $this->nom, $this->quantite, $_SESSION['user']['id'], $nomComplet, $difference, "modification");
            }
        }

        public function delete(){
        $pdo = Database::getPDO();
        $delete = 'DELETE FROM article WHERE id = ?';
        $retour = $pdo->prepare($delete);
        $retour->execute(array($this->id));
        }

        /**
         * retourne la liste de tous les articles
         */
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

        /**
         * retourne la liste des articles par lots definis par $perpage
         */
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

        public static function getListTransJournal($perpage, $offset){
            $pdo = Database::getPDO();
            $req = "SELECT * from transactions WHERE dateTrans = CURDATE() ORDER BY id DESC LIMIT $perpage OFFSET $offset";
            $reponse = $pdo->query($req);
            $articles = array();
            while ($row = $reponse->fetch()){
                $transaction = new Transaction($row['id']);
                $transactions[] = $transaction;
            }  
            return $transactions;
        }
    
        public static function getNbrArticle(){
            $pdo = Database::getPDO();
            $req = "SELECT COUNT(id) FROM  article";
            $reponse = $pdo->query($req);
            $count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
             return  $count;
        }

        public static function getNbrTransJournal(){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM transactions WHERE dateTrans = CURDATE()";
			$reponse = $pdo->query($req);
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			 return  $count;
		}
        /**
         * 
         */
        public static function insertTransaction($idArticle, $nomArticle, $quantiteArticle, $idBon, $numeroBon, $quantite, $typeTrans){
            $pdo = Database::getPDO();
            $numeroBon = $numeroBon . "";
            $quantiteArticle = intval($quantiteArticle);
            if ($typeTrans == "entrée" OR $typeTrans == "sortie"){
                $quantiteArticle = $quantiteArticle + $quantite;
            }

            $req = "SELECT count(id) as nbTrans FROM transactions";
            $reponse = $pdo->query($req);
            $resultat = $reponse->fetch();
            $numTrans = intval($resultat["nbTrans"]) + 1;

            $req  = "INSERT INTO transactions (dateTrans, numeroTrans, idArticle, nomArticle, quantiteArticle, idBon, numeroBon, quantite, typeTrans) VALUES (CURDATE(), :numeroTrans, :idArticle, :nomArticle, :quantiteArticle, :idBon, :numeroBon, :quantite, :typeTrans)";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'numeroTrans' => $numTrans,
                'idArticle' => $idArticle,
                'nomArticle' => $nomArticle,
                'quantiteArticle' => $quantiteArticle,
                'idBon'     => $idBon,
                'numeroBon' => $numeroBon,
                'quantite'  => $quantite,
                'typeTrans' =>$typeTrans
            ));
            $req  = "SELECT SUM(quantite) as somme FROM transactions WHERE idArticle = ?";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($idArticle));
            $row = $reponse->fetch();
            $resultat = intval($row["somme"]);
            $req  = "UPDATE article SET quantite = :quantite WHERE id = :idArticle";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'quantite' => $resultat,
                'idArticle'     => $idArticle,
            ));
        }   

        public static function updateTransaction($idArticle, $nomArticle, $quantiteArticle, $idBon, $numeroBon, $quantite, $typeTrans){
            $pdo = Database::getPDO();
            $numeroBon = $numeroBon . "";
         

            $req = "SELECT numeroTrans FROM transactions WHERE idArticle = :idArticle AND idBon = :idBon AND typeTrans = :typeTrans";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'idArticle' => $idArticle,
                'idBon'     => $idBon,
                'typeTrans' =>$typeTrans
            ));
            $row = $reponse->fetch();
            $numTrans = $row['numeroTrans'];

            $req = "DELETE FROM transactions WHERE idArticle = :idArticle AND idBon = :idBon AND typeTrans = :typeTrans";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'idArticle' => $idArticle,
                'idBon'     => $idBon,
                'typeTrans' =>$typeTrans
            ));

            $req  = "INSERT INTO transactions (dateTrans, numeroTrans, idArticle, nomArticle, quantiteArticle, idBon, numeroBon, quantite, typeTrans) VALUES (CURDATE(), :numeroTrans, :idArticle, :nomArticle, :quantiteArticle, :idBon, :numeroBon, :quantite, :typeTrans)";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'numeroTrans' => $numTrans,
                'idArticle' => $idArticle,
                'nomArticle' => $nomArticle,
                'quantiteArticle' => $quantiteArticle,
                'idBon'     => $idBon,
                'numeroBon' => $numeroBon,
                'quantite'  => $quantite,
                'typeTrans' => $typeTrans
            ));

            $req = "SELECT id FROM transactions WHERE idArticle = :idArticle";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'idArticle' => $idArticle,
            ));
            $idsTrans = array();
            while ($row = $reponse->fetch()){
                $idTrans = $row['id'];
                $idsTrans[] = $idTrans;
            }

            for($i = 1; $i < count($idsTrans); $i++){
                $j = 0;
                if ($i != 1){
                    $j = $i - 1;
                }
                $currentIdTrans = $idsTrans[$i];
                $previousIdTrans = $idsTrans[$j];

                //var_dump($currentIdTrans);
                //var_dump($previousIdTrans);
                //exit;

                $req  = "SELECT quantite FROM transactions WHERE id = $currentIdTrans";
                $reponse = $pdo->query($req);
                $row = $reponse->fetch();
                $quantite = intval($row['quantite']);
                
                $req = "SELECT quantiteArticle FROM transactions WHERE id = $previousIdTrans";
                $reponse = $pdo->query($req);
                $row = $reponse->fetch();
                $previousQuantity = intval($row['quantiteArticle']);
                   
                $req  = "UPDATE transactions SET quantiteArticle = :quantite + :previousQuantity WHERE id = :id";
                $reponse = $pdo->prepare($req);
                $reponse->execute(array(
                    'quantite' => $quantite,
                    'previousQuantity'     => $previousQuantity,
                    'id' => $idsTrans[$i]
                ));
            }
              
            
            $req  = "SELECT SUM(quantite) as somme FROM transactions WHERE idArticle = ?";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($idArticle));
            $row = $reponse->fetch();
            $resultat = intval($row["somme"]);
            $req  = "UPDATE article SET quantite = :quantite WHERE id = :idArticle";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'quantite' => $resultat,
                'idArticle'     => $idArticle,
            ));
        }

        public static function getTransactions($idArticle){
            $pdo = Database::getPDO();
            $req = "SELECT id from transactions WHERE idArticle = ? ORDER BY numeroTrans DESC";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($idArticle));
            $transactions = array();
            while ($row = $reponse->fetch()){
                $transaction = new transaction($row['id']);
                $transactions[] = $transaction;
            }
            return $transactions;
        }
        /**
         * 
         */
       /* public static function updateQuantity($idArticle, $quantite, $typeTrans){
            
            $pdo = Database::getPDO();
            if($typeTrans =="entrée"){
                $req  = "UPDATE article SET quantite = quantite + :quantite WHERE id= :idArticle";
            }elseif($typeTrans == "sortie"){
                $req  = "UPDATE article SET  quantite = quantite - :quantite WHERE id= :idArticle";
            }
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'idArticle' => $idArticle,
                'quantite'  => $quantite
            ));
        } */

        /**
         * Annule la quantité précédente qui a été ajoutée ou supprimée par le bon qui est modifié
         */
        public static function removeArticleQuantity($dotationIdArticle, $referenceBon, $typeTrans){
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