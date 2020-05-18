<?php

require_once CONTROLLER . 'controller.php';

class Acces extends Controller{

    public function process(){
        if ($this->request->method == 'POST'){
            if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                switch ($this->request->action){
                    case 'changerpassword':
                        if (isset($_SESSION['token'])){
                            if (!empty($_POST['password1']) AND $_POST['password1'] === $_POST['password2']){
                                $user = new User($_SESSION['token']);
                                $user->pasword = sha1($_POST['password1']);
                                $user->changePassword = true;
                                $user->update();
                                $_SESSION['user']['id'] = $user->id; 
                                $_SESSION['user']['username'] = $user->username; 
                                $_SESSION['user']['niveau'] = $user->niveau;
                                $_SESSION['user']['prenom'] = $user->prenom;
                                $_SESSION['user']['nom'] = $user->nom;
                                $_SESSION['user']['changePassword'] = $user->changePassword;
                                unset($_SESSION['token']);
                                $message = "Bienvenue sur l'application de gestion du matériel de l'IA de Kaffrine ! Vous êtes maintenant connecté.";
                                $_SESSION['notification'] = [
                                    'type'=> 'success',
                                    'message'=> $message
                                    ];
                                $this->request->action = 'home';
                            }
                            else{
                                $_SESSION['id'] = $_SESSION['token'];
                                if (empty($_POST['password1']) AND empty($_POST['password2'])){
                                    $message = "Le mot de passe ne doit pas être vide. Veuillez recommencer.";
                                }
                                else{
                                    $message = "Les deux mots de passe saisis ne sont pas identiques. Veuillez recommencer.";
                                }
                                $_SESSION['notification'] = [
                                'type'=> 'danger',
                                'message'=> $message
                                ];
                                $this->request->action = 'home';
                            } 
                        }
                    break;

                    case 'ajouter':
                        if (empty($_POST['prenom']) OR empty($_POST['nom']) OR empty($_POST['username']) OR empty($_POST['password1']) OR empty($_POST['password2'])){
                            $type = "danger";
                            $message[] = "Veuillez remplir tous les champs.";
                            $this->notification = new Notification($type, $message);
                            $this->request->action = "ajouter";
                        }
                        else if($_POST['password1'] !== $_POST['password2']){
                            $type = "danger";
                            $message[] = "Les mots de passe ne sont pas identiques.";
                            $this->notification = new Notification($type, $message);
                            $this->request->action = "ajouter";
                        }
                        else{
                            $user = new User();
                            $user->prenom =  mb_convert_case(strip_tags($_POST['prenom']), MB_CASE_UPPER);
                            $user->nom = mb_convert_case(strip_tags($_POST['nom']), MB_CASE_UPPER);
                            $user->username = strip_tags($_POST['username']);
                            $user->pasword = sha1($_POST['password1']);
                            $user->niveau = intval($_POST['niveau']);
                            $user->save();
                            $type = "success";
                            $message[] = "L'utilisateur a été bien ajouté.";
                            $this->notification = new Notification($type, $message);
                            $this->request->action = "home";
                        }  
                    break;

                    case 'modifier': 
                        $user = new User($_POST['idUser']);
                        $error = false;

                        if (empty($_POST['prenom']) OR empty($_POST['prenom']) OR empty($_POST['username'])){
                            $error = true;
                            $type = "danger";
                            $message[] = "Veuillez remplir tous les champs.";
                        }

                        if ($_POST['reset'] == "on"){
                            if (empty($_POST['password1']) OR empty($_POST['password2'])){
                                $error = true;
                                $type = "danger";
                                $message[] = "Les mots de passe ne doivent pas être vides.";
                            }
                            if($_POST['password1'] !== $_POST['password2']){
                                $error = true;
                                $type = "danger";
                                $message[] = "Les mots de passe ne sont pas identiques.";
                            }
                            else{
                                $user->pasword = sha1($_POST['password1']);
                                $user->changePassword = 0;
                            }
                        }

                        if ($error == true){
                            $this->notification = new Notification($type, $message);
                            $this->request->action = "modifier";
                            $this->request->id = $user->id;
                        }
                        else{
                            $user->prenom =  mb_convert_case(strip_tags($_POST['prenom']), MB_CASE_UPPER);
                            $user->nom = mb_convert_case(strip_tags($_POST['nom']), MB_CASE_UPPER);
                            $user->username = strip_tags($_POST['username']);
                            $user->niveau = intval($_POST['niveau']);
                            $user->update();
                            $type = "success";
                            $message[] = "L'utilisateur a été bien modifié.";
                            $this->notification = new Notification($type, $message);
                            $this->request->action = "home";
                        }    
                    break;
                } // fin switch
                $this->render($this->notification);
            } // fin verification droit d'accès
        } // fin traitement post
        else if ($this->request->method == 'GET'){
            if ($this->request->action == "supprimer"){
                // operation de suppression
                if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                    $user = new User($this->request->id);
                    if ($_SESSION['user']['niveau'] != $user->niveau){
                        $user->delete();
                        $message[] = "L'utilisateur a été bien supprimé";
                        $this->notification = new Notification("success", $message);
                    }
                    else{
                        $message[] = "Vous ne pouvez pas supprimer votre propre compte.";
                        $this->notification = new Notification("danger", $message);
                    }   
                }
                $this->request->action = 'home';
                $idUser = intval($this->request->id);
                $user  = new User($idUser);
                $user->delete();
                $message[] = "L'utilisateur a été bien supprimé";
                $this->notification = new Notification("success", $message);
            }
            $this->render($this->notification);
        } // fin traitement GET
    } // fin méthode process   

    public function render($notification = null){
        switch ($this->request->action){
            case 'ajouter':
                if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                    require_once VIEW . 'acces/ajoutuser.php';
                }
             break; 

            case 'modifier':
                if ($_SESSION['user']['niveau'] >= ADMINISTRATEUR){
                    $user = new User($this->request->id);
                    require_once VIEW . 'acces/modifuser.php';
                }
            break;

            case 'home':
                header ('location: /gestock/'); 
            break;
        }        
    }
}