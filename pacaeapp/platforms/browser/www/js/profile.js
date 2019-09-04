$(document).ready(function(){
    var userId = localStorage.getItem('id');
    userInfo(userId);

    $("form#profile").on('submit', function(e){
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
                

                if(data==1){
                    $('#success').css('display','block');
                    $('#error').css('display','none');
                }else{
                    $('#error').css('display','block');
                    $('#success').css('display','none');
                }
            }
          })
        e.preventDefault();
    })
});

function userInfo(userId) {

    $.ajax({
        type: "POST",
        url: "https://pacae.org/webapp.pacae/server/profile-handler.php",
        data: "get_id="+userId,
        cache: false,
        success: function(data) {
            var json = $.parseJSON(data);

            $(json).each(function(i,val){
                $("#userid").val(val.id);
                $("#fname").val(val.fname);
                $("#lname").val(val.lname);
                $("#mobile").val(val.mobile);
                $("#email").val(val.email);
                $("#region").val(val.region);
                $("#position").val(val.position);
                $("#school").val(val.school);
                $("#schooladd").val(val.schooladd);
            })
        }
    })
}