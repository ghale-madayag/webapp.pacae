$(document).ready(function() {
  $("form#login").on('submit', function(e){
    var formData = new FormData($(this)[0]);

    $.ajax({
			type: "POST",
			url: "https://pacae.org/webapp.pacae/server/login-handler.php",
			cache: false,
			data: formData,
			async: false,
			processData: false,
			contentType:false,
			success: function(data) {
          if(data==1){
            localStorage.setItem("id", "2");
            window.location.assign("dashboard.html");
          }else{
            $("#errorLogin").css("display","block");
            $("#errorLogin").html("Invalid email or password");
          }
      }
		})
    e.preventDefault();
  })
  $("#signUp").on('click', function(e){
    window.location.assign('register.html');
  });
});