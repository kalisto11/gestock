<?php
class Connections extends Controller{
  
    
    public function login(){
        if (!empty($_POST['username'])  && !empty($_POST['password'])){
            if ($_POST['username'] === 'Admin' && $_POST['password'] === 'Admin'){
                // On connecte l'utilisateur
                header('Location: /gestock');
                exit();
             }
        }
    }
    public function logout(){

    }
}