<h2 class="mt-5 text-center">Liste du Personnel</h2> 
<div></div>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Prénon</th>
                    <th>Nom</th>
                    <th class="th-md">Poste</th>
                    <th>Action</th>
                </tr>
                <?php foreach($agents as $agent):?>
                    <tr>
                        <td><a href="/gestock/personnels/consulter/<?=$agent->id?>"><?= $agent->prenom?></a></td>
                        <td><a href="/gestock/personnels/consulter/<?=$agent->id?>"><?=$agent->nom?></a></td>
                        <td>
                            <?php foreach ($agent->poste as $poste): ?>
                                <?= $poste['nom'] ?> <br>
                            <?php endforeach ; ?>
                        <td> 
                            <a class="btn btn-info btn-sm" href="/gestock/personnels/modifier/<?=$agent->id?>">
                                <img src="images/icones/pencil.png" alt="Modifier" title="Modifier">
                            </a>
                            <a class="btn btn-danger btn-sm" href="/gestock/personnels/supprimer/<?=$agent->id?>">
                                <img src="images/icones/delete.png" alt="Supprimer" title="Supprimer">
                            </a>
                        </td>   
                    </tr>
                <?php endforeach ;?>
            </table>
        </div>
        <div class="mt-5">
            <a href="/gestock/personnels/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png"> Ajouter un Agent</button></a>

        </div>
    