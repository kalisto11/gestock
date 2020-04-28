<?php require VIEW . 'infos/notifications.php'; ?>

<h2 class="mt-5 text-center">Liste du Personnel</h2> 
<div></div>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th class="th-md">Postes</th>
                    <th>Action</th>
                </tr>
                <?php foreach($agents as $agent):?>
                    <tr>
                        <td><a href="/gestock/personnels/consulter/<?=$agent->id?>"><?= $agent->prenom ?></a></td>
                        <td><a href="/gestock/personnels/consulter/<?=$agent->id?>"><?= $agent->nom ?></a></td>
                        <td>
                            <?php if ($agent->poste != null): ?>
                                <?php foreach ($agent->poste as $poste): ?>
                                <?= htmlspecialchars($poste->nom) ?> <br>
                                <?php endforeach ; ?>
                            <?php else : ?>
                                <?php echo 'NEANT'; ?>
                            <?php endif ; ?>
                         
                           
                        </td>
                        <td> 
                            <a class="btn btn-info btn-sm" href="/gestock/personnels/modifier/<?=$agent->id?>">
                                <img src="images/icones/pencil.png" class=" menu-icone" alt="Modifier" title="Modifier">
                            </a>
                            <a class="btn btn-danger btn-sm" href="/gestock/personnels/supprimer/<?=$agent->id?>">
                                <img src="images/icones/delete.png" class=" menu-icone" alt="Supprimer" title="Supprimer">
                            </a>
                        </td>   
                    </tr>
                <?php endforeach ;?>
            </table>
        </div>
        <div class="mt-5">
            <a href="/gestock/personnels/ajouter"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png" class=" menu-icone"> Ajouter un Agent</button></a>

        </div>
    