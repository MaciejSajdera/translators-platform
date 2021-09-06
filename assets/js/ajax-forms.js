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

				let closestRowWrapper = thisInput.closest(".row-wrapper");

				let newAttachmentPlaceholder = closestRowWrapper?.querySelector(
					".new-attachment__placeholder"
				);

				if (newAttachmentPlaceholder.tagName == "IMG") {
					console.log(newAttachmentPlaceholder);
					newAttachmentPlaceholder.setAttribute(
						"src",
						URL.createObjectURL(e.target.files[0])
					);
				}

				if (!closestRowWrapper.querySelector("input[type='file']").files[0]) {
					let soundLabel = thisInput
						.closest(".repeater__field")
						.querySelector(".input-text").value;
					let soundDescription = thisInput
						.closest(".repeater__field")
						.querySelector(".input-textarea").value;

					let newAttachmentPlaceholderContent = `
					<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper" style="position: absolute; display: none;">

						<a class="remove-item remove" data-id="clear-input" href="#"></a>

						<div class="my-sounds__gallery-text-wrapper">

							<div class="my-sounds__gallery-attachment--label">

								<p>${soundLabel}</p>

							</div>

							<div class="my-sounds__gallery-attachment--description">

								<p>${soundDescription}</p>

							</div>

						</div>

					</div>
					`;

					newAttachmentPlaceholder.innerHTML = newAttachmentPlaceholderContent;
				}

				if (
					closestRowWrapper.querySelector("input[type='file']").files[0] &&
					newAttachmentPlaceholder.id === "newSoundInGalleryPlaceholder"
				) {
					// newAttachmentPlaceholder.querySelector(".sound-title").textContent =
					// 	e.target.files[0].name;
					let soundLabel = thisInput
						.closest(".repeater__field")
						.querySelector(".input-text").value;
					let soundDescription = thisInput
						.closest(".repeater__field")
						.querySelector(".input-textarea").value;

					let newAttachmentPlaceholderContent = `
					<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper">

					<a class="remove-item remove" data-id="clear-input" href="#"></a>
					
					<div class="my-sounds__gallery-text-wrapper">
					
						<div class="my-sounds__gallery-attachment--label" style="display: none">
					
							<p>${soundLabel}</p>
					
						</div>
					
						<div class="my-sounds__gallery-attachment--description" style="display: none">
					
							<p>${soundDescription}</p>
					
						</div>
					
					</div>
					
					<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info">
					
						<div class="new-attachment__icon ">
					
							<svg viewBox="0 0 384 384" xmlns="http://www.w3.org/2000/svg">
							<path d="m176 288c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-192c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
							<path d="m16 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
							<path d="m152 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
							<path d="m80 240c8.832031 0 16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16zm0 0"/>
							<path d="m264 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
							<path d="m368 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
							<path d="m304 144c-8.832031 0-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16zm0 0"/>
							<path d="m176 368c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
							<path d="m192 48c8.832031 0 16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v16c0 8.832031 7.167969 16 16 16zm0 0"/></svg>
					
						</div>
					
						<div class="new-attachment__description">
					
							<p class="sound-title">${
								closestRowWrapper.querySelector("input[type='file']").files[0]
									.name
							}</p>
					
						</div>
					
					</div>
					
					</div>
					`;

					newAttachmentPlaceholder.innerHTML = newAttachmentPlaceholderContent;
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

							if (newAttachmentPlaceholder.tagName == "IMG") {
								newAttachmentPlaceholder.setAttribute(
									"src",
									URL.createObjectURL(e.target.files[0])
								);
							}

							console.log(
								e.target
									.closest(".row-wrapper")
									.querySelector("input[type='file']").files[0]
							);

							if (
								!closestRowWrapper.querySelector("input[type='file']").files[0]
							) {
								let soundLabel = thisInput
									.closest(".repeater__field")
									.querySelector(".input-text").value;
								let soundDescription = thisInput
									.closest(".repeater__field")
									.querySelector(".input-textarea").value;

								let newAttachmentPlaceholderContent = `
								<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper" style="position: absolute; display: none;">
			
									<a class="remove-item remove" data-id="clear-input" href="#"></a>
			
									<div class="my-sounds__gallery-text-wrapper">
			
										<div class="my-sounds__gallery-attachment--label">
			
											<p>${soundLabel}</p>
			
										</div>
			
										<div class="my-sounds__gallery-attachment--description">
			
											<p>${soundDescription}</p>
			
										</div>
			
									</div>
			
								</div>
								`;
								newAttachmentPlaceholder.innerHTML = newAttachmentPlaceholderContent;
							}

							if (
								e.target.files &&
								newAttachmentPlaceholder.id === "newSoundInGalleryPlaceholder"
							) {
								// newAttachmentPlaceholder.querySelector(".sound-title").textContent =
								// 	e.target.files[0].name;
								let soundLabel = thisInput
									.closest(".repeater__field")
									.querySelector(".input-text").value;
								let soundDescription = thisInput
									.closest(".repeater__field")
									.querySelector(".input-textarea").value;

								let newAttachmentPlaceholderContent = `
								<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper">
			
								<a class="remove-item remove" data-id="clear-input" href="#"></a>
								
								<div class="my-sounds__gallery-text-wrapper">
								
									<div class="my-sounds__gallery-attachment--label" style="display: none">
								
										<p>${soundLabel}</p>
								
									</div>
								
									<div class="my-sounds__gallery-attachment--description" style="display: none">
								
										<p>${soundDescription}</p>
								
									</div>
								
								</div>
								
								<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info">
								
									<div class="new-attachment__icon ">
								
										<svg viewBox="0 0 384 384" xmlns="http://www.w3.org/2000/svg">
										<path d="m176 288c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-192c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
										<path d="m16 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
										<path d="m152 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
										<path d="m80 240c8.832031 0 16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16zm0 0"/>
										<path d="m264 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
										<path d="m368 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
										<path d="m304 144c-8.832031 0-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16zm0 0"/>
										<path d="m176 368c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
										<path d="m192 48c8.832031 0 16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v16c0 8.832031 7.167969 16 16 16zm0 0"/></svg>
								
									</div>
								
									<div class="new-attachment__description">
								
										<p class="sound-title">${e.target.files[0].name}</p>
								
									</div>
								
								</div>
								
								</div>
								`;

								newAttachmentPlaceholder.innerHTML = newAttachmentPlaceholderContent;
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

	const basicUserDataForm = document.querySelector("#basic_user_data_form");

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

				// And scroll intro view
				basicUserDataForm.closest(".account__box-container").scrollIntoView({
					behavior: "smooth",
					block: "start",
					inline: "nearest"
				});
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

	const aboutUserDataForm = document.querySelector("#about_user_data_form");

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

				// And scroll intro view
				aboutUserDataForm.closest(".account__box-container").scrollIntoView({
					behavior: "smooth",
					block: "start",
					inline: "nearest"
				});
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

	const contactUserDataForm = document.querySelector("#contact_user_data_form");

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

				// And scroll intro view
				contactUserDataForm.closest(".account__box-container").scrollIntoView({
					behavior: "smooth",
					block: "start",
					inline: "nearest"
				});
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

					//remove emoty fields
					console.log(contactUserDataForm);
					let allRepeaterFieldsInThisForm = contactUserDataForm.querySelectorAll(
						".repeater__field"
					);

					allRepeaterFieldsInThisForm.forEach(repeaterField => {
						console.log(repeaterField.querySelector("INPUT").value);
						!repeaterField.querySelector("INPUT").value
							? repeaterField.remove()
							: "";
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

	//removing items

	const soundsGalleryWrapper = document.querySelector(".my-sounds__wrapper");
	const soundsToDeleteInput = document.querySelector("#sounds_to_delete");
	let soundsToDeleteArray = [];

	soundsGalleryWrapper &&
		soundsGalleryWrapper.addEventListener("mouseover", function(e) {
			if (e.target.classList.contains("my-sounds__gallery-row-wrapper")) {
				e.target.classList.add("my-sounds__gallery-attachment--hovered");

				e.target.addEventListener("mouseleave", e => {
					e.target.classList.contains("my-sounds__gallery-attachment--hovered")
						? e.target.classList.remove(
								"my-sounds__gallery-attachment--hovered"
						  )
						: "";
				});
			}

			if (e.target.classList.contains("remove-item")) {
				e.target.addEventListener("click", e => {
					e.preventDefault();

					let soundId = e.target.dataset.id;

					let thisSoundWrapper;

					//form
					if (e.target.closest("#upload_sound_to_gallery_form")) {
						// console.log("form");
						thisSoundWrapper = e.target.closest(".new-attachment__preview");

						thisSoundWrapper
							.closest("FORM")
							.querySelector("input[type='file']").value = null;
						thisSoundWrapper.closest(
							".new-attachment__placeholder"
						).style.display = "none";
						thisSoundWrapper.querySelector("p").innerText = null;

						thisSoundWrapper.remove();
					}

					//gallery
					if (e.target.closest(".my-sounds__gallery")) {
						// console.log("gallery");
						thisSoundWrapper = e.target.closest(".row-wrapper");

						thisSoundPreview = thisSoundWrapper.querySelector(
							".new-attachment__preview"
						);

						thisSoundWrapper && thisSoundWrapper.remove();
						thisSoundPreview && thisSoundPreview.remove();
					}

					if (soundId) {
						!soundsToDeleteArray.includes(soundId)
							? soundsToDeleteArray.push(soundId)
							: "";

						console.log(soundsToDeleteArray);
						soundsToDeleteInput.value = soundsToDeleteArray;
					}
				});
			}
		});

	//uploading

	var uploadSoundToGalleryForm = document.querySelector(
		"#upload_sound_to_gallery_form"
	);

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

				// And scroll intro view
				uploadSoundToGalleryForm
					.closest(".account__box-container")
					.scrollIntoView({
						behavior: "smooth",
						block: "start",
						inline: "nearest"
					});
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let allNewlyAddedSounds = $(
					"#upload_sound_to_gallery_form .new-attachment__preview"
				);

				// console.log(allNewlyAddedSounds);

				if (addedRows.length > 0) {
					allNewlyAddedSounds.each(function(index) {
						console.log(addedRows[index]);

						let numberOfDeletedRows = deletedRows.length;

						console.log(`numberOfDeletedRows: ${numberOfDeletedRows}`);

						let addedRowIndex = addedRows[index];

						let sound = $(this)
							.clone()
							.css("transform", "scale(0)")
							.css("position", "static")
							.css("transition", "all 0.3s ease-in")
							.css("display", "flex")
							.appendTo(".my-sounds__gallery")
							.addClass(
								"newlyAddedSound row-wrapper my-sounds__gallery-row-wrapper wrapper-flex-drow-mcol"
							);

						sound.find(".my-sounds__gallery-text-wrapper").addClass("col-d50");

						sound
							.find(".my-sounds__gallery-attachment--file-info")
							.addClass("col-d50");

						sound
							.find(".my-sounds__gallery-attachment--label")
							.css("display", "block");

						sound
							.find(".my-sounds__gallery-attachment--description")
							.css("display", "block");

						//clear input
						$(this).css("display", "none");

						setTimeout(function() {
							$(".newlyAddedSound")
								.css("transform", "scale(1)")
								.removeClass("newlyAddedSound");
						}, 200);
					});
				}

				let allRepeaterFieldsInThisForm = $(
					"#upload_sound_to_gallery_form .repeater__field"
				);

				//remove empty repeater fields and leave the 1st one

				if (allRepeaterFieldsInThisForm) {
					allRepeaterFieldsInThisForm.each(function(index) {
						if (index > 0) {
							$(this).remove();
						}
					});
				}

				//reset form
				$(uploadSoundToGalleryForm).trigger("reset");

				soundsToDeleteInput.value = "";
				soundsToDeleteArray = [];

				//re-index fields

				$(".my-sounds__gallery .row-wrapper").each(function(index) {
					console.log($(this));

					//because ACF repeater row indexes starts at 1
					$(this)
						.find("A")
						.attr("data-id", index + 1);
				});

				//clear data

				data = {};

				//scroll to the top of the block

				document
					.querySelector("#upload_sound_to_gallery_form")
					.closest(".account__box-container")
					.scrollIntoView({
						behavior: "smooth",
						block: "start",
						inline: "nearest"
					});
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

	const linkedinUserDataForm = document.querySelector(
		"#linkedin_user_data_form"
	);

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

				// And scroll intro view
				linkedinUserDataForm.closest(".account__box-container").scrollIntoView({
					behavior: "smooth",
					block: "start",
					inline: "nearest"
				});
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

	const workUserDataForm = document.querySelector("#work_user_data_form");

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

				// And scroll intro view
				workUserDataForm.closest(".account__box-container").scrollIntoView({
					behavior: "smooth",
					block: "start",
					inline: "nearest"
				});
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

	const uploadProfilePictureForm = document.querySelector(
		"#upload_profile_picture_form"
	);

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

	const uploadImageToGalleryForm = document.querySelector(
		"#upload_image_to_gallery_form"
	);

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

				uploadImageToGalleryForm
					.closest(".account__box-container")
					.scrollIntoView({
						behavior: "smooth",
						block: "start",
						inline: "nearest"
					});
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				// uploadPicturePreview.classList.remove("has-image");
			},

			success: function(data) {
				console.log("SUCCESS!");
				// console.log(data);

				const dataJSON = JSON.parse(data);
				// console.log(dataJSON);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let allRepeaterFieldsInThisForm = $(
					"#upload_image_to_gallery_form .repeater__field"
				);

				allRepeaterFieldsInThisForm.each(function(index) {
					console.log(this.querySelector("INPUT").value);

					let allNewAttachmentWrappersInThisForm = this.querySelector(
						".new-attachment__wrapper"
					);

					let repeaterInputValue = this.querySelector("INPUT").value;

					if (repeaterInputValue) {
						$(allNewAttachmentWrappersInThisForm)
							.clone()
							.css("transform", "scale(0)")
							.css("transition", "all 0.3s ease-in")
							.addClass("my-pictures__gallery-attachment")
							.addClass("newlyAddedImage")
							.appendTo(".my-pictures__gallery")
							.children("A")
							.attr("data-id", addedFilesIds[index]);

						// console.log(arrayOfIndexesToDelete[index]);

						// $(this).attr("data-id", arrayOfIndexesToDelete[index]);

						setTimeout(function() {
							$(".newlyAddedImage")
								.css("transform", "scale(1)")
								.removeClass("newlyAddedImage");
						}, 200);
					}
				});

				// let allNewAttachmentWrappersInThisForm = $(
				// 	"#upload_image_to_gallery_form .new-attachment__wrapper"
				// );

				// allNewAttachmentWrappersInThisForm.each(function(index) {

				// });

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

				document
					.querySelector("#upload_image_to_gallery_form")
					.closest(".account__box-container")
					.scrollIntoView({
						behavior: "smooth",
						block: "start",
						inline: "nearest"
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

	const uploadVideoToGalleryForm = document.querySelector(
		"#upload_video_to_gallery_form"
	);

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

				uploadVideoToGalleryForm
					.closest(".account__box-container")
					.scrollIntoView({
						behavior: "smooth",
						block: "start",
						inline: "nearest"
					});
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

	const changeSettingsUserLoginEmail = document.querySelector(
		"#settings_user_login_email_form"
	);

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

				changeSettingsUserLoginEmail
					.closest(".account__box-container")
					.scrollIntoView({
						behavior: "smooth",
						block: "start",
						inline: "nearest"
					});
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

	var userDataVisibilityForm = document.querySelector(
		"#settings_user_data_visibility_form"
	);

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

				userDataVisibilityForm
					.closest(".account__box-container")
					.scrollIntoView({
						behavior: "smooth",
						block: "start",
						inline: "nearest"
					});
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
