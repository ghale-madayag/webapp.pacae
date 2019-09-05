$(document).ready(function (p) {
    $("#dashboard").on('click', function(){
        window.location.assign("index.html");
    })
    $("#settings").on('click', function(){
        window.location.assign("profile.html");
    })

    $("#myevent").on('click', function(){
        window.location.assign("events.html");
    })

    $("#logout").on('click', function(){
        localStorage.removeItem("id")
        window.location.assign("login.html");
    })
})

function loaderVisible(e){
    $("#"+e).empty('');
    $("#"+e).html('<span class="spinner-border spinner-border-sm" role="status" align-middle aria-hidden="false"></span>');
}

function loaderHide(e,val){
    $("#"+e).empty('');
    $("#"+e).html('<span>'+val+'</span>');
}

function msg(i,val){
   
    var msg = $(".msg").empty();
    msg.html('<div class="alert alert-'+i+' alert-dismissible fade show mt-3" role="alert">'+val+
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
            '<span aria-hidden="true">&times;</span>'+
        '</button>'+
    '</div>');
    $(".alert").css('display','block');
}

function disableBtn(btn){
    btn.html('Cancel Reservation');
    btn.removeClass('btn-success');
    btn.addClass('btn-secondary');
}

function enableBtn(btn){
    btn.html('Attend');
    btn.removeClass('btn-secondary');
    btn.addClass('btn-success');   
}
