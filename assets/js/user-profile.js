document.addEventListener("DOMContentLoaded", () => {
	/* 	Animate input labels */

	const allAnimatedLabelHolders = document.querySelectorAll(
		".animated-label-holder, #loginform p"
	);

	allAnimatedLabelHolders &&
		allAnimatedLabelHolders.forEach(holder => {
			if (
				holder.classList.contains("login-remember") ||
				holder.classList.contains("login-submit")
			) {
				return;
			}

			holder.addEventListener("click", function(e) {
				if (!holder.classList.contains(".input-holder__active")) {
					holder.classList.add(".input-holder__active");
				}
			});

			holder.querySelector("INPUT").addEventListener("focus", function(e) {
				this.closest("P").classList.add("input-holder__active");
			});

			holder.querySelector("INPUT").addEventListener("blur", function(e) {
				let isInputFilled = this.value;

				console.log(isInputFilled);

				if (isInputFilled) {
					this.closest("P").classList.add("input-holder__filled");
				}

				if (!isInputFilled) {
					this.closest("P").classList.remove(
						"input-holder__active",
						"input-holder__filled"
					);
				}
			});
		});
});
