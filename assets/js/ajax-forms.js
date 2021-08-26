jQuery(document).ready(function($) {
	/***************** ADDITIONAL FUNCTIONALITIES RELATED TO FORMS ******************/

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

	/* 	For handling previews of files added by repeaters */

	const allRepeaterHolders = document.querySelectorAll(".repeater__holder");

	allRepeaterHolders.forEach(wrapper => {
		let repeaterFieldWrapper = wrapper.querySelector(
			".repeater__field-wrapper"
		);

		const allOriginalInputs = wrapper.querySelectorAll(".input-preview__src");

		//static for already existing inputs
		allOriginalInputs.forEach(thisInput => {
			thisInput.addEventListener("change", function(e) {
				console.log(e);

				let newAttachmentPlaceholder = thisInput
					.closest(".row-wrapper")
					?.querySelector(".new-attachment__placeholder");

				if (newAttachmentPlaceholder.tagName == "IMG") {
					console.log(newAttachmentPlaceholder);
					newAttachmentPlaceholder.setAttribute(
						"src",
						URL.createObjectURL(e.target.files[0])
					);
				}

				if (
					newAttachmentPlaceholder.querySelector(
						".my-sounds__gallery-text-wrapper"
					) &&
					!e.target.files
				) {
					let soundLabel = thisInput
						.closest("FORM")
						.querySelector(".input-text").value;
					let soundDescription = thisInput
						.closest("FORM")
						.querySelector(".input-textarea").value;

					newAttachmentPlaceholder.querySelector(
						".my-sounds__gallery-attachment--label p"
					).textContent = soundLabel;
					newAttachmentPlaceholder.querySelector(
						".my-sounds__gallery-attachment--description p"
					).textContent = soundDescription;

					//dont show icon if there is no sound attached
					newAttachmentPlaceholder.querySelector(
						".new-attachment__icon"
					).style.display = "none";
					newAttachmentPlaceholder.style.position = "absolute";
				}

				if (
					newAttachmentPlaceholder.querySelector(".sound-title") &&
					e.target.files
				) {
					newAttachmentPlaceholder.querySelector(".sound-title").textContent =
						e.target.files[0].name;
					let soundLabel = thisInput
						.closest("FORM")
						.querySelector(".input-text").value;
					let soundDescription = thisInput
						.closest("FORM")
						.querySelector(".input-textarea").value;

					console.log(soundLabel);

					newAttachmentPlaceholder.querySelector(
						".my-sounds__gallery-attachment--label p"
					).textContent = soundLabel;
					newAttachmentPlaceholder.querySelector(
						".my-sounds__gallery-attachment--description p"
					).textContent = soundDescription;

					//show icon and title if there is sound attached
					newAttachmentPlaceholder.classList.add("important-visible");

					newAttachmentPlaceholder.querySelector(
						".new-attachment__icon"
					).style.display = "block";
					newAttachmentPlaceholder.style.position = "static";
				}

				if (newAttachmentPlaceholder) {
					newAttachmentPlaceholder.style.display = "block";
				}
			});
		});

		//dynamic for inputs added with repeater
		let observer = new MutationObserver(function(mutations) {
			mutations.forEach(function(mutation) {
				console.log(mutation);

				if (mutation.type === "childList") {
					const allFileInputs = wrapper.querySelectorAll(".input-preview__src");

					allFileInputs.forEach(thisInput => {
						thisInput.addEventListener("change", function(e) {
							console.log(e);

							let closestRowWrapper = thisInput.closest(".row-wrapper");

							let newAttachmentPlaceholder = closestRowWrapper?.querySelector(
								".new-attachment__placeholder"
							);

							console.log(
								newAttachmentPlaceholder.querySelector(".sound-title")
									.textContent.length
							);

							if (newAttachmentPlaceholder.tagName == "IMG") {
								newAttachmentPlaceholder.setAttribute(
									"src",
									URL.createObjectURL(e.target.files[0])
								);
							}

							if (
								newAttachmentPlaceholder.querySelector(
									".my-sounds__gallery-text-wrapper"
								) &&
								newAttachmentPlaceholder.querySelector(".sound-title")
									.textContent.length > 0 &&
								!e.target.files
							) {
								let soundLabel = thisInput
									.closest("FORM")
									.querySelector(".input-text").value;
								let soundDescription = thisInput
									.closest("FORM")
									.querySelector(".input-textarea").value;

								newAttachmentPlaceholder.querySelector(
									".my-sounds__gallery-attachment--label p"
								).textContent = soundLabel;
								newAttachmentPlaceholder.querySelector(
									".my-sounds__gallery-attachment--description p"
								).textContent = soundDescription;

								//dont show icon if there is no sound attached
								newAttachmentPlaceholder.querySelector(
									".new-attachment__icon"
								).style.display = "none";
								newAttachmentPlaceholder.style.position = "absolute";
							}

							if (
								newAttachmentPlaceholder.querySelector(".sound-title") &&
								e.target.files
							) {
								newAttachmentPlaceholder.querySelector(
									".sound-title"
								).textContent = e.target.files[0].name;
								let soundLabel = thisInput
									.closest("FORM")
									.querySelector(".input-text").value;
								let soundDescription = thisInput
									.closest("FORM")
									.querySelector(".input-textarea").value;

								console.log(soundLabel);

								newAttachmentPlaceholder.querySelector(
									".my-sounds__gallery-attachment--label p"
								).textContent = soundLabel;
								newAttachmentPlaceholder.querySelector(
									".my-sounds__gallery-attachment--description p"
								).textContent = soundDescription;

								//show icon and title if there is sound attached
								newAttachmentPlaceholder.querySelector(
									".new-attachment__icon"
								).style.display = "block";
								newAttachmentPlaceholder.style.position = "static";
							}

							if (newAttachmentPlaceholder) {
								newAttachmentPlaceholder.style.display = "block";
							}
						});
					});
				}
			});
		});

		observer.observe(repeaterFieldWrapper, {
			attributes: true,
			childList: true,
			characterData: true
		});
	});

	/******************************* FORMS ***********************************/

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

		const allSoundToGalleryInputs = this.querySelectorAll(
			"#sound-to-gallery__input"
		);

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

				const dataJSON = JSON.parse(data);

				// console.log(dataJSON.added_files_ids);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let allNewlyAddedSounds = $(
					"#upload_sound_to_gallery_form .new-attachment__placeholder"
				);

				// console.log(allNewlyAddedSounds);

				allNewlyAddedSounds.each(function(index) {
					console.log(index);

					$(this)
						.clone()
						.css("transform", "scale(0)")
						.css("position", "static")
						.css("transition", "all 0.3s ease-in")
						.appendTo(".my-sounds__gallery")
						.addClass(
							"newlyAddedSound row-wrapper my-sounds__gallery-row-wrapper wrapper-flex-drow-mcol"
						)
						.find("A")
						.attr("data-id", addedRows[index]);

					//clear input
					$(this).css("display", "none");
				});

				//reset form

				$(uploadSoundToGalleryForm).trigger("reset");

				setTimeout(function() {
					$(".newlyAddedSound")
						.find(".my-sounds__gallery-attachment--label")
						.css("display", "block");
					$(".newlyAddedSound")
						.find(".my-sounds__gallery-attachment--description")
						.css("display", "block");

					$(".newlyAddedSound")
						.find(".my-sounds__gallery-text-wrapper")
						.addClass("col-d50");
					$(".newlyAddedSound")
						.find(".my-sounds__gallery-attachment--file-info")
						.addClass("col-d50");

					$(".newlyAddedSound")
						.css("transform", "scale(1)")
						.removeClass("newlyAddedSound");
				}, 200);

				let allRepeaterFieldsInThisForm = $(
					"#upload_sound_to_gallery_form .repeater__field"
				);

				allRepeaterFieldsInThisForm.each(function(index) {
					//clear first one
					// if (index === 0) {
					// 	$(this)
					// 		.find(".new-attachment__placeholder")
					// 		.attr("src", "");
					// }

					//delete rest
					if (index > 0) {
						$(this).remove();
					}
				});

				$(uploadSoundToGalleryForm).trigger("reset");

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

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);
				console.log(typeof dataJSON);

				let arrayOfIndexesToDelete = Object.values(dataJSON);

				console.log(arrayOfIndexesToDelete);

				let allNewAttachmentWrappersInThisForm = $(
					"#upload_image_to_gallery_form .new-attachment__wrapper"
				);

				allNewAttachmentWrappersInThisForm.each(function(index) {
					console.log(this);
					$(this)
						.clone()
						.css("transform", "scale(0)")
						.css("transition", "all 0.3s ease-in")
						.addClass("my-pictures__gallery-attachment")
						.addClass("newlyAddedImage")
						.appendTo(".my-pictures__gallery")
						.children("A")
						.attr("data-id", arrayOfIndexesToDelete[index]);

					// console.log(arrayOfIndexesToDelete[index]);

					// $(this).attr("data-id", arrayOfIndexesToDelete[index]);

					setTimeout(function() {
						$(".newlyAddedImage")
							.css("transform", "scale(1)")
							.removeClass("newlyAddedImage");
					}, 200);
				});

				let allRepeaterFieldsInThisForm = $(
					"#upload_image_to_gallery_form .repeater__field"
				);

				//clearings

				$(uploadImageToGalleryForm).trigger("reset");

				allRepeaterFieldsInThisForm.each(function(index) {
					//clear first one
					if (index === 0) {
						$(this)
							.find(".new-attachment__placeholder")
							.attr("src", "");
					}

					//delete rest
					if (index > 0) {
						$(this).remove();
					}
				});

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

				const dataJSON = JSON.parse(data);

				console.log(dataJSON);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let newlyAddedVideo = $("#newVideoInGalleryPlaceholder").clone();

				newlyAddedVideo
					.css("transform", "scale(0)")
					.css("transition", "all 0.3s ease-in")
					.appendTo(".my-videos__gallery")
					.attr("id", "newlyAddedVideo");

				setTimeout(function() {
					$("#newlyAddedVideo .remove-item").attr("data-id", addedRows[0]);

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
