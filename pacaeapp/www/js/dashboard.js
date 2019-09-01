$(document).ready(function(){
    getAllEvent();
})

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
            console.log(data)
            $("#loader").css("display", "none");
            if(data!=""){
                var json = $.parseJSON(data);
                var event = $("#eventContainer").empty();
                $(json).each(function(i, val){
                    event.append('<div class="card my-4">'+
                    // '<img src="https://pacae.org/webapp.pacae/img/'+val.img+'" class="card-img-top" alt="...">'+
                    '<div class="card-body">'+
                        '<h5 class="card-title">'+val.title+'</h5>'+
                        '<p class="card-text">'+val.desc+'</p>'+
                        '</div>'+
                        '<ul class="list-group list-group-flush">'+
                        '<li class="list-group-item"><i class="far fa-calendar-alt"></i> <span class="ml-2">'+val.eveDate+'</span></li>'+
                        '<li class="list-group-item"><i class="fas fa-map-marker-alt"></i> <span class="ml-2">'+val.location+'</span></li>'+
                        '</ul>'+
                        '<div class="card-body">'+
                        '<a href="#" class="btn btn-block btn-success">Going</a>'+
                        '</div>'+
                        '</div>');
                })
            }
        }
    })
}