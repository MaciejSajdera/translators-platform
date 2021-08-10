<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pstk
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main single-translator">

		<div class="breadcrumbs">

			<?php

				$translator_first_name = get_field("translator_first_name");
				$translator_last_name = get_field("translator_last_name");

				echo '<p>PSTK > Znajdź tłumacza > Wyniki wyszukiwania > '.$translator_first_name.' '. $translator_last_name.'</p>';

			?>

			<button class="button button__go-back go-back">Powrót</button>
		</div>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single-translator' );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();