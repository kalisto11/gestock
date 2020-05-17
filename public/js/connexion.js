var checkPassword = document.getElementById("checkPassword");
var password = document.getElementById("password");
checkPassword.addEventListener("mousedown", function(){
    checkPassword.style.width = "35px";
    checkPassword.style.height = "35px";
    password.setAttribute("type", "text");
});
checkPassword.addEventListener("mouseup", function(){
    checkPassword.style.width = "30px";
    checkPassword.style.height = "30px";
    password.setAttribute("type", "password");
});