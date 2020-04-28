<?php
    class Dotation {
            public $article;
            public $quantite;
          

            public function __construct($article = null, $quantite = null){
                $this->article = $article;
                $this->quantite = $quantite;
            }
    }