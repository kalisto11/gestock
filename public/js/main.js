var notification = document.querySelector('#notification');
var btnFermer = document.querySelector('#btn-fermer');
btnFermer.addEventListener('click', function(){
    this.parentElement.parentElement.parentElement.parentElement.removeChild(notification);
});

  
