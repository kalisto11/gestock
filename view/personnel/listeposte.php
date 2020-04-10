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
            <td>
    
            <input type="hidden" name="action" value="modifier">
            <input type="submit" value="modifier" class="btn btn-success">     
            

            
            <input type="hidden" name="action" value="supprimer">
            <input type="submit" value="supprimer" class="btn btn-success">

            </td>
        </tr>
        <?php endforeach ; ?>
   </table>
</div>

