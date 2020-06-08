var supprs = document.querySelectorAll('.suppr')
var i = 0 
var  choix 
for (i = 0; i < supprs.length; i++){
    supprs[i].addEventListener('click', function(event){
        event.preventDefault()
        choix = confirm('Etes-vous sûr de vouloir supprimer cet élément ?')
        if (choix){
            window.location.href= this.getAttribute('href')
        }
    })
}

var notif = document.querySelector('#notification');
var btnFermer = document.querySelector('#btn-fermer');
btnFermer.addEventListener('click', function(){
    notif.parentElement.removeChild(notif);
});
setTimeout(function(){ 
    notif.parentElement.removeChild(notif); 
}, 5000);