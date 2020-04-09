<?php 

    /*
    * le dispatcher permet d'analyser la requete de l'utilisateur et fait appel au controleur
    * qui correspond à la requete
    */
    class Dispatcher{
        public $request;

        /**
        *constructeur du controleur Dispatcher
        * instancie le dispatcher et 
        * appelle le bon controller selon la valeur de $request->loadController
        * instancie le controleur et execute la méthode process() de l'instance.
         **/
        public function __construct(){k
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