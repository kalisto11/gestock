<?php

     /*
    * Controleur du module des Bons d'netrée pour la gestion des bons d'entrée
    */
    
    class BonsEntree extends Controller{
        public function process(){
            if ($this->request->method === 'POST'){ // si la requete vient d'un formulaire
                if ($this->request->action != null){
                    switch ($this->request->action){
                        case 'traitement-bonentree':
                         switch ($_POST['operation']){
                             case 'ajouter':
                                 $bonEntree = new BonEntree();
                                 $bonEntree->reference = $_POST['reference'];
                                 $bonentree->article = $_POST['article'];
                                 $bonEntree->quantite = $_POST['quantite'];
                                 $bonEntree->fournisseur = $_POST['fournisseur'];
                                 $bonEntree->save();
                                 $this->request->action = 'liste';
                             break;
 
                             case 'modifier':
                                $idBonEntree = intval($_POST['id']);
                                $bonEntree  = new BonEntree();
                                $bonEntree->id = $idBonEntree;
                                $bonEntree->reference = $_POST['reference'];
                                $bonEntree->article = $_POST['article'];
                                $bonEntree->quantite = $_POST['quantite'];
                                $bonEntree->fournisseur = $_POST['fournisseur'];
                                //var_dump($bonEntree);
                                //exit;
                                $bonEntree->modify();
                                $this->request->action = 'liste';
                            break;
 
                             default:
                             $this->message['type'] = "danger";
                             $this->message['contenu'] = "Une erreur s'est produite pendant le traitement des données. Veuillez rééssayer svp.";
                             $this->request->action = 'liste';
                            
                         }
                         $this->render($this->message);
                    }
                }
             }
             else if ($this->request->method === 'GET'){ // si la requete vient d'un lien 
 
                 if ($this->request->action === 'supprimer'){
                     $idBonEntree = intval($this->request->id);
                     $bonEntree  = new BonEntree($idBonEntree);
                     $bonEntree->delete();
                     $this->request->action = 'liste';
                     $this->message['type'] = 'success';
                     $this->message['contenu'] = "Le bon a été supprimé avec succès.";
                 }
                 $this->render($this->message);
             }
        } // fin méthode process

        /**
         * Permet d'afficher les vues du module bons d'entrée
         * @param array permet de stocker les messgaes de notification s à afficher dans la vue en cas de reussite ou d'echec d'une opération
        **/
        public function render($message = null){
            switch ($this->request->action){

                case 'liste':
                    $bonentrees = BonEntree::getList();
                    require_once VIEW . 'bons/listbonentree.php';
                break;

                case 'consulter':
                    $agent = new Personnel($this->request->id);
                    require_once VIEW . 'personnel/infoagent.php';
                break;

                case 'ajouter':
                    $articles = article::getList();
                    require_once VIEW . 'bons/ajoutbonentree.php';
                break;

                case 'modifier':
                    $idBonEntree = intval($this->request->id);
                    $bonEntree  = new BonEntree($idBonEntree);
                    $articles = article::getList();
                    require_once VIEW . 'bons/modifbonentree.php';
                break;
            
                default: // gestion des erreurs au cas ou la valeur de action 
                    $currentController = new Erreur($this->request);
                    $currentController->process();
            }
        }
    }