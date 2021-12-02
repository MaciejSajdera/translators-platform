import { handleModal } from "./helperFunctions.js";

document.addEventListener("DOMContentLoaded", () => {
	// Modal for errors displayed on page reload
	const allphpErrorContentainers = document.querySelectorAll(
		".php-error__text"
	);

	if (allphpErrorContentainers.length > 0) {
		const errorsWrapperForModal = document.createElement("DIV");
		errorsWrapperForModal.classList.add("errors-wrapper-for-modal");
		document.querySelector("BODY").appendChild(errorsWrapperForModal);

		allphpErrorContentainers.forEach(container => {
			errorsWrapperForModal.appendChild(container);
		});

		handleModal(errorsWrapperForModal);
	}

	// Modal for success messages displayed on page reload

	const allphpSuccessContentainers = document.querySelectorAll(
		".php-success__text--in-modal"
	);

	if (allphpSuccessContentainers.length > 0) {
		const successMessagesWrapperForModal = document.createElement("DIV");
		successMessagesWrapperForModal.classList.add(
			"success-messages-wrapper-for-modal"
		);
		document.querySelector("BODY").appendChild(successMessagesWrapperForModal);

		allphpSuccessContentainers.forEach(container => {
			successMessagesWrapperForModal.appendChild(container);
		});

		// check if there are no errors to avoid mixed message
		if (allphpErrorContentainers.length > 0) {
			successMessagesWrapperForModal.style.display = "none";
		}

		handleModal(successMessagesWrapperForModal);
	}

	/* 	Animate input labels */

	const allAnimatedLabelHolders = document.querySelectorAll(
		".animated-label-holder input, #loginform p input"
	);

	allAnimatedLabelHolders &&
		allAnimatedLabelHolders.forEach(input => {
			if (
				input.closest("P").classList.contains("login-remember") ||
				input.closest("P").classList.contains("login-submit")
			) {
				return;
			}

			input.addEventListener("focus", function(e) {
				this.closest("P").classList.add("input-holder__active");
			});

			input.addEventListener("blur", function(e) {
				let isInputFilled = this.value;

				console.log(isInputFilled);

				if (isInputFilled) {
					this.closest("P").classList.add("input-holder__filled");
				}

				if (!isInputFilled) {
					this.closest("P").classList.remove(
						"input-holder__active",
						"input-holder__filled"
					);
				}
			});
		});
});
