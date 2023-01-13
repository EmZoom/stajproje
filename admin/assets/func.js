function formAjaxCall(formId,file=""){
        var responseForm ='';
        var post_url = $(formId).attr("action");  
        var request_method = $(formId).attr("method");  

        var form_data  = new FormData();  
        var formSerial = $(formId).serializeArray();
        var indexArr   = {};
        
        $.map(formSerial , function (n,i){
            indexArr[n['name']] = n['value'];
        });

        $.each(indexArr, function(key, item){
            form_data.append(key, item);
        });

        if(file != ""){
            form_data.append('file',file);
        }

        $.ajax({
            url : post_url,
            type: request_method,
            data : form_data,
            contentType: false,
            cache: false,
            processData:false,
            async:false,
        }).done(function(response){ //sonucun geleceği alan
            responseForm = JSON.parse(response);
           
        });

        return responseForm;
    
}

function aktifPasif(){
    $('input[id^="aktif_mi"]').click(function(){
        var dataid = $(this).attr("data-id");
        if($(this).prop("checked") == true){
            var aktif = 1;
        }
        else{
            var aktif = 0;
        }

        $.ajax({
                type: 'POST',
                url: "blogcontrol.php",
                data: {
                aktif: aktif,
                dataid: dataid,
                'cmd':'kategoriackapa'
                },
                success: function (response) {
                    var response = JSON.parse(response);
                    if(response.status == 'error'){
                        swal('HATA',response.message,'warning');
                    }
                    else if(response.status == 'ok'){
                        swal('BAŞARI',response.message,'success');
                    }
                }
                });


    });
}