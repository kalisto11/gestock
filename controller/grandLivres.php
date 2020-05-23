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
                $count = Article::getNbrArticle();
                if ($count > 0){
                    $pagination = self::Pagination($count);
                    if (!$pagination){
                        $message[] = "Cette page n'existe pas";
                        $this->notification = new Notification("danger", $message);
                    }
                    else{
                        $articles = Article::getListTrans($pagination->perPage, $pagination->offset);
                    }
                }
                require_once VIEW . 'journal/grand_livre.php';
            break;
            case 'consulter':
                $article = new Article($this->request->id);
                $transactions = Article::getTransactions($this->request->id);
                
                require_once VIEW . 'journal/inventaire.php';
            break;
            default: // gestion des erreurs au cas ou la valeur de action 
                $currentController = new Erreur($this->request);
                $currentController->process();
        }
    } //fin méthode render
} // fin class
