<h2>Liste des postes</h2>
<div>
   <table>
       <tr>
           <th>poste</th>
           <th>Action</th>
       </tr>
       <?php foreach($postes as $poste): ?>
        <tr>
            <td><?= $poste->nom ?></td>
            <td>

            <a href=""><button class="btn btn-info mr-0"><img src="images/icones/pencil.png"> modifier</button></a>
   
            <a href=""><button class="btn btn-danger mr-0"><img src="images/icones/delete.png"> supprimer</button></a>

            </td>
        </tr>
        <?php endforeach ; ?>
   </table>
</div>
<div class="mt-5">
 <a href="/gestock/personnel/ajouter-poste"><button class="btn btn-success"><img src="images/icones/ajout.png"> ajouter</button></a>
</div>