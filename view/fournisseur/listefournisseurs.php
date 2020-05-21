<?php require VIEW . 'infos/notifications.php'; ?>

<div class="container-fluid">
<h2>Fournisseurs</h2>
    <div class="row">
        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?><div class="col-md-8"><?php endif; ?>
            <table class="table table-striped table-borderless table-hover table-sm">
                <tr>
                    <th class="th-md">Fournisseur</th>
                    <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?><th class="th-sm">Action</th><?php endif; ?>
                </tr>
                <?php foreach($fournisseurs as $fournisseur): ?>
                    <tr>
                        <td><a href="/gestock/fournisseurs/consulter/<?= $fournisseur->id ?>"><?= $fournisseur->nom ?></a></td>
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

            <div class="d-flex justify-content-between my-4">
                <?php if ($currentPage > 1):?>
                    <a href="/gestock/fournisseurs/liste/?page=<?= $currentPage - 1 ?>" class="btn btn-info">Page précédente</a>
                <?php endif ?>
                <?php if ($currentPage < $pages):?>
                    <a href="/gestock/fournisseurs/liste/?page=<?= $currentPage + 1 ?>" class="btn btn-info ml-auto">Page suivante</a>
                <?php endif ?>
            </div>

        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?></div><?php endif; ?>
         
        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
            <div class="col-md-4 bg-light">
            <h4 class="mt-5 text-center"><?php if (isset($currentFournisseur->id)){echo 'Modifier le fournisseur';}else{echo 'Ajouter un fournisseur';} ?></h4>
                <div class="container-fluid">
                    <form method="post" action="/gestock/Fournisseurs/traitement-fournisseur">
                        <div class="form-group">
                            <label for="nom">Nom du fournisseur</label>
                            <input class="form-control form-control-sm" type="text" name="nom" value="<?php if (isset($currentFournisseur->id)){echo $currentFournisseur->nom;} ?>" placeholder="Saisir le nom du nouveau founisseur ici" required>
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

