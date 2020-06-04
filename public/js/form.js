setInterval(function(){
    if(document.getElementById("reset").checked == true){
        document.getElementById("hiddenBlock").style.display = "block"
    }
    else{
        document.getElementById("hiddenBlock").style.display = "none" 
    }
}, 500)


createBtnSuppr()

// nbre d'articles presents sur le formulaire
cptArticles = 1

var btnAdd = document.getElementById("btnAdd")
btnAdd.addEventListener("click", function(e){
  var articles = document.getElementsByClassName("row-color")
  createArticle()
  cptArticles++
})

/*
var quantite1 = document.querySelector('#quantite1')
var prix1 = document.querySelector('#prix1')
var total1 = document.querySelector('#total1')
quantite1.addEventListener('change', function(){
    if (quantite1.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite1.value = ""
    }
    else{
        total1.value = parseInt(quantite1.value * prix1.value)
        updateTotalGeneral()
    }
})
prix1.addEventListener('change', function(){
    if (prix1.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix1.value = ""
    }
    else{
        total1.value = parseInt(quantite1.value * prix1.value)
        updateTotalGeneral()
    }
})
*/

var quantiteArticles = document.getElementsByClassName("quantiteArticle")
var prixArticles = document.getElementsByClassName("prixArticle")
var totalArticles = document.getElementsByClassName("totalArticle")
for (i = 0; i < quantiteArticles.length; i++){
    quantiteArticles[i].addEventListener("change", function(){
        if (quantiteArticles[i].value <= 0){
            alert('La valeur de la quantité ne peut etre négative ou nulle.')
            quantiteArticles[i].value = ""
        }
        else{
            alert("test")
            totalArticles[i].value = parseInt(quantiteArticles[i].value * prixArticles[i].value)
            updateTotalGeneral()
        }
    })
    prixArticles[i].addEventListener("change", function(){
        if (prixArticles[i].value <= 0){
            alert('La valeur de la quantité ne peut etre négative ou nulle.')
            prixArticles[i].value = ""
        }
        else{
            totalArticles[i].value = parseInt(prixArticles[i].value * quantiteArticles[i].value)
            updateTotalGeneral()
        }
    })
}


/**
 * mettre a jour la valeur de totalGeneral
 */
var totalGeneral = document.querySelector('#totalGeneral')
function updateTotalGeneral(){
    let somme = 0
    totalArticles = document.getElementsByClassName("totalArticle")
    for (i = 0; i < totalArticles.length; i++){
        somme = parseInt(somme) + parseInt(totalArticles[i].value)
    }
    totalGeneral.innerHTML = somme
}


function createArticle(){
    rowColors = document.getElementsByClassName("row-color")
    compteur = cptArticles + 1
    var dotations = document.getElementById("dotations")
    var article = document.getElementsByClassName("row-color")[0]
    selects = document.getElementsByTagName("select")
    var articles = document.createElement("select")

    var divRow = document.createElement("div")
    divRow.className = "row row-color m-2"

    var divColArticle = document.createElement("div")
    divColArticle.className = "col-3"

    var divFormGroupArticle = document.createElement("div")
    divFormGroupArticle.className = "form-group"

    var labelArticle = document.createElement("label")
    labelArticle.for = "article" + compteur
    labelArticle.textContent = "Article"

    articles.innerHTML = selects[1].innerHTML
    var options = articles.getElementsByTagName("option")
    for (i = 0; i < options.length; i++){
        if (options[i].selected = "selected"){
            options[i].selected = ""
        }
    }
    articles.className = "form-control form-control-sm"
    articles.name = "article" + compteur
    articles.id = "article" + compteur

    divFormGroupArticle.appendChild(labelArticle)
    divFormGroupArticle.appendChild(articles)
    divColArticle.appendChild(divFormGroupArticle)

    var divColQuantite = document.createElement("div")
    divColQuantite.className = "col-3"
    var divFormGroupQuantite = document.createElement("div")
    divFormGroupQuantite.className = "form-group"
    var labelQuantite = document.createElement("label")
    labelQuantite.textContent = "Quantité"
    labelQuantite.for = "quantite" + compteur
    var inputQuantite = document.createElement("input")
    inputQuantite.type = "number"
    inputQuantite.id = "quantite" + compteur
    inputQuantite.name = "quantite" + compteur
    inputQuantite.className = "form-control form-control-sm"
    divFormGroupQuantite.appendChild(labelQuantite)
    divFormGroupQuantite.appendChild(inputQuantite)
    divColQuantite.appendChild(divFormGroupQuantite)

    var divColPrix = document.createElement("div")
    divColPrix.className = "col-3"
    var divFormGroupPrix = document.createElement("div")
    divFormGroupPrix.className = "form-group"
    var labelPrix = document.createElement("label")
    labelPrix.textContent = "Prix unitaire"
    labelPrix.for = "prix" + compteur
    var inputPrix = document.createElement("input")
    inputPrix.type = "number"
    inputPrix.id = "prix" + compteur
    inputPrix.name = "prix" + compteur
    inputPrix.className = "form-control form-control-sm"
    divFormGroupPrix.appendChild(labelPrix)
    divFormGroupPrix.appendChild(inputPrix)
    divColPrix.appendChild(divFormGroupPrix)

    var divColTotal = document.createElement("div")
    divColTotal.className = "col-2"
    var divFormGroupTotal = document.createElement("div")
    divFormGroupTotal.className = "form-group"
    var labelTotal = document.createElement("label")
    labelTotal.textContent = " Prix total"
    labelTotal.for = "total" + compteur
    var inputTotal = document.createElement("input")
    inputTotal.type = "text"
    inputTotal.id = "total" + compteur
    inputTotal.name = "total" + compteur
    inputTotal.setAttribute("disabled", "disabled")
    inputTotal.className = "form-control form-control-sm totalArticle"
    divFormGroupTotal.appendChild(labelTotal)
    divFormGroupTotal.appendChild(inputTotal)
    divColTotal.appendChild(divFormGroupTotal)

    inputQuantite.addEventListener('change', function(){
        if (inputQuantite.value <= 0){
            alert('La valeur de la quantité ne peut etre négative ou nulle.')
            inputQuantite.value = ""
        }
        else{
            inputTotal.value = parseInt(inputQuantite.value * inputPrix.value)
            updateTotalGeneral()
        }
    })

    inputPrix.addEventListener('change', function(){
        if (inputPrix.value < 0){
            alert('Le prix ne peut pas etre négatif.')
            inputPrix.value = ""
        }
        else{
            inputTotal.value = parseInt(inputQuantite.value * inputPrix.value)
            updateTotalGeneral()
        }
    })

    var divColSuppr = document.createElement("div")
    divColSuppr.className = "col-1 d-flex align-items-center"
    var btnSuppr = document.createElement("button")
    btnSuppr.type ="button"
    btnSuppr.className = "btn btn-info btnSuppr"
    var iconeSuppr = document.createElement("img")
    iconeSuppr.src ="images/icones/delete.png"
    iconeSuppr.className = "menu-icone"
    btnSuppr.appendChild(iconeSuppr)
    divColSuppr.appendChild(btnSuppr)

    divRow.appendChild(divColArticle)
    divRow.appendChild(divColQuantite)
    divRow.appendChild(divColPrix)
    divRow.appendChild(divColTotal)
    divRow.appendChild(divColSuppr)
    dotations.appendChild(divRow)

    createBtnSuppr()
}

function updateArticles(){
    articles = document.getElementsByClassName("row-color")
    for (i = 0; i < articles.length; i++){
        labels = articles[i].getElementByTagName(label)
        alert(labels.length)
        
        labels[0].for = "article" + i
        labels[1].for = "quantite" + i
        lables[2].for = "prix" + i
        labels[3] = "total" + i
        select = articles[i].getElementByTagName("select")
        select[0].id = "article" + i
        select[0].name = "article" + i
    }
}

function createBtnSuppr(){
    var btnSuppr = document.getElementsByClassName("btnSuppr")
    for (i = 0; i < btnSuppr.length; i++){
        btnSuppr[i].addEventListener("click", function(e){
            e.preventDefault()
            this.parentElement.parentElement.parentElement.removeChild(this.parentElement.parentElement)
            updateTotalGeneral()
        })
    }
}


var checkPassword1 = document.getElementById("checkPassword1")
var password1 = document.getElementById("password1")
checkPassword1.addEventListener("mousedown", function(){
    checkPassword1.style.width = "35px"
    checkPassword1.style.height = "25px"
    password1.setAttribute("type", "text")
})

checkPassword1.addEventListener("mouseup", function(){
    password1.setAttribute("type", "password")
    checkPassword1.style.width = "30px"
    checkPassword2.style.height = "20px"
    password1.setAttribute("type", "password")
})

var checkPassword2 = document.getElementById("checkPassword2");
var password2 = document.getElementById("password2");
checkPassword2.addEventListener("mousedown", function(){
    checkPassword2.style.width = "35px"
    checkPassword2.style.height = "25px"
    password2.setAttribute("type", "text")
})

checkPassword2.addEventListener("mouseup", function(){
    checkPassword2.style.width = "30px"
    checkPassword2.style.height = "20px"
    password2.setAttribute("type", "password")
})

password1.addEventListener("input", function (e) {
    var mdp = e.target.value // Valeur saisie dans le champ mdp
    var longueurMdp = "faible"
    var couleurMsg = "red" // Longueur faible => couleur rouge
    if (mdp.length >= 8) {
        longueurMdp = "fort"
        couleurMsg = "green" // Longueur suffisante => couleur verte
    } else if (mdp.length >= 4) {
        longueurMdp = "moyen"
        couleurMsg = "orange" // Longueur moyenne => couleur orange
    }
    var aideMdpElt = document.getElementById("helpPassword1")
    aideMdpElt.textContent = "Mot de passe : " + longueurMdp // Texte de l'aide
    aideMdpElt.style.color = couleurMsg; // Couleur du texte de l'aide
    document.getElementById("passwordMsg").textContent = ""
})

password2.addEventListener("input", function (e) {
    var mdp = e.target.value; // Valeur saisie dans le champ mdp
    var longueurMdp = "faible"
    var couleurMsg = "red" // Longueur faible => couleur rouge
    if (mdp.length >= 8) {
        longueurMdp = "fort"
        couleurMsg = "green" // Longueur suffisante => couleur verte
    } else if (mdp.length >= 4) {
        longueurMdp = "moyen"
        couleurMsg = "orange" // Longueur moyenne => couleur orange
    }
    var aideMdpElt = document.getElementById("helpPassword2")
    aideMdpElt.textContent = "Mot de passe : " + longueurMdp // Texte de l'aide
    aideMdpElt.style.color = couleurMsg; // Couleur du texte de l'aide
    document.getElementById("passwordMsg").textContent = ""
})

password1.addEventListener("blur", function(e){
    if (password1.value.length != 0  && password2.value.length != 0){
        if( password1.value != password2.value){
            document.getElementById("passwordMsg").textContent = "Les mots de passe ne sont pas identiques."
        }
    }
})
password2.addEventListener("blur", function(e){
    if (password2.value.length != 0  && password1.value.length != 0){
        if( password2.value != password1.value){
            document.getElementById("passwordMsg").textContent = "Les mots de passe ne sont pas identiques."
        }
    }
})




/*
var quantite2 = document.querySelector('#quantite2')
var prix2 = document.querySelector('#prix2')
var total2 = document.querySelector('#total2')
quantite2.addEventListener('change', function(){
    if (quantite2.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite2.value = "" 
    }
    else{
        total2.value = parseInt(quantite2.value * prix2.value)
        updateTotalGeneral()
    }
})
prix2.addEventListener('change', function(){
    if (prix2.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix2.value = ""
    }
    else{
        total2.value = parseInt(quantite2.value * prix2.value)
        updateTotalGeneral()
    }
})

var quantite3 = document.querySelector('#quantite3')
var prix3 = document.querySelector('#prix3')
var total3 = document.querySelector('#total3')
quantite3.addEventListener('change', function(){
    if (quantite3.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite3.value = "" 
    }
    else{
        total3.value = parseInt(quantite3.value * prix3.value)
        updateTotalGeneral()
    }
})
prix3.addEventListener('change', function(){
    if (prix3.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix3.value = ""
    }
    else{
        total3.value = parseInt(quantite3.value * prix3.value)
        updateTotalGeneral()
    }
})

var quantite4 = document.querySelector('#quantite4')
var prix4 = document.querySelector('#prix4')
var total4 = document.querySelector('#total4')
quantite4.addEventListener('change', function(){
    if (quantite4.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite4.value = "" 
    }
    else{
        total4.value = parseInt(quantite4.value * prix4.value)
        updateTotalGeneral()
    }
})
prix4.addEventListener('change', function(){
    if (prix4.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix4.value = ""
    }
    else{
        total4.value = parseInt(quantite4.value * prix4.value)
        updateTotalGeneral()
    }
})

var quantite5 = document.querySelector('#quantite5')
var prix5 = document.querySelector('#prix5')
var total5 = document.querySelector('#total5')
quantite5.addEventListener('change', function(){
    if (quantite5.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite5.value = "" 
    }
    else{
        total5.value = parseInt(quantite5.value * prix5.value)
        updateTotalGeneral()
    }
})
prix5.addEventListener('change', function(){
    if (prix5.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix5.value = ""
    }
    else{
        total5.value = parseInt(quantite5.value * prix5.value)
        updateTotalGeneral()
    }
})

var quantite6 = document.querySelector('#quantite6')
var prix6 = document.querySelector('#prix6')
var total6 = document.querySelector('#total6')
quantite6.addEventListener('change', function(){
    if (quantite6.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite6.value = "" 
    }
    else{
        total6.value = parseInt(quantite6.value * prix6.value)
        updateTotalGeneral()
    }
})
prix6.addEventListener('change', function(){
    if (prix6.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix6.value = ""
    }
    else{
        total6.value = parseInt(quantite6.value * prix6.value)
        updateTotalGeneral()
    }
})

var quantite7 = document.querySelector('#quantite7')
var prix7 = document.querySelector('#prix7')
var total7 = document.querySelector('#total7')
quantite7.addEventListener('change', function(){
    if (quantite7.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite7.value = "" 
    }
    else{
        total7.value = parseInt(quantite7.value * prix7.value)
        updateTotalGeneral()
    }
})
prix7.addEventListener('change', function(){
    if (prix7.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix7.value = ""
    }
    else{
        total7.value = parseInt(quantite7.value * prix7.value)
        updateTotalGeneral()
    }
})

var quantite8 = document.querySelector('#quantite8')
var prix8 = document.querySelector('#prix8')
var total8 = document.querySelector('#total8')
quantite8.addEventListener('change', function(){
    if (quantite8.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite8.value = "" 
    }
    else{
        total8.value = parseInt(quantite8.value * prix8.value)
        updateTotalGeneral()
    }
})
prix8.addEventListener('change', function(){
    if (prix8.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix8.value = ""
    }
    else{
        total8.value = parseInt(quantite8.value * prix8.value)
        updateTotalGeneral()
    }
})

var quantite9 = document.querySelector('#quantite9')
var prix9 = document.querySelector('#prix9')
var total9 = document.querySelector('#total9')
quantite9.addEventListener('change', function(){
    if (quantite9.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite9.value = "" 
    }
    else{
        total9.value = parseInt(quantite9.value * prix9.value)
        updateTotalGeneral()
    }
})
prix9.addEventListener('change', function(){
    if (prix9.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix9.value = ""
    }
    else{
        total9.value = parseInt(quantite9.value * prix9.value)
        updateTotalGeneral()
    }
})

var quantite10 = document.querySelector('#quantite10')
var prix10 = document.querySelector('#prix10')
var total10 = document.querySelector('#total10')
quantite10.addEventListener('change', function(){
    if (quantite10.value <= 0){
        alert('La valeur de la quantité ne peut etre négative ou nulle.')
        quantite10.value = "" 
    }
    else{
        total10.value = parseInt(quantite10.value * prix10.value)
        updateTotalGeneral()
    }
})

prix10.addEventListener('change', function(){
    if (prix10.value < 0){
        alert('Le prix ne peut pas etre négatif.')
        prix10.value = ""
    }
    else{
        total10.value = parseInt(quantite10.value * prix10.value)
        updateTotalGeneral()
    }
})
*/



