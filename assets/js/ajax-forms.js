import { confetti } from "./domConfetti.js";
import { handleModal } from "./helperFunctions.js";
const ProgressBar = require("progressbar.js");

jQuery(document).ready(function($) {
	/*****ADDITIONAL FUNCTIONALITIES RELATED TO FORMS ********/

	console.log("test2");

	const accountNavigation = document.querySelector(".account__navigation");

	if (accountNavigation) {
		const allAccountNavigationLinks = accountNavigation.querySelectorAll("A");

		allAccountNavigationLinks.forEach(link => {
			let linkClicked = false;

			link.addEventListener("click", function() {
				linkClicked = true;

				allAccountNavigationLinks.forEach(link => {
					link.classList.contains("active")
						? link.classList.remove("active")
						: "";
				});

				linkClicked ? link.classList.toggle("active") : "";

				let sectionId = this.dataset.profileSection;
				let targetSection = document.querySelector(`#${sectionId}`);

				if (sectionId && targetSection) {
					const activeProfileSection = document.querySelector(
						".profile-section--active"
					);

					activeProfileSection?.classList.remove("profile-section--active");
					activeProfileSection?.classList.add("profile-section--not-active");

					targetSection?.classList.remove("profile-section--not-active");
					targetSection?.classList.add("profile-section--active");

					localStorage?.setItem("activeProfileSectionID", sectionId);
				}
			});
		});
	}

	//keep the right tab active after page reload

	if (localStorage.activeProfileSectionID && accountNavigation) {
		const activeProfileSectionID = document.querySelector(
			".profile-section--active"
		).id;

		const lastChosenProfileSectionID = localStorage.getItem(
			"activeProfileSectionID"
		);

		const profileSectionNavigationLink = document.querySelector(
			`a[data-profile-section="${lastChosenProfileSectionID}"]`
		);

		profileSectionNavigationLink.classList.add("active");

		if (activeProfileSectionID !== lastChosenProfileSectionID) {
			const activeProfileSection = document.querySelector(
				`#${activeProfileSectionID}`
			);

			const lastChosenProfileSection = document.querySelector(
				`#${lastChosenProfileSectionID}`
			);

			activeProfileSection?.classList.remove("profile-section--active");
			activeProfileSection?.classList.add("profile-section--not-active");

			lastChosenProfileSection?.classList.remove("profile-section--not-active");
			lastChosenProfileSection?.classList.add("profile-section--active");
		}
	}

	const allButtonsEditAccountContent = document.querySelectorAll(
		".button__edit-account-content"
	);

	let editContentButtonClicked = false;

	if (allButtonsEditAccountContent) {
		allButtonsEditAccountContent.forEach(button => {
			button.addEventListener("click", function(e) {
				e.preventDefault();
				editContentButtonClicked = !editContentButtonClicked;

				const editBoxId = this.dataset.profileEdit;
				const editBox = document.querySelector(`#${editBoxId}`);
				const contentBox = this.closest(".info-box").querySelector(
					".content-box"
				);

				const closestTextInput = editBox.querySelector('input[type="text"]');
				const closestTextarea = editBox.querySelector("textarea");

				if (editBox && contentBox) {
					editBox.classList.toggle("box--active");
					contentBox.classList.toggle("box--not-active");
					this.classList.toggle("button__edit-account-content--back");
				}

				if (editContentButtonClicked) {
					this.innerHTML = `Powrót`;
				}

				if (!editContentButtonClicked) {
					this.innerHTML = `Edytuj`;
				}

				if (closestTextInput) {
					closestTextInput.focus();
					return;
				}

				if (closestTextarea) {
					closestTextarea.focus();
					return;
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
				const editContentButton = this.closest(
					".account__box-container"
				).querySelector(".button__edit-account-content");

				const editBoxId = editContentButton.dataset.profileEdit;

				const editBox = document.querySelector(`#${editBoxId}`);
				const contentBox = this.closest(
					".account__box-container"
				).querySelector(".content-box");

				if (editBox && contentBox) {
					editBox.classList.toggle("box--active");
					contentBox.classList.toggle("box--not-active");
				}

				if (
					editContentButton &&
					editContentButton.classList.contains(
						"button__edit-account-content--back"
					)
				) {
					editContentButton.classList.remove(
						"button__edit-account-content--back"
					);
					editContentButton.innerHTML = `Edytuj`;
					editContentButtonClicked = false;
				}
			});
		});
	}

	//Character limit counter for all textareas with "maxlength" attribute

	document.addEventListener("input", function(e) {
		if (
			e.target.nodeName === "TEXTAREA" &&
			e.target.getAttribute("maxlength") &&
			e.target.closest("FIELDSET")
		) {
			const textarea = e.target;
			const thisTextareaField = textarea.closest("FIELDSET");
			const thisTextareaCharactersCounter = thisTextareaField.querySelector(
				".characters-counter"
			);
			const thisTextareaMaxlength = textarea.getAttribute("maxlength");

			thisTextareaCharactersCounter
				? (thisTextareaCharactersCounter.innerHTML = `${textarea.value.length}/${thisTextareaMaxlength}`)
				: "";
		}
	});

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

					let thisUploadFileButton;

					if (
						e.target.closest(".repeater__field") &&
						e.target
							.closest(".repeater__field")
							.querySelector(".button--upload-file")
					) {
						thisUploadFileButton = e.target
							.closest(".repeater__field")
							.querySelector(".button--upload-file");
					}

					if (
						thisUploadFileButton &&
						thisUploadFileButton.classList.contains("dnone")
					) {
						thisUploadFileButton.classList.remove("dnone");
					}

					let pictureId = e.target.dataset.id;

					if (
						thisPictureWrapper &&
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

					thisPictureWrapper && thisPictureWrapper.remove();
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

	// Fields to be filled

	const fillTheseFieldsButton = document.querySelector("#fillTheseFields");
	const emptyProfileFieldsLabels = document.querySelector(
		"#emptyProfileFieldsLabels"
	);

	fillTheseFieldsButton &&
		fillTheseFieldsButton.addEventListener("click", e => {
			emptyProfileFieldsLabels.classList.toggle("show-empty-fields");
		});

	const allRepeaterHolders = document.querySelectorAll(".repeater__holder");

	let i = 1;

	allRepeaterHolders.forEach(holder => {
		// Node repeater

		holder.addEventListener("click", function(e) {
			if (e.target.classList.contains("repeater__button--add")) {
				e.preventDefault();

				console.log(this);

				const container = e.target
					.closest(".repeater__holder")
					.querySelector(".repeater__field-wrapper");

				let clonedField = e.target
					.closest(".repeater__holder")
					.querySelector(".repeater__field")
					.cloneNode(true);

				clonedField.dataset.repeaterId = i;

				i++;

				let deleteFieldButton = document.createElement("BUTTON");

				deleteFieldButton.classList.add(
					"repeater__button--delete",
					"remove",
					"remove-item"
				);

				deleteFieldButton.innerText = "";

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

		/* 	For handling previews of files added by repeaters */

		const repeaterFieldWrapper = holder.querySelector(
			".repeater__field-wrapper"
		);

		const allOriginalInputs = holder.querySelectorAll(".input-preview__src");

		//static for already existing inputs
		allOriginalInputs.forEach(thisInput => {
			thisInput.addEventListener("change", function(e) {
				// console.log(e);

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

				if (
					!closestRowWrapper.querySelector("input[type='file']").files[0] &&
					newAttachmentPlaceholder.id === "newSoundInGalleryPlaceholder"
				) {
					let soundLabel = thisInput
						.closest(".repeater__field")
						.querySelector(".input-text").value;
					let soundDescription = thisInput
						.closest(".repeater__field")
						.querySelector(".input-textarea").value;

					let newAttachmentPlaceholderContent = `
					<div class="new-attachment__preview row-wrapper my-sounds__gallery-row-wrapper pb--2 mb--2" style="position: absolute; display: none;">

						<a class="remove-item remove" data-id="clear-input" href="#"></a>

						<div class="my-sounds__gallery-text-wrapper">

							<div class="my-sounds__gallery-attachment--label mb--1">

								<p class="fw--500">${soundLabel}</p>

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
					<div class="new-attachment__preview row-wrapper my-sounds__gallery-row-wrapper pb--2 mb--2">

						<a class="remove-item remove" data-id="clear-input" href="#"></a>
						
						<div class="my-sounds__gallery-text-wrapper">
						
							<div class="my-sounds__gallery-attachment--label mb--1" style="display: none">
						
								<p class="fw--500">${soundLabel}</p>
						
							</div>
						
							<div class="my-sounds__gallery-attachment--description" style="display: none">
						
								<p>${soundDescription}</p>
						
							</div>
						
						</div>
						
						<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info">
						
							<div class="new-attachment__icon ">
						
								<svg width="44" height="38" viewBox="0 0 44 38" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M26.4822 19.0011C26.4822 13.3803 26.4822 7.74847 26.4822 2.12766C26.4822 1.44301 26.681 0.857736 27.2221 0.438109C27.8405 -0.0477762 28.5362 -0.136119 29.254 0.206209C29.9828 0.548537 30.3362 1.14485 30.3804 1.93993C30.3804 2.00619 30.3804 2.08349 30.3804 2.14975C30.3804 13.3803 30.3804 24.6219 30.3804 35.8525C30.3804 36.6917 30.0822 37.3543 29.3313 37.7629C28.0834 38.4365 26.5595 37.5752 26.4822 36.1617C26.4712 36.0181 26.4712 35.8746 26.4712 35.731C26.4822 30.1544 26.4822 24.5778 26.4822 19.0011Z" fill="#18A0AA"/>
								<path d="M23.744 19.0233C23.744 23.0428 23.744 27.0624 23.744 31.082C23.744 32.098 23.1587 32.8599 22.2201 33.0697C21.0385 33.3458 19.8901 32.4513 19.8569 31.2366C19.8569 31.1704 19.8569 31.0931 19.8569 31.0268C19.8569 23.0097 19.8569 14.9816 19.8569 6.96447C19.8569 6.13626 20.1661 5.49577 20.895 5.10928C22.1649 4.42462 23.733 5.34118 23.744 6.78779C23.7661 8.95218 23.7551 11.1055 23.7551 13.2699C23.744 15.1803 23.744 17.1018 23.744 19.0233Z" fill="#16538C"/>
								<path d="M6.62239 18.9791C6.62239 15.7877 6.62239 12.5853 6.62239 9.39391C6.62239 8.46631 7.05306 7.78166 7.81502 7.46141C9.0739 6.93136 10.4543 7.81478 10.5205 9.19514C10.5205 9.2614 10.5205 9.31661 10.5205 9.38287C10.5205 15.7877 10.5205 22.2036 10.5205 28.6084C10.5205 29.536 10.0457 30.2649 9.25059 30.552C8.00274 31.0158 6.6776 30.1434 6.63343 28.8293C6.61135 28.0784 6.62239 27.3275 6.62239 26.5766C6.62239 24.0478 6.62239 21.5079 6.62239 18.9791Z" fill="#16538C"/>
								<path d="M36.9919 19.001C36.9919 22.1924 36.9919 25.3948 36.9919 28.5862C36.9919 29.3702 36.7158 29.9996 36.0422 30.3972C34.7723 31.1591 33.1821 30.2868 33.0938 28.807C33.0938 28.7408 33.0938 28.6856 33.0938 28.6193C33.0938 22.2034 33.0938 15.7875 33.0938 9.37163C33.0938 8.4109 33.6017 7.68208 34.4741 7.40601C35.6557 7.01951 36.9256 7.89189 36.9808 9.12869C37.0029 9.55936 36.9919 10.0011 36.9919 10.4317C36.9919 13.2808 36.9919 16.1409 36.9919 19.001Z" fill="#16538C"/>
								<path d="M17.1435 18.9906C17.1435 21.3869 17.1435 23.7832 17.1435 26.1795C17.1435 26.9967 16.8233 27.6261 16.0945 28.0126C14.8135 28.6972 13.3006 27.7917 13.2344 26.312C13.2344 26.2678 13.2344 26.2126 13.2344 26.1684C13.2344 21.3869 13.2344 16.5943 13.2344 11.8127C13.2344 10.8741 13.7203 10.1453 14.5264 9.85817C15.7411 9.41645 17.0662 10.2778 17.1215 11.5698C17.1546 12.3649 17.1325 13.171 17.1325 13.9661C17.1435 15.6336 17.1435 17.3121 17.1435 18.9906Z" fill="#18A0AA"/>
								<path d="M0.0110428 18.9687C0.0110428 17.3454 0.0110428 15.7221 0.0110428 14.1099C0.0110428 13.1933 0.66257 12.4203 1.55704 12.2215C2.44047 12.0228 3.36806 12.4866 3.72144 13.3258C3.83186 13.5798 3.89812 13.878 3.89812 14.154C3.90916 17.3896 3.90916 20.6251 3.89812 23.8607C3.89812 24.965 3.01469 25.8373 1.94354 25.8263C0.850298 25.8153 0 24.9429 0 23.8165C0.0110428 22.2043 0.0110428 20.581 0.0110428 18.9687Z" fill="#18A0AA"/>
								<path d="M39.7158 18.9904C39.7158 18.1732 39.7048 17.345 39.7158 16.5278C39.7268 15.6002 40.3784 14.8383 41.2949 14.6505C42.1783 14.4738 43.0949 14.9376 43.4483 15.7879C43.5477 16.0198 43.6029 16.2959 43.6139 16.5499C43.625 18.1842 43.625 19.8186 43.6139 21.464C43.6139 22.5241 42.7526 23.3744 41.6925 23.3854C40.6103 23.3965 39.7489 22.5682 39.7158 21.4971C39.7158 21.475 39.7158 21.4529 39.7158 21.4308C39.7048 20.6026 39.7048 19.7965 39.7158 18.9904C39.7048 18.9904 39.7158 18.9904 39.7158 18.9904Z" fill="#18A0AA"/>
								</svg>
						
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
					const allFileInputs = holder.querySelectorAll(".input-preview__src");

					allFileInputs.forEach(thisInput => {
						thisInput.addEventListener("change", function(e) {
							console.log(e);

							const closestRowWrapper = thisInput.closest(".row-wrapper");

							const newAttachmentPlaceholder = closestRowWrapper?.querySelector(
								".new-attachment__placeholder"
							);

							if (newAttachmentPlaceholder.tagName == "IMG") {
								newAttachmentPlaceholder.setAttribute(
									"src",
									URL.createObjectURL(e.target.files[0])
								);
							}

							if (
								newAttachmentPlaceholder.tagName == "IMG" &&
								newAttachmentPlaceholder.id === "newImageInGalleryPlaceholder"
							) {
								const uploadFileButton = thisInput.closest(
									".button--upload-file"
								);
								uploadFileButton.classList.add("dnone");
							}

							if (
								!closestRowWrapper.querySelector("input[type='file']")
									.files[0] &&
								newAttachmentPlaceholder.id === "newSoundInGalleryPlaceholder"
							) {
								const soundLabel = thisInput
									.closest(".repeater__field")
									.querySelector(".input-text").value;
								const soundDescription = thisInput
									.closest(".repeater__field")
									.querySelector(".input-textarea").value;

								const newAttachmentPlaceholderContent = `
								<div class="new-attachment__preview row-wrapper my-sounds__gallery-row-wrapper pb--2 mb--2" style="position: absolute; display: none;">
			
									<a class="remove-item remove" data-id="clear-input" href="#"></a>
			
									<div class="my-sounds__gallery-text-wrapper">
			
										<div class="my-sounds__gallery-attachment--label mb--1">
			
											<p class="fw--500">${soundLabel}</p>
			
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
								const uploadFileButton = thisInput.closest(
									".button--upload-file"
								);

								uploadFileButton.classList.add("dnone");

								// newAttachmentPlaceholder.querySelector(".sound-title").textContent =
								// 	e.target.files[0].name;
								const soundLabel = thisInput
									.closest(".repeater__field")
									.querySelector(".input-text").value;
								const soundDescription = thisInput
									.closest(".repeater__field")
									.querySelector(".input-textarea").value;

								const newAttachmentPlaceholderContent = `
								<div class="new-attachment__preview row-wrapper my-sounds__gallery-row-wrapper pb--2 mb--2">
			
								<a class="remove-item remove" data-id="clear-input" href="#"></a>
								
								<div class="my-sounds__gallery-text-wrapper">
								
									<div class="my-sounds__gallery-attachment--label mb--1" style="display: none">
								
										<p class="fw--500">${soundLabel}</p>
								
									</div>
								
									<div class="my-sounds__gallery-attachment--description" style="display: none">
								
										<p>${soundDescription}</p>
								
									</div>
								
								</div>
								
								<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info">
								
									<div class="new-attachment__icon ">
								
										<svg width="44" height="38" viewBox="0 0 44 38" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M26.4822 19.0011C26.4822 13.3803 26.4822 7.74847 26.4822 2.12766C26.4822 1.44301 26.681 0.857736 27.2221 0.438109C27.8405 -0.0477762 28.5362 -0.136119 29.254 0.206209C29.9828 0.548537 30.3362 1.14485 30.3804 1.93993C30.3804 2.00619 30.3804 2.08349 30.3804 2.14975C30.3804 13.3803 30.3804 24.6219 30.3804 35.8525C30.3804 36.6917 30.0822 37.3543 29.3313 37.7629C28.0834 38.4365 26.5595 37.5752 26.4822 36.1617C26.4712 36.0181 26.4712 35.8746 26.4712 35.731C26.4822 30.1544 26.4822 24.5778 26.4822 19.0011Z" fill="#18A0AA"/>
										<path d="M23.744 19.0233C23.744 23.0428 23.744 27.0624 23.744 31.082C23.744 32.098 23.1587 32.8599 22.2201 33.0697C21.0385 33.3458 19.8901 32.4513 19.8569 31.2366C19.8569 31.1704 19.8569 31.0931 19.8569 31.0268C19.8569 23.0097 19.8569 14.9816 19.8569 6.96447C19.8569 6.13626 20.1661 5.49577 20.895 5.10928C22.1649 4.42462 23.733 5.34118 23.744 6.78779C23.7661 8.95218 23.7551 11.1055 23.7551 13.2699C23.744 15.1803 23.744 17.1018 23.744 19.0233Z" fill="#16538C"/>
										<path d="M6.62239 18.9791C6.62239 15.7877 6.62239 12.5853 6.62239 9.39391C6.62239 8.46631 7.05306 7.78166 7.81502 7.46141C9.0739 6.93136 10.4543 7.81478 10.5205 9.19514C10.5205 9.2614 10.5205 9.31661 10.5205 9.38287C10.5205 15.7877 10.5205 22.2036 10.5205 28.6084C10.5205 29.536 10.0457 30.2649 9.25059 30.552C8.00274 31.0158 6.6776 30.1434 6.63343 28.8293C6.61135 28.0784 6.62239 27.3275 6.62239 26.5766C6.62239 24.0478 6.62239 21.5079 6.62239 18.9791Z" fill="#16538C"/>
										<path d="M36.9919 19.001C36.9919 22.1924 36.9919 25.3948 36.9919 28.5862C36.9919 29.3702 36.7158 29.9996 36.0422 30.3972C34.7723 31.1591 33.1821 30.2868 33.0938 28.807C33.0938 28.7408 33.0938 28.6856 33.0938 28.6193C33.0938 22.2034 33.0938 15.7875 33.0938 9.37163C33.0938 8.4109 33.6017 7.68208 34.4741 7.40601C35.6557 7.01951 36.9256 7.89189 36.9808 9.12869C37.0029 9.55936 36.9919 10.0011 36.9919 10.4317C36.9919 13.2808 36.9919 16.1409 36.9919 19.001Z" fill="#16538C"/>
										<path d="M17.1435 18.9906C17.1435 21.3869 17.1435 23.7832 17.1435 26.1795C17.1435 26.9967 16.8233 27.6261 16.0945 28.0126C14.8135 28.6972 13.3006 27.7917 13.2344 26.312C13.2344 26.2678 13.2344 26.2126 13.2344 26.1684C13.2344 21.3869 13.2344 16.5943 13.2344 11.8127C13.2344 10.8741 13.7203 10.1453 14.5264 9.85817C15.7411 9.41645 17.0662 10.2778 17.1215 11.5698C17.1546 12.3649 17.1325 13.171 17.1325 13.9661C17.1435 15.6336 17.1435 17.3121 17.1435 18.9906Z" fill="#18A0AA"/>
										<path d="M0.0110428 18.9687C0.0110428 17.3454 0.0110428 15.7221 0.0110428 14.1099C0.0110428 13.1933 0.66257 12.4203 1.55704 12.2215C2.44047 12.0228 3.36806 12.4866 3.72144 13.3258C3.83186 13.5798 3.89812 13.878 3.89812 14.154C3.90916 17.3896 3.90916 20.6251 3.89812 23.8607C3.89812 24.965 3.01469 25.8373 1.94354 25.8263C0.850298 25.8153 0 24.9429 0 23.8165C0.0110428 22.2043 0.0110428 20.581 0.0110428 18.9687Z" fill="#18A0AA"/>
										<path d="M39.7158 18.9904C39.7158 18.1732 39.7048 17.345 39.7158 16.5278C39.7268 15.6002 40.3784 14.8383 41.2949 14.6505C42.1783 14.4738 43.0949 14.9376 43.4483 15.7879C43.5477 16.0198 43.6029 16.2959 43.6139 16.5499C43.625 18.1842 43.625 19.8186 43.6139 21.464C43.6139 22.5241 42.7526 23.3744 41.6925 23.3854C40.6103 23.3965 39.7489 22.5682 39.7158 21.4971C39.7158 21.475 39.7158 21.4529 39.7158 21.4308C39.7048 20.6026 39.7048 19.7965 39.7158 18.9904C39.7048 18.9904 39.7158 18.9904 39.7158 18.9904Z" fill="#18A0AA"/>
										</svg>
									
								
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

	const removeArrayOfNodes = arr => {
		arr &&
			arr.forEach(node => {
				node && node.remove();
			});
	};

	// Animate progress bar

	/* 	You need use strokeWidth < 7. If it more then 7 it won't work in the IE. You can detect browser. For IE use less 7. For other use what you want. */

	const progressRingHolder = document.querySelector("#progressRing");

	if (progressRingHolder) {
		var progressRing = new ProgressBar.Circle(progressRingHolder, {
			color: "#16538c",
			// This has to be the same size as the maximum width to
			// prevent clipping
			strokeWidth: 0,
			trailWidth: 0,
			easing: "easeInOut",
			duration: 1700,
			text: {
				autoStyleContainer: false
			},
			from: { color: "#18a0aa", width: 10 },
			to: { color: "#16538c", width: 12 },
			// Set default step function for all animate calls
			step: function(state, circle) {
				circle.path.setAttribute("stroke", state.color);
				circle.path.setAttribute("stroke-width", state.width);

				var value = Math.round(circle.value() * 100);
				if (value === 0) {
					circle.setText("0%");
				}

				if (value > 0) {
					circle.setText(`${value}%`);
				}

				if (
					state.offset > 0 &&
					progressRingHolder.classList.contains("progress-ring--complete")
				) {
					progressRingHolder.classList.remove("progress-ring--complete");
				}

				if (
					state.offset === 0 &&
					!progressRingHolder.classList.contains("progress-ring--complete")
				) {
					progressRingHolder.classList.add("progress-ring--complete");
				}
			}
		});

		if (
			ajax_forms_params.initial_percent_value_of_account_fill_completness < 100
		) {
			progressRing.animate(
				ajax_forms_params.initial_percent_value_of_account_fill_completness /
					100
			);
		}

		if (
			ajax_forms_params.initial_percent_value_of_account_fill_completness == 100
		) {
			progressRing.set(1);
		}
	}

	let userHasAlreadyReceivedCongratsMessage = false;

	const updateProfileCompletness = dataJSON => {
		console.log(dataJSON);

		const accountFillCompletenessWrapper = document.querySelector(
			".account__fill-completeness-wrapper"
		);

		const accountFillCompletness = document.querySelector(
			"#accountFillCompletness"
		);

		const percentValueOfAccountFillCompletnessHolder = document.querySelector(
			"#percentValueOfAccountFillCompletness"
		);

		const emptyProfileFieldsWrapper = document.querySelector(
			"#emptyProfileFieldsLabels"
		);

		const emptyProfileFieldsLabelsContainer = document.querySelector(
			"#emptyProfileFieldsLabels .empty-fields-labels"
		);

		const oldlabelsOfEmptyTranslatorFields = document.querySelectorAll(
			"#emptyProfileFieldsLabels .empty-field-label"
		);

		// Refresh percent Value Of Account Fill Completness

		const percentValueOfAccountFillCompletness =
			dataJSON.percent_value_of_account_fill_completness;

		percentValueOfAccountFillCompletnessHolder.textContent = percentValueOfAccountFillCompletness;

		if (
			percentValueOfAccountFillCompletness < 100 &&
			emptyProfileFieldsWrapper.classList.contains("no-empty-fields")
		) {
			emptyProfileFieldsWrapper.classList.remove("no-empty-fields");
			emptyProfileFieldsWrapper.classList.add("empty-fields");
		}

		if (
			percentValueOfAccountFillCompletness === 100 &&
			emptyProfileFieldsWrapper.classList.contains("empty-fields")
		) {
			emptyProfileFieldsWrapper.classList.remove("empty-fields");
			emptyProfileFieldsWrapper.classList.add("no-empty-fields");
		}

		// if (progressHistory.length > 0) {
		// 	progressHistory.length = 0;
		// }

		const animateRingAsync = async function() {
			progressRing.animate(percentValueOfAccountFillCompletness / 100);
		};

		// console.log(progressRing._opts.duration);
		console.log(userHasAlreadyReceivedCongratsMessage);

		animateRingAsync().then(() => {
			setTimeout(() => {
				if (
					percentValueOfAccountFillCompletness === 100 &&
					!userHasAlreadyReceivedCongratsMessage
				) {
					const congratulationsMessage = `
					<div class="text--center relative">
						<span class="confetti-target"></span>
						<p class="fs--1200 fw--900 ff--secondary text--center text--turquoise mb--1">GRATULACJE!</p>
						<p class="fs--800 fw--500 text--center">Twój profil jest kompletny w 100%!</p>
					</div>
					`;

					const congratulationsMessageNode = document
						.createRange()
						.createContextualFragment(congratulationsMessage);

					// modalMessageHolder.appendChild(congratulationsMessageNode);
					// showModal();
					handleModal(congratulationsMessageNode);

					// Confetti config
					// https://daniel-lundin.github.io/react-dom-confetti/

					const confettiConfig = {
						angle: 90,
						spread: 360,
						startVelocity: 40,
						elementCount: 70,
						dragFriction: 0.12,
						duration: 3000,
						stagger: 3,
						width: "10px",
						height: "10px",
						perspective: "500px",
						colors: ["#16538c", "#18a0aa"]
					};

					setTimeout(() => {
						confetti(
							document.querySelector(".confetti-target"),
							confettiConfig
						);
					}, 250);

					userHasAlreadyReceivedCongratsMessage = true;
				}
			}, progressRing._opts.duration);
		});

		// progressCurrentValue = progressHistory;
		// console.log(`progressCurrentValue:${progressCurrentValue}`);
		// console.log(`progressCloseToCompleteValue:${progressCloseToCompleteValue}`);

		// if (dataJSON.percent_value_of_account_fill_completness < 49) {
		// 	accountFillCompletness.className = "";
		// 	accountFillCompletness.classList.add("value__low");
		// }

		// if (
		// 	dataJSON.percent_value_of_account_fill_completness > 49 &&
		// 	75 > dataJSON.percent_value_of_account_fill_completness
		// ) {
		// 	accountFillCompletness.className = "";
		// 	accountFillCompletness.classList.add("value__medium");
		// }

		// if (
		// 	dataJSON.percent_value_of_account_fill_completness > 75 &&
		// 	95 > dataJSON.percent_value_of_account_fill_completness
		// ) {
		// 	accountFillCompletness.className = "";
		// 	accountFillCompletness.classList.add("value__high");
		// }

		// if (dataJSON.percent_value_of_account_fill_completness < 100) {
		// 	accountFillCompletenessWrapper.classList.remove("hide");
		// 	accountFillCompletenessWrapper.classList.add("show");
		// }

		// if (dataJSON.percent_value_of_account_fill_completness === 100) {
		// 	accountFillCompletenessWrapper.classList.remove("show");
		// 	accountFillCompletenessWrapper.classList.add("hide");
		// }

		// Refresh list of empty fields

		const labelsOfEmptyTranslatorFieldsAjax =
			dataJSON.labels_of_empty_translator_fields;

		oldlabelsOfEmptyTranslatorFields &&
			removeArrayOfNodes(oldlabelsOfEmptyTranslatorFields);

		labelsOfEmptyTranslatorFieldsAjax &&
			labelsOfEmptyTranslatorFieldsAjax.forEach(label => {
				const newParagraph = document.createElement("P");
				newParagraph.classList.add("empty-field-label");
				newParagraph.textContent = label;

				emptyProfileFieldsLabelsContainer.appendChild(newParagraph);
			});
	};

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
				// console.log(data);
				// console.log(JSON.parse(data));
				const dataJSON = JSON.parse(data);

				const postData = dataJSON.post_data;

				const allAccountFirstNames = document.querySelectorAll(
					".account__user-first-name"
				);

				const allAccountLastNames = document.querySelectorAll(
					".account__user-last-name"
				);

				const accountUserName = document.querySelector(
					".account__user-fullname"
				);
				const userBioText = document.querySelector("#user_about_short_text");
				const userLanguagesText = document.querySelector(
					"#user_languages_text"
				);
				const userSpecializationsText = document.querySelector(
					"#user_specializations_text"
				);

				allAccountFirstNames &&
					allAccountFirstNames.forEach(field => {
						field.innerText = postData.user_first_name;
					});

				allAccountLastNames &&
					allAccountLastNames.forEach(field => {
						field.innerText = postData.user_last_name;
					});

				accountUserName.innerText = `${postData.user_first_name} ${postData.user_last_name}`;
				userBioText.innerText = `${postData.user_about_short}`;

				postData.user_languages && postData.user_languages.length > 0
					? (userLanguagesText.innerText = `${postData.user_languages.join(
							", "
					  )}`)
					: (userLanguagesText.innerText = "");

				postData.user_specializations &&
				postData.user_specializations.length > 0
					? (userSpecializationsText.innerText = `${postData.user_specializations.join(
							", "
					  )}`)
					: (userSpecializationsText.innerText = "");

				updateProfileCompletness(dataJSON);

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
				// aboutUserDataForm.closest(".account__box-container").scrollIntoView({
				// 	behavior: "smooth",
				// 	block: "start",
				// 	inline: "nearest"
				// });
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				// console.log(data);

				const dataJSON = JSON.parse(data);
				const postData = dataJSON.post_data;

				const userAboutText = document.querySelector("#user_about_text");
				userAboutText.innerText = `${postData.user_about}`;

				updateProfileCompletness(dataJSON);

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
				// contactUserDataForm.closest(".account__box-container").scrollIntoView({
				// 	behavior: "smooth",
				// 	block: "start",
				// 	inline: "nearest"
				// });
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				// console.log(data);

				const dataJSON = JSON.parse(data);

				const postData = dataJSON.post_data;

				const userContactPhoneText = document.querySelector(
					"#user_contact_phone_text"
				);

				if (postData.user_contact_phone) {
					userContactPhoneText.innerText = `${postData.user_contact_phone}`;
				}

				const userContactEmailText = document.querySelector(
					"#user_contact_email_text"
				);

				if (postData.user_contact_email) {
					userContactEmailText.innerText = `${postData.user_contact_email}`;
				}

				const userCityText = document.querySelector("#user_city_text");

				if (postData.user_city) {
					userCityText.innerText = `${postData.user_city}`;
				}

				if (
					postData.user_localizations &&
					postData.user_localizations.length > 0
				) {
					//remove old localizations

					const allUserLocalizations = document.querySelectorAll(
						".user_localization"
					);

					allUserLocalizations.forEach(localization => {
						localization.remove();
					});

					//display all checked localizations

					let allUniqueLocalizations = [
						...new Set(postData.user_localizations)
					];

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

					allRepeaterFieldsInThisForm.forEach((repeaterField, i) => {
						// console.log(repeaterField.querySelector("INPUT").value);
						!repeaterField.querySelector("INPUT").value && i > 0 //leave the original one to be able to clone it after update
							? repeaterField.remove()
							: "";
					});
				}

				updateProfileCompletness(dataJSON);

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
					let thisUploadFileButton;

					// console.log(e.target);

					if (
						e.target.closest(".repeater__field") &&
						e.target
							.closest(".repeater__field")
							.querySelector(".button--upload-file")
					) {
						thisUploadFileButton = e.target
							.closest(".repeater__field")
							.querySelector(".button--upload-file");
					}

					if (
						thisUploadFileButton &&
						thisUploadFileButton.classList.contains("dnone")
					) {
						thisUploadFileButton.classList.remove("dnone");
					}

					//form
					if (e.target.closest("#upload_sound_to_gallery_form")) {
						// console.log("form");
						thisSoundWrapper = e.target.closest(".new-attachment__preview");

						if (
							thisSoundWrapper &&
							thisSoundWrapper
								.closest("FORM")
								.querySelector("input[type='file']").value
						) {
							thisSoundWrapper
								.closest("FORM")
								.querySelector("input[type='file']").value = null;
						}

						if (
							thisSoundWrapper &&
							thisSoundWrapper.closest(".new-attachment__placeholder")
						) {
							thisSoundWrapper.closest(
								".new-attachment__placeholder"
							).style.display = "none";
							thisSoundWrapper.querySelector("p").innerText = null;

							thisSoundWrapper.remove();
						}
					}

					//gallery
					if (e.target.closest(".my-sounds__gallery")) {
						// console.log("gallery");
						thisSoundWrapper = e.target.closest(".row-wrapper");

						let thisSoundPreview = thisSoundWrapper.querySelector(
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

		const thisAjaxLoader = this.closest(".info-box").querySelector(
			".my-ajax-loader"
		);

		const allSoundToGalleryInputs = this.querySelectorAll(
			"#sound-to-gallery__input"
		);

		var soundGalleryFormData = new FormData(this);

		const progress = this.closest(".info-box").querySelector(".progress");
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
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
			},

			success: function(data) {
				console.log("SUCCESS!");
				// console.log(data);

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

						sound
							.find(".my-sounds__gallery-text-wrapper")
							.addClass("col-m100-d50");

						sound
							.find(".my-sounds__gallery-attachment--file-info")
							.addClass("col-m100-d50");

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
					//because ACF repeater row indexes starts at 1
					$(this)
						.find("A")
						.attr("data-id", index + 1);
				});

				// Change is-gallery-empty status

				const soundsGallery = document.querySelector(".my-sounds__gallery");

				let addedSounds = soundsGallery.querySelectorAll(
					".my-sounds__gallery-row-wrapper"
				);

				const isGalleryEmptyStatusTextHolder = soundsGallery.querySelector(
					".is-gallery-empty__status-text-holder"
				);

				if (addedSounds.length > 0) {
					isGalleryEmptyStatusTextHolder.textContent = soundsGallery.querySelector(
						".is-gallery-empty__no"
					).textContent;
				} else {
					isGalleryEmptyStatusTextHolder.textContent = soundsGallery.querySelector(
						".is-gallery-empty__yes"
					).textContent;
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				// modalMessageHolder.appendChild(errorMessageNode[0]);

				// showModal();

				let modalMessage = errorMessageNode[0];

				handleModal(modalMessage);
			}
		});
	});

	/* 	User Linkedin Form */

	const linkedinUserDataForm = document.querySelector(
		"#linkedin_user_data_form"
	);

	if (linkedinUserDataForm) {
		$(linkedinUserDataForm).submit(function(event) {
			event.preventDefault();

			const thisAjaxLoader = this.closest(
				".ajax-content-wrapper"
			).querySelector(".my-ajax-loader");

			$.ajax({
				url: ajaxurl + "?action=add_linkedin_user_data_with_ajax",
				type: "post",
				data: $(linkedinUserDataForm).serialize(),
				beforeSend: function() {
					thisAjaxLoader.classList.add("my-ajax-loader--active");
				},

				complete: function() {
					thisAjaxLoader.classList.remove("my-ajax-loader--active");
				},

				success: function(data) {
					console.log("SUCCESS!");
					// console.log(data);

					const dataJSON = JSON.parse(data);

					const userlinkedinText = document.querySelector(
						"#user_linkedin_text"
					);

					userlinkedinText.innerText = `${dataJSON.user_linkedin}`;

					updateProfileCompletness(dataJSON);

					return data;
				},
				error: function(err) {
					console.log("FAILURE");
					console.log(err);
				}
			});
		});
	}

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
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				const dataJSON = JSON.parse(data);
				const userworkText = document.querySelector("#user_work_text");
				userworkText.innerText = `${dataJSON.user_work}`;
				updateProfileCompletness(dataJSON);
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

	if (uploadProfilePictureForm) {
		//New profile picture sneakpeak when uploading file
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
				filePreviewWrapper.classList.add("preview-mode");
			};

			// read the image file as a data URL.
			reader.readAsDataURL(this.files[0]);
		};

		// TODO: Delete profile picture option

		$(uploadProfilePictureForm).submit(function(event) {
			event.preventDefault();

			const submitButton = this.querySelector("input[type='submit']");
			submitButton.classList.remove("reveal-button");
			const originalImage = document.querySelector(
				".profile-picture__wrapper .post-thumbnail img"
			);
			const uploadPicturePreview = this.querySelector(
				".input-preview__wrapper"
			);

			const thisAjaxLoader = this.closest(
				".ajax-content-wrapper"
			).querySelector(".my-ajax-loader");

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
					uploadPicturePreview.classList.remove("preview-mode");
				},

				success: function(data) {
					console.log("SUCCESS!");
					const dataJSON = JSON.parse(data);
					updateProfileCompletness(dataJSON);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);

					let errorMessage = jqXHR.responseText;

					console.log(errorMessage);

					let errorMessageNode = $.parseHTML(errorMessage);

					console.log(errorMessageNode);

					let modalMessage = errorMessageNode[0];

					handleModal(modalMessage);

					originalImage.style.opacity = "1";
					uploadPicturePreview.classList.remove("has-image");
					uploadPicturePreview.classList.remove("preview-mode");
				}
			});
		});
	}

	/* 	Upload image to gallery Form */

	const uploadImageToGalleryForm = document.querySelector(
		"#upload_image_to_gallery_form"
	);

	$(uploadImageToGalleryForm).submit(function(event) {
		event.preventDefault();
		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".info-box").querySelector(
			".my-ajax-loader"
		);

		var galleryFormData = new FormData(this);

		const progress = this.closest(".info-box").querySelector(".progress");
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
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
			},

			success: function(data) {
				console.log("SUCCESS!");
				const dataJSON = JSON.parse(data);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let allRepeaterFieldsInThisForm = $(
					"#upload_image_to_gallery_form .repeater__field"
				);

				allRepeaterFieldsInThisForm.each(function(index) {
					// console.log(this.querySelector("INPUT").value);

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
							.addClass("pb--2")
							.addClass("mb--2")
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

				// Change is-gallery-empty status

				const picturesGallery = document.querySelector(".my-pictures__gallery");

				let addedPictures = picturesGallery.querySelectorAll(
					".my-pictures__gallery-attachment"
				);

				const isGalleryEmptyStatusTextHolder = picturesGallery.querySelector(
					".is-gallery-empty__status-text-holder"
				);

				if (addedPictures.length > 0) {
					isGalleryEmptyStatusTextHolder.textContent = picturesGallery.querySelector(
						".is-gallery-empty__no"
					).textContent;
				} else {
					isGalleryEmptyStatusTextHolder.textContent = picturesGallery.querySelector(
						".is-gallery-empty__yes"
					).textContent;
				}

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

				let modalMessage = errorMessageNode[0];

				handleModal(modalMessage);
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

		const thisAjaxLoader = this.closest(".info-box").querySelector(
			".my-ajax-loader"
		);

		const videoToGalleryInput = this.querySelector("#video-to-gallery__input");

		// console.log(this);

		var videoGalleryFormData = new FormData(this);

		const progress = this.closest(".info-box").querySelector(".progress");
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
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
			},

			success: function(data) {
				console.log("SUCCESS!");
				const dataJSON = JSON.parse(data);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let newlyAddedVideo = $("#newVideoInGalleryPlaceholder").clone();

				if (addedRows > 0) {
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
				}

				//clear input

				videoToGalleryInput.value = null;

				// Change is-gallery-empty status

				const videosGallery = document.querySelector(".my-videos__gallery");

				let addedVideos = videosGallery.querySelectorAll(
					".my-videos__gallery-attachment"
				);

				const isGalleryEmptyStatusTextHolder = videosGallery.querySelector(
					".is-gallery-empty__status-text-holder"
				);

				if (addedVideos.length > 0) {
					isGalleryEmptyStatusTextHolder.textContent = videosGallery.querySelector(
						".is-gallery-empty__no"
					).textContent;
				} else {
					isGalleryEmptyStatusTextHolder.textContent = videosGallery.querySelector(
						".is-gallery-empty__yes"
					).textContent;
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				let modalMessage = errorMessageNode[0];

				handleModal(modalMessage);
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
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
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

				let modalMessage = errorMessageNode[0];

				handleModal(modalMessage);
			}
		});
	});

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
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				const dataJSON = JSON.parse(data);

				const isProfilePublic = dataJSON.profile_is_public;

				let isProfilePublicStatus = document.querySelector(
					".account__privacy-status"
				);

				if (isProfilePublic && isProfilePublicStatus) {
					isProfilePublicStatus.classList.remove("account__private");
					isProfilePublicStatus.classList.add("account__public");
				} else {
					isProfilePublicStatus.classList.remove("account__public");
					isProfilePublicStatus.classList.add("account__private");
				}

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	// Prevent form resubmission when user reload the page

	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
});
