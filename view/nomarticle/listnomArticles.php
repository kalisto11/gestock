<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h2>Articles</h2>
            <table>
                <tr>
                    <th class="th-md">Articles</th>
                    <th class="th-sm">Action</th>
                </tr>
                <?php foreach($nomarticles as $nomarticle): ?>
                    <tr>
                        <td><?= $nomarticle->nom ?></td>
                        <td>
                            <a href="/gestock/nomarticles/modifier-article/<?= $nomarticle->id ?>"><button class="btn btn-info btn-sm"><img src="images/icones/pencil.png" alt="Modifier" title="Modifier"></button></a>
                            <a href="/gestock/nomarticles/supprimer-article/<?= $nomarticle->id ?>"><button class="btn btn-danger btn-sm"><img src="images/icones/delete.png" alt="Supprimer" title="Supprimer"></button></a>
                        </td>
                    </tr>
                <?php endforeach ; ?>
            </table>
        </div>  
        <div class="col-md-4">
            <h2>Ajouter un article</h2>
            <div class="container-fluid">
                <form method="article" action="/gestock/nomarticles/traitement-article">
                    <div class="form-group">
                        <label for="nom">nom de article</label>
                        <input class="form-control" type="text" name="nomArticle" value="<?php if (isset($currentArticle->id)){echo $currentArticle->nom;} ?>">
                    </div>
                    <input type="hidden" name="operation" value="<?php if (isset($currentArticle->id)){echo 'modifier-article';}else{echo 'ajouter-article';} ?>">
                    <input type="hidden" name="idArticle" value="<?php if (isset($currentArticle->id)){echo $currentArticlee->id ;} ?>">
                    <input type="submit" value="<?php if (isset($currentArticle->id)){echo 'Modifier';}else{echo 'Ajouter';} ?>"class="btn btn-success">
                </form>
            </div>     
        </div>
    </div>
</div>

        

