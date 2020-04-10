
    <h2>Ajouter un poste</h2>
    <div class="container-fluid">
        <form method="post" action="/gestock/personnel/ajouterposte">
            <div class="form-group">
                <label for="nom">nom du poste</label>
                <input class="form-control" type="text" name="nom">
            </div>
            <input type="hidden" name="action" value="ajouter">
            <input type="submit" value="Ajouter" class="btn btn-success">
        </form>
    </div>
 
