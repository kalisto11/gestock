<?php

require_once CONTROLLER . 'controller.php';
class Auths extends Controller{

    public function process(){
        if ($this->request->method === 'POST'){
            $users = Users::getList();
            foreach ($users as $user){
                if ($_POST['username'] ==  $user->username  && sha1($_POST['pasword']) == $user->pasword ){
                    $_SESSION['user']['username'] = $user->username; 
                    $_SESSION['user']['niveau'] = $user->niveau;
                    $_SESSION['user']['nomComplet'] = $user->nomComplet;
                    unset($_SESSION['notification']);
                    $this->request->controller = 'home';
                    $this->render();
                }
                else{
                    $message = "Les identifiant sont incorrects";
                    $_SESSION['notification'] = [
                        'type'=> 'danger',
                        'message'=> $message
                    ];
                    $this->request->controller = 'login';
                    $this->render($_SESSION['notification']);   
                    
                }
            }
        }else if ($this->request->method === 'GET'){
            unset($_SESSION['user']);
            $this->request->controller = 'login';
            $this->render();   
        }
    }            
    public function render(){
        switch ($this->request->controller){
            case 'home': 
                header ('location: /gestock/home/');         
            break;        
            case 'login':
               header ('location: /gestock/');    
            break;
        }        
    }
}

