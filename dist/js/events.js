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
            { "data": "count" },
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