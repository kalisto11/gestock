checkPassword1 = document.getElementById("checkPassword1");
password1 = document.getElementById("password1");
checkPassword1.addEventListener("mousedown", function(){
    checkPassword1.style.width = "35px";
    checkPassword1.style.height = "35px";
    password1.setAttribute("type", "text");
});
checkPassword1.addEventListener("mouseup", function(){
    checkPassword1.style.width = "30px";
    checkPassword1.style.height = "30px";
    password1.setAttribute("type", "password");
});

checkPassword2 = document.getElementById("checkPassword2");
password2 = document.getElementById("password2");
checkPassword2.addEventListener("mousedown", function(){
    checkPassword2.style.width = "35px";
    checkPassword2.style.height = "35px";
    password1.setAttribute("type", "text");
});
checkPassword2.addEventListener("mouseup", function(){
    checkPassword2.style.width = "30px";
    checkPassword2.style.height = "30px";
    password2.setAttribute("type", "password");
});
