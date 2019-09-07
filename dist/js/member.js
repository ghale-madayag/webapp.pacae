$(document).ready(function(){
    getAllMember();
    $('[data-mask]').inputmask();
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
                if (data==1) {
                    $("#addEvent").modal('hide');
                    $("input[type=text],input[type=email]").val("");
                    $("#region").val('-1');
                    $("#position").val('-1');
                    refresh("member-all");
                    toastSuccess("Successfully Added", "You added new data");
                }else{
                    toastErr("Duplicate Entry", "Mobile number or Email address is already exist");
                }
            }
        })
        e.preventDefault();
    });

    $("form#form-member-edit").on('submit', function(e){
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
                if (data==1) {
                    $("#editModal").modal('hide');
                    $("input[type=text],input[type=email]").val("");
                    $("#region").val('-1');
                    $("#position").val('-1');
                    refresh("member-all");
                    toastSuccess("Successfully Updated", "You updated the data");
                }else{
                    toastErr("Duplicate Entry", "Mobile number or Email address is already exist");
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
                    url:"data/member-handler.php",
                    data: "get_mem="+formData,
                    cache:false,
                    success: function(data){
                        var json = $.parseJSON(data);

                        $(json).each(function(i,val){
                            $("#userid").val(formData);
                            $("#fnameEdit").val(val.fname);
                            $("#lnameEdit").val(val.lname);
                            $("#mobileEdit").val(val.mobile);
                            $("#emailEdit").val(val.email);
                            $("#regionEdit").val(val.region);
                            $("#positionEdit").val(val.position);
                            $("#schoolEdit").val(val.school);
                            $("#schooladdEdit").val(val.schooladd);
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
                        url: "data/member-handler.php",
                        data: "del=true&memId="+formData,
                        cache: false,
                        success: function(data){
                            toastSuccess("Successfully Deleted", "All data has been deleted");
                            refresh("member-all");
                        }
                    })
                });
           }
        }
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
            "emptyTable":     "No data available"
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
         '<button type="button" class="btn btn-default btn-sm checkbox-toggle" title="Select All"><i class="fa fa-square-o"></i> Select All</button> '+
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