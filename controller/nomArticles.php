<?php

    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class NomArticles extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){
                if ($this->request->action === 'traitement-article'){
                    switch ($_POST['operation']){
                        case 'ajouter':
                            if(!empty($_POST['nomArticle'])){
                                $nomarticle = new Article();
                                $nomarticle->nom = $_POST['nomArticle'];                                            
                                $nomarticle->ajoutArticle();
                                $this->message['type'] = 'success';
                                $this->message['contenu'] = 'L\'article a été ajouté avec succès.';
                            }
                            else{
                                $this->message['type'] = 'danger';
                                $this->message['contenu'] = "Le nom de l\'article ne doit pas etre vide.";
                            }       
                            $this->request->action = 'liste';
                            $this->render($this->message);
                        break;  

                        case 'modifier':
                                
                            $nomarticle = new Article();
                            $nomarticle->nom = $_POST['nomArticle'];
                            $nomarticle->id = $_POST['idArticle'];
                            if(!empty($_POST['nomArticle'])){
                            $nomarticle->modif();
                            $this->message['type'] = 'success';
                            $this->message['contenu'] = 'L\'article a été modifié avec succès.';
                            $this->request->action = 'liste';
                            }
                            else{
                            $this->message['type'] = 'danger';
                            $this->message['contenu'] = 'Le nom de l\'article ne doit pas etre vide.';
                            $this->request->action = 'modifier';
                            $this->request->id = $nomarticle->id;
                            }
                            $this->render($this->message);
                        break;

                        default:
                        $this->message['type'] = 'danger';
                        $this->message['contenu'] = 'Une erreur s\'est produite pendant le traitement des données. Veuillez rééssayer svp.';
                        $this->request->action = 'liste';
                        $this->render($this->message);
                    }            
                }  
            }  // fin traitement de la méthode post
            elseif ($this->request->method === 'GET'){ //Si la requete vient d'un lien
                if ($this->request->action === 'supprimer'){
                    $idArticle = intval($this->request->id);
                    $nomarticle = new Article($idArticle);
                    $nomarticle->supprime(); 
                    $this->request->action = 'liste';
                    $this->message['type'] = 'success';
                    $this->message['contenu'] = 'L\'article a été supprimé avec succès.';
                }
                $this->render($this->message); 
            } // fin traitement de la méthode GET
        } // fin méthode process
         
        public function render($message = null){
             switch ($this->request->action){
                // inclure les vues ici selon la valeur de $view
                case 'liste':
                     $nomarticles = Article::listArticles();
                     require_once VIEW . 'nomarticle/listnomArticles.php';
                break;
                case 'modifier':
                     $idArticle = intval($this->request->id);
                     $currentArticle = new Article($idArticle);
                     $nomarticles = Article::listArticles();
                     require_once VIEW . 'nomarticle/listnomArticles.php';
                break;
                case 'ajouter':
                    require_once   VIEW . 'nomarticle/listnomArticles.php';
                 break;
                case 'supprimer':
                    require_once VIEW . 'nomarticle/listnomArticles.php';
                 break;

                default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                $currentController = new Erreur($this->request);
                $currentController->process();
                    
            }
        }
    } 