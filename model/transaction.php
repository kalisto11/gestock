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
    }