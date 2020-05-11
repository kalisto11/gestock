var notif = document.querySelector('#notification');
var btnFermer = document.querySelector('#btn-fermer');
btnFermer.addEventListener('click', function(){
    notif.parentElement.removeChild(notif);
});