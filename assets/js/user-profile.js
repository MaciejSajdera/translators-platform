const accountNavigation = document.querySelector(".account__navigation");

if (accountNavigation) {
	const allAccountNavigationLinks = accountNavigation.querySelectorAll("A");
	const allProfileSections = document.querySelector(
		".account__main .profile-section"
	);

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
