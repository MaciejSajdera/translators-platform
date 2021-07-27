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

	console.log(allButtonsSaveAccountContent);

	if (allButtonsSaveAccountContent) {
		allButtonsSaveAccountContent.forEach(button => {
			button.addEventListener("click", function() {
				let editBoxId = this.closest(".account__box-container").querySelector(
					".button__edit-account-content"
				).dataset.profileEdit;

				console.log(editBoxId);

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

	const allRepeaterAddInputButtons = document.querySelectorAll(
		".repeater-input__add-button"
	);

	if (allRepeaterAddInputButtons) {
		const makeAddingInputsRepeatable = () => {
			allRepeaterAddInputButtons.forEach(button => {
				button.addEventListener("click", function(e) {
					e.preventDefault();

					const container = this.parentNode.querySelector(
						".repeater-input__wrapper"
					);

					let clonedInput = this.parentNode.querySelector("INPUT").cloneNode();

					container.appendChild(clonedInput);
				});
			});
		};

		makeAddingInputsRepeatable();
	}

	const uploadProfilePictureForm = document.querySelector(
		"form#upload-profile-picture"
	);

	if (uploadProfilePictureForm) {
		const fileImage = uploadProfilePictureForm.querySelector(
			".input-preview__src"
		);

		fileImage.onchange = function() {
			const originalImage = document.querySelector(
				".profile-pricture__wrapper img"
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

	const aboutUserForm = document.querySelector("#about_user_data_form");

	if (aboutUserForm) {
		const aboutUserTextarea = aboutUserForm.querySelector("TEXTAREA");
		const aboutUserTextareaLabel = aboutUserForm.querySelector("LABEL");

		aboutUserTextareaLabel.innerHTML = `${aboutUserTextarea.value.length}/300`;

		aboutUserTextarea.addEventListener("input", function(e) {
			aboutUserTextareaLabel.innerHTML = `${this.value.length}/300`;
		});
	}
});
