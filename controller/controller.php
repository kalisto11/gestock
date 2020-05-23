<?php

     /*
    * Super classe Controller dont hérite tous les autres controleurs
    */

    class Controller{
        public $request;
        public $notification;

        public function __construct($request){
            $this->request = $request;
            $this->message = array();
        }

        public function pagination($count){
            $currentPage = (int)($_GET['page'] ?? 1) ? :1;
            $perPage = 10;
            $pages = ceil($count / $perPage);
            if ($currentPage > $pages){
                return false;
            }
            $offset = $perPage * ($currentPage - 1);
            $pagination = new Pagination($pages, $currentPage, $perPage, $offset);
            return $pagination;
        }
    }