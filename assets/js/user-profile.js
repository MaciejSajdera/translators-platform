document.addEventListener("DOMContentLoaded", () => {
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
			button.addEventListener("click", function() {
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
		allRepeaterHolders.forEach(holder => {
			holder.addEventListener("click", function(e) {
				if (e.target.classList.contains("repeater__button--add")) {
					e.preventDefault();

					const container = this.parentNode.querySelector(
						".repeater__field-wrapper"
					);

					let clonedField = this.parentNode
						.querySelector(".repeater__field")
						.cloneNode(true);

					let deleteFieldButton = document.createElement("BUTTON");

					deleteFieldButton.classList.add(
						"repeater__button",
						"repeater__button--delete"
					);

					deleteFieldButton.innerText = "-";

					clonedField.appendChild(deleteFieldButton);

					let clonedFieldInput = clonedField.querySelector("INPUT");

					clonedFieldInput ? (clonedFieldInput.value = "") : "";

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

	//Gallery

	const galleryWrapper = document.querySelector(".my-pictures__wrapper");
	const allPictureGalleryAttachments = document.querySelectorAll(
		".my-pictures__gallery-attachment"
	);
	const imageToGalleryInput = galleryWrapper.querySelector(
		"#image-to-gallery__input"
	);

	const allRemovePictureButtons = galleryWrapper.querySelectorAll(
		".remove-item"
	);
	const picturesToDeleteArray = [];
	const picturesToDeleteInput = document.querySelector("#pictures_to_delete");

	galleryWrapper.addEventListener("mouseover", function(e) {
		if (e.target.classList.contains("my-pictures__gallery-attachment")) {
			console.log(e.target);
			e.target.classList.add("my-pictures__gallery-attachment--hovered");
		}

		if (e.target.classList.contains("remove-item")) {
			e.target.addEventListener("click", e => {
				e.preventDefault();

				let thisPictureWrapper = e.target.closest(
					".my-pictures__gallery-attachment"
				);

				thisPictureWrapper.remove();

				let pictureId = e.target.dataset.id;

				if (pictureId === "clear-input") {
					console.log("clear");
					imageToGalleryInput.value = null;
				}

				if (pictureId) {
					!picturesToDeleteArray.includes(pictureId)
						? picturesToDeleteArray.push(pictureId)
						: "";

					console.log(picturesToDeleteArray);
					picturesToDeleteInput.value = picturesToDeleteArray;
				}
			});
		}
	});

	allPictureGalleryAttachments.forEach(pictureWrapper => {
		// pictureWrapper.addEventListener("mouseenter", e => {
		// 	pictureWrapper.classList.add("my-pictures__gallery-attachment--hovered");
		// });

		pictureWrapper.addEventListener("mouseleave", e => {
			pictureWrapper.classList.contains(
				"my-pictures__gallery-attachment--hovered"
			)
				? pictureWrapper.classList.remove(
						"my-pictures__gallery-attachment--hovered"
				  )
				: "";
		});
	});

	// allRemovePictureButtons.forEach(button => {
	// 	button.addEventListener("click", e => {
	// 		e.preventDefault();

	// 		let thisPictureWrapper = button.closest(
	// 			".my-pictures__gallery-attachment"
	// 		);

	// 		thisPictureWrapper.remove();

	// 		let pictureId = button.dataset.id;

	// 		if (pictureId === "clear-input") {
	// 			console.log("clear");
	// 			imageToGalleryInput.value = null;
	// 		}

	// 		if (pictureId) {
	// 			!picturesToDeleteArray.includes(pictureId)
	// 				? picturesToDeleteArray.push(pictureId)
	// 				: "";

	// 			console.log(picturesToDeleteArray);
	// 			picturesToDeleteInput.value = picturesToDeleteArray;
	// 		}
	// 	});
	// });
});
