setInterval(function(){
    if(document.getElementById("reset").checked == true){
        document.getElementById("hiddenBlock").style.display = "block";
    }
    else{
        document.getElementById("hiddenBlock").style.display = "none"; 
    }
}, 500);

var checkPassword1 = document.getElementById("checkPassword1");
var password1 = document.getElementById("password1");
checkPassword1.addEventListener("mousedown", function(){
    checkPassword1.style.width = "35px";
    checkPassword1.style.height = "25px";
    password1.setAttribute("type", "text");
});
checkPassword1.addEventListener("mouseup", function(){
    password1.setAttribute("type", "password");
    checkPassword1.style.width = "30px";
    checkPassword2.style.height = "20px";
    password1.setAttribute("type", "password");
});
var checkPassword2 = document.getElementById("checkPassword2");
var password2 = document.getElementById("password2");
checkPassword2.addEventListener("mousedown", function(){
    checkPassword2.style.width = "35px";
    checkPassword2.style.height = "25px";
    password2.setAttribute("type", "text");
});
checkPassword2.addEventListener("mouseup", function(){
    checkPassword2.style.width = "30px";
    checkPassword2.style.height = "20px";
    password2.setAttribute("type", "password");
});

password1.addEventListener("input", function (e) {
    var mdp = e.target.value; // Valeur saisie dans le champ mdp
    var longueurMdp = "faible";
    var couleurMsg = "red"; // Longueur faible => couleur rouge
    if (mdp.length >= 8) {
        longueurMdp = "fort";
        couleurMsg = "green"; // Longueur suffisante => couleur verte
    } else if (mdp.length >= 4) {
        longueurMdp = "moyen";
        couleurMsg = "orange"; // Longueur moyenne => couleur orange
    }
    var aideMdpElt = document.getElementById("helpPassword1");
    aideMdpElt.textContent = "Mot de passe : " + longueurMdp; // Texte de l'aide
    aideMdpElt.style.color = couleurMsg; // Couleur du texte de l'aide
});

password2.addEventListener("input", function (e) {
    var mdp = e.target.value; // Valeur saisie dans le champ mdp
    var longueurMdp = "faible";
    var couleurMsg = "red"; // Longueur faible => couleur rouge
    if (mdp.length >= 8) {
        longueurMdp = "fort";
        couleurMsg = "green"; // Longueur suffisante => couleur verte
    } else if (mdp.length >= 4) {
        longueurMdp = "moyen";
        couleurMsg = "orange"; // Longueur moyenne => couleur orange
    }
    var aideMdpElt = document.getElementById("helpPassword2");
    aideMdpElt.textContent = "Mot de passe : " + longueurMdp; // Texte de l'aide
    aideMdpElt.style.color = couleurMsg; // Couleur du texte de l'aide
});