/**
 * Ce fichier est utilisé par les formulaires de création et de modification de bons
 */
createBtnSuppr()

var compteur = nbreArticles()

var btnAdd = document.getElementById("btnAdd")
btnAdd.addEventListener("click", function(e){
  var articles = document.getElementsByClassName("row-color")
  createArticle()
  cptArticles++
})

var rows = document.getElementsByClassName("row-color")
for (i = 1; i <= rows.length; i++){
    var idQuantite = "quantite" + i
    var idPrix = "prix" + i 

    document.getElementById(idQuantite).addEventListener("change", function(){
        if (this.value <= 0){
            alert('La valeur de la quantité ne peut etre négative ou nulle.')
            this.value = 0
        }
        else{
            var id = this.id
            var num = id.charAt(id.length - 1)
            var idPrix = "prix" + num
            var idTotal = "total" + num
            document.getElementById(idTotal).value = parseInt(this.value * document.getElementById(idPrix).value)
            updateTotalGeneral()
        }
    })

    document.getElementById(idPrix).addEventListener("change", function(){
        if (this.value <= 0){
            alert('La valeur de la quantité ne peut etre négative ou nulle.')
            this.value = 0
        }
        else{
            var id = this.id
            var num = id.charAt(id.length - 1)
            var idQuantite = "quantite" + num
            var idTotal = "total" + num
            document.getElementById(idTotal).value = parseInt(this.value * document.getElementById(idQuantite).value)
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
    if (typeof(totalGeneral.innerHTML) != int){
        totalGeneral.innerHTML = 0
    }
}


function nbreArticles(){
    return document.getElementsByClassName("row-color").length
}

function createArticle(){
    var numArticle = compteur + 1
    compteur = numArticle
    var dotations = document.getElementById("dotations")
    selects = document.getElementsByTagName("select")
    var articles = document.createElement("select")

    var divRow = document.createElement("div")
    divRow.className = "row row-color m-2"

    var divColArticle = document.createElement("div")
    divColArticle.className = "col-3"

    var divFormGroupArticle = document.createElement("div")
    divFormGroupArticle.className = "form-group"

    var labelArticle = document.createElement("label")
    labelArticle.htmlFor = "article" + numArticle
    labelArticle.textContent = "Article"

    articles.innerHTML = selects[1].innerHTML
    var options = articles.getElementsByTagName("option")
    for (i = 0; i < options.length; i++){
        if (options[i].selected = "selected"){
            options[i].selected = ""
        }
    }
    articles.className = "form-control form-control-sm"
    articles.name = "article" + numArticle
    articles.id = "article" + numArticle

    divFormGroupArticle.appendChild(labelArticle)
    divFormGroupArticle.appendChild(articles)
    divColArticle.appendChild(divFormGroupArticle)

    var divColQuantite = document.createElement("div")
    divColQuantite.className = "col-3"
    var divFormGroupQuantite = document.createElement("div")
    divFormGroupQuantite.className = "form-group"
    var labelQuantite = document.createElement("label")
    labelQuantite.textContent = "Quantité"
    labelQuantite.htmlFor = "quantite" + numArticle
    var inputQuantite = document.createElement("input")
    inputQuantite.type = "number"
    inputQuantite.id = "quantite" + numArticle
    inputQuantite.name = "quantite" + numArticle
    inputQuantite.value = 0
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
    labelPrix.htmlFor = "prix" + numArticle
    var inputPrix = document.createElement("input")
    inputPrix.type = "number"
    inputPrix.id = "prix" + numArticle
    inputPrix.name = "prix" + numArticle
    inputPrix.value = 0
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
    labelTotal.htmlFor = "total" + numArticle
    var inputTotal = document.createElement("input")
    inputTotal.type = "text"
    inputTotal.id = "total" + numArticle
    inputTotal.name = "total" + numArticle
    inputTotal.value = 0
    inputTotal.setAttribute("disabled", "disabled")
    inputTotal.className = "form-control form-control-sm totalArticle"
    divFormGroupTotal.appendChild(labelTotal)
    divFormGroupTotal.appendChild(inputTotal)
    divColTotal.appendChild(divFormGroupTotal)

    inputQuantite.addEventListener('change', function(){
        if (inputQuantite.value <= 0){
            alert('La valeur de la quantité ne peut etre négative ou nulle.')
            inputQuantite.value = 0
        }
        else{
            inputTotal.value = parseInt(inputQuantite.value * inputPrix.value)
            updateTotalGeneral()
        }
    })

    inputPrix.addEventListener('change', function(){
        if (inputPrix.value < 0){
            alert('Le prix ne peut pas etre négatif.')
            inputPrix.value = 0
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
    btnSuppr.className = "btn btnSuppr"
    var iconeSuppr = document.createElement("img")
    iconeSuppr.src ="images/icones/delete.png"
    iconeSuppr.title = "Supprimer l'article"
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
        btnSuppr[i].removeEventListener("click", function(){})
        btnSuppr[i].addEventListener("click", function(e){
            e.preventDefault()
            var numberArticle = nbreArticles()
            if (numberArticle > 1){
                this.parentElement.parentElement.parentElement.removeChild(this.parentElement.parentElement)
                updateTotalGeneral()
            }
        })
    }
}
