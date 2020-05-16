<?php
/**
 * Controller du grand livre
 */
require_once CONTROLLER . 'controller.php';

class GrandLivres extends Controller{

    public function process(){

              $this->render($this->notification);                 
    } // fin méthode process
    
    public function render($notification = null){
        switch ($this->request->action){
            case 'liste':
                $currentPage = (int)( $_GET['page'] ?? 1) ? :1;
                $perpage = 10;
                $count = Article::getNbrArticle();
                $pages = ceil($count/$perpage);
                if ($currentPage > $pages){
                    $message[] = "Cette page n'existe pas";
                    $this->notification = new Notification("success", $message);
                }
                $offset = $perpage * ($currentPage - 1);
                $articles = Article::getListTrans($perpage, $offset);
                require_once VIEW . 'journal/grand_livre.php';
            break;
            case 'consulter':
                $article = new Article($this->request->id);
                $transactions = Article::requireTransaction($this->request->id);
                
                require_once VIEW . 'journal/inventaire.php';
            break;
            default: // gestion des erreurs au cas ou la valeur de action 
                $currentController = new Erreur($this->request);
                $currentController->process();
        }
    } //fin méthode render
} // fin class