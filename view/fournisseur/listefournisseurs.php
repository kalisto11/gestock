<?php require VIEW . 'infos/notifications.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
        <h2 class="mt-5 text-center">Fournisseurs</h2>
            <table class="table table-striped table-borderless table-hover table-sm">
                <tr>
                    <th class="th-md">Fournisseur</th>
                    <th class="th-sm">Action</th>
                </tr>
                <?php foreach($fournisseurs as $fournisseur): ?>
                    <tr>
                        <td><?= $fournisseur->nom ?></td>
                        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
                            <td>
                                <a class="btn btn-info btn-sm" href="/gestock/fournisseurs/modifier/<?= $fournisseur->id ?>">
                                    <img src="images/icones/pencil.png" class="menu-icone" alt="Modifier" title="Modifier">
                                </a>
                                <a class="btn btn-info btn-sm suppr" href="/gestock/fournisseurs/supprimer/<?= $fournisseur->id ?>">
                                    <img src="images/icones/delete.png" class="menu-icone" alt="Supprimer" title="Supprimer">
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ; ?>
            </table>
        </div>  
        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
            <div class="col-md-4 bg-light">
            <h2 class="mt-5 text-center"><?php if (isset($currentFournisseur->id)){echo 'Modifier le fournisseur';}else{echo 'Ajouter un fournisseur';} ?></h2>
                <div class="container-fluid">
                    <form method="post" action="/gestock/Fournisseurs/traitement-fournisseur">
                        <div class="form-group">
                            <label for="nom">Nom du fournisseur</label>
                            <input class="form-control" type="text" name="nom" value="<?php if (isset($currentFournisseur->id)){echo $currentFournisseur->nom;} ?>" placeholder="Saisir le nom du nouveau founisseur ici" required>
                        </div>
                        <input type="hidden" name="operation" value="<?php if (isset($currentFournisseur->id)){echo 'modifier';}else{echo 'ajouter';} ?>">
                        <input type="hidden" name="id" value="<?php if (isset($currentFournisseur->id)){echo $currentFournisseur->id ;} ?>">
                        <input type="submit" value="<?php if (isset($currentFournisseur->id)){echo 'Modifier';}else{echo 'Ajouter';} ?>"class="btn <?php if (isset($currentFournisseur->id)){echo 'btn-info' ; }else{echo 'btn-success';}?>">
                        <?php if (isset($currentFournisseur->id)): ?>
                        <a class="btn btn-danger" href="/gestock/fournisseurs/liste">Annuler</a>
                        <?php endif ; ?>
                    </form>
                </div>     
            </div>
        <?php endif; ?>
    </div>
</div>

