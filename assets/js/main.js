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
});
