<?php require VIEW . 'infos/notifications.php'; ?>

<h2>Personnel</h2> 
<div></div>
            <table class="table table-striped table-borderless table-hover table-sm">
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Postes</th>
                    <th class="th-sm">Action</th>
                </tr>
                <?php foreach($agents as $agent):?>
                    <tr>
                        <td class="align-middle"><?= $agent->prenom ?></td>
                        <td class="align-middle"><?= $agent->nom ?></td>
                        <td class="align-middle">
                            <?php if ($agent->poste != null): ?>
                                <?php foreach ($agent->poste as $poste): ?>
                                <?= htmlspecialchars($poste->nom) ?> <br>
                                <?php endforeach ; ?>
                            <?php else : ?>
                                <?php echo 'NEANT'; ?>
                            <?php endif ; ?>
                        </td>
                        <td class="align-middle">
                            <a class="btn btn-info btn-sm" href="/gestock/personnels/consulter/<?=$agent->id?>">
                                <img src="images/icones/consult.png" class="menu-icone" alt="Consulter" title="Consulter">
                            </a>
                            <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
                                <a class="btn btn-info btn-sm" href="/gestock/personnels/modifier/<?=$agent->id?>">
                                    <img src="images/icones/pencil.png" class=" menu-icone" alt="Modifier" title="Modifier">
                                </a>
                                <a class="btn btn-info btn-sm suppr" href="/gestock/personnels/supprimer/<?=$agent->id?>">
                                    <img src="images/icones/delete.png" class=" menu-icone" alt="Supprimer" title="Supprimer">
                                </a>
                            <?php endif; ?>
                        </td>   
                    </tr>
                <?php endforeach ;?>
            </table>
        </div>
        <?php if($_SESSION['user']['niveau'] >= GESTIONNAIRE) : ?>
            <div class="mt-5">
                <a class="btn btn-success" href="/gestock/personnels/ajouter"><img src="images/icones/ajout.png" class="menu-icone">  Ajouter un Bénéficiaire</a>
            </div>
        <?php endif; ?>
          