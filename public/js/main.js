var notification = document.querySelector('#notification');
var btnFermer = document.querySelector('#btn-fermer');
btnFermer.addEventListener('click', function(){
    notification.parentElement.removeChild(notification);
});

var ajouterPoste = document.querySelector('#ajouterPoste');
ajouterPoste.addEventListener('click', function(){
    var boutonsuppr = document.createElement('button');
    var contenusuppr = document.createTextNode('X');
    boutonsuppr.appendChild(contenusuppr);
    boutonsuppr.addEventListener('click', SupprPara);

    var poste2 = document.createElement('select');
    var optionPoste = document.createElement('option');
    optionPoste.text = 'test';
    poste2.add(optionPoste);
    document.body.insertBefore(poste2, poste);
});

  
