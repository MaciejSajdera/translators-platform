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

		//This template is for both page FAQ and FAQ post archive so we need to pull the_content() differently

		$my_id = 1093;
		$post_id_1093 = get_post($my_id);
		$content = $post_id_1093->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		echo $content;

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
			$posts = new WP_Query( $args );

			echo '<ul class="list--clear">';

			if( $posts->have_posts() ) :
				while( $posts->have_posts() ) : $posts->the_post();

					echo '<li class="list-item--classic">';

					echo '<a href="'.get_permalink().'">'. get_the_title() .'</a>';

					echo '</li>';

				endwhile;
			endif;
			wp_reset_postdata(); //important

			echo '</ul>';

		endforeach;

		the_posts_navigation();

		endif;

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();