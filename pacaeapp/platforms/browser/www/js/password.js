$(document).ready(function(){
    $("#pid").val(localStorage.getItem('id'));
    $("#pword").focus();
    $("form#password").on('submit', function(e){
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: "POST",
            url: "https://pacae.org/webapp.pacae/server/profile-handler.php",
            cache: false,
            data: formData,
            async: false,
            processData: false,
            contentType:false,
            beforeSend: function(){
              loaderVisible("loaderBtn");
            },
            success: function(data) {
                loaderHide("loaderBtn","Update");
                console.log(data)
                
                if(data==3){
                    msg("danger","Passwords don't match")
                }else if(data==2){
                    msg("danger","Current password doesn't match")
                }else{
                    $("input[type=password]").val("");
                    msg("success","Successfully updated")
                }
            }
          })
        e.preventDefault();
    })
})