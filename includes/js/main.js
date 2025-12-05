function activate(para){
    if(para==1)
    {
        $("img.activator").css("display","block");
    }
    else
    {
        $("img.activator").css("display","none");
    }
}

function ajax_call(form_id,ajax_url,error_id,success_id,redirect_url,ajax_method,data_type){
    activate(1);
    $.ajax({
        type: ajax_method,
        url: site_url+ajax_url,
        data: $(form_id).serialize(),
        dataType: data_type,
        success: function(result){ 
            $(error_id).html('');
            $(success_id).html('');
            if(result.category == "success"){
                var url = site_url+redirect_url;
                window.location.replace(url);
            }else{
                $(error_id).html(result.message).css("color", "red");
            }
            activate(0);
        }
    });
}

$("#adminloginform").submit(function(e){
    e.preventDefault(); 
    ajax_call("#adminloginform","home/validateadmin","#admin-login-error","#admin-login-success","admin/dashboard","POST","json");
});

$("#csirlabsloginform").submit(function(e){
    e.preventDefault(); 
    ajax_call("#csirlabsloginform","home/validatecsirlabs","#csirlabs-login-error","#csirlabs-login-success","csirlabs/dashboard","POST","json");
});
