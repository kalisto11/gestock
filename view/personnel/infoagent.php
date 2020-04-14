<h2 class="ml-5 text-center">Informations sur un Agent</h2>
<div class="container my-2">
    <div class="card">
    <div class="card-header display-4">
    <?= $agent->prenom ; ?> <?= $agent->nom ; ?></div>
    <div class="card-body">
        <h5 class="card-title">Poste agent: <?= $agent->poste_agent; ?></h5>
        <a href="#"class="btn btn-success">Modifier</a>
        <a href="#"class="btn btn-danger">Supprimer</a>
    </div>
    </div>
    <div class="mt-5">
        <p>
            <a class="btn btn-warning" href="#">Voir la liste du Personnel</a>
        </p>
    </div>
</div>
    

               
