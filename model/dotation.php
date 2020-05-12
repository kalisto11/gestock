<?php
    class Dotation {
            public $idArticle;
            public $nomArticle;
            public $quantite;
            public $prix;
            public $total;
          
            public function __construct($idArticle = null, $nomArticle = null, $quantite = 0, $prix = 0){
                $this->idArticle = $idArticle;
                $this->nomArticle = $nomArticle;
                $this->quantite = $quantite;
                $this->prix = $prix;
                $this->total = $quantite * $prix;
            }
    }