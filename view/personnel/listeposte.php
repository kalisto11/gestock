<div>
    <div class="row">
        <div class="col-md-8">
            <h2>Liste des postes</h2>
            <table>
                <tr>
                    <th>poste</th>
                    <th>Action</th>
                </tr>
                <?php foreach($postes as $poste): ?>
                    <tr>
                        <td><?= $poste->nom ?></td>
                        <td></td>
                    </tr>
                <?php endforeach ; ?>
            </table>
        </div>  
        <div class="col-md-4">
            <h2>Ajouter un poste</h2>
            <div class="container-fluid">
                <form method="post" action="/gestock/personnel/traitement-ajouter-poste">
                    <div class="form-group">
                        <label for="nom">nom du poste</label>
                        <input class="form-control" type="text" name="nom">
                    </div>
                    <input type="hidden" name="action" value="ajouter">
                    <input type="submit" value="Ajouter" class="btn btn-success">
                </form>
            </div>     
        </div>
    </div>
</div>

