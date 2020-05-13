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
                    require_once VIEW . 'journal/livrejournal.php';
                break;
            }
        }
     
    } // fin classe