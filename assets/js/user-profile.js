document.addEventListener("DOMContentLoaded", () => {
	const switchSignIn = document.querySelector("#switch-sign-in");
	const switchSignUp = document.querySelector("#switch-sign-up");
	const signInWrapper = document.querySelector(".sign-in-wrapper");
	const signUpWrapper = document.querySelector(".sign-up-wrapper");

	if (switchSignIn) {
		switchSignUp.addEventListener("click", () => {
			signInWrapper.classList.remove("form-active", "form-activated");
			signInWrapper.classList.add("form-deactivated");

			signUpWrapper.classList.add("form-activated");
			setTimeout(() => signUpWrapper.classList.add("form-active"), 100);

			// switchSignIn.classList.remove("switch-active");
			// switchSignUp.classList.add("switch-active");
		});

		switchSignIn.addEventListener("click", () => {
			signUpWrapper.classList.remove("form-active", "form-activated");
			signUpWrapper.classList.add("form-deactivated");

			signInWrapper.classList.add("form-activated");
			setTimeout(() => signInWrapper.classList.add("form-active"), 100);

			// switchSignUp.classList.remove("switch-active");
			// switchSignIn.classList.add("switch-active");
		});
	}

	const accountNavigation = document.querySelector(".account__navigation");

	if (accountNavigation) {
		const allAccountNavigationLinks = accountNavigation.querySelectorAll("A");

		allAccountNavigationLinks.forEach(link => {
			link.addEventListener("click", function() {
				let sectionId = this.dataset.profileSection;
				let targetSection = document.querySelector(`#${sectionId}`);

				if (sectionId && targetSection) {
					const activeProfileSection = document.querySelector(
						".profile-section--active"
					);

					activeProfileSection.classList.remove("profile-section--active");
					activeProfileSection.classList.add("profile-section--not-active");

					targetSection.classList.remove("profile-section--not-active");
					targetSection.classList.add("profile-section--active");
				}
			});
		});
	}

	const allButtonsEditAccountContent = document.querySelectorAll(
		".button__edit-account-content"
	);

	if (allButtonsEditAccountContent) {
		allButtonsEditAccountContent.forEach(button => {
			button.addEventListener("click", function(e) {
				e.preventDefault();

				let editBoxId = this.dataset.profileEdit;
				let editBox = document.querySelector(`#${editBoxId}`);
				let contentBox = this.parentNode.querySelector(".content-box");

				if (editBox && contentBox) {
					editBox.classList.toggle("box--active");
					contentBox.classList.toggle("box--not-active");
				}
			});
		});
	}

	const allButtonsSaveAccountContent = document.querySelectorAll(
		".edit-box input[type='submit']"
	);

	if (allButtonsSaveAccountContent) {
		allButtonsSaveAccountContent.forEach(button => {
			button.addEventListener("click", function() {
				let editBoxId = this.closest(".account__box-container").querySelector(
					".button__edit-account-content"
				).dataset.profileEdit;

				let editBox = document.querySelector(`#${editBoxId}`);
				let contentBox = this.closest(".account__box-container").querySelector(
					".content-box"
				);

				if (editBox && contentBox) {
					editBox.classList.toggle("box--active");
					contentBox.classList.toggle("box--not-active");
				}
			});
		});
	}

	//Node repeater

	const allRepeaterHolders = document.querySelectorAll(".repeater__holder");

	if (allRepeaterHolders) {
		let i = 1;

		allRepeaterHolders.forEach(holder => {
			holder.addEventListener("click", function(e) {
				if (e.target.classList.contains("repeater__button--add")) {
					e.preventDefault();

					const container = this.closest(".repeater__holder").querySelector(
						".repeater__field-wrapper"
					);

					let clonedField = this.closest(".repeater__holder")
						.querySelector(".repeater__field")
						.cloneNode(true);

					clonedField.dataset.repeaterId = i;

					i++;

					let deleteFieldButton = document.createElement("BUTTON");

					deleteFieldButton.classList.add(
						"repeater__button",
						"repeater__button--delete"
					);

					deleteFieldButton.innerText = "-";

					clonedField.appendChild(deleteFieldButton);

					//clearings

					let allInputsOfClonedField = clonedField.querySelectorAll("INPUT");

					let allTextAreasOfClonedField = clonedField.querySelectorAll(
						"TEXTAREA"
					);

					allInputsOfClonedField &&
						allInputsOfClonedField.forEach(clonedInput => {
							clonedInput.value = "";
						});

					allTextAreasOfClonedField &&
						allTextAreasOfClonedField.forEach(clonedTextArea => {
							clonedTextArea.value = "";
						});

					let clonedFieldNewAttachmentPlaceholder = clonedField.querySelector(
						".new-attachment__placeholder"
					);

					clonedFieldNewAttachmentPlaceholder &&
					clonedFieldNewAttachmentPlaceholder
						? (clonedFieldNewAttachmentPlaceholder.src = "")
						: "";

					clonedFieldNewAttachmentPlaceholder &&
						clonedFieldNewAttachmentPlaceholder
							.querySelector(".new-attachment__preview")
							?.remove();

					if (clonedFieldNewAttachmentPlaceholder) {
						clonedFieldNewAttachmentPlaceholder.style.display = "none";
					}

					container.appendChild(clonedField);
				}

				if (e.target.classList.contains("repeater__button--delete")) {
					e.preventDefault();
					e.target.closest(".repeater__field").remove();
				}
			});
		});
	}

	//New profile picture sneakpeak when uploading file

	const uploadProfilePictureForm = document.querySelector(
		"form#upload_profile_picture_form"
	);

	if (uploadProfilePictureForm) {
		const fileImage = uploadProfilePictureForm.querySelector(
			".input-preview__src"
		);

		fileImage.onchange = function() {
			const originalImage = document.querySelector(
				".profile-picture__wrapper img"
			);

			const filePreviewWrapper = uploadProfilePictureForm.querySelector(
				".input-preview__wrapper"
			);
			const filePreview = uploadProfilePictureForm.querySelector(
				".input-preview"
			);
			const submitButton = uploadProfilePictureForm.querySelector(
				"input[type='submit']"
			);

			const reader = new FileReader();

			reader.onload = function(e) {
				originalImage.style.opacity = 0;
				submitButton.classList.add("reveal-button");
				// get loaded data and render thumbnail.
				filePreview.src = e.target.result;
				filePreviewWrapper.classList.add("has-image");
			};

			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		};
	}

	//Character limit counter for all textareas with "maxlength" attribute

	const allTextareas = document.querySelectorAll("TEXTAREA");

	const allTextareasWithMaxLength = [];

	[...allTextareas].filter(textarea => {
		textarea.getAttribute("maxlength")
			? allTextareasWithMaxLength.push(textarea)
			: "";
	});

	if (allTextareasWithMaxLength) {
		allTextareasWithMaxLength.forEach(textarea => {
			let thisTextareaForm = textarea.closest("FORM");
			let thisTextareaLabel = thisTextareaForm.querySelector("LABEL");
			let thisTextareaMaxlength = textarea.getAttribute("maxlength");

			thisTextareaLabel
				? (thisTextareaLabel.innerHTML = `${textarea.value.length}/${thisTextareaMaxlength}`)
				: "";

			thisTextareaLabel
				? textarea.addEventListener("input", function(e) {
						thisTextareaLabel.innerHTML = `${this.value.length}/${thisTextareaMaxlength}`;
				  })
				: "";
		});
	}

	//Picture Gallery

	const galleryWrapper = document.querySelector(".my-pictures__wrapper");

	const imageToGalleryInput = galleryWrapper?.querySelector(
		"#image-to-gallery__input"
	);

	const picturesToDeleteArray = [];
	const picturesToDeleteInput = document.querySelector("#pictures_to_delete");

	galleryWrapper &&
		galleryWrapper.addEventListener("mouseover", function(e) {
			if (e.target.classList.contains("my-pictures__gallery-attachment")) {
				// console.log(e.target);
				e.target.classList.add("my-pictures__gallery-attachment--hovered");

				e.target.addEventListener("mouseleave", e => {
					e.target.classList.contains(
						"my-pictures__gallery-attachment--hovered"
					)
						? e.target.classList.remove(
								"my-pictures__gallery-attachment--hovered"
						  )
						: "";
				});
			}

			if (e.target.classList.contains("remove-item")) {
				e.target.addEventListener("click", e => {
					e.preventDefault();

					let thisPictureWrapper = e.target.closest(
						".my-pictures__gallery-attachment"
					);

					let pictureId = e.target.dataset.id;

					if (
						thisPictureWrapper.classList.contains(
							"newImageInGalleryPlaceholder"
						)
					) {
						console.log("clear");
						imageToGalleryInput.value = null;
						thisPictureWrapper.style.display = "none";
						thisPictureWrapper.querySelector("IMG").src = null;

						return;
					}

					if (pictureId) {
						!picturesToDeleteArray.includes(pictureId)
							? picturesToDeleteArray.push(pictureId)
							: "";

						console.log(picturesToDeleteArray);
						picturesToDeleteInput.value = picturesToDeleteArray;
					}

					thisPictureWrapper.remove();
				});
			}
		});

	//Video Gallery

	const videosGalleryWrapper = document.querySelector(".my-videos__wrapper");

	const videoToGalleryInput = videosGalleryWrapper?.querySelector(
		"#video-to-gallery__input"
	);

	const videosToDeleteArray = [];
	const videosToDeleteInput = document.querySelector("#videos_to_delete");

	videosGalleryWrapper &&
		videosGalleryWrapper.addEventListener("mouseover", function(e) {
			if (e.target.classList.contains("my-videos__gallery-attachment")) {
				console.log(e.target);
				e.target.classList.add("my-videos__gallery-attachment--hovered");

				e.target.addEventListener("mouseleave", e => {
					e.target.classList.contains("my-videos__gallery-attachment--hovered")
						? e.target.classList.remove(
								"my-videos__gallery-attachment--hovered"
						  )
						: "";
				});
			}

			if (e.target.classList.contains("remove-item")) {
				e.target.addEventListener("click", e => {
					e.preventDefault();

					let thisVideoWrapper = e.target.closest(
						".my-videos__gallery-attachment"
					);

					let videoId = e.target.dataset.id;

					if (thisVideoWrapper.id === "newVideoInGalleryPlaceholder") {
						console.log("clear");
						videoToGalleryInput.value = null;
						thisVideoWrapper.style.display = "none";
						thisVideoWrapper.querySelector("p").innerText = null;

						return;
					}

					if (videoId) {
						!videosToDeleteArray.includes(videoId)
							? videosToDeleteArray.push(videoId)
							: "";

						console.log(videosToDeleteArray);
						videosToDeleteInput.value = videosToDeleteArray;
					}

					thisVideoWrapper.remove();
				});
			}
		});
});
