<?php 
    class Router {
        /**
         * permet de parser les url
         * @param url à parser
         * @return tableau contenant les parametres issus de l'url
         */
        static function parse($url, $request){
            $url = trim($url, "/");
            $parts = explode("/", $url);
            $request->site = $parts[0];
            $request->controller = isset($parts[1]) ? $parts[1] : '';
            $request->action = isset($parts[2]) ? $parts[2] : '';
            $request->params = array_slice($parts, 3);
            return true;
        }
    }