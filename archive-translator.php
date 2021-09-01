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

	<div id="primary" class="content-area">
		<main id="main" class="site-main archive-translator">

		<div class="breadcrumbs">
			<p>PSTK > Znajdź tłumacza > Wyniki wyszukiwania</p>

			<a href="<?php echo home_url(); ?>" class="button button__go-back go-back">Powrót</a>
			
		</div>

		<?php
			get_template_part( 'template-parts/searchfilter-full' );
		?>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div id="search-results-container" class="archive-translator__article-list-wrapper">

				<?php

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

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

		<a href="<?php echo home_url(); ?>" class="button button__go-back go-back">Powrót do strony głównej</a>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
