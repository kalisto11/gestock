<?php
    class Notification{
        public $type;
        public $contenu;

        /**
         * Permet d'instancier un objet de type notification
         *  @param String type de la notification
         *  @param String contenu de la notification
         *  @return Notification un objet de type notification
        **/
        public function __construct($type, $contenu){
            $this->type = $type;
            $this->contenu = $contenu;
        }
    }