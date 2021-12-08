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

	<div class="desktop-only">
		<?php
			if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
			?>
	</div>

		<main id="main" class="site-main single-translator">

		<!-- <div class="breadcrumbs">

			<?php

				$translator_first_name = get_field("translator_first_name");
				$translator_last_name = get_field("translator_last_name");

				echo '<p>PSTK > Znajdź tłumacza > Wyniki wyszukiwania > '.$translator_first_name.' '. $translator_last_name.'</p>';

			?>

			<a href="<?php echo home_url(); ?>" class="button button__go-back go-back">Powrót</a>
		</div> -->

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single-translator' );

			// the_post_navigation();

			

			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>


			<div class="post-navigation">

				<div>
					<?php
					$prev_post = get_adjacent_post(false, '', true);
					if(!empty($prev_post)) {
					echo '<a href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '"><span class="post-navigation__prev">Poprzedni</span><p class="text--blue fw--700">' . mb_strimwidth( html_entity_decode($prev_post->post_title), 0, 60, '...' ) . '</p></a>'; }
					?>
				</div>

				<div>
					<?php
					$next_post = get_adjacent_post(false, '', false);
					if(!empty($next_post)) {
					echo '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '"><span class="post-navigation__next">Następny</span><p class="text--blue fw--700">' . mb_strimwidth( html_entity_decode($next_post->post_title), 0, 60, '...' ) . '</p></a>'; }
					?>
				</div>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
