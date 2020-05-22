// Gestion de la fermeture de la page web
window.addEventListener("beforeunload", function (e) {
    var message = "Voulez-vous quitter sans enregistrer le bon ?";
    e.returnValue = message; // Provoque une demande de confirmation (standard)
    return message; // Provoque une demande de confirmation (certains navigateurs)
});