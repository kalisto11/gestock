<?php

class GrandLivre{
    public $id;
    public $nomArticle;
    public $refbonEntree;
    public $refbonSortie;
    public $stock;
    public $restant;

    public function __construct($id = null) {//constructeur des transactions
        if ($id != null){
            $this->id = $id;
            $pdo = Database::getPDO();
            $req = "SELECT id, nomArticle, refbonEntree,  refbonSortie, stock, restant  FROM transactions WHERE id = ?";
            $reponse = $pdo->prepare($req);
            $reponse->execute(array($id));
            $transaction        = $reponse->fetch();
            $this->id          = $transaction['id'];
            $this->nomArticle   = $transaction['nomArticle'];
            $this->refbonEntree        = $transaction['refbonEntree'];
            $this->refbonSortie = $transaction['refbonSortie'];
            $this->stock = $transaction['stock'];
            $this->restant = $transaction['restant'];
           
        }	
        else{
            $this->id           = null;
            $this->nomArticle   = null;
            $this->refbonEntree = null;
            $this->refbonSortie = null;
            $this->stock        = null;
            $this->restant      = null;
            
        }
    }
    public function save() {// Méthode permettant d'insérer un bon de sortie
        $pdo = Database::getPDO();
        $req = 'INSERT INTO transactions (nomArticle, refbonEntree, refbonSortie, stock, restant) VALUES (:nomArticle, :refbonEntree, :refbonSortie, :stock, :restant)';
        $reponse = $pdo->prepare($req);
        $reponse->execute(array(
            'nomArticle'   => $this->nomArticle,
            'refbonEntree' => $this->refbonEntree,
            'refbonSortie' => $this->refbonSortie,
            'stock' => $this->stock,
            'restant' => $this->restant  
        ));
    } 
    public static function getList($perpage, $offset) {
        $pdo = Database::getPDO();
        $req = "SELECT id from transactions ORDER BY  DESC LIMIT $perpage OFFSET $offset";
        $reponse = $pdo->query($req);
        $bonssorties = array();
        while ($row = $reponse->fetch()){
            $transaction = new BonSortie($row['id']);
            $bonssorties[] = $transaction;
        }
        return $bonssorties;
        
    }

    public static function getNbrTransaction(){
        $pdo = Database::getPDO();
        $req = "SELECT COUNT(id) FROM transactions";
        $reponse = $pdo->query($req);
        $count = (int) $reponse->fetch(PDO::FETCH_NUM)[0];
         return  $count;
    }
    
}// fin class
