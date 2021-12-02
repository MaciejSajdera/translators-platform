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

	makeNavSticky() {
		const siteHeader = document.querySelector(".site-header");

		if (window.pageYOffset > siteHeader.offsetTop) {
			siteHeader.classList.add("site-header__fixed", "box-shadow__header");
		} else {
			siteHeader.classList.remove("site-header__fixed", "box-shadow__header");
		}
	}

	///// MENUS /////

	mobileMenu() {
		const nav = document.querySelector("#mobile-menu");
		const linksWithChildren = nav.querySelectorAll(".menu-item-has-children a");

		linksWithChildren.forEach(link => {
			const submenu = link.parentElement.querySelector(".sub-menu");
			submenu ? (link.style.pointerEvents = "none") : "";
		});

		let backButtonAppended = false;

		nav.addEventListener("click", function(e) {
			console.log(e.target);

			if (e.target.classList.contains("menu-item-has-children")) {
				const expandSubMenu = e.target.querySelector(".show-submenu");

				expandSubMenu.querySelector("#back-button")
					? expandSubMenu.querySelector("#back-button").remove()
					: "";

				const myBackButton = document.createElement("LI");
				myBackButton.id = "back-button";
				myBackButton.classList.add("back-button", "menu-item");

				const myBackButtonAnchor = document.createElement("A");
				myBackButtonAnchor.setAttribute("href", "#");
				myBackButtonAnchor.innerText =
					expandSubMenu.previousElementSibling.innerText;

				const myBackButtonSpan = document.createElement("SPAN");
				myBackButtonSpan.classList.add("hide-submenu");

				myBackButton.appendChild(myBackButtonAnchor);
				myBackButton.appendChild(myBackButtonSpan);

				const submenu = expandSubMenu.nextElementSibling;

				const appendButton = () => {
					if (!backButtonAppended) {
						submenu.appendChild(myBackButton);
						backButtonAppended = true;
					}
				};

				appendButton();

				submenu.classList.add("sub-menu--expanded");

				// console.log(wooMenu.getBoundingClientRect().height);
				// submenu.style.minHeight = `${wooMenu.getBoundingClientRect().height}`;
			}

			if (e.target.classList.contains("back-button")) {
				const submenuExpanded = e.target.closest(".sub-menu--expanded");
				submenuExpanded.classList.remove("sub-menu--expanded");

				setTimeout(() => {
					e.target.remove();
				}, 100);

				backButtonAppended = false;
			} else {
				return;
			}
		});
	}

	desktopMenu() {
		const nav = document.querySelector(".menu-main-menu-container");
		const allMenuLinks = nav.querySelectorAll("#desktop-menu > li");
		const linksWithChildren = nav.querySelectorAll(".menu-item-has-children");

		const background = document.querySelector(".dropdownBackground");

		allMenuLinks.forEach(link => {
			link.addEventListener("mouseenter", handleEnter);
		});

		function handleEnter(e) {
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
	}
}
