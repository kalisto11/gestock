var notification = document.querySelector('#notification');
var btnFermer = document.querySelector('#btn-fermer');
btnFermer.addEventListener('click', function(){
    notification.parentElement.removeChild(notification);
});

  