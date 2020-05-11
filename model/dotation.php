<?php
    class Dotation {
            public $article;
            public $quantite;
            public $prix;
            public $total;
          

            public function __construct($article = null, $quantite = 0, $prix = 0, $total = 0){
                $this->article = $article;
                $this->quantite = $quantite;
                $this->prix = $prix;
                $this->total = $total;
            }
    }