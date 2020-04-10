<h2>Liste des professeurs</h2>
<div>
   <table>
       <tr>
           <th>Prénom</th>
           <th>Nom</th>
           <th>Poste</th>
           <th>Action</th>
       </tr>
        <tr>
            <td>
                <a href="index.php?page=personnels&action=consulter&id=<?= $personnel->id ; ?>">
                    <?= $personnel->prenom ; ?>
                </a>
            </td>
            <td><?= $personnel->nom ; ?></td>
            <td><?= $personnel->poste ; ?></td>
            <td><a href="index.php?page=personnel&action=supprimer&id=<?= $personnel->id ;?>"></a></td>
        </tr>
        <?php endforeach ; ?>
   </table>
</div>
<div class="mt-5">
    <a class="btn btn-warning" href="index.php?page=personnels&action=ajouter"> <img src="images/icones/add.jpg" alt="Ajouter" title="Ajouter un nouvel personnel" class="icone"> Ajouter</a>
</div>
