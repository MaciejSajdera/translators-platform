jQuery(document).ready(function($) {
	/* 	Modal for displaying errors */
	const modal = document.querySelector(".modal");
	const modalContent = modal.querySelector(".modal-content");
	const modalMessageHolder = modal.querySelector(".modal-message-holder");
	const closeButton = document.querySelector(".close-button");

	function showModal() {
		modal.classList.add("unlock-modal");
		modal.classList.add("show-modal");

		setTimeout(() => modal.classList.add("show-modal"), 300);

		// modal.classList.contains("show-modal")
		// 	? modal.classList.remove("show-modal")
		// 	: modal.classList.add("show-modal");
	}

	function closeModal() {
		modal.classList.remove("show-modal");
		modal.classList.remove("unlock-modal");
		modalMessageHolder.innerHTML = "";
	}

	function windowOnClick(event) {
		if (event.target === modal && event.target !== closeButton) {
			closeModal();
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
			headers: {
				"Content-Type": "application/x-www-form-urlencoded"
			},
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

	/* 	Upload sound to gallery Form */

	var uploadSoundToGalleryForm = ajax_forms_params.upload_sound_to_gallery_form;

	$(uploadSoundToGalleryForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadSoundPreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		const soundToGalleryInput = this.querySelector("#sound-to-gallery__input");

		// console.log(this);

		var soundGalleryFormData = new FormData(this);

		const progress = this.querySelector(".progress");
		const progressBar = progress.querySelector(".progress-bar");
		const progressPercents = progress.querySelector(".progress-percents");

		$.ajax({
			xhr: function() {
				const xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener(
					"progress",
					function(e) {
						if (e.lengthComputable) {
							const percentComplete = (e.loaded / e.total) * 100;
							console.log(percentComplete);
							progress.classList.add("progress-show");
							progressBar.style.width = percentComplete + "%";
							progressPercents.innerText = Math.round(percentComplete) + "%";
						}
					},
					false
				);
				return xhr;
			},
			url: ajaxurl + "?action=handle_sound_to_gallery_upload",
			type: "POST",
			data: soundGalleryFormData,
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
				progress.classList.remove("progress-show");
				// uploadSoundPreview.classList.remove("has-image");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				// const dataJSON = JSON.parse(data);

				// console.log(dataJSON);

				let newlyAddedSound = $("#newSoundInGalleryPlaceholder").clone();

				newlyAddedSound
					.css("transform", "scale(0)")
					.css("transition", "all 0.3s ease-in")
					.appendTo(".my-sounds__gallery")
					.attr("id", "newlyAddedSound");

				setTimeout(function() {
					$("#newlyAddedSound .remove-item").attr("data-id", data);

					$("#newlyAddedSound")
						.css("transform", "scale(1)")
						.attr("id", "");
				}, 100);

				$("#newSoundInGalleryPlaceholder").css("display", "none");

				//clear input

				soundToGalleryInput.value = null;

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

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	$("#sound-to-gallery__input").change(function(event) {
		$("#newSoundInGalleryPlaceholder").fadeIn(300);
		$("#newSoundInGalleryPlaceholder p").text(event.target.files[0]?.name);
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
		const originalImage = document.querySelector(
			".profile-picture__wrapper .post-thumbnail img"
		);
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		console.log(this);

		var profilePictureformData = new FormData(this);

		$.ajax({
			url: ajaxurl + "?action=handle_profile_picture_upload",
			type: "POST",
			data: profilePictureformData,
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

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				originalImage.style.opacity = "1";
				uploadPicturePreview.classList.remove("has-image");

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	/* 	Upload image to gallery Form */

	var uploadImageToGalleryForm = ajax_forms_params.upload_image_to_gallery_form;

	$(uploadImageToGalleryForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		const imageToGalleryInput = this.querySelector("#image-to-gallery__input");

		var galleryFormData = new FormData(this);

		const progress = this.querySelector(".progress");
		const progressBar = progress.querySelector(".progress-bar");
		const progressPercents = progress.querySelector(".progress-percents");

		$.ajax({
			xhr: function() {
				const xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener(
					"progress",
					function(e) {
						if (e.lengthComputable) {
							const percentComplete = (e.loaded / e.total) * 100;
							console.log(percentComplete);
							progress.classList.add("progress-show");
							progressBar.style.width = percentComplete + "%";
							progressPercents.innerText = Math.round(percentComplete) + "%";
						}
					},
					false
				);
				return xhr;
			},
			type: "POST",
			url: ajaxurl + "?action=handle_image_to_gallery_upload",
			data: galleryFormData,
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
				progress.classList.remove("progress-show");
				// uploadPicturePreview.classList.remove("has-image");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				// const dataJSON = JSON.parse(data);

				let newlyAddedImage = $("#newImageInGalleryPlaceholder").clone();

				newlyAddedImage
					.css("transform", "scale(0)")
					.css("transition", "all 0.3s ease-in")
					.appendTo(".my-pictures__gallery")
					.attr("id", "newlyAddedImage");

				setTimeout(function() {
					$("#newlyAddedImage .remove-item").attr("data-id", data);

					$("#newlyAddedImage")
						.css("transform", "scale(1)")
						.attr("id", "");
				}, 100);

				$("#newImageInGalleryPlaceholder").css("display", "none");

				//clear input

				imageToGalleryInput.value = null;

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

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	$("#image-to-gallery__input").change(function(event) {
		$("#newImageInGalleryPlaceholder").fadeIn(300);

		$("#newImageInGalleryPlaceholder img")
			.fadeIn(300)
			.attr("src", URL.createObjectURL(event.target.files[0]));
	});

	/* 	Upload video to gallery Form */

	var uploadVideoToGalleryForm = ajax_forms_params.upload_video_to_gallery_form;

	$(uploadVideoToGalleryForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		const videoToGalleryInput = this.querySelector("#video-to-gallery__input");

		// console.log(this);

		var videoGalleryFormData = new FormData(this);

		const progress = this.querySelector(".progress");
		const progressBar = progress.querySelector(".progress-bar");
		const progressPercents = progress.querySelector(".progress-percents");

		$.ajax({
			xhr: function() {
				const xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener(
					"progress",
					function(e) {
						if (e.lengthComputable) {
							const percentComplete = (e.loaded / e.total) * 100;
							console.log(percentComplete);
							progress.classList.add("progress-show");
							progressBar.style.width = percentComplete + "%";
							progressPercents.innerText = Math.round(percentComplete) + "%";
						}
					},
					false
				);
				return xhr;
			},
			url: ajaxurl + "?action=handle_video_to_gallery_upload",
			type: "POST",
			data: videoGalleryFormData,
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
				progress.classList.remove("progress-show");
				// uploadPicturePreview.classList.remove("has-image");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				// const dataJSON = JSON.parse(data);

				// console.log(dataJSON);

				let newlyAddedVideo = $("#newVideoInGalleryPlaceholder").clone();

				newlyAddedVideo
					.css("transform", "scale(0)")
					.css("transition", "all 0.3s ease-in")
					.appendTo(".my-videos__gallery")
					.attr("id", "newlyAddedVideo");

				setTimeout(function() {
					$("#newlyAddedVideo .remove-item").attr("data-id", data);

					$("#newlyAddedVideo")
						.css("transform", "scale(1)")
						.attr("id", "");
				}, 100);

				$("#newVideoInGalleryPlaceholder").css("display", "none");

				//clear input

				videoToGalleryInput.value = null;

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

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	$("#video-to-gallery__input").change(function(event) {
		$("#newVideoInGalleryPlaceholder").fadeIn(300);
		$("#newVideoInGalleryPlaceholder p").text(event.target.files[0].name);
	});

	/* USERS SETTINGS */

	/* 	User Settings Update Email Form */

	var changeSettingsUserLoginEmail =
		ajax_forms_params.settings_user_login_email_form;

	$(changeSettingsUserLoginEmail).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		var changeSettingsUserLoginEmailFormData = new FormData(this);

		$.ajax({
			url: ajaxurl + "?action=change_settings_user_login_email_with_ajax",
			type: "POST",
			data: changeSettingsUserLoginEmailFormData,
			async: true,
			cache: false,
			contentType: false,
			processData: false,

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

				const userCurrentLoginEmailText = document.querySelector(
					"#user_current_login_email"
				);

				userCurrentLoginEmailText.innerText = `${dataJSON}`;

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

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	/* 	User Settings Update Password */

	// var changeSettingsUserPassword =
	// 	ajax_forms_params.settings_user_password_form;

	// $(changeSettingsUserPassword).submit(function(event) {
	// 	event.preventDefault();

	// 	const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
	// 		".my-ajax-loader"
	// 	);

	// 	var changeSettingsUserPasswordFormData = new FormData(this);

	// 	$.ajax({
	// 		url: ajaxurl + "?action=change_settings_user_password_with_ajax",
	// 		type: "POST",
	// 		data: changeSettingsUserPasswordFormData,
	// 		async: true,
	// 		cache: false,
	// 		contentType: false,
	// 		processData: false,

	// 		beforeSend: function() {
	// 			// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
	// 			thisAjaxLoader.classList.add("my-ajax-loader--active");
	// 		},

	// 		complete: function() {
	// 			thisAjaxLoader.classList.remove("my-ajax-loader--active");
	// 		},

	// 		success: function(data) {
	// 			console.log("SUCCESS!");
	// 			console.log(data);

	// 			// const dataJSON = JSON.parse(data);

	// 			// console.log(dataJSON);

	// 			// const userCurrentLoginEmailText = document.querySelector(
	// 			// 	"#user_current_login_email"
	// 			// );

	// 			// userCurrentLoginEmailText.innerText = `${dataJSON}`;

	// 			let successMessageNode = $.parseHTML(data);

	// 			modalMessageHolder.appendChild(successMessageNode[0]);

	// 			showModal();

	// 			return data;
	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown) {
	// 			console.log(jqXHR);
	// 			console.log(textStatus);
	// 			console.log(errorThrown);

	// 			let errorMessage = jqXHR.responseText;

	// 			console.log(errorMessage);

	// 			let errorMessageNode = $.parseHTML(errorMessage);

	// 			console.log(errorMessageNode);

	// 			modalMessageHolder.appendChild(errorMessageNode[0]);

	// 			showModal();

	// 			// jsonValue = jQuery.parseJSON( jqXHR.responseText );
	// 			// console.log(jsonValue.Message);
	// 		}
	// 	});
	// });

	/* UPDATE VISIBILITY SETTINGS FORM */

	var userDataVisibilityForm =
		ajax_forms_params.settings_user_data_visibility_form;

	$(userDataVisibilityForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=change_settings_user_data_visibility_with_ajax",
			type: "post",
			data: $(userDataVisibilityForm).serialize(),
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

				// const dataJSON = JSON.parse(data);

				// const userworkText = document.querySelector("#user_work_text");

				// userworkText.innerText = `${dataJSON.user_work}`;

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});
});
