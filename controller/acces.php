<?php

require_once CONTROLLER . 'controller.php';

class Acces extends Controller{

    public function process(){
        if ($this->request->method == 'POST'){
            switch ($this->request->action){
                case 'changerpassword':
                    if (isset($_SESSION['token'])){
                        if ($_POST['password1'] === $_POST['password2']){
                            $user = new User($_SESSION['token']);
                            $user->pasword = sha1($_POST['password1']);
                            $user->changePassword = true;
                            $user->update();
                            $_SESSION['user']['id'] = $user->id; 
                            $_SESSION['user']['username'] = $user->username; 
                            $_SESSION['user']['niveau'] = $user->niveau;
                            $_SESSION['user']['nomComplet'] = $user->nomComplet;
                            $_SESSION['user']['changePassword'] = $user->changePassword;
                            unset($_SESSION['token']);
                            $message[] = "Bienvenue sur l'application de gestion du matériel de l'IA de Kaffrine ! Vous etes maintenant connecté.";
                            $this->notification = new notification("success", $message);
                            $this->request->action = 'home';
                        }
                        else{
                            $_SESSION['id'] = $_SESSION['token'];
                            $message = "Les deux mots de passe saisis ne sont pas identiques. Veuillez recommencer.";
                            $_SESSION['notification'] = null;
                            $_SESSION['notification'] = [
                            'type'=> 'danger',
                            'message'=> $message
                            ];
                        } 
                    }
                break;

                case 'ajouter':
                    if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                        if (empty($_POST['nomComplet']) OR empty($_POST['username']) OR empty($_POST['password1']) OR empty($_POST['password2'])){
                            $message[] = "Veuillez remplir tous les champs.";
                            $this->notification = new Notification("success", $message);
                        }
                        else{
                            if ($_POST['password1'] !== $_POST['password2']){
                                
                            }
                        }
                        $message[] = "L'utilisateur a été bien ajouté.";
                        $this->notification = new Notification("success", $message);
                    }

                break;

                case 'modifier':
                    if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                        $message[] = "L'utilisateur a été bien modifié.";
                       $this->notification = new Notification("success", $message);
                    }
                break;
            }
            $this->render($this->notification);
        }
        else if ($this->request->method == 'GET'){
            if ($this->request->action == "supprimer"){
                $this->request->action = 'home';
                // operation de suppression ici
                $message[] = "L'utilisateur a été bien supprimé";
                $this->notification = new Notification("success", $message);
            }
           
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
                header ('location: /gestock/'); 
            break;

            default:
            header ('location: /gestock/'); 
        }        
    }
}

