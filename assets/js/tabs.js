export default function handleTabs(tabsContainer) {
	if (tabsContainer) {
		const allTabMenuPositions = tabsContainer.querySelectorAll(
			".tab-menu__position"
		);

		allTabMenuPositions.forEach(menuTab => {
			menuTab.addEventListener("click", function() {
				let tabId = this.dataset.tab;
				let targetTab = tabsContainer.querySelector(`#${tabId}`);

				let currentlyActiveMenuTab = tabsContainer.querySelector(
					".tab-menu__position--active"
				);
				let currentlyActiveTab = tabsContainer.querySelector(".tab--active");

				currentlyActiveMenuTab.classList.remove("tab-menu__position--active");
				this.classList.add("tab-menu__position--active");

				currentlyActiveTab.classList.remove("tab--active");
				currentlyActiveTab.classList.remove("tab--loaded");
				targetTab.classList.add("tab--active");

				targetTab.scrollIntoView({
					behavior: "smooth",
					block: "start",
					inline: "nearest"
				});

				setTimeout(() => {
					targetTab.classList.add("tab--loaded");
				}, 200);
			});
		});
	}
}

const managementTabs = document.querySelector(".management__tabs");

handleTabs(managementTabs);
