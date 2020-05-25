<?php
    class Pagination{
        public $pages;
        public $currentPage;
        public $perPage;
        public $offset;

        /**
         * construit un objet de type pagination pour gérer l'afficage des pages des vues
         * @param Int $count : nombre d'objets issus de la base qui doivent etre affichés
         * @return Pagination $pagination : objet de type pagination
         */
        public function __construct($count){
            $currentPage = (int)($_GET['page'] ?? 1) ? :1;
            $perPage = 2;
            $pages = ceil($count / $perPage);
            if ($currentPage > $pages){
                return false;
            }
            $offset = $perPage * ($currentPage - 1);

            $this->pages = $pages;
            $this->currentPage = $currentPage;
            $this->perPage = $perPage;
            $this->offset = $offset;
        }
    }