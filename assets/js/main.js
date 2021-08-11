/**
 * Main JavaScript file.
 */
import Navigation from "./navigation.js";
import skipLinkFocus from "./skip-link-focus-fix.js";

document.addEventListener("DOMContentLoaded", () => {
	// const navigation = new Navigation();
	// skipLinkFocus();
	// navigation.setupNavigation();
	// navigation.enableTouchFocus();

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

	// const allGoBackLinks = document.querySelectorAll(".go-back");

	// allGoBackLinks &&
	// 	allGoBackLinks.forEach(link => {
	// 		link.addEventListener("click", () => {
	// 			window.history.back();
	// 		});
	// 	});

	const allCheckboxesSwitches = document.querySelectorAll(".options__switch");

	allCheckboxesSwitches &&
		allCheckboxesSwitches.forEach(element => {
			element.addEventListener("click", function() {
				this.classList.toggle("options__switch--on");

				let checkbox = element.querySelector("input[type='checkbox']");

				checkbox.checked = !checkbox.checked;
			});
		});

	// const searchAndFilterForm = document.querySelector(
	// 	"form.searchandfilter input[type='submit']"
	// );

	// searchAndFilterForm &&
	// 	searchAndFilterForm.addEventListener("click", e => {
	// 		e.preventDefault();
	// 		console.log(e);
	// 	});

	const searchAndFilterForm = document.querySelector("form.searchandfilter");

	searchAndFilterForm.addEventListener("change", e => {
		console.log(e);
	});

	setTimeout(() => {
		const allComboboxes = document.querySelectorAll(
			'[data-sf-field-input-type="multiselect"]'
		);

		allComboboxes.forEach(box => {
			const selectionCounter = document.createElement("SPAN");
			selectionCounter.classList.add("my-selection-counter");

			let boxSelection = box.querySelector(".select2-selection");
			boxSelection.appendChild(selectionCounter);

			let boxSearchField = box.querySelector(".select2-search__field");

			//Dynamic
			const observer = new MutationObserver(function(mutations) {
				mutations.forEach(function(mutation) {
					console.log(mutation);

					if (mutation.type == "attributes") {
						console.log("attributes changed");

						let allOptionsChosen = box.querySelectorAll(
							".select2-selection__choice"
						);

						console.log(allOptionsChosen.length);

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
					}
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

		const allSearchFields = document.querySelectorAll(".select2-search__field");

		allSearchFields.forEach(field => {
			field.addEventListener("focus", e => {
				console.log(e);
			});
		});
	}, 100);
});
