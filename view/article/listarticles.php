<?php require VIEW . 'infos/notifications.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h2 class="text-center">Articles</h2>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th class="th-md">Articles</th>
                    <th class="th-sm">Groupe</th>
                    <th class="th-sm">Action</th>
                </tr>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td><?= $article->nom ?></td>
                        <td><?= $article->groupe ?></td>
                        <td>
                            <a href="/gestock/articles/modifier/<?= $article->id ?>"><button class="btn btn-info btn-sm"><img src="images/icones/pencil.png" class=" menu-icone" alt="Modifier" title="Modifier"></button></a>
                            <a href="/gestock/articles/supprimer/<?= $article->id ?>"><button class="btn btn-danger btn-sm"><img src="images/icones/delete.png" class=" menu-icone" alt="Supprimer" title="Supprimer"></button></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </table>
        </div>  
        <div class="col-md-4 bg-light">
        <h2 class="mt-5 text-center"><?php if (isset($currentArticle->id)){echo 'Modifier l\'article';}else{echo 'Ajouter un article';} ?></h2>
            <div class="container-fluid">
                <form method="post" action="/gestock/articles/traitement-article">
                    <div class="form-group">
                        <label for="nom">Nom de l'Article</label>
                        <input class="form-control" type="text" name="article" value="<?php if (isset($currentArticle->id)){echo $currentArticle->nom;} ?>">
                    </div>
                    <label for="groupe">Groupe</label><br/>
                    <select name="groupe" id="groupe">
                        <option value="1" <?php if (isset($currentArticle->groupe) AND $currentArticle->groupe == 1){echo 'selected="selected"';} ?>>Groupe 1
                        </option>
                        <option value="2" <?php if (isset($currentArticle->groupe) AND $currentArticle->groupe == 2){echo 'selected="selected"';} ?>>Groupe 2
                        </option>
                    </select><br/><br/>

                    <input type="hidden" name="operation" value="<?php if (isset($currentArticle->id)){echo 'modifier';}else{echo 'ajouter';} ?>">
                    <input type="hidden" name="idArticle" value="<?php if (isset($currentArticle->id)){echo $currentArticle->id ;} ?>">
                    <input type="submit" value="<?php if (isset($currentArticle->id)){echo 'Modifier';}else{echo 'Ajouter';} ?>"class="btn btn-success">

                    <?php if (isset($currentArticle->id)): ?>
                    <a class="btn btn-danger" href="/gestock/articles/liste">Annuler</a>
                    <?php endif ; ?>
                </form>
            </div>     
        </div>
    </div>
</div>