$(document).ready(function(){
	var path = window.location.pathname;
	var page = path.split("/").pop();

	if(page=="msg-sent.php" || page == "msg-new.php"){
		$("#top-msg-body").addClass('active');
		$("#top-msg").addClass('menu-open');
		$("#messageSent").addClass('active');
		$("#top-msg .treeview-menu").css('display', 'block');
	}else if(page=="members.php"){
		$("#memberPage").addClass('active');
	}else if(page=="events.php"){
		$("#eventPage").addClass('active');
	}else{
		$("#dashboardPage").addClass('active');
	}
})
function toast(txt) {
	$.toast({
		stack: false,
	    heading: '<strong>Thank you!</strong>',
	    text: txt,
	    showHideTransition: 'slide',
	    icon: 'success',
	    bgColor: '#00A65A',
	    hideAfter: 10000,
	})
}

function toastErr(head,txt) {
	$.toast({
		stack: true,
	    heading: head,
	    text: txt,
	    showHideTransition: 'slide',
	    icon: 'error',
	    hideAfter: 10000,
	    loaderBg: '#FEC532',
	    position: 'bottom-right'
	})
}

function toastSuccess(head,txt) {
	$.toast({
		stack: true,
	    heading: head,
	    text: txt,
	    icon: 'success',
	    showHideTransition: 'slide',
	    bgColor: '#0B7542',
	    hideAfter: 10000,
	    loaderBg: '#f1f1f1',
	    position: 'bottom-right'
	})
}

function refresh(tbl) {
	$('#' + tbl).DataTable().ajax.reload(null, false);
	$('#' + tbl).on('draw.dt', function () {
	})
}

function loadSent() {
	var users = $(".products-list").empty();
	$.ajax({
	  type: 'POST',
	  url: 'data/msg-handler.php',
	  data: "all_msg=true",
	  cache: false,
	  success: function(data){
		  console.log(data)
		if(data!=0){
			var json = $.parseJSON(data);
			$(json).each(function(i,val){	
					users.append('<li class="item">'+
							'<div class="product-info">'+
						'<a href="#" class="product-title">'+val.title+' <span class="label label-success pull-right"><strong>'+val.total+'</strong> Received</span></a>'+
						'<span class="product-description">Date Sent: <strong>'+val.indate+
							'</strong></span>'+
						'</div>'+
					'</li>');
			});
		}else{
			users.append('<center><li class="item"><h4>No available data</h4></li></center>');
		}
	  }
	})
}

function infoboxPat(){
      
	$.ajax({
		type: "POST",
		url: "data/info-handler.php",
		data: "infoboxPat=true",
		cache: false,
		success: function(data){
		$("#patient-info").html(data.toLocaleString());
			count("countPat");
		}
	})
}

function countUltrasound() {
	$.ajax({
		type: "POST",
		url: "data/info-handler.php",
		data: "events=true",
		cache: false,
		success: function(data) {
			$("#countUltrasound").html(data.toLocaleString());
			count("countUltrasound");
		}
		
	})
}

function countMsg() {
	$.ajax({
		type: "POST",
		url: "data/info-handler.php",
		data: "msg=true",
		cache: false,
		success: function(data) {
			$("#countEmb").html(data.toLocaleString());
			count("countEmb");
		}
		
	})
}

function countAPI() {
	$.ajax({
		type: "POST",
		url: "data/info-handler.php",
		data: "api=true",
		cache: false,
		success: function(data) {
			
			var json = $.parseJSON(data);
			$(json).each(function(i,val) {
				$("#user-info").html(val.result.APIStatus);
			})
		}
		
	})
}


function count(param){
  $('.'+param).each(function () {
      $(this).prop('Counter',0).animate({
          Counter: $(this).text()
      }, {
          duration: 4000,
          easing: 'swing',
          step: function (now) {
              $(this).text(Math.ceil(now));
          }
      });
  });
}