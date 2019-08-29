$(document).ready(function() {
    showTab(currentTab);
});
var currentTab = 0;
function showTab(n) {
    var x = $(".tab");
    x.eq(n).css('display','block');

    if (n==0) {
        $("#prevBtn").css('display','none');
    }else{
        $("#prevBtn").css('display','inline');
    }

    if (n == (x.length - 1)) {
        $("#nextBtn").html("Finish");
      } else {
        $("#nextBtn").html("Next");
      }
      fixStepIndicator(n)
}

function validateForm() {


    var x, y, i, valid = true;
    x = $(".tab");
    y = x[currentTab].getElementsByTagName("input");
    z = x[currentTab].getElementsByClassName("invalid-feedback");

    
    for (i = 0; i < y.length; i++) {

      if (y[i].value == "") {

        y[i].className += " invalid";
        z[i].className += " was-validated";

        valid = false;
      }else{
        y[i].classList.remove("invalid");
        z[i].classList.remove("was-validated");
      }
    }

    if(currentTab==1){
      var email = $("#email").val();
      var pword = $("#pword").val();
      var cpword = $("#cpword").val();

      if(pword!=""){
        if(pword.length<6){
          $("#pword").addClass("invalid");
          $("#pwordfb").addClass("was-validated");
          $("#pwordfb").html("Please enter atleast 6 characters");
        }
      }

      if(pword!=cpword){
        $("#cpword").addClass("invalid");
        $("#cpwordfb").addClass("was-validated");
        $("#cpwordfb").html("Password does not match");
        valid = false;
      }

      if( !validateEmail(email)) {
        $("#email").addClass('invalid');
        $("#emailfb").addClass('was-validated');
        valid = false;
      }
    }

    if (valid) {
      $(".step").eq(currentTab).addClass("finish");
    }
    return valid; 
  }

function nextPrev(n){

    var x = $(".tab");
    if (n == 1 && !validateForm()) return false;
    x.eq(currentTab).css("display", "none");
    currentTab = currentTab + n;

    if (currentTab >= x.length) {
        submitForm();
        return false;
    }
    showTab(currentTab);
}

function fixStepIndicator(n){

    var i, x = $(".step");
    
    for(i = 0; i < x.length; i++){
        x.eq(i).removeClass("active");
    }
    x.eq(n).addClass('active');
}

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

function submitForm(){
  $("#stepContainer").css('display','none');
  var formData = $("#form-register").serialize();
  
    $.ajax({
        type: "POST",
        url: "http://localhost/webapp.pacae/server/register-handler.php",
        data: formData,
        cache: false,
        beforeSend: function(){
          $("#loader").css("display", "block");
          $(".footer").css("display", "none");
        },
        success: function(data){
            $("#loader").css("display", "none");
            if(data==1){
                $(".form-signin").css("display", "none");
                $("#thankyou").css("display", "block");
            }else{
                //toastSuccess("Successfully Updated", "Patient information successfully updated")
            }
        }
    })
}