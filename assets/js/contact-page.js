import { handleModal } from "./helperFunctions.js";

document.addEventListener("DOMContentLoaded", () => {
	// Modal for errors displayed on page reload

	const allFormErrorContainers = document.querySelectorAll(
		"div.frm_error_style, div.frm_message"
	);

	if (allFormErrorContainers.length > 0) {
		const errorsWrapperForModal = document.createElement("DIV");
		errorsWrapperForModal.classList.add("errors-wrapper-for-modal");
		document.querySelector("BODY").appendChild(errorsWrapperForModal);

		allFormErrorContainers.forEach(container => {
			errorsWrapperForModal.appendChild(container);
		});

		handleModal(errorsWrapperForModal);
	}
});
