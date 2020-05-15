setInterval(function(){
    if(document.getElementById("reset").checked == true){
        document.getElementById("hiddenBlock").style.display = "block";
    }
    else{
        document.getElementById("hiddenBlock").style.display = "none"; 
    }
}, 500);