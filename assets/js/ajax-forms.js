jQuery(document).ready(function($) {
	/* 	Modal for displaying errors */
	const modal = document.querySelector(".modal");
	const modalContent = modal.querySelector(".modal-content");
	const closeButton = document.querySelector(".close-button");

	function toggleModal() {
		modal.classList.contains("unlock-modal")
			? modal.classList.remove("unlock-modal")
			: modal.classList.add("unlock-modal");

		setTimeout(
			() =>
				modal.classList.contains("show-modal")
					? modal.classList.remove("show-modal")
					: modal.classList.add("show-modal"),
			10
		);

		// modal.classList.contains("show-modal")
		// 	? modal.classList.remove("show-modal")
		// 	: modal.classList.add("show-modal");
	}

	function closeModal() {
		modal.classList.remove("show-modal");
	}

	function windowOnClick(event) {
		if (event.target === modal && event.target !== closeButton) {
			toggleModal();
		}
	}

	closeButton.addEventListener("click", closeModal);
	window.addEventListener("click", windowOnClick);

	/* 	AJAX URL path */

	var ajaxurl = ajax_forms_params.ajaxurl;

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

	//inputs: #user_city and #user_localization_city needs to share the same value

	$("#user_city").change(function() {
		$("#user_localization_city").val($(this).val());
	});

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

				const userContactPhoneText = document.querySelector(
					"#user_contact_phone_text"
				);

				if (dataJSON.user_contact_phone) {
					userContactPhoneText.innerText = `${dataJSON.user_contact_phone}`;
				}

				const userContactEmailText = document.querySelector(
					"#user_contact_email_text"
				);

				if (dataJSON.user_contact_email) {
					userContactEmailText.innerText = `${dataJSON.user_contact_email}`;
				}

				const userCityText = document.querySelector("#user_city_text");

				if (dataJSON.user_city) {
					userCityText.innerText = `${dataJSON.user_city}`;
				}

				if (
					dataJSON.user_localizations &&
					dataJSON.user_localizations.length > 0
				) {
					//remove old localizations

					const allUserLocalizations = document.querySelectorAll(
						".user_localization"
					);

					allUserLocalizations.forEach(localization => {
						localization.remove();
					});

					//display all checked localizations

					allUniqueLocalizations = [...new Set(dataJSON.user_localizations)];

					allUniqueLocalizations
						.filter(
							localization =>
								localization.length > 0 &&
								localization !== userCityText.innerText
						)
						.forEach(localization => {
							console.log(typeof localization);
							const userLocalizationsColumn = document.querySelector(
								".user_localizations__column"
							);
							let newAddedLocalization = document.createElement("P");
							newAddedLocalization.classList.add(
								"user_localization",
								"info-box__content"
							);

							newAddedLocalization.innerText = localization;

							userLocalizationsColumn.appendChild(newAddedLocalization);
						});
				}

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	User Linkedin Form */

	var linkedinUserDataForm = ajax_forms_params.linkedin_user_data_form;

	$(linkedinUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_linkedin_user_data_with_ajax",
			type: "post",
			data: $(linkedinUserDataForm).serialize(),
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

				const userlinkedinText = document.querySelector("#user_linkedin_text");

				userlinkedinText.innerText = `${dataJSON.user_linkedin}`;

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

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

		console.log(this);

		var formData = new FormData(this);

		$.ajax({
			url: ajaxurl + "?action=handle_profile_picture_upload",
			type: "POST",
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
				console.log(data);

				// const dataJSON = JSON.parse(data);
				// console.log(dataJSON);

				return data;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				modalContent.appendChild(errorMessageNode[0]);

				toggleModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});
});
