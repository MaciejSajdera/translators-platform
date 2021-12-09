/**
 * Main JavaScript file.
 */
import Navigation from "./navigation.js";
import smoothscroll from "smoothscroll-polyfill";
import { isElementInViewport, handleModal } from "./helperFunctions.js";

document.addEventListener("DOMContentLoaded", () => {
	// Loading Page scripts

	const myPreloader = document.querySelector(".my-preloader");
	const page = document.querySelector("#page");

	// const controlHeightElement = document.querySelector("#control-height");

	// const measureBrowsersBarHeight = fullHeightElement => {
	// 	const actualHeight = window.innerHeight;
	// 	const elementHeight = fullHeightElement.clientHeight;
	// 	const barHeight = elementHeight - actualHeight;

	// 	console.log(barHeight);
	// 	return barHeight;
	// };

	// const adjustHorizontalPositionOfAnElement = element => {
	// 	element.style.transform = `translateY(
	// 		${measureBrowsersBarHeight(controlHeightElement)}px
	// 	)`;
	// };

	setTimeout(() => {
		myPreloader.classList.add("my-preloader-off");
		page.classList.add("page-loaded");
		document.querySelector("body").classList.add("body-loaded");
	}, 600);

	setTimeout(() => {
		myPreloader.classList.add("my-preloader-none");
		page.classList.add("page-loaded");
	}, 700);

	// setTimeout(() => {
	// 	cookiesNotification();
	// }, 1000);

	const cookiesNotification = () => {
		const cookiesInfo = document.querySelector(".cookie-law-notification");
		const cookiesAcceptButton = document.querySelector("#cookie-law-button");

		if (localStorage.getItem("cookiesAreAccepted")) {
			return;
		} else {
			cookiesInfo.classList.add("cookies-notification-on");
			cookiesAcceptButton &&
				cookiesAcceptButton.addEventListener("click", () => {
					localStorage.setItem("cookiesAreAccepted", "1");
					cookiesInfo.classList.add("cookies-notification-off");
				});
			return;
		}
	};

	// Navigation scripts

	const navigation = new Navigation();
	navigation.setupNavigation();
	smoothscroll.polyfill();

	const mediaQueryDesktop = window.matchMedia("(min-width: 992px)");
	const asideDesktopMenu = document.querySelector("#desktop-menu");
	let desktopMenuWasAlreadyFired = false;

	function handleDesktopChange(e) {
		// Check if the media query is true
		if (asideDesktopMenu && e.matches && !desktopMenuWasAlreadyFired) {
			// Then log the following message to the console
			console.log("Media Query Desktop Matched!");
			navigation.desktopMenu();
			desktopMenuWasAlreadyFired = true;
		}
	}

	const mediaQueryMobile = window.matchMedia("(max-width: 992px)");
	let mobileMenuWasAlreadyFired = false;

	function handleMobileChange(e) {
		// Check if the media query is true
		if (e.matches && !mobileMenuWasAlreadyFired) {
			// Then log the following message to the console
			console.log("Media Query Mobile Matched!");
			navigation.mobileMenu();
			mobileMenuWasAlreadyFired = true;
		}
	}

	if (mediaQueryMobile.matches) {
		handleMobileChange(mediaQueryMobile);
		handleSearchSelectBoxesMobile();
	}

	if (!mediaQueryMobile.matches) {
		handleDesktopChange(mediaQueryDesktop);
		handleSearchSelectBoxesDesktop();
	}

	mediaQueryMobile.addEventListener("change", () => {
		handleMobileChange(mediaQueryMobile);
		handleSearchSelectBoxesMobile();
	});

	mediaQueryDesktop.addEventListener("change", () => {
		handleDesktopChange(mediaQueryDesktop);
		handleSearchSelectBoxesDesktop();
	});

	/* 	HEADER */

	window.onscroll = function() {
		navigation.makeNavSticky();
	};

	/* SEARCH AND FILTER PRO PLUGIN FIX */

	const allCheckboxesSwitches = document.querySelectorAll(".options__switch");

	allCheckboxesSwitches &&
		allCheckboxesSwitches.forEach(element => {
			element.addEventListener("click", function() {
				this.classList.toggle("options__switch--on");

				let checkbox = element.querySelector("input[type='checkbox']");

				if (checkbox) {
					checkbox.checked = !checkbox.checked;
				}
			});
		});

	//display choices in place other then default

	// const relocateChoices = () => {
	// 	const select2SelectionRendered = document.querySelectorAll(
	// 		".select2-selection__rendered"
	// 	);

	// 	select2SelectionRendered &&
	// 		select2SelectionRendered.forEach(selection => {
	// 			const selectionContainer = selection.closest(
	// 				'[data-sf-field-input-type="multiselect"]'
	// 			);

	// 			console.log(selectionContainer);

	// 			if (selectionContainer) {
	// 				const selectionLabel = selectionContainer.querySelector("H4")
	// 					.textContent;

	// 				const newLocationOfChoices = document.createElement("DIV");
	// 				newLocationOfChoices.classList.add("new-location-of-choices");

	// 				selectionContainer.appendChild(newLocationOfChoices);

	// 				const allSelectedChoicesIntheContainer = selection.querySelectorAll(
	// 					".select2-selection__choice"
	// 				);

	// 				allSelectedChoicesIntheContainer &&
	// 					allSelectedChoicesIntheContainer.forEach(choice => {
	// 						newLocationOfChoices.appendChild(choice);
	// 					});

	// 				console.log(selectionLabel);
	// 			}
	// 		});
	// };

	function handleSearchSelectBoxesDesktop() {
		setTimeout(() => {
			const allComboboxes = document.querySelectorAll(
				'[data-sf-field-input-type="multiselect"], .sf-field-taxonomy-translator_localization'
			);

			allComboboxes &&
				allComboboxes.forEach(box => {
					// console.log(box);

					const selectionCounter = document.createElement("SPAN");
					selectionCounter.classList.add("my-selection-counter");
					let boxSelection = box.querySelector(".select2-selection"); //Desktop
					boxSelection.appendChild(selectionCounter);
					let boxSearchField = box.querySelector(".select2-search__field");

					//Dynamic - DESKTOP
					const observer = new MutationObserver(function(mutations) {
						mutations.forEach(function(mutation) {
							if (mutation.type === "attributes") {
								// console.log(mutation);
								// console.log("attribute aria-expanded changed");

								const select2Dropdown = document.querySelector(
									".select2-dropdown"
								);

								if (
									select2Dropdown &&
									select2Dropdown.classList.contains("show-dropdown")
								) {
									select2Dropdown.classList.remove("show-dropdown");
								}

								select2Dropdown &&
									select2Dropdown.classList.add("show-dropdown");

								let allOptionsChosen = box.querySelectorAll(
									".select2-selection__choice"
								);

								let boxTitle = box.querySelector("H4").innerHTML;

								if (allOptionsChosen.length === 1) {
									console.log(allOptionsChosen[0].title.trim().split("("));
									boxSearchField.placeholder = `${
										allOptionsChosen[0].title.trim().split("(")[0]
									}`;
								}

								if (allOptionsChosen.length > 1) {
									boxSearchField.placeholder = `${boxTitle} (${allOptionsChosen.length})`;
								}

								// setTimeout(() => {

								const searchField = select2Dropdown?.querySelector(
									".select2-search__field"
								);

								searchField?.focus();

								if (searchField) {
									searchField.placeholder = "Wpisz miasto...";
								}
								// }, 0);
							}

							// if (
							// 	mutation.type === "attributes" &&
							// 	mutation.target.ariaExpanded === "false"
							// ) {
							// 	boxSearchField.blur();
							// }
						});
					});

					observer.observe(boxSelection, {
						attributes: true //configure it to listen to attribute changes
					});

					// Static - to display allOptionsChosen counter after form is submitted and page is loaded again

					let allOptionsChosen = box.querySelectorAll(
						".select2-selection__choice"
					);

					let boxTitle = box.querySelector("H4").innerHTML;

					if (allOptionsChosen.length === 1) {
						console.log(allOptionsChosen[0].title.trim().split("("));
						boxSearchField.placeholder = `${
							allOptionsChosen[0].title.trim().split("(")[0]
						}`;
					}

					if (allOptionsChosen.length > 1) {
						boxSearchField.placeholder = `${boxTitle} (${allOptionsChosen.length})`;
					}
				});

			// relocateChoices();
		}, 300);
	}

	function handleSearchSelectBoxesMobile() {
		setTimeout(() => {
			const allComboboxes = document.querySelectorAll(
				'[data-sf-field-input-type="multiselect"], .sf-field-taxonomy-translator_localization'
			);

			allComboboxes &&
				allComboboxes.forEach(box => {
					// console.log(box);

					const selectionCounter = document.createElement("SPAN");
					selectionCounter.classList.add("my-selection-counter");
					const boxSelection = box.querySelector(".select2-selection"); //Desktop
					boxSelection.appendChild(selectionCounter);
					const boxSearchField = box.querySelector(".select2-search__field");

					const observer = new MutationObserver(function(mutations) {
						mutations.forEach(function(mutation) {
							if (mutation.type === "attributes") {
								// console.log(mutation);
								// console.log("attribute aria-expanded changed");

								const select2Dropdown = document.querySelector(
									".select2-dropdown"
								);

								if (
									select2Dropdown &&
									select2Dropdown.classList.contains("show-dropdown")
								) {
									select2Dropdown.classList.remove("show-dropdown");
								}

								select2Dropdown &&
									select2Dropdown.classList.add("show-dropdown");

								// const select2DropdownAbsoluteContainer = select2Dropdown?.closest(
								// 	".select2-container"
								// );

								// console.log(select2DropdownAbsoluteContainer);

								// select2DropdownAbsoluteContainer &&
								// 	adjustHorizontalPositionOfAnElement(
								// 		select2DropdownAbsoluteContainer
								// 	);

								let allOptionsChosen = box.querySelectorAll(
									".select2-selection__choice"
								);

								let boxTitle = box.querySelector("H4").innerHTML;

								if (allOptionsChosen.length === 1) {
									console.log(allOptionsChosen[0].title.trim().split("("));
									boxSearchField.placeholder = `${
										allOptionsChosen[0].title.trim().split("(")[0]
									}`;
								}

								if (allOptionsChosen.length > 1) {
									boxSearchField.placeholder = `${boxTitle} (${allOptionsChosen.length})`;
								}

								// setTimeout(() => {

								const searchField = select2Dropdown?.querySelector(
									".select2-search__field"
								);

								searchField?.focus();

								if (searchField) {
									searchField.placeholder = "Wpisz miasto...";
								}
								// }, 0);
							}

							// if (
							// 	mutation.type === "attributes" &&
							// 	mutation.target.ariaExpanded === "false"
							// ) {
							// 	boxSearchField.blur();
							// }
						});
					});

					observer.observe(boxSelection, {
						attributes: true //configure it to listen to attribute changes
					});

					// //Dynamic - 	MOBILE

					let optionSelection = box.querySelector("SELECT");
					console.log(optionSelection);

					optionSelection.addEventListener("change", e => {
						let allOptionsChosen = box.querySelectorAll(
							".select2-selection__choice"
						);

						let boxTitle = box.querySelector("H4").innerHTML;

						if (allOptionsChosen.length === 1) {
							console.log(allOptionsChosen[0].title.trim().split("("));
							boxSearchField.placeholder = `${
								allOptionsChosen[0].title.trim().split("(")[0]
							}`;
						}

						if (allOptionsChosen.length > 1) {
							boxSearchField.placeholder = `${boxTitle} (${allOptionsChosen.length})`;
						}
					});

					// Static - to display allOptionsChosen counter after form is submitted and page is loaded again

					let allOptionsChosen = box.querySelectorAll(
						".select2-selection__choice"
					);

					let boxTitle = box.querySelector("H4").innerHTML;

					if (allOptionsChosen.length === 1) {
						console.log(allOptionsChosen[0].title.trim().split("("));
						boxSearchField.placeholder = `${
							allOptionsChosen[0].title.trim().split("(")[0]
						}`;
					}

					if (allOptionsChosen.length > 1) {
						boxSearchField.placeholder = `${boxTitle} (${allOptionsChosen.length})`;
					}
				});

			// relocateChoices();
		}, 300);
	}

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

	// Animations for specific pages

	const managementPage = document.querySelector(".management");

	if (managementPage) {
		const welcomeSVGsHolder = document.querySelector(
			".welcome-view__left .svg-holder"
		);
		welcomeSVGsHolder &&
			welcomeSVGsHolder.classList.add("svg-holder--animated");
	}

	//single post page
	setTimeout(() => {
		postNavigation && isElementInViewport(postNavigation)
			? postNavigation.classList.add("post-navigation--wide")
			: "";
	}, 800);

	const singleAnimationsSinglePost = () => {
		postNavigation && isElementInViewport(postNavigation)
			? postNavigation.classList.add("post-navigation--wide")
			: "";
	};

	//info pop up

	let isPopUpActive = false;

	const showInfoPopUp = (parentContainer, message) => {
		if (isPopUpActive) {
			return;
		}

		if (!parentContainer) {
			// console.error(
			// 	"No parentContainer passed to the showInfoPopUp function call."
			// );
			return;
		}

		if (!message) {
			console.error("No message passed to the showInfoPopUp function call.");
			return;
		}

		if (!message || typeof message !== "string") {
			console.error("Message is not a string.");
			return;
		}

		let infoPopUp = document.createElement("DIV");
		infoPopUp.classList.add("info-pop-up");
		infoPopUp.id = "popUp";

		let infoPopUpArrow = document.createElement("SPAN");
		infoPopUpArrow.classList.add("pop-up__arrow");

		let infoPopUpParagraph = document.createElement("P");
		infoPopUpParagraph.innerText = message;

		infoPopUp.appendChild(infoPopUpArrow);
		infoPopUp.appendChild(infoPopUpParagraph);

		parentContainer.style.position = "relative";

		parentContainer.appendChild(infoPopUp);

		isPopUpActive = true;

		setTimeout(() => {
			infoPopUp.style.opacity = 1;
		}, 100);
	};

	const hideInfoPopUp = (eventTarget, showPopUpTriggerTarget) => {
		const infoPopUp = document.querySelector(".info-pop-up");
		infoPopUp ? (infoPopUp.style.opacity = 0) : "";
		infoPopUp
			? setTimeout(() => {
					infoPopUp.remove();
					isPopUpActive = false;
			  }, 300)
			: "";
	};

	const handleInfoPopUp = e => {
		let isOneOfTargets;

		const optionsToBeApproved = document.querySelector(
			".options__to-be-approved"
		);

		if (
			(e.target && e.target.classList.contains("options__to-be-approved")) ||
			(e.target && e.target.closest(".options__to-be-approved"))
		) {
			isOneOfTargets = true;
			showInfoPopUp(
				optionsToBeApproved,
				"Twój profil nie został jeszcze opublikowany. Zmiana widoczności profilu będzie możliwa po aktywacji konta."
			);
		}

		const accountPrivacyStatus = document.querySelector(
			".account__privacy-status"
		);

		if (
			(e.target && e.target.classList.contains("account__public")) ||
			(e.target && e.target.closest(".account__public"))
		) {
			isOneOfTargets = true;
			showInfoPopUp(
				accountPrivacyStatus,
				"Twój profil jest publicznie dostępny."
			);
		}

		if (
			(e.target && e.target.classList.contains("account__private")) ||
			(e.target && e.target.closest(".account__private"))
		) {
			isOneOfTargets = true;
			showInfoPopUp(
				accountPrivacyStatus,
				"Twój profil nie jest publicznie dostępny."
			);
		}

		const accountApprovalStatus = document.querySelector(
			".account__approval-status"
		);

		if (
			(e.target && e.target.classList.contains("account__approved")) ||
			(e.target && e.target.closest(".account__approved"))
		) {
			isOneOfTargets = true;
			showInfoPopUp(accountApprovalStatus, "Twój profil jest zweryfikowany.");
		}

		if (
			(e.target && e.target.classList.contains("account__not-approved")) ||
			(e.target && e.target.closest(".account__not-approved"))
		) {
			isOneOfTargets = true;
			showInfoPopUp(
				accountApprovalStatus,
				"Twój profil nie jest jeszcze zweryfikowany."
			);
		}

		if (!isOneOfTargets) {
			hideInfoPopUp();
		}
	};

	/* Global mouseover event listener */

	document.addEventListener("mouseover", e => {
		// console.log(e.target);
		handleInfoPopUp(e);
	});

	/* Global click event listener */

	/* Search Submit Button */

	// if (e.target.name === "_sf_submit") {
	// 	const searchButtonHolder = document.querySelector(".sf-field-submit");
	// 	searchButtonHolder.classList.add("search-button--clicked");

	// 	const loadingMessages = {
	// 		loadingMessage_1:
	// 			"Zbieramy dane aby dostarczyć Ci najbardziej trafne wyniki wyszukiwania.",
	// 		loadingMessage_2:
	// 			"W naszej bazie danych znajduje się blisko 500 tłumaczy z całego świata."
	// 	};

	// 	setTimeout(() => {
	// 		const interval = 1500; // how much time should the delay between two iterations be (in milliseconds)?
	// 		let promise = Promise.resolve();
	// 		Object.values(loadingMessages).forEach(function(value) {
	// 			promise = promise.then(function() {
	// 				console.log(value);

	// 				let loadingMessage = document.createElement("DIV");
	// 				loadingMessage.classList.add("search-loading-message");
	// 				loadingMessage.textContent = value;
	// 				searchButtonHolder.appendChild(loadingMessage);

	// 				return new Promise(function(resolve) {
	// 					setTimeout(() => {
	// 						loadingMessage.classList.add("search-loading-message__show");
	// 					}, 100);

	// 					setTimeout(() => {
	// 						loadingMessage.classList.remove("search-loading-message__show");
	// 						loadingMessage.classList.add("search-loading-message__hide");
	// 						resolve();
	// 					}, interval);
	// 				});
	// 			});
	// 		});

	// 		promise.then(function() {
	// 			console.log("Loop finished.");
	// 		});
	// 	}, 1000);
	// }

	document.addEventListener("click", e => {
		console.log(e);

		/* Search Submit Button */
		if (e.target.name === "_sf_submit") {
			const searchButtonHolder = document.querySelector(".sf-field-submit");
			searchButtonHolder.classList.add("search-button--clicked");
		}

		/* Scroll Down Button */

		if (e.target.closest(".welcome-section-scroll-down")) {
			window.scroll({
				top: window.innerHeight,
				left: 0,
				behavior: "smooth"
			});
		}
	});

	/* Global scroll event listener */

	const postNavigation = document.querySelector(".post-navigation");

	const scrollToTopBtn = document.querySelector(".scrollToTopBtn");

	document.addEventListener("scroll", () => {
		if (scrollToTopBtn) {
			if (pageYOffset > window.innerHeight) {
				scrollToTopBtn.classList.add("showBtn");
			} else {
				scrollToTopBtn.classList.remove("showBtn");
			}
			scrollToTopBtn.addEventListener("click", () => {
				window.scrollTo({
					top: 0,
					behavior: "smooth"
				});
			});
		}

		if (postNavigation) {
			singleAnimationsSinglePost();
		}
	});
});
