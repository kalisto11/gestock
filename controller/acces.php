<?php

require_once CONTROLLER . 'controller.php';
class Acces extends Controller{

    public function process(){
        if ($this->request->method == 'POST'){
            switch ($this->request->action){
                case 'ajouter':
                    if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                        $message = "L'utilisateur a été bien ajouté.";
                        $this->notification = new Notification("success", $message);
                    }

                break;

                case 'modifier':
                    if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                        $message = "L'utilisateur a été bien modifié.";
                        $this->notification = new Notification("success", $message);
                    }
                break;
            }
            $this->render($this->notification);
        }
        else if ($this->request->method == 'GET'){
            if ($this->request->action == "supprimer"){

            }
            $message = "L'utilisateur a été bien supprimé";
            $this->notification = new Notification("success", $message);
            $this->request->action = 'home';
            $this->render($this->notification);
        }
    }            
    public function render($notification = null){
        switch ($this->request->action){
            case 'ajouter':
                if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                    require_once VIEW . 'acces/ajoutuser.php';
                }
                
             break; 

            case 'modifier':
                if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                    require_once VIEW . 'acces/modifuser.php';
                }
            break;

            case 'home':
                require_once VIEW . 'home/home.php';
            break;

            default:
            require_once VIEW . 'home/home.php';
        }        
    }
}

