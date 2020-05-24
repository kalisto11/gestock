<?php

    /**
     * Modele transaction
     */

    class Transaction {
        public $id;
        public $dateTrans;
        public $idArticle;
        public $nomArticle;
        public $quantiteArticle;
        public $idBon;
        public $numeroBon;
        public $quantite;
        public $typeTrans;
        
        public function __construct($id){
            if ($id != null){
                $this->id = $id;
                $pdo = Database::getPDO();
                $req = "SELECT id, DATE_FORMAT(dateTrans, '%d/%m/%Y') AS dateTrans, idArticle, nomArticle, quantiteArticle, idBon, numeroBon, quantite, typeTrans from transactions WHERE id = ?";
                $reponse = $pdo->prepare($req);
                $reponse -> execute(array($id));
                $transaction = $reponse->fetch();
                $this->id = $transaction['id'];
                $this->dateTrans = $transaction['dateTrans'];
                $this->idArticle = $transaction['idArticle'];
                $this->nomArticle = $transaction['nomArticle'];
                $this->quantiteArticle = $transaction['quantiteArticle'];
                $this->idBon = $transaction['idBon'];
                $this->numeroBon = $transaction['numeroBon'];
                $this->quantite = $transaction['quantite'];
                $this->typeTrans = $transaction['typeTrans'];
            }
        }

        public static function getListByArticle($idArticle, $perPage, $offset){
            $pdo = Database::getPDO();
           
            //$req = "SELECT id from transactions WHERE idArticle = :idArticle ORDER BY numeroTrans DESC LIMIT :perPage OFFSET :offset";
            $req = "SELECT id FROM transactions WHERE idArticle = $idArticle ORDER BY numeroTrans DESC LIMIT $perPage OFFSET $offset";
            $reponse = $pdo->query($req);
            $transactions = array();
            while ($row = $reponse->fetch()){
                $transaction = new transaction($row['id']);
                $transactions[] = $transaction;
            }
            return $transactions;
        }

        public static function getList($perpage, $offset){
            $pdo = Database::getPDO();
            $req = "SELECT * from transactions WHERE dateTrans = CURDATE() ORDER BY id DESC LIMIT $perpage OFFSET $offset";
            $reponse = $pdo->query($req);
            $articles = array();
            $transactions = [];
            while ($row = $reponse->fetch()){
                $transaction = new Transaction($row['id']);
                $transactions[] = $transaction;
            }  
            return $transactions;
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
            if ($typeTrans == "entrée"){
                $quantiteArticle = $quantiteArticle + $quantite;
            }
            elseif($typeTrans == "sortie"){
                $quantiteArticle = $quantiteArticle - $quantite;
            }

            $req = "SELECT count(id) as nbTrans FROM transactions";
            $reponse = $pdo->query($req);
            $resultat = $reponse->fetch();
            $numTrans = intval($resultat["nbTrans"]) + 1;

            if ($typeTrans == "sortie"){
                $quantite = - $quantite;
            }

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

            
            if ($typeTrans == "sortie"){
                $quantite = - $quantite;
            }
            
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

        public static function getNbrTransactionByArticle($idArticle){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM transactions WHERE idArticle = ?";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($idArticle));
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			return  $count;
		}

    }