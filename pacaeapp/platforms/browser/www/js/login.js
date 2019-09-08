$(document).ready(function() {
  $("form#login").on('submit', function(e){
    var formData = new FormData($(this)[0]);

      $.ajax({
        type: "POST",
        url: "https://pacae.org/webapp.pacae/server/login-handler.php",
        //url: "http://localhost/webapp.pacae/server/login-handler.php",
        cache: false,
        data: formData,
        async: false,
        processData: false,
        contentType:false,
        beforeSend: function(){
          //$("#loader").css("display", "block");
          
          loaderVisible("loaderBtn");

        },
        success: function(data) {
          //$("#loader").css("display", "none");
          loaderHide("loaderBtn","Sign in");
            var json = $.parseJSON(data);

            if(data!=0){
              $(json).each(function(i, val){
                if(val.status==1){
                  localStorage.setItem("id", val.id);
                  window.location.assign("index.html");
                }
              })
            }else{
              $("#errorLogin").css("display","block");
              $("#errorLogin").html("<p>Invalid email or password</p>");
            }
        }
      })
    e.preventDefault();
  })
  $("#signUp").on('click', function(e){
    window.location.assign('register.html');
  });
});