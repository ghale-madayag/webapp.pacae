$(document).ready(function (p) {
    $("#settings").on('click', function(){
        window.location.assign("profile.html");
    })
    $("#logout").on('click', function(){
        localStorage.removeItem("id")
        window.location.assign("login.html");
    })
})