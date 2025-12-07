function activate(para) {
	if (para == 1) {
		$("img.activator").css("display", "block");
	} else {
		$("img.activator").css("display", "none");
	}
}

function ajax_call(
	form_id,
	ajax_url,
	error_id,
	success_id,
	redirect_url,
	ajax_method,
	data_type
) {
	activate(1);
	$.ajax({
		type: ajax_method,
		url: site_url + ajax_url,
		data: $(form_id).serialize(),
		dataType: data_type,
		success: function (result) {
			$(error_id).html("");
			$(success_id).html("");
			if (result.category == "success") {
				var url = site_url + redirect_url;
				window.location.replace(url);
			} else {
				$(error_id).html(result.message).css("color", "red");
			}
			activate(0);
		},
	});
}

/*** Employee Type Start ***/

$("#employeetype-add-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#employeetype-add-data-form",
		admin_prefix + "/addemployeetype",
		"#employeetype-add-data-error",
		"#employeetype-add-data-success",
		admin_prefix + "/employeetype",
		"POST",
		"json"
	);
});

$(".employeetype-edit").click(function (e) {
	var buttonid = this.id;
	var id = this.id.replace("employeetype_edit_", "");
	var table = "employeetype";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
		dataType: "json",
		success: function (data) {
			$("#edit_employee_type").val(data.employee_type);
			$("#edit_employeetype_id").val(data.id);
			$("#employeetype-edit-data-modal").modal("show");
		},
	});
});

$("#employeetype-edit-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#employeetype-edit-data-form",
		admin_prefix + "/editemployeetype",
		"#employeetype-edit-data-error",
		"#employeetype-edit-data-success",
		admin_prefix + "/employeetype",
		"POST",
		"json"
	);
});

$(".employeetype-delete").click(function (e) {
	activate(1);
	var buttonid = this.id;
	var id = this.id.replace("employeetype_delete_", "");
	var ids = id.split("_status_");
	var status = 0;
	var origin_id = ids[0].trim();
	if (ids[1].trim() == "0") {
		status = 1;
	}
	var table = "employeetype";
	$.ajax({
		url: site_url + "admin/updatetable",
		method: "POST",
		data: {
			id: origin_id,
			table: table,
			status: status,
			manpowerzibrish: manpowerzibrish,
		},
		dataType: "json",
		success: function (data) {
			if (data.category == "success") {
				var url = site_url + "admin/employeetype";
				window.location.replace(url);
			} else {
				alert(data.message);
			}
			activate(0);
		},
	});
});

/*** Employee Type End ***/

/*** Designation Start ***/

$("#designation-add-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#designation-add-data-form",
		admin_prefix + "/adddesignation",
		"#designation-add-data-error",
		"#designation-add-data-success",
		admin_prefix + "/designations",
		"POST",
		"json"
	);
});

$(".designation-edit").click(function (e) {
	var buttonid = this.id;
	var id = this.id.replace("designation_edit_", "");
	var table = "designations";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
		dataType: "json",
		success: function (data) {
			$("#edit_designation_id").val(data.id);
			$("#edit_employee_type_id").val(data.employee_type_id);
			$("#edit_designation").val(data.designation);
			$("#designation-edit-data-modal").modal("show");
		},
	});
});

$("#designation-edit-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#designation-edit-data-form",
		admin_prefix + "/editdesignation",
		"#designation-edit-data-error",
		"#designation-edit-data-success",
		admin_prefix + "/designations",
		"POST",
		"json"
	);
});

$(".designation-delete").click(function (e) {
	activate(1);
	var buttonid = this.id;
	var id = this.id.replace("designation_delete_", "");
	var ids = id.split("_status_");
	var status = 0;
	var origin_id = ids[0].trim();
	if (ids[1].trim() == "0") {
		status = 1;
	}
	var table = "designations";
	$.ajax({
		url: site_url + "admin/updatetable",
		method: "POST",
		data: {
			id: origin_id,
			table: table,
			status: status,
			manpowerzibrish: manpowerzibrish,
		},
		dataType: "json",
		success: function (data) {
			if (data.category == "success") {
				var url = site_url + "admin/designations";
				window.location.replace(url);
			} else {
				alert(data.message);
			}
			activate(0);
		},
	});
});

/*** Designation End ***/

/*** Pay Level Start ***/

$("#paylevel-add-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#paylevel-add-data-form",
		admin_prefix + "/addpaylevel",
		"#paylevel-add-data-error",
		"#paylevel-add-data-success",
		admin_prefix + "/paylevel",
		"POST",
		"json"
	);
});

$(".paylevel-edit").click(function (e) {
	var buttonid = this.id;
	var id = this.id.replace("paylevel_edit_", "");
	var table = "paylevel";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
		dataType: "json",
		success: function (data) {
			$("#edit_paylevel_id").val(data.id);
			$("#edit_paylevel").val(data.paylevel);
			$("#paylevel-edit-data-modal").modal("show");
		},
	});
});

$("#paylevel-edit-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#paylevel-edit-data-form",
		admin_prefix + "/editpaylevel",
		"#paylevel-edit-data-error",
		"#paylevel-edit-data-success",
		admin_prefix + "/paylevel",
		"POST",
		"json"
	);
});

$(".paylevel-delete").click(function (e) {
	activate(1);
	var buttonid = this.id;
	var id = this.id.replace("paylevel_delete_", "");
	var ids = id.split("_status_");
	var status = 0;
	var origin_id = ids[0].trim();
	if (ids[1].trim() == "0") {
		status = 1;
	}
	var table = "paylevel";
	$.ajax({
		url: site_url + "admin/updatetable",
		method: "POST",
		data: {
			id: origin_id,
			table: table,
			status: status,
			manpowerzibrish: manpowerzibrish,
		},
		dataType: "json",
		success: function (data) {
			if (data.category == "success") {
				var url = site_url + "admin/paylevel";
				window.location.replace(url);
			} else {
				alert(data.message);
			}
			activate(0);
		},
	});
});

/*** Pay Level End ***/

/*** Categories Start ***/

$("#category-add-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#category-add-data-form",
		admin_prefix + "/addcategory",
		"#category-add-data-error",
		"#category-add-data-success",
		admin_prefix + "/categories",
		"POST",
		"json"
	);
});

$(".category-edit").click(function (e) {
	var buttonid = this.id;
	var id = this.id.replace("category_edit_", "");
	var table = "categories";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
		dataType: "json",
		success: function (data) {
			$("#edit_category_name").val(data.name);
			$("#edit_category_id").val(data.id);
			$("#edit_parent_category").val(data.parent_category);
			$("#category-edit-data-modal").modal("show");
		},
	});
});

$("#category-edit-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#category-edit-data-form",
		admin_prefix + "/editcategory",
		"#category-edit-data-error",
		"#category-edit-data-success",
		admin_prefix + "/categories",
		"POST",
		"json"
	);
});

$(".category-delete").click(function (e) {
	activate(1);
	var buttonid = this.id;
	var id = this.id.replace("category_delete_", "");
	var ids = id.split("_status_");
	var status = 0;
	var origin_id = ids[0].trim();
	if (ids[1].trim() == "0") {
		status = 1;
	}
	var table = "categories";
	$.ajax({
		url: site_url + "admin/updatetable",
		method: "POST",
		data: {
			id: origin_id,
			table: table,
			status: status,
			manpowerzibrish: manpowerzibrish,
		},
		dataType: "json",
		success: function (data) {
			if (data.category == "success") {
				var url = site_url + "admin/categories";
				window.location.replace(url);
			} else {
				alert(data.message);
			}
			activate(0);
		},
	});
});

/*** Categories End ***/

/*** Sub Categories Start ***/

$("#subcategory-add-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#subcategory-add-data-form",
		admin_prefix + "/addsubcategory",
		"#subcategory-add-data-error",
		"#subcategory-add-data-success",
		admin_prefix + "/subcategories",
		"POST",
		"json"
	);
});

$(".add-subcategory").click(function (e) {
	var buttonid = this.id;
	var id = this.id.replace("add-subcategory-", "");
	var table = "subcategories";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
		dataType: "json",
		success: function (data) {
			$("#subcategory-add-category").val(data.name).prop("readonly", true);
			$("#subcategory-add-category-id").val(data.id);
			$("#subcategory-add-data-modal").modal("show");
		},
	});
});

$(".subcategory-edit").click(function (e) {
	var id = this.id.replace("subcategory_edit_", "");
	var table = "subcategories";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
		dataType: "json",
		success: function (data) {
			$("#subcategory-edit-id").val(data.id);
			$("#subcategory-edit-sub-category").val(data.name);
			$("#subcategory-edit-data-modal").modal("show");
		},
	});
});

$("#subcategory-edit-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#subcategory-edit-data-form",
		admin_prefix + "/editsubcategory",
		"#subcategory-edit-data-error",
		"#subcategory-edit-data-success",
		admin_prefix + "/subcategories",
		"POST",
		"json"
	);
});

$(".subcategory-delete").click(function (e) {
	activate(1);
	var id = this.id.replace("subcategory_delete_", "");
	var ids = id.split("_status_");
	var status = 0;
	var origin_id = ids[0].trim();
	if (ids[1].trim() == "0") {
		status = 1;
	}
	var table = "subcategories";
	$.ajax({
		url: site_url + "admin/updatetable",
		method: "POST",
		data: {
			id: origin_id,
			table: table,
			status: status,
			manpowerzibrish: manpowerzibrish,
		},
		dataType: "json",
		success: function (data) {
			if (data.category == "success") {
				var url = site_url + "admin/subcategories";
				window.location.replace(url);
			} else {
				alert(data.message);
			}
			activate(0);
		},
	});
});

/*** Sub Categories End ***/

/*** Gender Start ***/

$("#gender-add-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#gender-add-data-form",
		admin_prefix + "/addgender",
		"#gender-add-data-error",
		"#gender-add-data-success",
		admin_prefix + "/genders",
		"POST",
		"json"
	);
});

$(".gender-edit").click(function (e) {
	var buttonid = this.id;
	var id = this.id.replace("gender_edit_", "");
	var csrfToken = $("#" + buttonid).data("csrf");
	var table = "genders";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
		dataType: "json",
		success: function (data) {
			$("#edit_gender_name").val(data.name);
			$("#edit_gender_id").val(data.id);
			$("#gender-edit-data-modal").modal("show");
		},
	});
});

$("#gender-edit-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#gender-edit-data-form",
		admin_prefix + "/editgender",
		"#gender-edit-data-error",
		"#gender-edit-data-success",
		admin_prefix + "/genders",
		"POST",
		"json"
	);
});

$(".gender-delete").click(function (e) {
	activate(1);
	var buttonid = this.id;
	var csrfToken = $("#" + buttonid).data("csrf");
	var id = this.id.replace("gender_delete_", "");
	var ids = id.split("_status_");
	var status = 0;
	var origin_id = ids[0].trim();
	if (ids[1].trim() == "0") {
		status = 1;
	}
	var table = "genders";
	$.ajax({
		url: site_url + "admin/updatetable",
		method: "POST",
		data: {
			id: origin_id,
			table: table,
			status: status,
			manpowerzibrish: manpowerzibrish,
		},
		dataType: "json",
		success: function (data) {
			if (data.category == "success") {
				var url = site_url + "admin/genders";
				window.location.replace(url);
			} else {
				alert(data.message);
			}
			activate(0);
		},
	});
});

/*** Gender End ***/

/*** Forms Start ***/

$("#forms-add-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#forms-add-data-form",
		admin_prefix + "/submitform",
		"#forms-add-data-error",
		"#forms-add-data-success",
		admin_prefix + "/forms",
		"POST",
		"json"
	);
});

/*** Forms End ***/

/*** Sanctioned Strength Start ***/

$(".sanctionedstrength-edit").click(function (e) {
	var buttonid = this.id;
	var id = this.id.replace("sanctionedstrength_edit_", "");
	var table = "sanctionedstrength";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
		dataType: "json",
		success: function (data) {
			$("#edit_sanctionedstrength_id").val(data.id);
			$("#edit_sanctionedstrength_form_id").val(data.form_id);
			$("#edit_csirlabs_id").val(data.added_by);
			$("#edit_sanctionedstrength").val(data.sanctionedstrength);
			$("#edit_dgquota").val(data.dgquota);
			$("#edit_postsreceived").val(data.postsreceived);
			$("#edit_poststransferred").val(data.poststransferred);
			$("#sanctionedstrength-edit-data-modal").modal("show");
		},
	});
});

$("#sanctionedstrength-edit-data-form").submit(function (event) {
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#sanctionedstrength-edit-data-form")[0]);

	$.ajax({
		url: site_url + "admin/editsanctionedstrength",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function (result) {
			var res = JSON.parse(result);
			if (res.category == "Success") {
				alert(res.message);
				var url = site_url + "admin/sanctionedstrengthdata/" + res.formid;
				window.location.replace(url);
				activate(0);
			} else {
				$("#sanctionedstrength-edit-data-error")
					.html(res.message)
					.css("color", "red");
				activate(0);
			}
		},
	});
});

/*** Sanctioned Strength End ***/

/* Headquarter's Post Start */

$("#addheadquarterpost-add-data-form").submit(function (event) {
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#addheadquarterpost-add-data-form")[0]);

	$.ajax({
		url: site_url + "admin/submitheadquarterpost",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function (result) {
			var res = JSON.parse(result);
			if (res.category == "success") {
				alert(res.message);
				var url = site_url + "admin/headquarterposts";
				window.location.replace(url);
				activate(0);
			} else {
				$("#addheadquarterpost-add-data-error")
					.html(res.message)
					.css("color", "red");
				activate(0);
			}
		},
	});
});

$("#editheadquarterpost-edit-data-form").submit(function (event) {
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#editheadquarterpost-edit-data-form")[0]);

	$.ajax({
		url: site_url + "admin/submiteditheadquarterpost",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function (result) {
			var res = JSON.parse(result);
			if (res.category == "Success") {
				alert(res.message);
				var url =
					site_url + "admin/editheadquarterpost/" + res.headquarterpostsid;
				window.location.replace(url);
				activate(0);
			} else {
				$("#editheadquarterpost-edit-data-error")
					.html(res.message)
					.css("color", "red");
				activate(0);
			}
		},
	});
});

$(".headquarterposts-delete").click(function (e) {
	e.preventDefault(); // Prevent default action in case of direct link

	var confirmation = confirm("Are you sure you want to delete this record?");
	if (confirmation) {
		activate(1);
		var buttonid = this.id;
		var id = this.id.replace("headquarterposts_delete_", "");
		var table = "headquarterposts";

		$.ajax({
			url: site_url + "admin/deletetable",
			method: "POST",
			data: { id: id, table: table, manpowerzibrish: manpowerzibrish },
			dataType: "json",
			success: function (data) {
				if (data.category == "success") {
					var url = site_url + "admin/headquarterposts";
					window.location.replace(url);
				} else {
					alert(data.message);
				}
				activate(0);
			},
		});
	}
});

/* Headquarter's Post End */

$("#labs-add-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#labs-add-data-form",
		admin_prefix + "/addlab",
		"#labs-add-data-error",
		"#labs-add-data-success",
		admin_prefix + "/labs",
		"POST",
		"json"
	);
});

$(".labs-edit").click(function (e) {
	var id = this.id.replace("labs_edit_", "");
	var table = "csirlabs";
	$.ajax({
		url: site_url + "admin/gettabledata",
		method: "POST",
		data: { id: id, table: table },
		dataType: "json",
		success: function (data) {
			$("#edit_labs_id").val(data.id);
			$("#edit_labs_lab_name").val(data.lab_name);
			$("#edit_labs_username").val(data.username);
			$("#edit_labs_email").val(data.email);
			$("#edit_labs_mobile").val(data.mobile);
			$("#labs-edit-data-modal").modal("show");
		},
	});
});

$("#labs-edit-data-form").submit(function (e) {
	e.preventDefault();
	ajax_call(
		"#labs-edit-data-form",
		admin_prefix + "/editlab",
		"#labs-edit-data-error",
		"#labs-edit-data-success",
		admin_prefix + "/labs",
		"POST",
		"json"
	);
});

$(".labs-delete").click(function (e) {
	activate(1);
	var id = this.id.replace("labs_delete_", "");
	var ids = id.split("_status_");
	var status = 0;
	var origin_id = ids[0].trim();
	if (ids[1].trim() == "0") {
		status = 1;
	}
	var table = "csirlabs";
	$.ajax({
		url: site_url + "admin/updatetable",
		method: "POST",
		data: { id: origin_id, table: table, status: status },
		dataType: "json",
		success: function (data) {
			if (data.category == "success") {
				var url = site_url + "admin/labs";
				window.location.replace(url);
			} else {
				alert(data.message);
			}
			activate(0);
		},
	});
});

function getadmindata(page) {
	activate(1);
	$.ajax({
		method: "POST",
		url: site_url + "admin/adminpagination/" + page,
		data: { page: page },
		beforeSend: function () {
			$(".loading").show();
		},
		success: function (data) {
			$(".loading").hide();
			$("#adminpagination").html(data);
		},
	});
	activate(0);
}

function getlabdata(page) {
	activate(1);
	$.ajax({
		method: "POST",
		url: site_url + "admin/labpagination/" + page,
		data: { page: page },
		beforeSend: function () {
			$(".loading").show();
		},
		success: function (data) {
			$(".loading").hide();
			$("#labpagination").html(data);
		},
	});
	activate(0);
}

/* Add Freezing date */
/*
$("#freezind-date-form").submit(function (event) {
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#freezind-date-form")[0]);

	$.ajax({
		url: site_url + "admin/addfreezingdate",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function (result) {
			var res = JSON.parse(result);
			if (res.category == "Success") {
				alert(res.message);
				activate(0);
			} else {
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal("show");
				activate(0);
			}
		},
	});
});
*/
/* Add Freezing date */

/* Custom Form Section */

$("#addcustomform-add-data-form").submit(function (event) {
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#addcustomform-add-data-form")[0]);

	$.ajax({
		url: site_url + "admin/submitcustomform",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function (result) {
			var res = JSON.parse(result);
			if (res.category == "Success") {
				alert(res.message);
				var url = site_url + "admin/customforms";
				window.location.replace(url);
				activate(0);
			} else {
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal("show");
				activate(0);
			}
		},
	});
});

$("#editform-add-data-form").submit(function (event) {
	activate(1);
	event.preventDefault();
	var formData = new FormData($("#editform-add-data-form")[0]);

	$.ajax({
		url: site_url + "admin/submiteditcustomform",
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: function (result) {
			var res = JSON.parse(result);
			if (res.category == "Success") {
				alert(res.message);
				var url = site_url + "admin/editcustomform/" + res.formid;
				window.location.replace(url);
				activate(0);
			} else {
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal("show");
				activate(0);
			}
		},
	});
});

/* Custom Form Section */

$(document).ready(function () {
	$("#dashboard_mmr_data_table").DataTable({
		dom: "Bfrtip",
		lengthMenu: [50],
		buttons: [
			{
				extend: "excel",
				text: "Export Report",
				className: "btn btn-default",
				exportOptions: {
					columns: ":visible:not(:last-child):not(:nth-last-child(2))",
				},
			},
		],
	});

	$("#freezing-date").datepicker({
		format: "dd-mm-yyyy", // Define the date format
		autoclose: true, // Close the datepicker when a date is selected
	});

	$("#add-new-form-field").click(function (e) {
		e.preventDefault();

		var clonedItem = $("#form-fields-section > :first-child").clone();

		var elementWithClass = clonedItem.find(".optionsdiv");

		var fieldtypeSelect = clonedItem.find(".fieldtype");
		var fieldtypeValue = fieldtypeSelect.val();

		if (
			fieldtypeValue == "Dropdown" ||
			fieldtypeValue == "Radio Button" ||
			fieldtypeValue == "Checkbox"
		) {
			elementWithClass.css({
				display: "block",
			});
		} else {
			elementWithClass.css({
				display: "none",
			});
		}

		$("#form-fields-section").append(clonedItem);

		var newHtml =
			'<div class="col-md-12 text-right"><span class="btn btn-sm btn-danger removemmrentry">Remove Field</span></div><div class="col-md-12"><hr style="border-top: 1px solid #fff;"></div>';
		if (clonedItem.find(".btn.btn-sm.btn-danger.removemmrentry").length == 0) {
			clonedItem.append(newHtml);
		}
	});

	$("#form-fields-section").on("click", "span.removemmrentry", function (e) {
		e.preventDefault();
		var childIndex = $(this).parent().parent().index();
		if (childIndex > 0) {
			$(this).closest(".row").remove();
		} else {
			alert("Form should have at least on field");
		}
	});

	$("#form-entry-start-date").datepicker({
		format: "dd-mm-yyyy",
		minDate: 0,
		autoclose: true,
	});

	$("#form-entry-end-date").datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
	});

	$("#customform-entry-start-date").datepicker({
		format: "dd-mm-yyyy",
		minDate: 0,
		autoclose: true,
	});

	$("#customform-entry-end-date").datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
	});
});

function selectemployeetype(ref) {
	activate(1);
	var employee_type_id = $(ref).val();
	$.ajax({
		url: site_url + "admin/getemployetypeoptions",
		type: "POST",
		data: {
			employee_type_id: employee_type_id,
			manpowerzibrish: manpowerzibrish,
		},
		dataType: "json",
		success: function (result) {
			console.log(result);
			if (result.category === "success") {
				$("#designationoptions").html(result.designationoptions);
				$("#form-fields-section").children().not(":first-child").remove();
			} else {
				alert(result.message);
			}
			activate(0);
		},

		error: function (xhr, status, error) {
			console.error("AJAX Error: " + status + " " + error);
			console.error("Response: " + xhr.responseText);
			alert(
				"An error occurred while processing your request. Please try again."
			);
			activate(0);
		},
	});
}

function selectfieldtype(ref) {
	var selectedOption = $(ref).val();
	if (
		selectedOption === "Dropdown" ||
		selectedOption === "Radio Button" ||
		selectedOption === "Checkbox"
	) {
		$(ref).parent().next().show();
	} else {
		$(ref).parent().next().hide();
	}
}

function addoptions(ref) {
	var childIndex = $(ref).parent().parent().index();
	$(ref)
		.prev()
		.children(":first-child")
		.children()
		.attr("name", "options[" + childIndex + "][]");
	var clonedItem = $(ref).prev().children(":first-child").clone();
	var optionlist = $(ref).prev();
	clonedItem.append(
		'<span class="btn btn-sm btn-danger" style="display: inline-block;padding: 8px;" onclick="removeoption(this)">Remove Option</span>'
	);
	$(optionlist).append(clonedItem);
}

function removeoption(ref) {
	$(ref).closest("li").remove();
}

$(document).ready(function () {

    // --- Toggle Submenu Click ---
    $(".submenu-toggle").on("click", function () {
        let parent = $(this).closest(".nav-item");

        parent.toggleClass("open");
        parent.find(".sub-menu").slideToggle(200);
    });

    // --- Keep Submenu Open After Page Reload ---
    let currentUrl = window.location.href;

    $(".admin-sidebar a").each(function () {
        if (this.href === currentUrl) {

            // Highlight active link
            $(this).addClass("active");

            // Open the parent submenu
            let parentItem = $(this).closest(".nav-item.has-submenu");

            parentItem.addClass("open");
            parentItem.find(".sub-menu").show(); // keep it open
        }
    });

});

/* Add Freezing date */
$("#freezind-date-form").off('submit').on('submit', function(event){
    activate(1);
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: site_url + "admin/addfreezingdate",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result){ 
        	var res = JSON.parse(result);
            if(res.category == "Success"){
				$("#success-message").html(res.message).css("color", "green");
				$("#success-message-model").modal('show');
                activate(0);    
            }else{
				$("#validation-error-message").html(res.message).css("color", "red");
				$("#validation-error-model").modal('show');
				activate(0);
            }
        }
    });
});
/* Add Freezing date */

/* Add Backlog Vacancies */
$("#addbacklogvacancies-add-data-form").submit(function(e){
    activate(1);
    event.preventDefault();
    var formData = new FormData($('#addbacklogvacancies-add-data-form')[0]);

    $.ajax({
        url: site_url+"admin/submitbacklogvacancies", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result){ 
            var res = JSON.parse(result);
            $("#addbacklogvacancies-add-data-error").html('');
            if(res.category == "Success"){
                alert(res.message);
                var url = site_url+"admin/backlogvacancies";
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
/* Add Backlog Vacancies */

/* Add Probity Portal Data */
$("#addprobitydata-add-data-form").submit(function(e){
    activate(1);
    event.preventDefault();
    var formData = new FormData($('#addprobitydata-add-data-form')[0]);

    $.ajax({
        url: site_url+"admin/submitprobitydata", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result){ 
            var res = JSON.parse(result);
            $("#addprobitydata-add-data-error").html('');
            if(res.category == "Success"){
                alert(res.message);
                var url = site_url+"admin/probityportal";
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
/* Add Probity Portal Data */

/* Add 15 Point Programme data */

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

$("#addproforma-add-data-form").submit(function(e){
    activate(1);
    event.preventDefault();
    var formData = new FormData($('#addproforma-add-data-form')[0]);

    $.ajax({
        url: site_url+"admin/submitproforma", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result){ 
            var res = JSON.parse(result);
            $("#addproforma-add-data-error").html('');
            if(res.category == "Success"){
                alert(res.message);
                var url = site_url+"admin/proforma";
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
/* Add 15 Point Programme data */

/* qualifying service */
$("#addqualifyingservice-add-data-form").submit(function(e){
    activate(1);
    event.preventDefault();
    var formData = new FormData($('#addqualifyingservice-add-data-form')[0]);

    $.ajax({
        url: site_url+"admin/submitqualifyingservice", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result){ 
            var res = JSON.parse(result);
            $("#addqualifyingservice-add-data-error").html('');
            if(res.category == "Success"){
                alert(res.message);
                var url = site_url+"admin/qualifyingservice";
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
/* qualifying service */

/* HALF-YEARLY REPORT */
$("#addhalfyearlyreport-add-data-form").submit(function(e){
    activate(1);
    event.preventDefault();
    var formData = new FormData($('#addhalfyearlyreport-add-data-form')[0]);

    $.ajax({
        url: site_url+"admin/submithalfyearlyreport", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result){ 
            var res = JSON.parse(result);
            $("#addhalfyearlyreport-add-data-error").html('');
            if(res.category == "Success"){
                alert(res.message);
                var url = site_url+"admin/halfyearlyreport";
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
/* HALF-YEARLY REPORT */

/* Mission Mode Recruitment */
$("#addmmr-add-data-form").submit(function(e){
    activate(1);
    event.preventDefault();
    var formData = new FormData($('#addmmr-add-data-form')[0]);

    $.ajax({
        url: site_url+"admin/submitmmrform", 
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(result){ 
            var res = JSON.parse(result);
            $("#addmmr-add-data-error").html('');
            if(res.category == "Success"){
                alert(res.message);
                var url = site_url+"admin/mmr";
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
	    $('#mmr-entry-section').append(clonedItem);
	    clonedItem.append('<div class="col-md-12 text-right"><button class="btn btn-sm btn-danger removemmrentry">Remove Employee Details</button></div><div class="col-md-12"><hr style="border-top: 1px solid #fff;"></div>');
    });

    $('#mmr-entry-section').on('click', 'button.removemmrentry', function(e) {
    	e.preventDefault();
        $(this).closest('.row').remove();
    });

});
/* Mission Mode Recruitment */

$(document).ready(function() {
    $('.table').each(function(index) {
        $(this).DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i> Export to CSV',
                    className: 'btn btn-success btn-sm mb-2',
                    title: 'Report_' + (index + 1),
                    filename: 'Report_' + (index + 1) + '_' + new Date().toISOString().slice(0,19).replace(/[:T]/g, "-"),
                    fieldSeparator: ',',
                    bom: true,
                    exportOptions: {
                        // ✅ Include both body and footer rows
                        rows: function (idx, data, node) {
                            return true; // include all rows, including totals
                        },
                        columns: ':visible',
                        format: {
                            body: function (data, row, column, node) {
                                // Preserve empty cells
                                if (data === null || data === undefined || data === '') {
                                    return '';
                                }
                                // Strip HTML (like <td>, <b>, <span>)
                                return data.toString().replace(/<[^>]*>/g, '').trim();
                            },
                            footer: function (data, row, column, node) {
                                // Same treatment for footer cells
                                if (data === null || data === undefined || data === '') {
                                    return '';
                                }
                                return data.toString().replace(/<[^>]*>/g, '').trim();
                            }
                        }
                    },
                    // ✅ Include footer data in export
                    footer: true
                }
            ],
            paging: false,
            searching: false,
            ordering: false,
            info: false
        });
    });
});