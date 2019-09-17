$(document).ready(function(){
    getAllEvent();

    $("form#form-events").on('submit', function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: "POST",
            url: "data/events-handler.php",
            data: formData,
            cache: false,
            async: false,
            processData: false,
            contentType: false,
            success: function(data){
                if (data==1) {
                    $("#addEvent").modal('hide');
                    $("input[type=text],textarea,input[type=file]").val("");
                    refresh("member-all");
                    toastSuccess("Successfully Added", "You added new data");
                }else{
                    toastErr("Error", data);
                }
            }
        })
        e.preventDefault();
    });

    $("form#form-events-edit").on('submit', function(e) {
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: "POST",
            url: "data/events-handler.php",
            data: formData,
            cache: false,
            async: false,
            processData: false,
            contentType: false,
            success: function(data){

                if (data==1) {
                    $("#editModal").modal('hide');
                    $("input[type=text],textarea,input[type=file]").val("");
                    refresh("member-all");
                    toastSuccess("Successfully Updated", "You updated the data");
                }else{
                    toastErr("Error", data);
                }
            }
        })
        e.preventDefault();
    });

    $("#edit").on('click', function(){
        var len = $("input[name='selectVal']:checked").length;

        if(len==0){
            alert('Please select data');
        }else if(len>1){
            alert('Please select only one data');
        }else{
            $.each($("input[name='selectVal']:checked"), function(){ 
                var formData = $(this).val();
                $.ajax({
                    type: "POST",
                    url:"data/events-handler.php",
                    data: "get_event="+formData,
                    cache:false,
                    success: function(data){
                        var json = $.parseJSON(data);

                        $(json).each(function(i,val){
                            $("#eventId").val(formData);
                            $("#titleEdit").val(val.title);
                            $("#descEdit").val(val.desc);
                            $("#eveDateEdit").val(val.date);
                            $("#locationEdit").val(val.location);
                        });
                    }
                }) 
                $("#editModal").modal('show');
            });
        }
    });

    $("#del").on('click', function(){
        var len = $("input[name='selectVal']:checked").length;

        if(len==0){
            alert('Please select data');
        }else{
           var del = confirm("Are you sure you want to delete the data?");

           if(del==true){
                $.each($("input[name='selectVal']:checked"), function(){
                    var formData = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "data/events-handler.php",
                        data: "del="+formData,
                        cache: false,
                        success: function(data){
                            toastSuccess("Successfully Deleted", "The data has been deleted");
                            refresh("member-all");
                        }
                    })
                });
           }
        }
    })

   

});

function getAllEvent() {
    var table = $('#member-all').DataTable( {
        "dom": '<"toolbar">Bfrtip',
        "lengthChange": false,
		"ordering": false,
		"scrollX": true,
        "buttons": [
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Bahaghari.'
            },
        ],
        "language": {
            "emptyTable": "No data available"
        },
        "ajax": {
            "url": "data/events-handler.php",
            "dataSrc": ""
        },
         "columns": [
            { "data": "id" },
            { "data": "attendees" },
            { "data": "confirmed" },
            { "data": "title" },
			{ "data": "desc" },
            { "data": "date" },
            { "data": "location" },
            { "data": "indate" },
		],
		'drawCallback': function(){
			$('input[type="checkbox"]').iCheck({
			   checkboxClass: 'icheckbox_flat-green'
			});
		 },
         'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="selectVal" id="selectVal" value="'+data+'" data-rec="'+full.id+'">';
        }
        }],
        'order': [1, 'asc']
    } );

    /*------------- custom toolbar ------------*/
     $("div.toolbar").html('<div class="mailbox-controls">'+
         '<button type="button" class="btn btn-default btn-sm checkbox-toggle" title="Select All"><i class="fa fa-square-o"></i> Select All</button> '+
         '<div class="btn-group">'+
            '<button type="button" class="btn btn-default btn-sm" id="del" title="Delete"><i class="fa fa-trash"></i> Delete</button>'+
            '<button type="button" class="btn btn-default btn-sm" id="edit" title="Edit"><i class="fa fa-edit"></i> Edit</button>'+
			'<button type="button" class="btn btn-default btn-sm" title="Add" data-toggle="modal" data-target="#addEvent"><i class="fa fa-plus"></i> Add Event</button>'+
            '</div>'+
        '</div>');

     $("div.toolbar").css('float','left');
     $(".buttons-excel").css("display","none");
}

function getAllAtt(id) {
    var table = $('#events-all').DataTable( {
        "dom": '<"toolbar">Bfrtip',
        "lengthChange": false,
		"ordering": false,
		"scrollX": true,
        "buttons": [
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Bahaghari.'
            },
        ],
        "language": {
            "emptyTable": "No data available"
        },
        "ajax": {
            "url": "data/events-handler.php",
            "type": "POST",
            "data": {
                "getAtt": id
            },
            "dataSrc": "",
        },
         "columns": [
            { "data": "id" },
            { "data": "img" },
            { "data": "fullname" },
            { "data": "date" }
		],
		'drawCallback': function(){
			$('input[type="checkbox"]').iCheck({
			   checkboxClass: 'icheckbox_flat-green'
			});
		 },
         'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="selectValApp" id="selectValApp" value="'+data+'" data-rec="'+full.id+'">';
        }
        }]
    } );

    $("#getAttendees div.toolbar").html('<div class="mailbox-controls">'+
         '<button type="button" class="btn btn-default btn-sm selectApp" title="Select All"><i class="fa fa-square-o"></i> Select All</button> '+
         '<div class="btn-group">'+
            '<button type="button" class="btn btn-default btn-sm" id="decline" title="Decline"><i class="fa fa-thumbs-down"></i> Decline</button>'+
            '<button type="button" class="btn btn-default btn-sm" id="approved" title="Approved"><i class="fa fa-thumbs-up"></i> Approved</button>'+
            '</div>'+
        '</div>');

     $("#getAttendees div.toolbar").css('float','left');
     $(".buttons-excel").css("display","none");

    $(document).on('shown.bs.modal', '#getAttendees', function () {
        table.columns.adjust();
    });

    
}

function getAllConf(id, title) {
    var table = $('#eventsCon-all').DataTable( {
        "dom": '<"toolbar">Bfrtip',
        "lengthChange": false,
		"ordering": false,
		"scrollX": true,
        "buttons": [
            {
                extend: 'excel',
                messageTop: title,
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
        ],
        "language": {
            "emptyTable": "No data available"
        },
        "ajax": {
            "url": "data/events-handler.php",
            "type": "POST",
            "data": {
                "getConf": id
            },
            "dataSrc": "",
        },
         "columns": [
            { "data": "img" },
            { "data": "fullname" },
            { "data": "contact" },
            { "data": "email" },
            { "data": "designation" },
            { "data": "school" },
            { "data": "schoolAdd" },
            { "data": "date" }
		],
		'drawCallback': function(){
			$('input[type="checkbox"]').iCheck({
			   checkboxClass: 'icheckbox_flat-green'
			});
		 }
    } );

    $("#getConfirmed div.toolbar").html('<div class="mailbox-controls">'+
    '<button type="button" class="btn btn-default btn-sm" id="export" title="Export"><i class="fa fa-cloud-download"></i> Export to Excel</button>'+
        '</div>');

     $("#getConfirmed div.toolbar").css('float','left');
     $(".buttons-excel").css("display","none");

    $(document).on('shown.bs.modal', '#getConfirmed', function () {
        table.columns.adjust();
    });

    $('#export').click(function(){ console.log('h'); $('#getConfirmed .buttons-excel').click(); });
}

function getConf(id,title){
    getAllConf(id,title);
    $("#titConf").html(title);
    $("#getConfirmed").modal('show');
}

function getAtt(id,title){
    getAllAtt(id);
    $("#titAtt").html(title);
    $("#getAttendees").modal('show');

    $(".selectApp").click(function () {

      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".events-all input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".events-all input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    $("#approved").on('click', function(){
        var len = $("input[name='selectValApp']:checked").length;

        if(len==0){
            alert('Please select data');
        }else{
           var del = confirm("Are you sure you want to approved?");

           if(del==true){
                $.each($("input[name='selectValApp']:checked"), function(){
                    var formData = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "data/events-handler.php",
                        data: "approved="+formData,
                        cache: false,
                        success: function(data){
                            $('#getAttendees').modal('hide');
                            toastSuccess("Successfully Approved", "The data has been approved");
                            refresh("member-all");
                        }
                    })
                });
           }
        }
    })

    $("#decline").on('click', function(){
        var len = $("input[name='selectValApp']:checked").length;

        if(len==0){
            alert('Please select data');
        }else{
           var del = confirm("Are you sure you want to decline?");

           if(del==true){
                $.each($("input[name='selectValApp']:checked"), function(){
                    var formData = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "data/events-handler.php",
                        data: "decline="+formData,
                        cache: false,
                        success: function(data){
                            $('#getAttendees').modal('hide');
                            toastSuccess("Decline", "The data has been decline");
                            refresh("member-all");
                        }
                    })
                });
           }
        }
    })
} 

$('#getAttendees').on('hidden.bs.modal', function() {
    $('#events-all').DataTable().destroy();
});

$('#getConfirmed').on('hidden.bs.modal', function() {
    $('#eventsCon-all').DataTable().destroy();
});