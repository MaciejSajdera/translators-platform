<?php

// /*
//  * Template Name: Find Translator Page Template
//  * description: >-
//   Page template without sidebar
//  */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


		<div class="home__welcome-view">

			<h1><span class="text--outline-blue">Eksperci</span> od tłumaczeń symultanicznych i konsekutywnych</h1>

			<div class="search__container">

				<h2>Znajdź tłumacza na wydarzenie</h2>

				<?php
					get_template_part( 'template-parts/searchfilter-full' );
				?>

			</div>

		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();