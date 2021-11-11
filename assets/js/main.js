/**
 * Main JavaScript file.
 */
import Navigation from "./navigation.js";

document.addEventListener("DOMContentLoaded", () => {
	// Loading Page scripts

	const myPreloader = document.querySelector(".my-preloader");
	const page = document.querySelector("#page");

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

	mediaQueryMobile.matches
		? handleMobileChange(mediaQueryMobile)
		: handleDesktopChange(mediaQueryDesktop);

	mediaQueryMobile.addEventListener("change", () => {
		handleMobileChange(mediaQueryMobile);
	});

	mediaQueryDesktop.addEventListener("change", () => {
		handleDesktopChange(mediaQueryDesktop);
	});

	/* 	HEADER */

	window.onscroll = function() {
		navigation.makeNavSticky();
	};

	// Animations for specific pages

	const managementPage = document.querySelector(".management");

	if (managementPage) {
		const welcomeSVGsHolder = document.querySelector(
			".welcome-view__left .svg-holder"
		);
		welcomeSVGsHolder &&
			welcomeSVGsHolder.classList.add("svg-holder--animated");
	}

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

	setTimeout(() => {
		const allComboboxes = document.querySelectorAll(
			'[data-sf-field-input-type="multiselect"], .sf-field-taxonomy-translator_localization'
		);

		allComboboxes.forEach(box => {
			console.log(box);

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

						const select2Dropdown = document.querySelector(".select2-dropdown");

						if (
							select2Dropdown &&
							select2Dropdown.classList.contains("show-dropdown")
						) {
							select2Dropdown.classList.remove("show-dropdown");
						}

						select2Dropdown && select2Dropdown.classList.add("show-dropdown");

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

			let allOptionsChosen = box.querySelectorAll(".select2-selection__choice");

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
	}, 10);

	let isPopUpActive = false;

	const showInfoPopUp = (parentContainer, message) => {
		if (isPopUpActive) {
			return;
		}

		if (!parentContainer) {
			console.error(
				"No parentContainer passed to the showInfoPopUp function call."
			);
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

	/* Global mouseover event listener */

	document.addEventListener("mouseover", e => {
		// console.log(e.target);

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
		handleInfoPopUp(e);
	});

	/* Global click event listener */

	document.addEventListener("click", e => {
		console.log(e);
		if (e.target.name === "_sf_submit") {
			const searchButtonHolder = document.querySelector(".sf-field-submit");
			searchButtonHolder.classList.add("search-button--clicked");

			const loadingMessages = {
				loadingMessage_1:
					"Zbieramy dane aby dostarczyć Ci najbardziej trafne wyniki wyszukiwania.",
				loadingMessage_2:
					"W naszej bazie danych znajduje się blisko 500 tłumaczy z całego świata."
			};

			setTimeout(() => {
				const interval = 1500; // how much time should the delay between two iterations be (in milliseconds)?
				let promise = Promise.resolve();
				Object.values(loadingMessages).forEach(function(value) {
					promise = promise.then(function() {
						console.log(value);

						let loadingMessage = document.createElement("DIV");
						loadingMessage.classList.add("search-loading-message");
						loadingMessage.textContent = value;
						searchButtonHolder.appendChild(loadingMessage);

						return new Promise(function(resolve) {
							setTimeout(() => {
								loadingMessage.classList.add("search-loading-message__show");
							}, 100);

							setTimeout(() => {
								loadingMessage.classList.remove("search-loading-message__show");
								loadingMessage.classList.add("search-loading-message__hide");
								resolve();
							}, interval);
						});
					});
				});

				promise.then(function() {
					console.log("Loop finished.");
				});
			}, 1000);
		}
	});
});
