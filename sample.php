<?php
// On se connecte à la BD
try{
    $database = new PDO ('mysql:host=localhost;dbname=isidatabase', 'root', 'passer');
}
catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$id = $_GET['idetudiant'] ;

$retour = $database->prepare('DELETE from etudiants WHERE id = ?');
$retour->execute(array($id));	
?>

</h3>Les informations sur l’étudiant ont été supprimées avec succès</h3>
<a href="informations.php">Retour à la liste des étudiants</a>
