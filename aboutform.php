		<div class="desktop-menu-wrapper">
			<div id="desktop-menu">

				<div class="dropdownBackground">
					<span class="arrow"></span>
				</div>

				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
						)
					);
				?>
				
			</div>
		</div>

		<div class="mobile-menu-wrapper">
			<div id="mobile-menu">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
						)
					);
				?>
			</div>
		</div>



<script>

	const switchSignIn = document.querySelector("#switch-sign-in");
	const switchSignUp = document.querySelector("#switch-sign-up");
	const signInWrapper = document.querySelector(".sign-in-wrapper");
	const signUpWrapper = document.querySelector(".sign-up-wrapper");

	if (switchSignIn) {
		switchSignUp.addEventListener("click", () => {
			signInWrapper.classList.remove("form-active");
			signUpWrapper.classList.add("form-active");

			switchSignIn.classList.remove("switch-active");
			switchSignUp.classList.add("switch-active");
		});

		switchSignIn.addEventListener("click", () => {
			signUpWrapper.classList.remove("form-active");
			signInWrapper.classList.add("form-active");

			switchSignUp.classList.remove("switch-active");
			switchSignIn.classList.add("switch-active");
		});
	}


</script>