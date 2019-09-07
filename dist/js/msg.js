$(document).ready(function(){
    $(document).on('click', '.select-all', function (e) {
        getAllContact();
    });


    $(document).on("keyup", ".select2-search__field", function (e) {
        var eventObj = window.event ? event : e;
        if (eventObj.keyCode === 65 && eventObj.ctrlKey){
            getAllContact();
        } 
    });
    $("form#form-msg").on('submit', function(e){
        var formData = new FormData($(this)[0]);      
  
        $.ajax({
           type: "POST",
           url: "data/msg-handler.php",
           cache: false,
           data: formData,
           async: false,
           processData: false,
           contentType:false,
           success: function(data) {
                var json = $.parseJSON(data);
                $(json).each(function(i, val) {
                    if(val.status==1){
                        if(val.cnt>1){
                            toastSuccess("Message Sent", "<strong>"+val.cnt+"</strong> members successfully received the message");
                        }else{
                            toastSuccess("Message Sent", "<strong>"+val.cnt+"</strong> member successfully received the message");
                        }
                        $("input[type=text],textarea").val("");
                        $('#contact').html('');
                        getContact();
                    }else{
                        toastErr("Error!", "Message not sent");
                    }
                })
              }
        });
        
        e.preventDefault();
    });

    getContact();
});

function getContact(){
    
    $('#contact').select2({
		closeOnSelect: false,
		placeholder: "Press CTRL+A for select or unselect all contacts",
		allowHtml: true,
		allowClear: false,
		tags: true,
		ajax: {
			url: 'data/contact-search.php',
			dataType: 'json',
			quietMillis: 100,
			processResults: function (data) {
				return {
					results: $.map(data, function (obj) {
						return { id: obj.id, text: obj.contact };
					})
				};

			}
		}
	}).on('select2:selecting', e => $(e.currentTarget).data('scrolltop', $('.select2-results__options').scrollTop()))
        .on('select2:select', e => $('.select2-results__options').scrollTop($(e.currentTarget).data('scrolltop')));
    
    $('select[multiple]').siblings('.select2-container').append('<span class="select-all"></span>');
}

function getAllContact(){
    var contact = $("#contact").val();

    if(contact==0){
        $.ajax({
            type: "POST",
            url: 'data/contact-search.php',
            cache: false,
            success: function(data){
                if(data!=0){
                    var json = $.parseJSON(data);
                    $(json).each(function(i,val){
                        $('#contact').append('<option selected="selected" value='+val.id+'>'+val.contact+'</option>').trigger('change');;
                    });
                }
            }

        });
    }else{
        $('#contact').html('');
        getContact();
    }
    
}
