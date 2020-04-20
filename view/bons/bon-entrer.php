<h2>Bon d'entree</h2>
<div>
    
<?php foreach($bons_entree as $bon_entree):?>
    <form>
        <label for="reference">reference :</label><br/>
        <input type="text" name="reference" id="reference"/><br/><br/>

        <label for="date">date :</label><br/>
        <input type="date" name="date" id="date"/><br/><br/>

               <label for="article">Articles :</label><br/>
                  <select name="article" id="article">
                    <option value="ordinateur">ordinateur</option>
                    <option value="table bureau">table bureau</option>
                    <option value="armoire">armoire</option>
                  </select><br/><br/>

        <label for="quantite">quantite :</label><br/>
        <input type="text" name="quantite" id="quantite"/><br/><br/>

        <label for="fournisseur">fournisseur :</label><br/>
        <input type="text" name="fournisseur" id="fournisseur"/><br/><br/>
    </form>

     <input type="submit" value="ajouter" />     <input type="submit" value="modifier" /> 
       
     <?php endforeach ;?>
</div>