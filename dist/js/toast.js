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