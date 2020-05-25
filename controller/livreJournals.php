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
                    $count = Transaction::getNbrTransJournal();
                    if ($count > 0){
                        $pagination = new Pagination($count);
                        if (!$pagination){
                            $message[] = "Cette page n'existe pas";
                            $this->notification = new Notification("danger", $message);
                        }
                        else{
                            $transactions = Transaction::getList($pagination->perPage, $pagination->offset);
                            sort($transactions);
                        } 
                    }
                    $entreesSorties = Article::getSommeJournal();
                    require_once VIEW . 'journal/livrejournal.php';
                break;
            }
        }
     
    } // fin classe