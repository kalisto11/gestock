<?php 
    class Router {
        /**
         * permet de parser les url
         * @param String url à parser
         * @param Request attribut request du dispatcher
         * @return bool pour valider le parsing
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