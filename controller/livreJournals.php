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
                    $currentPage = (int)($_GET['page'] ?? 1) ? :1;
                    $perpage = 10;
                    $count = Article::getNbrTransJournal();
                    $pages = ceil($count/$perpage);
                    if ($currentPage > $pages){
                        $message[] = "Cette page n'existe pas";
                        $this->notification = new Notification("success", $message);
                    }
                    $offset = $perpage * ($currentPage - 1);
                    $transactions = Article::getListTransJournal($perpage, $offset);
                    sort($transactions);
                    $entreesSorties = Article::getEntreeSortiesJournal();
                    require_once VIEW . 'journal/livrejournal.php';
                break;
            }
        }
     
    } // fin classe