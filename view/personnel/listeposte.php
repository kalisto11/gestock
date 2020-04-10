<h2>Liste des professeurs</h2>
<div>
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

