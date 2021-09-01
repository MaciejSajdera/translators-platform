/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

export default class Navigation {
	constructor() {
		this.container = document.querySelector(".mobile-menu-container");
		this.button = document.querySelector(".menu-toggle");
	}

	setupNavigation() {
		// Toggle mobile navigation
		this.button.onclick = () => {
			if (this.container.classList.contains("toggled")) {
				this.container.classList.remove("toggled");
				this.button.setAttribute("aria-expanded", "false");
			} else {
				this.container.classList.add("toggled");
				this.button.setAttribute("aria-expanded", "true");
			}
		};
	}
}
