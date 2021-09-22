import "../../node_modules/progressbar.js/dist/progressbar.js";

jQuery(document).ready(function($) {
	/***************** ADDITIONAL FUNCTIONALITIES RELATED TO FORMS ******************/

	/* 	Modal for displaying errors */
	const modal = document.querySelector(".modal");
	const modalContent = modal.querySelector(".modal-content");
	const modalMessageHolder = modal.querySelector(".modal-message-holder");
	const closeButton = document.querySelector(".close-button");

	function showModal(modalContent) {
		modal.classList.add("unlock-modal");
		modal.classList.add("show-modal");

		setTimeout(() => modal.classList.add("show-modal"), 300);

		if (modalContent) {
			console.log(modalContent);

			typeof modalContent === "object" ? showObjectInModal(modalContent) : "";
		}

		// modal.classList.contains("show-modal")
		// 	? modal.classList.remove("show-modal")
		// 	: modal.classList.add("show-modal");
	}

	function showObjectInModal(modalContent) {
		const objectValues = Object.values(modalContent);
		objectValues.forEach(value => {
			let newParagraph = document.createElement("P");

			newParagraph.classList.add("modal-message");
			modalMessageHolder.appendChild(newParagraph);
			newParagraph.innerText = value.innerText;

			if (value.classList.contains("php-error__text")) {
				newParagraph.classList.add("php-error__text");
			}

			console.log(value);
		});
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

	const progressRingHolder = document.querySelector("#progressRing");

	if (progressRingHolder) {
		var progressRing = new ProgressBar.Circle(progressRingHolder, {
			color: "#16538c",
			// This has to be the same size as the maximum width to
			// prevent clipping
			strokeWidth: 0,
			trailWidth: 0,
			easing: "easeInOut",
			duration: 1400,
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
				} else {
					circle.setText(`${value}%`);
				}
			}
		});

		progressRing.animate(
			ajax_forms_params.initial_percent_value_of_account_fill_completness / 100
		);
	}

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

		// Refresh percent Value Of Account Fill Completness

		const percentValueOfAccountFillCompletness =
			dataJSON.percent_value_of_account_fill_completness;

		percentValueOfAccountFillCompletnessHolder.textContent = percentValueOfAccountFillCompletness;

		progressRing.animate(percentValueOfAccountFillCompletness / 100);

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

		const emptyProfileFieldsLabelsContainer = document.querySelector(
			"#emptyProfileFieldsLabels"
		);

		const oldlabelsOfEmptyTranslatorFields = document.querySelectorAll(
			"#emptyProfileFieldsLabels .empty-field-label"
		);

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
				console.log(data);
				console.log(JSON.parse(data));
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
				console.log(data);

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
				console.log(data);

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

					allRepeaterFieldsInThisForm.forEach(repeaterField => {
						console.log(repeaterField.querySelector("INPUT").value);
						!repeaterField.querySelector("INPUT").value
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
				// uploadSoundToGalleryForm
				// 	.closest(".account__box-container")
				// 	.scrollIntoView({
				// 		behavior: "smooth",
				// 		block: "start",
				// 		inline: "nearest"
				// 	});
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
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
				// linkedinUserDataForm.closest(".account__box-container").scrollIntoView({
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
				console.log(data);

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);

				const userlinkedinText = document.querySelector("#user_linkedin_text");

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
				// workUserDataForm.closest(".account__box-container").scrollIntoView({
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
				console.log(data);

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);

				const userworkText = document.querySelector("#user_work_text");

				userworkText.innerText = `${dataJSON.user_work}`;

				updateProfileCompletness(dataJSON);

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
				// uploadPicturePreview.classList.remove("has-image");
				uploadPicturePreview.classList.remove("preview-mode");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);

				updateProfileCompletness(dataJSON);

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
				uploadPicturePreview.classList.remove("preview-mode");
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
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);

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

				// uploadVideoToGalleryForm
				// 	.closest(".account__box-container")
				// 	.scrollIntoView({
				// 		behavior: "smooth",
				// 		block: "start",
				// 		inline: "nearest"
				// 	});
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
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

				// changeSettingsUserLoginEmail
				// 	.closest(".account__box-container")
				// 	.scrollIntoView({
				// 		behavior: "smooth",
				// 		block: "start",
				// 		inline: "nearest"
				// 	});
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

	// Modal for errors displayed on page reload

	const allphpErrorContentainers = document.querySelectorAll(
		".php-error__content"
	);

	allphpErrorContentainers &&
		allphpErrorContentainers.forEach(container => {
			let singleErrors = container.querySelectorAll(".php-error__text");
			showModal(singleErrors);
		});

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

				// userDataVisibilityForm
				// 	.closest(".account__box-container")
				// 	.scrollIntoView({
				// 		behavior: "smooth",
				// 		block: "start",
				// 		inline: "nearest"
				// 	});
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);
				const dataJSON = JSON.parse(data);

				const isProfilePublic = dataJSON.profile_is_public;

				let isProfilePublicStatus = document.querySelector(
					".account__privacy-status"
				);

				if (isProfilePublic && isProfilePublicStatus) {
					// profileStatusIcon.style.fill = "green";
					isProfilePublicStatus.classList.remove("account__private");
					isProfilePublicStatus.classList.add("account__public");
				} else {
					// profileStatusIcon.style.fill = "#cacaca";
					isProfilePublicStatus.classList.remove("account__public");
					isProfilePublicStatus.classList.add("account__private");
				}

				// accountIsPublicIcon.style.

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
