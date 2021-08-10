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

	const allGoBackLinks = document.querySelectorAll(".go-back");

	allGoBackLinks &&
		allGoBackLinks.forEach(link => {
			link.addEventListener("click", () => {
				window.history.back();
			});
		});

	const allCheckboxesSwitches = document.querySelectorAll(".options__switch");

	allCheckboxesSwitches &&
		allCheckboxesSwitches.forEach(element => {
			element.addEventListener("click", function() {
				this.classList.toggle("options__switch--on");

				let checkbox = element.querySelector("input[type='checkbox']");

				checkbox.checked = !checkbox.checked;
			});
		});

	const searchAndFilterForm = document.querySelector(
		"form.searchandfilter input[type='submit']"
	);

	// searchAndFilterForm &&
	// 	searchAndFilterForm.addEventListener("click", e => {
	// 		e.preventDefault();
	// 		console.log(e);
	// 	});

	document.addEventListener("click", e => {
		if (
			e.target.closest("form") &&
			e.target.closest("form").classList.contains("searchandfilter")
		) {
			const allSelect2OpenContainers = document.querySelectorAll(
				".select2-container--open"
			);

			console.log(allSelect2OpenContainers);

			const resultsContainer = allSelect2OpenContainers[1];

			resultsContainer &&
			resultsContainer.classList.contains("select2-container--loaded")
				? resultsContainer.classList.remove("select2-container--loaded")
				: "";

			setTimeout(() => {
				// currentSelect = e.target;

				// const DOMKids = currentSelect.closest("body").childNodes;

				// console.log(DOMKids);

				// const searchContainer = DOMKids[DOMKids.length - 1];

				resultsContainer.classList.add("select2-container--loaded");

				// if (currentSelect !== searchContainer) {
				// 	searchContainer.remove();
				// }
			}, 300);
		}

		// if(e.target.classList.map(singleClass => {
		// 	(console.log(singleClass));
		// }) {

		// })
	});
});
