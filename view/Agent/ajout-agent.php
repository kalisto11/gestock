<?php require VIEW . 'infos/notifications.php'; ?>
<h2>AJOUTER UN AGENT</h2>
<div>
    <form>
        <label for="prenom">Prenom :</label><br/>
        <input type="text" name="prenom" id="prenom"/><br/><br/>

        <label for="nom">nom :</label><br/>
        <input type="text" name="nom" id="nom"/><br/><br/>

     </form>
            <?php foreach($postes as $poste): ?>
            <?= $poste->nom ?>
                <label for="poste">Postes :</label><br/>
                  <select name="poste" id="poste">
                    <option value="charge des TIC">charge des TIC</option>
                    <option value="charge des ressources humaines">charge des ressources humaines</option>
                    <option value="charge des examens et concours">charge des examens et concours</option>
                    <option value="charge des communications">charge des communications</option>
                    <option value="charge des formations">charge des formations</option>
                  </select><br/><br/>

                  <?php endforeach ; ?>      
                  <a href="/gestock/postes/modifier-poste/<?= $poste->id ?>"><button class="btn btn-info btn-sm"><img src="images/icones/pencil.png" alt="Modifier" title="Modifier"></button></a>
                  
                  <a href="/gestock/postes/supprimer-poste/<?= $poste->id ?>"><button class="btn btn-danger btn-sm"><img src="images/icones/delete.png" alt="Supprimer" title="Supprimer"></button></a>
</div>