<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h2>Postes</h2>
            <table>
                <tr>
                    <th class="th-md">Poste</th>
                    <th class="th-sm">Action</th>
                </tr>
                <?php foreach($postes as $poste): ?>
                    <tr>
                        <td><?= $poste->nom ?></td>
                        <td>
                            <a href="/gestock/postes/modifier-poste/<?= $poste->id ?>"><button class="btn btn-info btn-sm"><img src="images/icones/pencil.png" alt="Modifier" title="Modifier"></button></a>
                            <a href="/gestock/postes/supprimer-poste/<?= $poste->id ?>"><button class="btn btn-danger btn-sm"><img src="images/icones/delete.png" alt="Supprimer" title="Supprimer"></button></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </table>
        </div>  
        <div class="col-md-4">
            <h2>Ajouter un poste</h2>
            <div class="container-fluid">
                <form method="post" action="/gestock/postes/traitement-poste">
                    <div class="form-group">
                        <label for="nom">nom du poste</label>
                        <input class="form-control" type="text" name="nomPoste" value="<?php if (isset($currentPoste->id)){echo $currentPoste->nom;} ?>">
                    </div>
                    <input type="hidden" name="operation" value="<?php if (isset($currentPoste->id)){echo 'modifier';}else{echo 'ajouter';} ?>">
                    <input type="hidden" name="idPoste" value="<?php if (isset($currentPoste->id)){echo $currentPoste->id ;} ?>">
                    <input type="submit" value="<?php if (isset($currentPoste->id)){echo 'Modifier';}else{echo 'Ajouter';} ?>"class="btn btn-success">
                </form>
            </div>     
        </div>
    </div>
</div>

