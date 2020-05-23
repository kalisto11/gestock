<?php
    /*
    * Controleur du module livre journal
    */

    require_once CONTROLLER . 'controller.php';
    class livreJournals extends Controller{
        public function process(){
            $this->request->action = 'liste';
            $this->render();
        }

        public function render(){
            switch ($this->request->action){
                case 'liste':
                    $bonssentrees = BonEntree::getListJournal();
                    $bonssorties = BonSortie::getListJournal();
                    $count = Article::getNbrTransJournal();
                    if ($count > 0){
                        $pagination = self::Pagination($count);
                        if (!$pagination){
                            $message[] = "Cette page n'existe pas";
                            $this->notification = new Notification("danger", $message);
                        }
                        else{
                            $transactions = Article::getListTransJournal($pagination->perPage, $pagination->offset);
                        } 
                    }
                    sort($transactions);
                    $entreesSorties = Article::getEntreeSortiesJournal();
                    require_once VIEW . 'journal/livrejournal.php';
                break;
            }
        }
     
    } // fin classe