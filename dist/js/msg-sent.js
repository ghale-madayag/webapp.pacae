$(document).ready(function(){
    getMsgSent()

    $("#del").on('click', function(){
        var len = $("input[name='selectVal']:checked").length;

        if(len==0){
            alert('Please select data');
        }else{
           var del = confirm("Are you sure you want to delete the data?");

           if(del==true){
                $.each($("input[name='selectVal']:checked"), function(){
                    var formData = $(this).val();
                    var msgId = $(this).data('msg')
                    $.ajax({
                        type: "POST",
                        url: "data/msg-handler.php",
                        data: "del="+formData+"&msgId="+msgId,
                        cache: false,
                        success: function(data){
                            console.log(data)
                            toastSuccess("Successfully Deleted", "The data has been deleted");
                            refresh("member-all");
                        }
                    })
                });
           }
        }
    })
});

function getMsgSent() {
    
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
            "emptyTable":     "No data available"
        },
        "ajax": {
            "url": "data/msg-handler.php",
            "dataSrc": ""
        },
         "columns": [
            { "data": "id" },
            { "data": "fullname" },
			{ "data": "title" },
			{ "data": "desc" },
            { "data": "status" },
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
             return '<input type="checkbox" name="selectVal" id="selectVal" value="'+data+'" data-msg="'+full.msg_id+'">';
        }
        }],
        'order': [1, 'asc']
    } );

    
    // $('input[type = search]').on( 'keyup', function () {
    //     table.column(2).search('^'+this.value, true, false).draw();
    //  } ); 

    /*------------- custom toolbar ------------*/
     $("div.toolbar").html('<div class="mailbox-controls">'+
         '<button type="button" class="btn btn-default btn-sm checkbox-toggle" title="Select All"><i class="fa fa-square-o"></i> Select All</button> '+
         '<div class="btn-group">'+
            '<button type="button" class="btn btn-default btn-sm" id="del" title="Delete"><i class="fa fa-trash"></i> Delete</button>'+
            '</div>'+
        '</div>');

     $("div.toolbar").css('float','left');
     $(".buttons-excel").css("display","none");
}