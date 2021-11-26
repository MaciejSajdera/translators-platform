<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */

get_header();
?>



	<div id="primary" class="content-area mb--8">
		<main id="main" class="site-main">

		<div class="breadcrumbs-wrapper mb--4">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
				}
			?>
		</div>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">


			</header><!-- .page-header -->


			<?php

				echo '<div class="blog-posts__category-wrapper">
						'.the_archive_title( '<h1 class="page-title fs--1000 w--60 border--standard mb--4">', '</h1>' ).'
						'.the_archive_description( '<div class="archive-description">', '</div>' ).'
					</div>';
			?>

			<div class="blog-posts-grid">

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', 'post-in-archive' );

				endwhile;

				?> 

			</div><!-- blog-posts-grid -->

			<?php
			// the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
