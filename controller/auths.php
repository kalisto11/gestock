<?php

require_once CONTROLLER . 'controller.php';
class Auths extends Controller{

    public function process(){
        if ($this->request->method === 'POST'){
            $users = User::getList();
            $connexion = false;
            foreach ($users as $user){
                if ($_POST['username'] == $user->username  && sha1($_POST['password']) == $user->pasword){ 
                    $_SESSION['user']['id'] = $user->id; 
                    $_SESSION['user']['username'] = $user->username; 
                    $_SESSION['user']['niveau'] = $user->niveau;
                    $_SESSION['user']['prenom'] = $user->prenom;
                    $_SESSION['user']['nom'] = $user->nom;
                    $_SESSION['user']['changePassword'] = $user->changePassword;
                    echo $user->prenom;
                    exit;
                    $connexion = true;
                    break; 
                }
                
            }

            if ($connexion == true){
                if ($user->changePassword == 0){
                    $_SESSION['id'] = $user->id;
                    $this->request->controller = 'acces';
                }
                else{
                    $this->request->controller = 'home';
                }
            }
            else{
                var_dump("test");
                exit;
                $message = "Les identifiants sont incorrects.";
                $_SESSION['notification'] = [
                'type'=> 'danger',
                'message'=> $message
                ];
                $this->request->controller = 'login';
            }
            
          
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

             case 'acces': 
                header ('location: /gestock/');     
            break; 
        }        
    }
}

