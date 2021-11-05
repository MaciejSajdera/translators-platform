<?php

/*
 * Template Name: Find Translator Page Template
 * description: >-
  Page template without sidebar
 */


/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */

get_header();
?>

	<div id="primary" class="content-area post-type-archive-translator">

		<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		?>

		<?php
			// get_template_part( 'template-parts/back-to-home-page' );
		?>

		<main id="main" class="site-main archive-translator">

		<div class="search__container">

			<h1>Wyszukiwarka PSTK</h1>

			<h2>Znajdź tłumacza na wydarzenie</h2>

			<!-- <?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?> -->

			<?php
				get_template_part( 'template-parts/searchfilter-full' );
			?>

		</div>

		<?php if ( have_posts() ) : ?>

			<div id="search__results-container" class="archive-translator__article-list-wrapper">

				<h3 class="page-title fs--1200">
					<?php 
						$count = $GLOBALS['wp_query']->post_count;

						esc_html_e( 'Wyniki wyszukiwania', 'pstk' ); 

						echo ' <span class="post-count">'.$count.'</span>';
					?>
				</h3>

				<?php

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', 'archive-translator' );

				endwhile;

				?>

			</div>

			<?php


			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

			get_template_part( 'template-parts/blog-new-posts' );

		?>

		<?php
			get_template_part( 'template-parts/back-to-home-page' );
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
