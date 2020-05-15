<?php

require_once CONTROLLER . 'controller.php';
class Auths extends Controller{

    public function process(){
        if ($this->request->method === 'POST'){
            $users = User::getList();
            foreach ($users as $user){
                if ($_POST['username'] ==  $user->username  && sha1($_POST['pasword']) == $user->pasword ){
                    if ($user->changePassword == false){
                        $_SESSION['id'] = $user->id;
                    }
                    else{
                        $_SESSION['user']['id'] = $user->id; 
                        $_SESSION['user']['username'] = $user->username; 
                        $_SESSION['user']['niveau'] = $user->niveau;
                        $_SESSION['user']['nomComplet'] = $user->nomComplet;
                        $_SESSION['user']['changePassword'] = $user->changePassword;
                    }
                    $this->request->controller = 'home';
                    $this->render();
                    $connexion = true;
                    break;
                }
                else{
                    $connexion = false;
                }     
            }
            
            if ($connexion == false){
                $message = "Les identifiants sont incorrects.";
                $_SESSION['notification'] = [
                'type'=> 'danger',
                'message'=> $message
                ];
            }
            
            $this->request->controller = 'login';
            $this->render($_SESSION['notification']);

        }else if ($this->request->method === 'GET'){
            session_destroy();
            $this->request->controller = 'deconnexion';
            $this->render();   
        }
    }            
    public function render(){
        switch ($this->request->controller){
            case 'home': 
                header ('location: /gestock/home/');         
            break;        
            case 'login':
               require_once VIEW . 'authentification/login.php';
            break;
            case 'deconnexion':
                header ('location: /gestock/'); 
             break;

             case 'acess': 
                header ('location: /gestock/');     
            break; 
        }        
    }
}

