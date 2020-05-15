<?php require VIEW . 'infos/notifications.php'; ?>

<div class="container-fluid">
<h2>Articles</h2>
    <div class="row">
        <?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?><div class="col-md-8"><?php endif; ?>
            <table class="table table-striped table-borderless table-hover table-sm">
                <tr>
                    <th class="th-md">Articles</th>
                    <th class="th-sm">Groupes</th>
                    <?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?><th class="th-sm">Action</th> <?php endif; ?>
                </tr>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td><?= $article->nom ?></td>
                        <td><?php if($article->groupe == 0){echo 'néant';}else{echo $article->groupe ;} ?></td>
                        <?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?>
                        <td>
                            <a class="btn btn-info btn-sm" href="/gestock/articles/modifier/<?= $article->id ?>"><img src="images/icones/pencil.png" class="menu-icone" alt="Modifier" title="Modifier"></a>
                            <a class="btn btn-info btn-sm suppr" href="/gestock/articles/supprimer/<?= $article->id ?>"><img src="images/icones/delete.png" class="menu-icone" alt="Supprimer" title="Supprimer"></a>                     
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ; ?>
            </table>
        <?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?></div><?php endif; ?>
        
        <?php if($_SESSION['user']['niveau'] == GESTIONNAIRE) : ?> 
        <div class="col-md-4 bg-light">
        <h4 class="mt-5 text-center"><?php if (isset($currentArticle->id)){echo 'Modifier l\'article';}else{echo 'Ajouter un article';} ?></h4>
            <div class="container-fluid">
                <form method="post" action="/gestock/articles/traitement-article">

                    <div class="form-group">
                        <label for="nom">Nom de l'article</label>
                        <input class="form-control" type="text" id="nom" name="nom" value="<?php if (isset($currentArticle->id)){echo $currentArticle->nom;} ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="groupe">Groupe</label><br/>
                        <select name="groupe" id="groupe" class="form-control">
                            <option value="0">Choisir un groupe</option>
                            <option value="1" <?php if (isset($currentArticle->groupe) AND $currentArticle->groupe == 1){echo 'selected="selected"';} ?>>Groupe 1
                            </option>
                            <option value="2" <?php if (isset($currentArticle->groupe) AND $currentArticle->groupe == 2){echo 'selected="selected"';} ?>>Groupe 2
                            </option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="quantite">Quantité de l'article dans l'existant</label>
                        <input class="form-control" type="number" id="quantite" name="quantite" value="<?php if (isset($currentArticle->id)){echo $currentArticle->quantite;} ?>">
                    </div>

                    <div class="form-group">
                        <label for="seuil">Seuil de l'article</label>
                        <input class="form-control" type="number" id="seuil" name="seuil" value="<?php if (isset($currentArticle->id)){echo $currentArticle->seuil;} ?>">
                    </div>

                    <input type="hidden" name="operation" value="<?php if (isset($currentArticle->id)){echo 'modifier';}else{echo 'ajouter';} ?>">
                    <input type="hidden" name="idArticle" value="<?php if (isset($currentArticle->id)){echo $currentArticle->id ;} ?>">
                    <input type="submit" value="<?php if (isset($currentArticle->id)){echo 'Modifier';}else{echo 'Ajouter';} ?>"class="btn btn-<?php if(isset($currentArticle->id)){echo 'info';}else{echo 'success';}?>">

                    <?php if (isset($currentArticle->id)): ?>
                    <a class="btn btn-danger" href="/gestock/articles/liste">Annuler</a>
                    <?php endif ; ?>

                </form>
            </div>     
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="d-flex justify-content-between my-4">
	<?php if ($currentPage > 1):?>
		<a href=" /gestock/articles/liste/?page=<?= $currentPage - 1 ?>" class="btn btn-primary">Page précédente</a>
	<?php endif ?>
    <?php if ($currentPage < $pages):?>
		<a href="/gestock/articles/liste/?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante </a>
	<?php endif ?>
</div>