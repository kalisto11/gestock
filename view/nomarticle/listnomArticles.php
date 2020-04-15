<?php require VIEW . 'infos/notifications.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h2>Articles</h2>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th class="th-md">Articles</th>
                    <th class="th-sm">Action</th>
                </tr>
                <?php foreach($nomarticles as $nomarticle): ?>
                    <tr>
                        <td><?= $nomarticle->nom ?></td>
                        <td>
                            <a href="/gestock/nomarticles/modifier/<?= $nomarticle->id ?>"><button class="btn btn-info btn-sm"><img src="images/icones/pencil.png" alt="Modifier" title="Modifier"></button></a>
                            <a href="/gestock/nomarticles/supprimer/<?= $nomarticle->id ?>"><button class="btn btn-danger btn-sm"><img src="images/icones/delete.png" alt="Supprimer" title="Supprimer"></button></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </table>
        </div>  
        <div class="col-md-4 bg-light">
        <h2 class="mt-5"><?php if (isset($currentArticle->id)){echo 'Modifier l\'article';}else{echo 'Ajouter un article';} ?></h2>
            <div class="container-fluid">
                <form method="post" action="/gestock/nomarticles/traitement-article">
                    <div class="form-group">
                        <label for="nom">Nom de l'Article</label>
                        <input class="form-control" type="text" name="nomArticle" value="<?php if (isset($currentArticle->id)){echo $currentArticle->nom;} ?>">
                    </div>
                    <input type="hidden" name="operation" value="<?php if (isset($currentArticle->id)){echo 'modifier';}else{echo 'ajouter';} ?>">
                    <input type="hidden" name="idArticle" value="<?php if (isset($currentArticle->id)){echo $currentArticle->id ;} ?>">
                    <input type="submit" value="<?php if (isset($currentArticle->id)){echo 'Modifier';}else{echo 'Ajouter';} ?>"class="btn btn-success">
                    <?php if (isset($currentArticle->id)): ?>
                    <a class="btn btn-danger" href="/gestock/nomarticles/liste">Annuler</a>
                    <?php endif ; ?>
                </form>
            </div>     
        </div>
    </div>
</div>