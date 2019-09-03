$(document).ready(function(){
    var userId = localStorage.getItem('id');
    userInfo(userId);
});

function userInfo(userId) {
    $.ajax({
        type: "POST",
        url: "https://pacae.org/webapp.pacae/server/profile-handler.php",
        data: "get_id="+userId,
        cache: false,
        success: function(data) {
            console.log(data);
        }
    })
}