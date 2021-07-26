jQuery(document).ready(function($) {
	// Perform AJAX login on form submit

	console.log("ajax test");

	$("form#basic_user_data_form").on("submit", function(e) {
		console.log(e);

		$("form#basic_user_data_form p.status")
			.show()
			.text(ajax_basic_user_data_object.loadingmessage);

		$.ajax({
			type: "POST",
			dataType: "json",
			url: ajax_basic_user_data_object.ajaxurl,
			data: {
				action: "ajax_add_basic_user_data", //calls wp_ajax_nopriv_basic_user_data
				user_first_name: $("form#basic_user_data_form #user_first_name").val(),
				user_last_name: $("form#basic_user_data_form #user_last_name").val(),
				user_bio: $("form#basic_user_data_form #user_bio").val(),
				user_languages_array: $(
					"form#basic_user_data_form #user_languages_array"
				).val(),
				user_specializations_array: $(
					"form#basic_user_data_form #user_specializations_array"
				).val(),
				security: $("form#basic_user_data_form #security").val()
			},
			error: function(err) {
				console.log(err);
			},

			success: function(data) {
				$("form#basic_user_data_form p.status").text(data.message);
				if (data.loggedin == true) {
					document.location.href = ajax_basic_user_data_object.redirecturl;
				}
			}
		});

		e.preventDefault();
	});
});
