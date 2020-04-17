<h2 class="ml-5 text-center">Informations sur un Agent</h2>
<div class="container my-2">
    <div class="card">
        <div class="card-header display-4">
            <?= $agent->prenom ?> <?= $agent->nom ?>
        </div>
        <div class="card-body">
            <h3 class="card-title bg-dark">
                Poste: 
                <?php foreach ($agent->poste as $poste): ?>
                    <?= $poste['nom'] ?><br>
                <?php endforeach ; ?>
            </h3>
            <a href="/gestock/personnels/modifier/<?= $agent->id ?>"class="btn btn-success">Modifier</a>
            <a href="/gestock/personnels/supprimer/<?= $agent->id ?>"class="btn btn-danger">Supprimer</a>
        </div>
    </div>
    <div class="mt-5">
        <p>
            <a class="btn btn-warning float-right" href="/gestock/personnels/liste">Voir la liste du Personnel</a>
        </p>
    </div>
</div>
    

               
