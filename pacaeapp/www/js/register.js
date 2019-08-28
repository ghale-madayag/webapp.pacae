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
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
}

function validateForm() {

    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = $(".tab");
    y = x[currentTab].getElementsByTagName("input");
    z = x[currentTab].getElementsByClassName("invalid-feedback");
    // A loop that checks every input field in the current tab:
    
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        z[i].className += " was-validated";
        // and set the current valid status to false
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

    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      $(".step").eq(currentTab).addClass("finish");
    }
    return valid; // return the valid status
  }

function nextPrev(n){

    var x = $(".tab");
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x.eq(currentTab).css("display", "none");
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        $("#regForm").trigger();
        return false;
    }
    showTab(currentTab);
}

function fixStepIndicator(n){

    var i, x = $(".step");
    
    for(i = 0; i < x.length; i++){
        x.eq(i).removeClass("active");
        //console.log('hi');
    }
    x.eq(n).addClass('active');
    //x[n].className += " active";
}

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}