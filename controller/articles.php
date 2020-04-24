<?php

    /*
    * Controleur du module nom articles pour la gestion des noms des articles
    */
    
    require_once CONTROLLER . 'controller.php';
    class articles extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){
                if ($this->request->action === 'traitement-article'){
                    switch ($_POST['operation']){
                        case 'ajouter':
                            $this->traiterArticle($_POST['groupe'], $_POST['article']);
                        break;  

                        case 'modifier':          
                            $this->traiterArticle($_POST['groupe'], $_POST['article'], $_POST['idArticle']);
                        break;

                        default:
                        $this->notification = new Notification("danger", "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.");
                        $this->request->action = 'liste';
                        $this->render($this->notification);
                    }            
                }  
            }  // fin traitement de la méthode post
            elseif ($this->request->method === 'GET'){ //Si la requete vient d'un lien
                if ($this->request->action === 'supprimer'){
                    $idArticle = intval($this->request->id);
                    $article = new Article($idArticle);
                    $article->supprime(); 
                    $this->request->action = 'liste';
                    $this->notification = new Notification("success", "L'article a été supprimé avec succès.");
                }
                $this->render($this->notification); 
            } // fin traitement de la méthode GET
        } // fin méthode process
         
        public function render($notification = null){
             switch ($this->request->action){
                // inclure les vues ici selon la valeur de $view
                case 'liste':
                     $articles = Article::getList();
                     require_once VIEW . 'article/listarticles.php';
                break;
                case 'modifier':
                     $idArticle = intval($this->request->id);
                     $currentArticle = new Article($idArticle);
                     $articles = Article::getList();
                     require_once VIEW . 'article/listarticles.php';
                break;
                case 'ajouter':
                    require_once   VIEW . 'article/listarticles.php';
                 break;
                case 'supprimer':
                    require_once VIEW . 'article/listarticles.php';
                 break;

                default: // gestion des erreurs au cas ou la valeur de action n'est pas valide
                $currentController = new Erreur($this->request);
                $currentController->process();
                    
            }
        }

        public function traiterArticle($groupeArticle, $nomArticle, $idArticle = null){
            if (empty($nomArticle)){
                $this->notification = new Notification("danger", "Le nom de l'article ne doit pas etre vide.");
                if ($idArticle == null){
                    $this->request->action = 'liste';
                }
                else{
                    $this->request->action = 'modifier';
                    $this->request->id = $idArticle;
                }
            }
            else{
                if ($idArticle == null){ // cas ou on ajoute un nouveau article
                    $articles = Article::getList();
                    $is_exist = false;
                    foreach ($articles as $article) :
                        if ($article->nom == $nomArticle){
                            $is_exist = true;
                        }   
                    endforeach;
                        if ($is_exist == true){
                            $this->notification = new Notification("danger", "Le nom de l'article existe déja. Veuillez choisir un autre nom.");
                        }
                        else{
                            $article = new Article();
                            $article->nom = strip_tags($nomArticle);   
                            $article->groupe = strip_tags($groupeArticle);                                            
                            $article->ajoutArticle();
                            $this->notification = new Notification("success", "L'article a été ajouté avec succès.");
                        }   
                    $this->request->action = 'liste';
                }
                else{ // idArticle n'est pas nul, donc on veut modifier un article déja existant
                    $article = new Article();
                    $article->id = (int) $idArticle;
                    $article->nom = strip_tags($nomArticle);
                    $article->groupe = strip_tags($groupeArticle);
                    $article->modif();
                    $this->notification = new Notification("success", "L'article a été modifié avec succès.");
                    $this->request->action = 'liste';
                }
            }
            $this->render($this->notification);
        } //fin méthode traiterArticle
    } // fin class