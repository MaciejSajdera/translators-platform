/**
 * Main JavaScript file.
 */
import Navigation from "./navigation.js";
import skipLinkFocus from "./skip-link-focus-fix.js";

document.addEventListener("DOMContentLoaded", () => {
	const navigation = new Navigation();
	navigation.setupNavigation();

	const myPreloader = document.querySelector(".my-preloader");
	const page = document.querySelector("#page");

	// setTimeout(() => {
	// 	myPreloader.classList.add("my-preloader-off");
	// }, 600);

	// setTimeout(() => {
	// 	myPreloader.classList.add("my-preloader-none");
	// 	page.classList.add("page-loaded");
	// }, 700);

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

	///// MENUS /////

	const mobileMenu = () => {
		const nav = document.querySelector("#mobile-menu");
		const allMenuLinks = nav.querySelectorAll("LI");
		const linksWithChildren = nav.querySelectorAll(".menu-item-has-children a");
		const backButton = document.querySelector("#back-button");

		linksWithChildren.forEach(link => {
			link.nextElementSibling &&
			link.nextElementSibling.classList.contains("sub-menu")
				? (link.style.pointerEvents = "none")
				: "";
		});

		nav.addEventListener("click", function(e) {
			let backButtonAppended = false;
			console.log(e.target);

			if (e.target.classList.contains("expand-menu-toggle")) {
				// e.preventDefault();

				e.target.querySelector("#back-button")
					? e.target.querySelector("#back-button").remove()
					: "";

				const myBackButton = document.createElement("LI");
				myBackButton.id = "back-button";
				myBackButton.classList.add("back-button");
				myBackButton.innerText = e.target.previousElementSibling.innerText;

				const submenu = e.target.nextElementSibling;

				const appendButton = () => {
					if (!backButtonAppended) {
						submenu.appendChild(myBackButton);
						backButtonAppended = true;
					}
				};
				appendButton();

				submenu.classList.add("sub-menu--expanded", "sub-menu--visible");

				myBackButton.addEventListener("click", function(e) {
					const submenuExpanded = this.closest(".sub-menu--expanded");
					submenuExpanded.classList.remove("sub-menu--expanded");

					setTimeout(() => {
						this.remove();
						submenu.classList.remove("sub-menu--visible");
					}, 500);

					backButtonAppended = false;
				});
			} else {
				return;
			}
		});
	};

	const mediaQueryMobile = window.matchMedia("(max-width: 992px)");

	let mobileMenuWasAlreadyFired = false;

	function handleMobileChange(e) {
		// Check if the media query is true
		if (e.matches && !mobileMenuWasAlreadyFired) {
			// Then log the following message to the console
			console.log("Media Query Mobile Matched!");
			mobileMenu();
			mobileMenuWasAlreadyFired = true;
		}
	}

	mediaQueryMobile.addListener(handleMobileChange);
	handleMobileChange(mediaQueryMobile);

	const desktopMenu = () => {
		const nav = document.querySelector(".menu-main-menu-container");
		const allMenuLinks = nav.querySelectorAll("#desktop-menu > li");
		const linksWithChildren = nav.querySelectorAll(".menu-item-has-children");

		const background = document.querySelector(".dropdownBackground");

		allMenuLinks.forEach(link => {
			link.addEventListener("mouseenter", handleEnter);
		});

		function handleEnter(e) {
			// console.log(e.target);

			const submenu = this.querySelector(".sub-menu");

			if (!submenu) {
				return;
			}

			submenu.classList.add("sub-menu--expanded");
			this.classList.add("trigger-enter");

			setTimeout(
				() =>
					this.classList.contains("trigger-enter") &&
					this.classList.add("trigger-enter-active"),
				150
			);

			background.classList.add("open");

			const dropdown = this.querySelector(".sub-menu");
			const dropdownCoords = dropdown.getBoundingClientRect();
			const navCoords = nav.getBoundingClientRect();

			const coords = {
				height: dropdownCoords.height,
				width: dropdownCoords.width,
				top: dropdownCoords.top - navCoords.top,
				left: dropdownCoords.left - navCoords.left
			};

			background.style.setProperty("width", `${coords.width}px`);
			background.style.setProperty("height", `${coords.height}px`);
			background.style.setProperty(
				"transform",
				`translate(${coords.left}px, ${coords.top}px)`
			);

			// }
		}

		allMenuLinks.forEach(link => {
			link.addEventListener("mouseleave", handleLeave);
		});

		function handleLeave(e) {
			const submenu = this.querySelector(".sub-menu");

			if (!submenu) {
				return;
			}

			submenu.classList.remove("sub-menu--expanded");
			this.classList.remove("trigger-enter");
			this.classList.remove("trigger-enter-active");

			background.classList.remove("open");
		}
	};

	const mediaQueryDesktop = window.matchMedia("(min-width: 992px)");

	const asideDesktopMenu = document.querySelector("#desktop-menu");
	let desktopMenuWasAlreadyFired = false;

	function handleDesktopChange(e) {
		// Check if the media query is true
		if (asideDesktopMenu && e.matches && !desktopMenuWasAlreadyFired) {
			console.log("Media Query Desktop Matched!");

			desktopMenu();
			desktopMenuWasAlreadyFired = true;
		}
	}

	mediaQueryDesktop.addListener(handleDesktopChange);
	handleDesktopChange(mediaQueryDesktop);

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

			let boxSelection = box.querySelector(".select2-selection");
			boxSelection.appendChild(selectionCounter);

			let boxSearchField = box.querySelector(".select2-search__field");

			//Dynamic
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

			//Static - to display allOptionsChosen counter after form is submitted and page is loaded again

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

		// const allSingleChoiceBoxes = [
		// 	document.querySelector(".sf-field-taxonomy-translator_localization")
		// ];

		// const allSingleChoiceBoxes = document.querySelectorAll(
		// 	".sf-field-taxonomy-translator_localization"
		// );

		// allSingleChoiceBoxes.length > 0 &&
		// 	allSingleChoiceBoxes.forEach(box => {
		// 		console.log(box);
		// 		let boxSelection = box.querySelector(".select2-selection");

		// 		//Dynamic
		// 		const observer = new MutationObserver(function(mutations) {
		// 			mutations.forEach(function(mutation) {
		// 				console.log(mutation);

		// 				if (mutation.type === "attributes") {
		// 					console.log("attributes changed");

		// 					setTimeout(() => {
		// 						const dropDownBelow = document.querySelector(
		// 							".select2-dropdown--below"
		// 						);

		// 						const searchField = dropDownBelow?.querySelector(
		// 							".select2-search__field"
		// 						);

		// 						searchField?.focus();

		// 						if (searchField) {
		// 							searchField.placeholder = "Wpisz miasto...";
		// 						}
		// 					}, 0);
		// 				}
		// 			});
		// 		});

		// 		observer.observe(boxSelection, {
		// 			attributes: true //configure it to listen to attribute changes
		// 		});
		// 	});
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

	// document.addEventListener("click", e => {});
});
