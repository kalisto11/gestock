<h1 class="mt-5 text-center">Liste du Personnel</h1> 
<div></div>
            <table >
                <tr>
                    <th>Prenon</th>
                    <th>Nom</th>
                    <th>Poste Agent</th>
                    <th>Action</th>
                </tr>
                <?php foreach($agents as $agent):?>

                <tr>
                    <td><?= $agent->prenom?></td>
                    <td><?=$agent->non?></td>
                    <td><?=$agent->post?></td>
                    <td> <a href="#"><button class="btn btn-danger"><img src="images/icones/delete.png">Supprimer</button></a></td>
                        
                
                </tr>
                <?php endforeach ;?>
            </table>
        </div>
        <div class="mt-5">
            <a href="/gestock/article/ajouter-article"><button class="btn btn-success ml-5"><img src="images/icones/ajout.png">Ajouter un Agent</button></a>

        </div>
    