$(document).ready(function(){
    getMyEvent();
})

function getMyEvent(){
    var userId = localStorage.getItem('id');
    $.ajax({
        type: "POST",
        url: "https://pacae.org/webapp.pacae/server/event-handler.php",
        data: "getMyEvent=true&userId="+userId,
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
                    var btnRes, btnTxt;
                    if(val.attend==1){
                        btnRes = 'secondary';
                        btnTxt = 'Cancel Reservation';
                    }else{
                        btnRes = 'success';
                        btnTxt = 'Attend';
                    }
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
                        '<button class="btn btn-block btn-'+btnRes+'" id="btn_'+val.id+'" onclick="getevent('+val.id+');">'+btnTxt+'</button>'+
                        '</div>'+
                        '</div>');
                })
            }
        }
    })
}