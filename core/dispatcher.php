<?php 

    /*
    * le dispatcher permet d'analyser la requete de l'utilisateur et fait appel au controleur
    * qui correspond à la requete
    */
    class Dispatcher{
        public $request;

        /**
         *constructeur du controleur Dispatcher
        * instancie le dispatcher
         **/
        public function __construct(){
            $this->request = new Request();
            Router::parse($this->request->url, $this->request);
            $currentController = $this->loadController();
            $currentController->process();
        }

        /**
         * permet de charger le bon controleur dynamiquement grace à l'autoloader
         * @return  Controller instance du controleur appelé 
         **/
        public function loadController(){
            $nom = $this->request->controller;
            if ($this->request->controller == ''){
                $nom = 'Home';
            }else if (file_exists(CONTROLLER . $this->request->controller . '.php')){
                $nom = ucfirst($this->request->controller);
            }
            else{
                $nom = 'Erreur';
            }
            $controller = new $nom($this->request);
            return $controller;
        }
    }