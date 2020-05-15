<?php

require_once CONTROLLER . 'controller.php';
class Acces extends Controller{

    public function process(){
        if ($this->request->method === 'POST'){
            
        }else if ($this->request->method === 'GET'){
             
        }
    }            
    public function render(){
        switch ($this->request->controller){
            case 'home': 
                      
            break;        
            case 'modifier':
               
            break;
            case 'supprimer':
              
             break;
        }        
    }
}

