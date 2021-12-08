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

	<div id="primary" class="content-area archive-translators">

		<!-- <?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
		?> -->

		<?php
			// get_template_part( 'template-parts/back-to-home-page' );
		?>

		<main id="main" class="site-main archive-translator">

			<div class="search__container">

				<h1 class="mb--1 fs--800">Wyszukiwarka PSTK</h1>

				<h2 class="text--turquoise fs--600">Znajdź tłumacza na wydarzenie</h2>

				<!-- <?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?> -->

				<?php
					get_template_part( 'template-parts/searchfilter-full' );
				?>

			</div>

			<h3 class="page-title fs--800">
						<?php 
							$count = $GLOBALS['wp_query']->post_count;

							esc_html_e( 'Wyniki wyszukiwania', 'pstk' ); 

							echo ' <span class="post-count">'.$count.'</span>';
						?>
			</h3>

			<div id="search__results-container">

					<?php if ( have_posts() ) : ?>

						<div id="search__results-wrapper" class="wrapper-flex-drow-mcol">

							<div class="archive-translator__article-list-wrapper flex column">

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

							<div class="search__side-bar relative">
								<div class="fixed-side-bar">
									<?php get_template_part( 'template-parts/blog-promo-posts' ) ?>
								</div>
							</div>

						</div>

						<?php
						
					else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php
						
					endif;

					?>

			</div>

			<?php
				// the_posts_navigation();
			?>

			<section>

			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

			</section>

			<?php
				// get_template_part( 'template-parts/back-to-home-page' );
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
