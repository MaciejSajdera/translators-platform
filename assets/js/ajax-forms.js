jQuery(document).ready(function($) {
	console.log("ajax test");

	var ajaxurl = ajax_forms_params.ajaxurl;

	console.log(ajaxurl);

	/* 	User Basic Info Form */

	var basicUserDataForm = ajax_forms_params.basic_user_data_form;

	$(basicUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_basic_user_data_with_ajax",
			type: "post",
			data: $(basicUserDataForm).serialize(),
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
				console.log(JSON.parse(data));

				const dataJSON = JSON.parse(data);

				const accountUserName = document.querySelector(".account__user-name");
				const userBioText = document.querySelector("#user_bio_text");
				const userLanguagesText = document.querySelector(
					"#user_languages_text"
				);
				const userSpecializationsText = document.querySelector(
					"#user_specializations_text"
				);

				accountUserName.innerText = `${dataJSON.user_first_name} ${dataJSON.user_last_name}`;
				userBioText.innerText = `${dataJSON.user_bio}`;

				dataJSON.user_languages && dataJSON.user_languages.length > 0
					? (userLanguagesText.innerText = `${dataJSON.user_languages.join(
							", "
					  )}`)
					: (userLanguagesText.innerText = "");

				dataJSON.user_specializations &&
				dataJSON.user_specializations.length > 0
					? (userSpecializationsText.innerText = `${dataJSON.user_specializations.join(
							", "
					  )}`)
					: (userSpecializationsText.innerText = "");

				return data;
			},

			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	User About Form */

	var aboutUserDataForm = ajax_forms_params.about_user_data_form;

	$(aboutUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_about_user_data_with_ajax",
			type: "post",
			data: $(aboutUserDataForm).serialize(),
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

				const userAboutText = document.querySelector("#user_about_text");

				userAboutText.innerText = `${dataJSON.user_about}`;

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	User Contact Data Form */

	var contactUserDataForm = ajax_forms_params.contact_user_data_form;

	$(contactUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_contact_user_data_with_ajax",
			type: "post",
			data: $(contactUserDataForm).serialize(),
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

				const userLocalizationsText = document.querySelector(
					"#user_localizations_text"
				);

				dataJSON.user_localizations && dataJSON.user_localizations.length > 0
					? (userLocalizationsText.innerText = `${dataJSON.user_localizations.join(
							", "
					  )}`)
					: (userLocalizationsText.innerText = "");

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	Upload profile picture Form */

	var uploadProfilePictureForm = ajax_forms_params.upload_profile_picture_form;

	$(uploadProfilePictureForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		var formData = new FormData($(this)[0]);

		$.ajax({
			url: ajaxurl + "?action=handle_profile_picture_upload",
			type: "post",
			data: formData,
			async: true,
			cache: false,
			contentType: false,
			enctype: "multipart/form-data",
			processData: false,

			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				uploadPicturePreview.classList.remove("has-image");
			},

			success: function(data) {
				console.log("SUCCESS!");

				// const dataJSON = JSON.parse(data);
				// console.log(dataJSON);

				return data;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
	});
});
