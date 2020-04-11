<?php

     /*
    * Super classe Controller dont hérite tous les autres controleurs
    */

    class Controller{
        public $request;
        public $message;

        public function __construct($request){
            $this->request = $request;
            $this->message = array();
        }
        
    }