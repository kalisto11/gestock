
var supprs = document.querySelectorAll('.suppr');
var i = 0 ;
var  choix ;
for (i = 0; i < supprs.length; i++){
     supprs[i].addEventListener('click', function(){
    event.preventDefault();
    choix = confirm('Etes-vous sûr de vouloir supprimer cet élément');
    if (choix){
        window.location.href= this.getAttribute('href');
    }
});
}
