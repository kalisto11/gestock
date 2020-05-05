<?php
public function connected() : bool {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    };
    return !empty($_SESSION['connecte']);
}
public function user_connecte() :void{
    if (!connected()){
        header('Location: /login.php');
        exit(); 
    }
}
$erreur = null;
if (!empty($_POST['pseudo'])  && !empty($_POST['motdepasse'])){
    if ($_POST['pseudo'] === 'Admin' && $_POST['motdepasse'] === 'Admin'){
        // On connecte l'utilisateur
        session_start();
        $_SESSION['connecte'] = 1;
        header('Location: /dashboard.php');
        exit();
    }else {
        $erreur = 'Identifiants incorrects';
    }
}
require 'controller/auth.php';
if (connected()){
    header('Location: /dashboard.php');
    exit();
}
<?php if ($erreur): ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
<?php endif ?>
