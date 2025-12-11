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

/* Group IV start */

$("#group-four-junior-scientist").submit(function(e){
    activate(1);
    event.preventDefault();
    var formData = new FormData($('#group-four-junior-scientist')[0]);

    $.ajax({
        url: site_url+"csirlabs/groupfourjuniorscientist", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result){ 
            var res = JSON.parse(result);
            if(res.category == "Success"){
                alert(res.message);
                var url = site_url+"csirlabs/groupfour";
                window.location.replace(url);
                activate(0);    
            }else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
            }
        }
    });

});

function check_non_verified(ref){
	var number_of_verified = $(ref).val();
	if(number_of_verified == ''){
		$(ref).val(0);
	}
	if(number_of_verified>0){
		$('#non-verification-reason-div').show();
	}else{
		$('#non-verification-reason-div').hide();
		$('#non_verification_reason').val('');
	}
}

/* Group IV end */

/* Form Data Entry Start */

function checkformdata(formid, designation, paylevel){
	let maninposition = "maninposition-"+formid+"-"+designation+"-"+paylevel;
	let maninpositionvalue = $("#"+maninposition).val();
	alert(maninpositionvalue);
}

/* Form Data Entry End */

/* Sanctioned Strength Start */

$("form[name='sanctioned-strength-form']").submit(function(event) {
 
    event.preventDefault();

    //var formData = $(this).serialize();
    var formData = new FormData($(this)[0]);
    $.ajax({
        url: site_url+"csirlabs/sanctionedstrengthdata", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false, 
        success: function(result) {
            var res = JSON.parse(result);
            if(res.category == "Success"){
                alert(res.message);
                var url = site_url+"csirlabs/updateformdata/"+res.formid;
                window.location.replace(url);
                activate(0);    
            }else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
            }
        }
    });
});

/* Sanctioned Strength End */

$("#addemployee-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#addemployee-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitemployee", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			if(res.category == "Success"){
				var url = site_url+"csirlabs/dashboard";
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

$("#editemployee-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#editemployee-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submiteditemployee", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			if(res.category == "Success"){
				alert(res.message)
				var url = site_url+"csirlabs/editemployee/"+res.participantid;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});


$("#csirlabs-password-change-form").submit(function(e){
	activate(1);
	event.preventDefault();
	$.ajax({
		url: site_url+"csirlabs/changepassword", 
		type: 'POST',
		data: $('#csirlabs-password-change-form').serialize(),
		success: function(result){ 
			var res = JSON.parse(result);
			$('.csirlabs-password-change-success-message').html('');
			$('.csirlabs-password-change-error-message').html('');
			if(res.category == "Success"){
				$('.csirlabs-password-change-success-message').html(res.message);
				activate(0);	
			}else{
				$('.csirlabs-password-change-error-message').html(res.message);
				activate(0);
			}
		}
	});
});


/**************Feedback Section Start***************************/

$("#add-feedback-form").submit(function(e){
	activate(1);
	event.preventDefault();
	$.ajax({
		url: site_url+"csirlabs/addfeedback", 
		type: 'POST',
		data: $('#add-feedback-form').serialize(),
		success: function(result){ 
			var res = JSON.parse(result);
			$('.add-feedback-success-message').html('');
			$('.add-feedback-error-message').html('');
			if(res.category == "Success"){
				$('.add-feedback-success-message').html(res.message);
				activate(0);	
			}else{
				$('.add-feedback-error-message').html(res.message);
				activate(0);
			}
		}
	});
});

function addfeedback(ref){
	var id = ref.id;
	$('#feedbackid').val(id);
	$("#feedbackform").modal('show');
}

/**************Feedback Section End***************************/

$(document).ready(function () {

	/**************Admin Sidebar **************/
	$(".submenu-toggle").on("click", function (e) {
		e.preventDefault();

		if (!$(".admin-sidebar").hasClass("fliph")) {
			let parent = $(this).closest(".nav-item");
			parent.toggleClass("open");
			parent.children(".sub-menu").slideToggle(200);
		}
	});

	let currentUrl = window.location.href.split(/[?#]/)[0];

	$(".admin-sidebar a").each(function () {
		let linkUrl = this.href.split(/[?#]/)[0];

		if (currentUrl === linkUrl) {
			$(this).addClass("active");

			let parentItem = $(this).closest(".nav-item.has-submenu");
			if (parentItem.length) {
				parentItem.addClass("open");
				parentItem.children(".sub-menu").show();
			}
		}
	});

	$(".nav-item.has-submenu").hover(
		function () {
			if ($(".admin-sidebar").hasClass("fliph")) {
				$(this).children(".sub-menu")
					.stop(true, true)
					.fadeIn(150);
			}
		},
		function () {
			if ($(".admin-sidebar").hasClass("fliph")) {
				$(this).children(".sub-menu")
					.stop(true, true)
					.fadeOut(150);
			}
		}
	);

	$("#toggleSidebar").on("click", function () {
		$(".admin-sidebar").toggleClass("fliph");
	});
	/**************Admin Sidebar **************/

    /**************Datepicker Section Start ***************************/

    $('#date-of-arrival').datepicker({
		format: 'dd-mm-yyyy', 
		autoclose: true     
	});
	$('#date-of-departure').datepicker({
		format: 'dd-mm-yyyy', 
		autoclose: true     
	});

	/**************Datepicker Section End ***************************/

});

/*******************************Start Vacancy Section*******************************************/
$("#addvacancies-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#addvacancies-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitvacancies", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 

			var res = JSON.parse(result);

			if(res.category == "Success"){
				var url = site_url+"csirlabs/backlogvacancies";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "detailerror"){
        		alert(res.message);
				var url = site_url+"csirlabs/updatedetail";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "error"){
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);	
			}
		}
	});
});

$("#editvacancies-edit-vacancies-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#editvacancies-edit-vacancies-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/editvacancies", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			$("#editvacancies-edit-vacancies-success").html('');
			$("#editvacancies-edit-vacancies-error").html('');
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/editvacanciesform/"+res.vacancy_id;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

/*******************************End Vacancy Section*******************************************/


/*******************************Start Probity Portal Data*******************************************/

$("#probityportalform-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#probityportalform-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitprobityportal", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 

			var res = JSON.parse(result);

			if(res.category == "Success"){
				var url = site_url+"csirlabs/probityportal";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "detailerror"){
        		alert(res.message);
				var url = site_url+"csirlabs/updatedetail";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "error"){
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);	
			}
		}
	});
});

$("#editprobityportalform-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#editprobityportalform-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submiteditprobityportal", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			$("#editprobityportalform-edit-vacancies-success").html('');
			$("#editprobityportalform-edit-vacancies-error").html('');
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/editprobityportal/"+res.probityportal_id;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

/*******************************End Probity Portal Data*******************************************/

/*******************************Start Proforma*******************************************/
$("#proformaform-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#proformaform-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitproforma", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 

			var res = JSON.parse(result);

			if(res.category == "Success"){
				var url = site_url+"csirlabs/proforma";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "detailerror"){
        		alert(res.message);
				var url = site_url+"csirlabs/updatedetail";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "error"){
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);	
			}
		}
	});
});

function calculate_total_employees(){
	var groupa = $("#total_employees_group_a").val();
	var groupb = $("#total_employees_group_b").val();
	var groupc = $("#total_employees_group_c").val();
	var groupd = $("#total_employees_group_d").val();
	var total = parseInt(groupa) + parseInt(groupb) + parseInt(groupc) + parseInt(groupd);
	$("#total_employees").val(total);
}

function calculate_total_employed(){
	var groupa = $("#total_employed_group_a").val();
	var groupb = $("#total_employed_group_b").val();
	var groupc = $("#total_employed_group_c").val();
	var groupd = $("#total_employed_group_d").val();
	var total = parseInt(groupa) + parseInt(groupb) + parseInt(groupc) + parseInt(groupd);
	$("#total_employed").val(total);
}

function calculate_total_minority_employed(){
	var groupa = $("#total_minority_employed_group_a").val();
	var groupb = $("#total_minority_employed_group_b").val();
	var groupc = $("#total_minority_employed_group_c").val();
	var groupd = $("#total_minority_employed_group_d").val();
	var total = parseInt(groupa) + parseInt(groupb) + parseInt(groupc) + parseInt(groupd);
	$("#total_minority_employed").val(total);
}

$("#editproformaform-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#editproformaform-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submiteditproforma", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			$("#editproformaform-edit-vacancies-success").html('');
			$("#editproformaform-edit-vacancies-error").html('');
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/editproforma/"+res.proforma_id;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

/*******************************End Proforma*******************************************/

/**************************Qualifying service start************************************/
$("#qualifyingserviceform-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#qualifyingserviceform-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitqualifyingservice", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 

			var res = JSON.parse(result);

			if(res.category == "Success"){
				var url = site_url+"csirlabs/qualifyingservice";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "detailerror"){
        		alert(res.message);
				var url = site_url+"csirlabs/updatedetail";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "error"){
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);	
			}
		}
	});
});

$("#editqualifyingservice-edit-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#editqualifyingservice-edit-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submiteditqualifyingservice", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			$("#editqualifyingservice-edit-data-success").html('');
			$("#editqualifyingservice-edit-data-error").html('');
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/editqualifyingservice/"+res.qualifyingservice_id;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

function check_non_verified(ref){
	var number_of_verified = $(ref).val();
	if(number_of_verified == ''){
		$(ref).val(0);
	}
	if(number_of_verified>0){
		$('#non-verification-reason-div').show();
	}else{
		$('#non-verification-reason-div').hide();
		$('#non_verification_reason').val('');
	}
}
/**************************Qualifying service end************************************/

/**************************Half-yearly report start************************************/
$("#halfyearlyreportform-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#halfyearlyreportform-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submithalfyearlyreport", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){

			var res = JSON.parse(result);

			if(res.category == "Success"){
				var url = site_url+"csirlabs/halfyearlyreport";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "detailerror"){
        		alert(res.message);
				var url = site_url+"csirlabs/updatedetail";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "error"){
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);	
			}
		}
	});
});

$("#edithalfyearlyreport-edit-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#edithalfyearlyreport-edit-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitedithalfyearlyreport", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			$("#edithalfyearlyreport-edit-data-success").html('');
			$("#edithalfyearlyreport-edit-data-error").html('');
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/edithalfyearlyreport/"+res.halfyearlyreport_id;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});
/**************************Half-yearly report End************************************/

/**************************MMR Start************************************/
$("#mmrform-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#mmrform-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitmmrform", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 

			var res = JSON.parse(result);

			if(res.category == "Success"){
				var url = site_url+"csirlabs/mmr";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "detailerror"){
        		alert(res.message);
				var url = site_url+"csirlabs/updatedetail";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "error"){
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);	
			}
		}
	});
});

$("#mmrform-add-nil-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#mmrform-add-nil-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitmmrnilform", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){

			var res = JSON.parse(result);

			if(res.category == "Success"){
				var url = site_url+"csirlabs/mmr";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "detailerror"){
        		alert(res.message);
				var url = site_url+"csirlabs/updatedetail";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "error"){
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);	
			}
		}
	});
});

$("#editmmr-edit-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#editmmr-edit-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submiteditmmr", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			$("#editmmr-edit-data-success").html('');
			$("#editmmr-edit-data-error").html('');
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/editmmr/"+res.mmr_id;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

$(document).ready(function() {
    $('#mmr-add-new-detail').click(function(e) {
    	e.preventDefault();
	    var clonedItem = $('#mmr-entry-fields').clone();

        var taskcodeInput = clonedItem.find('input[name="taskcode[]"]');
        taskcodeInput.val("Issue of Promotion Orders Offer");

        var nameInput = clonedItem.find('input[name="name[]"]');
        nameInput.val("");

        var genderInput = clonedItem.find('input[name="gender[]"]');
        genderInput.val("Male");

        var emailInput = clonedItem.find('input[name="email[]"]');
        emailInput.val("");

        var mobilenumberInput = clonedItem.find('input[name="mobile_number[]"]');
        mobilenumberInput.val("");

        var designationInput = clonedItem.find('input[name="designation[]"]');
        designationInput.val("");

        var paylevelInput = clonedItem.find('input[name="paylevel[]"]');
        paylevelInput.val("1");

        var groupcodeInput = clonedItem.find('input[name="groupcode[]"]');
        groupcodeInput.val("A");

        var categorycodeInput = clonedItem.find('input[name="categorycode[]"]');
        categorycodeInput.val("SC");

        var appointordernoInput = clonedItem.find('input[name="appointorderno[]"]');
        appointordernoInput.val("");

        var remarksInput = clonedItem.find('input[name="remarks[]"]');
        remarksInput.val("");

	    $('#mmr-entry-section').append(clonedItem);
	    clonedItem.append('<div class="col-md-12 text-right"><button class="btn btn-sm btn-danger removemmrentry">Remove Employee Details</button></div><div class="col-md-12"><hr style="border-top: 1px solid #fff;"></div>');
    });

    $('#mmr-entry-section').on('click', 'button.removemmrentry', function(e) {
    	e.preventDefault();
        $(this).closest('.row').remove();
    });

});

/**************************MMR End************************************/

/**************************Annexure-III Start************************************/
$("#annexure3form-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#annexure3form-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitannexure3", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 

			var res = JSON.parse(result);

			if(res.category == "Success"){
				var url = site_url+"csirlabs/annexure3";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "detailerror"){
        		alert(res.message);
				var url = site_url+"csirlabs/updatedetail";
				window.location.replace(url);
				activate(0);	
			}

			if(res.category == "error"){
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);	
			}
		}
	});
});

$("#annexure3editform-add-data-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#annexure3editform-add-data-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submiteditannexure3", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			$("#editmmr-edit-data-success").html('');
			$("#editmmr-edit-data-error").html('');
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/annexure3editform/"+res.annexure3_id;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

function handleInputChange() {
	let inputElements = $('input[name="'+this.name+'"]');

	let total = parseInt($(inputElements[0]).val())+parseInt($(inputElements[1]).val())+parseInt($(inputElements[2]).val())+parseInt($(inputElements[3]).val());

	$(inputElements[4]).val(total);

	if(this.name == "sanctioned_strength[]" || this.name == "person_in_position[]" || this.name == "direct_recruitement[]" || this.name == "promotion[]"){
		let sanctionedStrengthInputElements = $('input[name="sanctioned_strength[]"]');
		let personInPositionInputElements = $('input[name="person_in_position[]"]');
		let directRecruitementInputElements = $('input[name="direct_recruitement[]"]');
		let promotionInputElements = $('input[name="promotion[]"]');
		let totalInputElements = $('input[name="total[]"]');
		
		let groupa_total_value = parseInt($(sanctionedStrengthInputElements[0]).val())+parseInt($(personInPositionInputElements[0]).val())+parseInt($(directRecruitementInputElements[0]).val())+parseInt($(promotionInputElements[0]).val());
		let groupb_total_value = parseInt($(sanctionedStrengthInputElements[1]).val())+parseInt($(personInPositionInputElements[1]).val())+parseInt($(directRecruitementInputElements[1]).val())+parseInt($(promotionInputElements[1]).val());
		let group_b_non_total_value = parseInt($(sanctionedStrengthInputElements[2]).val())+parseInt($(personInPositionInputElements[2]).val())+parseInt($(directRecruitementInputElements[2]).val())+parseInt($(promotionInputElements[2]).val());
		let groupc_total_value = parseInt($(sanctionedStrengthInputElements[3]).val())+parseInt($(personInPositionInputElements[3]).val())+parseInt($(directRecruitementInputElements[3]).val())+parseInt($(promotionInputElements[3]).val());

		$(totalInputElements[0]).val(groupa_total_value);
		$(totalInputElements[1]).val(groupb_total_value);
		$(totalInputElements[2]).val(group_b_non_total_value);
		$(totalInputElements[3]).val(groupc_total_value);

		$(totalInputElements[4]).val(groupa_total_value+groupb_total_value+group_b_non_total_value+groupc_total_value);
	}
}

$('input[name="sanctioned_strength[]"]').on('change', handleInputChange);
$('input[name="person_in_position[]"]').on('change', handleInputChange);
$('input[name="direct_recruitement[]"]').on('change', handleInputChange);
$('input[name="promotion[]"]').on('change', handleInputChange);
$('input[name="total[]"]').on('change', handleInputChange);
$('input[name="upsc[]"]').on('change', handleInputChange);
$('input[name="ssc[]"]').on('change', handleInputChange);
$('input[name="other_recruiting_agencies_of_ministry[]"]').on('change', handleInputChange);
$('input[name="by_lab[]"]').on('change', handleInputChange);
$('input[name="calendar_of_dpc_with_number_of_vacancies[]"]').on('change', handleInputChange);

/**************************Annexure-III End************************************/

/********************************Other Functions start**************************************/

function selectmonthdate(ref){
	var selectedmonth = $(ref).val();
	var dates = selectedmonth.split('@@');
	$('#start_date').val(dates[0]);
	$('#end_date').val(dates[1]);
}

/********************************Other Functions end**************************************/

/*****************************************************************************************/

function check_percentage_group_a(){
	let total = $('#overall_strength_total_a').val();
	var initTotal = parseInt(total);
	let esm = $('#overall_strength_esm_a').val();
	var initEsm = parseInt(esm);
	if(initTotal < initEsm){
		alert('Total should be greater than ESM');
		$('#overall_strength_total_a').val(0);
		$('#overall_strength_esm_a').val(0);
		$('#percentage_of_esm_a').val(0);
	}else{
		let percent = (initEsm/initTotal)*100;
		$('#percentage_of_esm_a').val(percent);
	}
}

function check_percentage_group_b(){
	let total = $('#overall_strength_total_b').val();
	var initTotal = parseInt(total);
	let esm = $('#overall_strength_esm_b').val();
	var initEsm = parseInt(esm);
	if(initTotal < initEsm){
		alert('Total should be greater than ESM');
		$('#overall_strength_total_b').val(0);
		$('#overall_strength_esm_b').val(0);
		$('#percentage_of_esm_b').val(0);
	}else{
		let percent = (initEsm/initTotal)*100;
		$('#percentage_of_esm_b').val(percent);
	}
}

function check_percentage_group_d(){
	let total = $('#overall_strength_total_d').val();
	var initTotal = parseInt(total);
	let esm = $('#overall_strength_esm_d').val();
	var initEsm = parseInt(esm);
	if(initTotal < initEsm){
		alert('Total should be greater than ESM');
		$('#overall_strength_total_d').val(0);
		$('#overall_strength_esm_d').val(0);
		$('#percentage_of_esm_d').val(0);
	}else{
		let percent = (initEsm/initTotal)*100;
		$('#percentage_of_esm_d').val(percent);
	}
}

/*****************************************************************************************/

/**************************Custom Form Start************************************/

$("#custom-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#custom-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submitcustomform", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/dashboard";
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

$("#edit-custom-form").submit(function(e){
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#edit-custom-form")[0]);
	$.ajax({
		url: site_url+"csirlabs/submiteditcustomform", 
		type: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function(result){ 
			var res = JSON.parse(result);
			if(res.category == "Success"){
				alert(res.message);
				var url = site_url+"csirlabs/editcustomform/"+res.formid;
				window.location.replace(url);
				activate(0);	
			}else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
			}
		}
	});
});

/**************************Custom Form End************************************/