/* 	User work Form */

var workUserDataForm = ajax_forms_params.work_user_data_form;

$(workUserDataForm).submit(function(event) {
	event.preventDefault();

	const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
		".my-ajax-loader"
	);

	$.ajax({
		url: ajaxurl + "?action=add_work_user_data_with_ajax",
		type: "post",
		data: $(workUserDataForm).serialize(),
		beforeSend: function() {
			// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
			thisAjaxLoader.classList.add("my-ajax-loader--active");
		},

		complete: function() {
			thisAjaxLoader.classList.remove("my-ajax-loader--active");
		},

		success: function(data) {
			console.log("SUCCESS!");
			console.log(data);

			const dataJSON = JSON.parse(data);

			const userworkText = document.querySelector("#user_work_text");

			userworkText.innerText = `${dataJSON.user_work}`;

			return data;
		},
		error: function(err) {
			console.log("FAILURE");
			console.log(err);
		}
	});
});
