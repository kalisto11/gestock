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

        /**
         * Retourne les opérations effectuées sur l'article dont l'id est fourni en paramètre par lot
         * dont le nombre est défini par $perpage
         * @param Int $idArticle : id de l'article dont on veut récupérer les opérations
         * @param Int $perPage : le nombre d'opérations par lot
         * @param Int $offset : valeur de départ de chaque lot
         * @return Transaction[] $transactions : liste des transactions
         */
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

        /**
         * Retourne la liste de toutes les opérations par lot dont le nombre est défini par $perPage
         * @param Int $perPage : le nombre d'opérations par lot
         * @param Int $offset : valeur de départ de chaque lot
         * @return Transaction[] $transactions : liste des transactions
         */
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

        /**
         * Retourne le nombre d'opérations effectuées aujourd'hui
         * @return Int $count : nombre d'opérations
         */
        public static function getNbrTransJournal(){
            $pdo = Database::getPDO();
            $req = "SELECT COUNT(id) FROM transactions WHERE dateTrans = CURDATE()";
            $reponse = $pdo->query($req);
            $count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
                return  $count;
        }

        /**
         * insère une opération dans la base de données
         * @param Int $idArticle : id de l'article dont on veut insérer une opération
         * @param String $nomArticle : nom de l'article dont on veut insérer une opération
         * @param Int $quantiteArticle : quantité (somme totale) de l'article dans la base
         * @param Int $idBon : id du bon qui effectue l'opération sur l'article
         * @param Int $numeroBon : numéro du bon qui effectue l'opération  
         * @param Int $quantite : nouvelle quantité de l'article à enregistrer
         * @param String $typeTrans : type de l'opération (entrée ou sortie)
         */
        public static function insertTransaction($idArticle, $nomArticle, $quantiteArticle, $idBon, $numeroBon, $quantite, $typeTrans){
            $pdo = Database::getPDO();
            $numeroBon = $numeroBon . ""; // parsage en string car le chanmp doit aussi stocker le nom du modificateur, s'il y a une modification de la quantité de l'aticle directement par l'utilisateur
            $quantiteArticle = intval($quantiteArticle);
            if ($typeTrans == "entrée"){
                $quantiteArticle = $quantiteArticle + $quantite;
            }
            elseif($typeTrans == "sortie"){
                $quantiteArticle = $quantiteArticle - $quantite;
            }

            // récupérer le dernier numéro des opérations pour insérer un nouveau pour l'opération en cours de création
            $req = "SELECT count(id) as nbTrans FROM transactions";
            $reponse = $pdo->query($req);
            $resultat = $reponse->fetch();
            $numTrans = intval($resultat["nbTrans"]) + 1;

            // Si l'opération est effectuée par un bon de sortie, la quantité de l'article dans le bon est déduite de la quantité totale de l'article
            if ($typeTrans == "sortie"){
                $quantite = - $quantite;
            }

            // Insertion de l'opération dans la base
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

            // mise à jour de la quantité totale de l'article dans la base
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
        } // fin méthode insertTrasaction
        
        /**
         * Met à jour une opération existant
         * @param Int $idArticle : id de l'article dont on veut insérer une opération
         * @param String $nomArticle : nom de l'article dont on veut insérer une opération
         * @param Int $quantiteArticle : quantité (somme totale) de l'article dans la base
         * @param Int $idBon : id du bon qui effectue l'opération sur l'article
         * @param Int $numeroBon : numéro du bon qui effectue l'opération  
         * @param Int $quantite : nouvelle quantité de l'article à enregistrer
         * @param String $typeTrans : type de l'opération (entrée ou sortie)
         */
        public static function updateTransaction($idArticle, $nomArticle, $quantiteArticle, $idBon, $numeroBon, $quantite, $typeTrans){
            $pdo = Database::getPDO();
            $numeroBon = $numeroBon . ""; // parsage en string car le chanmp doit aussi stocker le nom du modificateur, s'il y a une modification de la quantité de l'aticle directement par l'utilisateur

            // Récupration du numéro de l'opération à modifier
            $req = "SELECT numeroTrans FROM transactions WHERE idArticle = :idArticle AND idBon = :idBon AND typeTrans = :typeTrans";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'idArticle' => $idArticle,
                'idBon'     => $idBon,
                'typeTrans' =>$typeTrans
            ));
            $row = $reponse->fetch();
            $numTrans = intval($row['numeroTrans']);

            if ($numTrans != null){
                // suppression de l'ancienne opération de la base
                $req = "DELETE FROM transactions WHERE numeroTrans = :numeroTrans";
                $reponse = $pdo->prepare($req);
                $reponse->execute(array(
                    'numeroTrans' => $numTrans
                ));
            }
            else{
                // récupérer le dernier numéro des opérations pour insérer un nouveau pour l'opération en cours de création
                $req = "SELECT count(id) as nbTrans FROM transactions";
                $reponse = $pdo->query($req);
                $resultat = $reponse->fetch();
                $numTrans = intval($resultat["nbTrans"]) + 1;
            }

             // si le bon qui modifie l'opération est un bon de sortie on doit déduire la quantité de la somme totale de l'article
            if ($typeTrans == "sortie"){
                $quantite = - $quantite;
            }

            try{
                  // Insertion à nouveau de l'opération avec les nouvelles valeurs
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
    
            }
            catch (PDOException $e) {
                echo $e;
            }
           
            // Mise à jour de la quantité de l'article pour chaque opération
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

            // Mise à jour de la somme totale de l'article en faisant la somme de toutes les opérations ayant comme $idArticle l'id de l'article concerné
            $req  = "SELECT SUM(quantite) as somme FROM transactions WHERE idArticle = ?";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($idArticle));
            $row = $reponse->fetch();
            $somme = intval($row["somme"]);
            $req  = "UPDATE article SET quantite = :quantite WHERE id = :idArticle";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array(
                'quantite' => $somme,
                'idArticle'     => $idArticle,
            ));
        } // fin méthode updateTransaction

        /**
         * retourne le nombre d'opérations effectuées sur l'article dont l'id est fourni en paramètre
         * @param int $idArticle : l'id de l'article dont on veut connaitre le nombre d'opérations
         * @return Int $count : nombre d'opérations sur l'article
         */
        public static function getNbrTransactionByArticle($idArticle){
			$pdo = Database::getPDO();
			$req = "SELECT COUNT(id) FROM transactions WHERE idArticle = ?";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($idArticle));
			$count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
			return  $count;
        }
    } // fin class Transaction
