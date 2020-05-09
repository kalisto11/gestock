var totalGeneral = document.querySelector('#totalGeneral');

var quantite1 = document.querySelector('#quantite1');
var prix1 = document.querySelector('#prix1');
var total1 = document.querySelector('#total1');
var quantite2 = document.querySelector('#quantite2');
var prix2 = document.querySelector('#prix2');
var total2 = document.querySelector('#total2');
var quantite3 = document.querySelector('#quantite3');
var prix3 = document.querySelector('#prix3');
var total3 = document.querySelector('#total3');
var quantite4 = document.querySelector('#quantite4');
var prix4 = document.querySelector('#prix4');
var total4 = document.querySelector('#total4');
var quantite5 = document.querySelector('#quantite5');
var prix5 = document.querySelector('#prix5');
var total5 = document.querySelector('#total5');
var quantite6 = document.querySelector('#quantite6');
var prix6 = document.querySelector('#prix6');
var total6 = document.querySelector('#total6');
var quantite7 = document.querySelector('#quantite7');
var prix7 = document.querySelector('#prix7');
var total7 = document.querySelector('#total7');
var quantite8 = document.querySelector('#quantite8');
var prix8 = document.querySelector('#prix8');
var total8 = document.querySelector('#total8');
var quantite9 = document.querySelector('#quantite9');
var prix9 = document.querySelector('#prix9');
var total9 = document.querySelector('#total9');
var quantite10 = document.querySelector('#quantite10');
var prix10 = document.querySelector('#prix10');
var total10 = document.querySelector('#total10');

quantite1.addEventListener('change', function(){
    if (quantite1.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite1.value = "";
    }
    else{
        total1.value = parseInt(quantite1.value * prix1.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix1.addEventListener('change', function(){
    if (prix1.value < 0){
        alert('Le prix ne peut pas etre négatif');
        prix1.value = "";
    }
    else{
        total1.value = parseInt(quantite1.value * prix1.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite2.addEventListener('change', function(){
    if (quantite2.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite2.value = "" ;
    }
    else{
        total2.value = parseInt(quantite2.value * prix2.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix2.addEventListener('change', function(){
    if (prix2.value < 0){
        alert('Le prix ne peut pas etre négatif');
        prix2.value = "";
    }
    else{
        total2.value = parseInt(quantite2.value * prix2.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite3.addEventListener('change', function(){
    if (quantite3.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite3.value = "" ;
    }
    else{
        total3.value = parseInt(quantite3.value * prix3.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix3.addEventListener('change', function(){
    if (prix3.value < 0){
        alert('Le prix ne peut pas etre négatif');
    }
    else{
        total3.value = parseInt(quantite3.value * prix3.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite4.addEventListener('change', function(){
    if (quantite4.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite4.value = "" ;
    }
    else{
        total4.value = parseInt(quantite4.value * prix4.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix4.addEventListener('change', function(){
    if (prix4.value < 0){
        alert('Le prix ne peut pas etre négatif');
    }
    else{
        total4.value = parseInt(quantite4.value * prix4.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite5.addEventListener('change', function(){
    if (quantite5.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite5.value = "" ;
    }
    else{
        total5.value = parseInt(quantite5.value * prix5.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix5.addEventListener('change', function(){
    if (prix5.value < 0){
        alert('Le prix ne peut pas etre négatif');
    }
    else{
        total5.value = parseInt(quantite5.value * prix5.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite6.addEventListener('change', function(){
    if (quantite6.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite6.value = "" ;
    }
    else{
        total6.value = parseInt(quantite6.value * prix6.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix6.addEventListener('change', function(){
    if (prix6.value < 0){
        alert('Le prix ne peut pas etre négatif');
    }
    else{
        total6.value = parseInt(quantite6.value * prix6.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite7.addEventListener('change', function(){
    if (quantite7.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite7.value = "" ;
    }
    else{
        total7.value = parseInt(quantite7.value * prix7.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix7.addEventListener('change', function(){
    if (prix7.value < 0){
        alert('Le prix ne peut pas etre négatif');
    }
    else{
        total7.value = parseInt(quantite7.value * prix7.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite8.addEventListener('change', function(){
    if (quantite8.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite8.value = "" ;
    }
    else{
        total8.value = parseInt(quantite8.value * prix8.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix8.addEventListener('change', function(){
    if (prix8.value < 0){
        alert('Le prix ne peut pas etre négatif');
    }
    else{
        total8.value = parseInt(quantite8.value * prix8.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite9.addEventListener('change', function(){
    if (quantite9.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite9.value = "" ;
    }
    else{
        total9.value = parseInt(quantite9.value * prix9.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix9.addEventListener('change', function(){
    if (prix9.value < 0){
        alert('Le prix ne peut pas etre négatif');
    }
    else{
        total9.value = parseInt(quantite9.value * prix9.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});

quantite10.addEventListener('change', function(){
    if (quantite10.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.');
        quantite10.value = "" ;
    }
    else{
        total10.value = parseInt(quantite10.value * prix10.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});
prix10.addEventListener('change', function(){
    if (prix10.value < 0){
        alert('Le prix ne peut pas etre négatif');
    }
    else{
        total10.value = parseInt(quantite10.value * prix10.value);
        totalGeneral.innerHTML = sommeTotalgeneral();
    }
});



function sommeTotalgeneral(){
    let somme;
    somme = parseInt(total1.value) + parseInt(total2.value) + parseInt(total3.value) + parseInt(total4.value) + parseInt(total5.value) + parseInt(total6.value) + parseInt(total7.value) + parseInt(total8.value) + parseInt(total9.value) + parseInt(total10.value);
    return somme;
}

/*
var i ;
for (i = 1; i <= 10; i++){
    eval('quantite' + i).addEventListener('change', function(){
        if (eval('quantite' + i).value <= 0){
            alert('La valeur de la quantité ne peut etre négative ou nulle.');
        }
        else{
            eval('total' + i).value = parseInt(eval('quantie' + i).value * eval('prix' + i).value);
            totalGeneral.innerHTML = sommeTotalgeneral();
        }
    });
    eval('prix' + i).addEventListener('change', function(){
        if (eval('prix' + i).value < 0){
            alert('Le prix ne peut pas etre négatif');
        }
        else{
            eval('total' + i).value = parseInt(eval('quantite' + i).value * eval('prix' + i).value);
            totalGeneral.innerHTML = sommeTotalgeneral();
        }
    });
}
*/
