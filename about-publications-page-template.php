<?php

/*
 * Template Name: Materiały i Publikacje Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

?>

	<div id="primary" class="content-area">

	<?php
		if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
	?>

		<main id="main" class="site-main">


			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php pstk_post_thumbnail(); ?>

			<div class="entry-content">
				<?php

				the_content();

				?>
			</div><!-- .entry-content -->

			<?php

				$cat_terms = get_terms(
					array('category'),
					array(
							'hide_empty'    => false,
							'orderby'       => 'name',
							'order'         => 'ASC',
							'exclude' => array(1,101),
					)
				);

				if( $cat_terms ) :

				foreach( $cat_terms as $term ) :

					echo '<div>';

						//var_dump( $term );
						echo '<h3>'. $term->name .'</h3>';

						$args = array(
								'post_type'             => 'post',
								'posts_per_page'        => -1, //specify yours
								'post_status'           => 'publish',
								'order' => 'ASC',
								'tax_query'             => array(
															array(
																'taxonomy' => 'category',
																'field'    => 'slug',
																'terms'    => $term->slug,
																
															),
														),
								'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
							);
							
						$posts = new WP_Query( $args );

						echo '<div class="wrapper-flex-drow-mcol">';

						if( $posts->have_posts() ) :
							while( $posts->have_posts() ) : $posts->the_post();

								echo '<div class="tile">';

								echo '<a href="'.get_permalink().'">';

								echo '<img src="'.get_the_post_thumbnail_url().'">';
								
								echo get_the_title();
								
								echo '</a>';

								echo '<div>';
								$blog_post_fields = get_field("blog_post_fields");
								if ($blog_post_fields && $blog_post_fields['file']) {
									echo '<a class="button button--download" href="'.$blog_post_fields['file']['url'].'" download>Pobierz</a>';
								}
								echo '</div>';


								echo '</div>';

							endwhile;
						endif;
						wp_reset_postdata(); //important

					echo '</div>';

				endforeach;

				endif;

				the_posts_navigation();

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();