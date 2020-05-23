<?php
    class Pagination{
        public $pages;
        public $currentPage;
        public $perPage;
        public $offset;

        public function __construct($pages, $currentPage, $perPage, $offset){
            $this->pages = $pages;
            $this->currentPage = $currentPage;
            $this->perPage = $perPage;
            $this->offset = $offset;
        }
    }