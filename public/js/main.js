var notification = document.querySelector('#notification');
var btnFermer = document.querySelector('#btn-fermer');
btnFermer.addEventListener('click', function(){
    notification.parentElement.removeChild(notification);
});

var quantite1 = document.querySelector('#quantite1');
var prix1 = document.querySelector('#prix1');
var total1 = document.querySelector('#total1');
quantite1.addEventListener('click', function(){
    document.alert('test');
});

