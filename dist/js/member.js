$(document).ready(function(){
    getAllMember();
    $("form#form-member").on('submit', function(e){
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "data/member-handler.php",
            data: formData,
            cache: false,
            async: false,
            processData: false,
            contentType: false,
            success: function(data){
                console.log(data)
                // if (data==1) {
                //     $("input[type=text],input[type=number]").val("");
                //     $("#patname").val('').change();
                //     recentEsr();
                //     toastSuccess("Successfully Registered", "You added new data <a href='all-esr.php'> View All</a>");
                // }
            }
        })
        e.preventDefault();
    })
})

function getAllMember() {
    
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
            "emptyTable":     "No client available"
        },
        "ajax": {
            "url": "data/member-handler.php",
            "dataSrc": ""
        },
         "columns": [
            { "data": "id" },
            { "data": "fullname" },
			{ "data": "mobile" },
			{ "data": "email" },
            { "data": "region" },
            { "data": "position" },
            { "data": "school" },
            { "data": "schooladd" },
            { "data": "indate" },
            { "data": "status" },
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

    
    // $('input[type = search]').on( 'keyup', function () {
    //     table.column(2).search('^'+this.value, true, false).draw();
    //  } ); 

    /*------------- custom toolbar ------------*/
     $("div.toolbar").html('<div class="mailbox-controls">'+
         '<button type="button" class="btn btn-default btn-sm checkbox-toggle" title="Select All"><i class="fa fa-square"></i> Select All</button> '+
         '<div class="btn-group">'+
            '<button type="button" class="btn btn-default btn-sm" id="del" title="Delete"><i class="fa fa-trash"></i> Delete</button>'+
            '<button type="button" class="btn btn-default btn-sm" id="edit" title="Edit"><i class="fa fa-edit"></i> Edit</button>'+
			'<button type="button" class="btn btn-default btn-sm" title="Add" data-toggle="modal" data-target="#addEvent"><i class="fa fa-plus"></i> Add Member</button>'+
            '</div>'+
        '</div>');

     $("div.toolbar").css('float','left');
     $(".buttons-excel").css("display","none");

//     $("#pl-all tbody").on('click', 'tr td:not(:first-child)', function() {
//         var data = table.row(this).data();
//         var encryptedRec = CryptoJS.AES.encrypt(data.recipient_id, "My Secret Passphrase");
//         var encryptedAES = CryptoJS.AES.encrypt(data.client_id, "My Secret Passphrase");
//         window.location.replace('client-edit.php?client='+encryptedAES+'&recipient='+encryptedRec);
//    })

   
}