<?php
session_start();
unset($_SESSION['connecte']);
header('Location: /Authentification/login.php');




<?php
           $erreur = null;
           
               }else {
                   $erreur = "Indentifiant Incorrects";
                       }
                   }
          
          require_once '../gestock/controller/auth.php';
          if (connected()){
            header('Location: /gestock');
            exit;
          } 
          
        ?>