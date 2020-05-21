<?php

     /*
    * Super classe Controller dont hérite tous les autres controleurs
    */

    class Controller{
        public $request;
        public $notification;
        public $pagination;

        public function __construct($request){
            $this->request = $request;
            $this->message = array();
        }

        public function pagination(){
            $currentPage = (int)($_GET['page'] ?? 1) ? :1;
            $perpage = 10;
        }
        
    }