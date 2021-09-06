<?php

/*
 * Template Name: FAQ Page Template
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

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.



		// wp_list_categories(array(
		// 	'title_li' => '',
		// 	'taxonomy' => 'faq_categories',
		// 	'orderby'    => 'name',
		// 	'show_count' => true,
			
		// ));

		$cat_terms = get_terms(
			array('faq_categories'),
			array(
					'hide_empty'    => false,
					'orderby'       => 'name',
					'order'         => 'ASC',
					// 'number'        => 6 //specify yours
				)
		);

		if( $cat_terms ) :

		foreach( $cat_terms as $term ) :

			//var_dump( $term );
			echo '<h3>'. $term->name .'</h3>';

			$args = array(
					'post_type'             => 'faq_posts',
					'posts_per_page'        => -1, //specify yours
					'post_status'           => 'publish',
					'order' => 'ASC',
					'tax_query'             => array(
												array(
													'taxonomy' => 'faq_categories',
													'field'    => 'slug',
													'terms'    => $term->slug,
													
												),
											),
					'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
				);
			$_posts = new WP_Query( $args );

			echo '<ul class="list--clear">';

			if( $_posts->have_posts() ) :
				while( $_posts->have_posts() ) : $_posts->the_post();

					echo '<li class="list-item--classic">';

					echo '<a href="'.get_permalink().'">'. get_the_title() .'</a>';

					echo '</li>';

				endwhile;
			endif;
			wp_reset_postdata(); //important

			echo '</ul>';

		endforeach;

		endif;




		?>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();