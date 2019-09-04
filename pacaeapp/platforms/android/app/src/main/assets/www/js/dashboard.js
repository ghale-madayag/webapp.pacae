$(document).ready(function(){
    getLocalStorage();

    $("form#eventForm").on('submit', function(e){
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "https://pacae.org/webapp.pacae/server/dashboard-handler.php",
            cache: false,
            data: formData,
            async: false,
            processData: false,
            contentType:false,
            beforeSend: function(){
              loaderVisible("loaderBtn");
            },
            success: function(data) {

                loaderHide("loaderBtn","Yes");
                $(".eventModal").modal('hide');

                var btn = $("#btn_"+data);
                disableBtn(btn);
                
                // if(data==3){
                //     msg("danger","Passwords don't match")
                // }else if(data==2){
                //     msg("danger","Current password doesn't match")
                // }else{
                //     $("input[type=password]").val("");
                //     msg("success","Successfully updated")
                // }
            }
          })
        e.preventDefault();
    });
})

function getLocalStorage(){
    var uid = localStorage.getItem("id");
    if(uid == null){
        window.location.assign("login.html");
    }else{
        $("body").css('display','block');
        getAllEvent();
    }
}
function getAllEvent(){
    $.ajax({
        type: "POST",
        url: "https://pacae.org/webapp.pacae/server/dashboard-handler.php",
        data: "getAllEvent=true",
        cache: false,
        beforeSend: function(){
          $("#loader").css("display", "block");
        },
        success: function(data){
            $("#loader").css("display", "none");
            if(data!=""){

                var json = $.parseJSON(data);
                var event = $("#eventContainer").empty();
                $(json).each(function(i, val){
                    event.append('<div class="card my-4">'+
                    '<img src="https://pacae.org/webapp.pacae/img/'+val.img+'" class="card-img-top" alt="...">'+
                    '<div class="card-body">'+
                        '<h5 class="card-title">'+val.title+'</h5>'+
                        '<p class="card-text">'+val.desc+'</p>'+
                        '</div>'+
                        '<ul class="list-group list-group-flush">'+
                        '<li class="list-group-item"><i class="far fa-calendar-alt"></i> <span class="ml-2">'+val.eveDate+'</span></li>'+
                        '<li class="list-group-item"><i class="fas fa-map-marker-alt"></i> <span class="ml-2">'+val.location+'</span></li>'+
                        '</ul>'+
                        '<div class="card-body">'+
                        '<button class="btn btn-block btn-success" id="btn_'+val.id+'" onclick="getevent('+val.id+');">Attend</button>'+
                        '</div>'+
                        '</div>');
                })
            }
        }
    })
}

function getevent(val){
    var userId = localStorage.getItem('id');
    $("#eventId").val(val);
    $("#userId").val(userId);
    $('.eventModal').modal('show');
}
