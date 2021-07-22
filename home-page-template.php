<?php

/*
 * Template Name: Home Page Template
 * description: >-
  Page template without sidebar
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


		<div class="home__welcome-view">

			<h1>Eksperci od tłumaczeń symultanicznych i konsekutywnych</h1>

			<div class="home-search__container">

				<h2>Znajdź tłumacza na zdarzenie</h2>

				<!--
				Example of multidropdown checkbox select
				https://codepen.io/elmahdim/embed/hlmri?height=565&theme-id=0&slug-hash=hlmri&default-tab=result&user=elmahdim&embed-version=2&pen-title=Dropdown%20with%20Multiple%20checkbox%20select%20with%20jQuery -->

				<?php
					echo do_shortcode( '[searchandfilter types="checkbox" hide_empty="0,0,0" fields="translator_language,translator_specialization,city" ]' );
				?>

			</div>

		</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();