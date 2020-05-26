<?php require VIEW . 'infos/notifications.php'; ?>

<div class="container-fluid">
<h2>Postes</h2>
    <div class="row">
        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?><div class="col-md-8"><?php endif; ?>
            <table class="table table-striped table-borderless table-hover table-sm">
                <tr>
                    <th class="th-md">Poste</th>
                    <th class="th-sm">Statut</th>
                    <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?><th class="th-sm">Action</th><?php endif; ?>
                </tr>
                <?php if (!empty($postes)) : ?>
                <?php foreach($postes as $poste): ?>
                    <tr>
                        <td><?= $poste->nom ?></td>
                        <td><?= $poste->statut ?></td>
                        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
                            <td class="th-sm">
                                <a class="btn btn-info btn-sm" href="/gestock/postes/modifier/<?= $poste->id ?>">
                                    <img src="images/icones/pencil.png" class="menu-icone" alt="Modifier" title="Modifier">
                                </a>
                                <a class="btn btn-info btn-sm suppr" href="/gestock/postes/supprimer/<?= $poste->id ?>">
                                    <img src="images/icones/delete.png" class="menu-icone" alt="Supprimer" title="Supprimer">
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ; ?>
                <?php endif ; ?>
            </table>
        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?></div><?php endif; ?>  

        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
        <div class="col-md-4 bg-light">
            <h4 class="mt-5 text-center"><?php if (isset($currentPoste->id)){echo 'Modifier le poste';}else{echo 'Ajouter un poste';} ?></h4>
            <div class="container-fluid">
                <form method="post" action="/gestock/postes/traitement-poste">
                    <div class="form-group">
                        <label for="nom">Nom du poste</label>
                        <input class="form-control form-control-sm" type="text" name="nomPoste" value="<?php if (isset($currentPoste->id)){echo $currentPoste->nom;} ?>" placeholder="Saisir le nom du nouveau poste ici" required>
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
    <?php endif; ?>
    </div>
</div>

