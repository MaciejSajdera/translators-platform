/* 	Modal for displaying errors */

export const handleModal = modalMessage => {
	const modalMarkup = `
            <div class="modal">
                <div class="modal-content">
                    <span class="close-button">&times;</span>
                    <div class="modal-message-holder"></div>
                </div>
            </div>
            `;

	const modalNode = document
		.createRange()
		.createContextualFragment(modalMarkup);

	document.querySelector("BODY").appendChild(modalNode);
	const modal = document.querySelector(".modal");
	const modalContent = modal.querySelector(".modal-content");
	const modalMessageHolder = modal.querySelector(".modal-message-holder");
	modalMessageHolder.appendChild(modalMessage);

	if (modalContent) {
		console.log(modalContent);
		console.log(typeof modalContent);

		typeof modalContent === "object" ? showObjectInModal(modalContent) : "";
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

	const closeButton = document.querySelector(".close-button");

	function closeModal() {
		modal.classList.remove("show-modal");
		modal.classList.remove("unlock-modal");

		setTimeout(() => {
			modal.remove();
		}, 300);
	}

	function windowOnClick(event) {
		if (event.target === modal && event.target !== closeButton) {
			closeModal();
		}
	}

	closeButton.addEventListener("click", closeModal);
	window.addEventListener("click", windowOnClick);

	setTimeout(() => {
		modal.classList.add("unlock-modal");
		modal.classList.add("show-modal");
	}, 300);
};

export const isElementInViewport = el => {
	const scroll = window.scrollY || window.pageYOffset;
	const boundsTop = el.getBoundingClientRect().top + scroll;

	const viewport = {
		top: scroll,
		bottom: scroll + window.innerHeight // add multiplier (i.e * 0.75) to delay trigger
	};

	const bounds = {
		top: boundsTop,
		bottom: boundsTop + el.getBoundingClientRect().height
	};

	return (
		(bounds.bottom >= viewport.top && bounds.bottom <= viewport.bottom) ||
		(bounds.top <= viewport.bottom && bounds.top >= viewport.top)
	);
};

export default handleModal;
