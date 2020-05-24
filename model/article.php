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
        public static function getListAll(){
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
        public static function getList($perpage, $offset){
            $pdo = Database::getPDO();
            $req = "SELECT id from article ORDER BY nom LIMIT $perpage OFFSET $offset";
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

        public static function getEntreeSortiesJournal(){
            $pdo = Database::getPDO();
            $req = "SELECT DISTINCT(idArticle) FROM transactions WHERE dateTrans = CURDATE()";
            $reponse = $pdo->query($req);
            $transactions = array();
            $rows = $reponse->fetchAll();
          

            $idArticles = [];
            foreach ($rows as $row){
                $idArticle = $row['idArticle'];
                $idArticles[] = $idArticle;
            }

            $entreesSorties = [];
            foreach ($idArticles as $idArticle){
                $art = new Article($idArticle);
                $article['id'] = $art->id;
                $article['nom'] = $art->nom;
                $article['sommeEntree'] = self::getSumArticle($idArticle, "entrée");
                $article['sommeSortie'] = self::getSumArticle($idArticle, "sortie");
                $article['sommeCreation'] = self::getSumArticle($idArticle, "création");
                $article['sommeModification'] = self::getSumArticle($idArticle, "modification");
                $entreesSorties[] = $article;
            }
            return $entreesSorties;
        }



        public static function getSumArticle($idArticle, $typeTrans){
            $pdo = Database::getPDO();
            $req  = "SELECT SUM(quantite) as somme FROM transactions WHERE idArticle = :idArticle AND typeTrans = :typeTrans GROUP BY idArticle";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'idArticle' => $idArticle,
                'typeTrans' => $typeTrans
            ));
            $row = $reponse->fetch();
            $somme = intval($row["somme"]);
            return $somme;
        }

    }//fin de la classe Article