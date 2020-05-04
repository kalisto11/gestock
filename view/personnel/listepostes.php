<?php require VIEW . 'infos/notifications.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
        <h2 class="mt-5 text-center">Postes</h2>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th class="th-md">Poste</th>
                    <th class="th-sm">Action</th>
                </tr>
                <?php foreach($postes as $poste): ?>
                    <tr>
                        <td><?= $poste->nom ?></td>
                        <td>
                            <a class="btn btn-info btn-sm" href="/gestock/postes/modifier/<?= $poste->id ?>">
                                <img src="images/icones/pencil.png" class="menu-icone" alt="Modifier" title="Modifier">
                            </a>
                            <a class="btn btn-info btn-sm" href="/gestock/postes/supprimer/<?= $poste->id ?>">
                                <img src="images/icones/delete.png" class="menu-icone" alt="Supprimer" title="Supprimer">
                            </a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </table>
        </div>  
        <div class="col-md-4 bg-light">
        <h2 class="mt-5 text-center"><?php if (isset($currentPoste->id)){echo 'Modifier le poste';}else{echo 'Ajouter un poste';} ?></h2>
            <div class="container-fluid">
                <form method="post" action="/gestock/postes/traitement-poste">
                    <div class="form-group">
                        <label for="nom">Nom du poste</label>
                        <input class="form-control" type="text" name="nomPoste" value="<?php if (isset($currentPoste->id)){echo $currentPoste->nom;} ?>" placeholder="Saisir le nom du nouveau poste ici" required>
                    </div>
                    <input type="hidden" name="operation" value="<?php if (isset($currentPoste->id)){echo 'modifier';}else{echo 'ajouter';} ?>">
                    <input type="hidden" name="id" value="<?php if (isset($currentPoste->id)){echo $currentPoste->id ;} ?>">
                    <input type="submit" value="<?php if (isset($currentPoste->id)){echo 'Modifier';}else{echo 'Ajouter';} ?>"class="btn <?php if (isset($currentPoste->id)){echo 'btn-info' ; }else{echo 'btn-success';}?>">
                    <?php if (isset($currentPoste->id)): ?>
                    <a class="btn btn-danger" href="/gestock/postes/liste">Annuler</a>
                    <?php endif ; ?>
                </form>
            </div>     
        </div>
    </div>
</div>

