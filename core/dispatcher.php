<?php 
    class Dispatcher{
        public $request;
        public $content;

        /**
         *constructeur du controleur Dispatcher
        * @param 
         *@return  
         **/
        public function __construct(){
            $this->request = new Request();
            Router::parse($this->request->url, $this->request);
            $controller = $this->loadController();
            $controller->view();
        }

        public function loadController(){
            $name = $this->request->controller;
            if ($this->request->controller == ''){
                $name = 'Home';
            }else if (file_exists(CONTROLLER . $this->request->controller . '.php')){
                $name = ucfirst($this->request->controller);
            }
            else{
                $name = 'Erreur';
            }
            $controller = new $name();
            return $controller;
        }
    }