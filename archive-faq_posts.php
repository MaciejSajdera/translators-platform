<?php

/*
 * Template Name: FAQ Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

		//This template is for both page FAQ and FAQ post archive so we need to pull the_content() differently

		$faq_page_id = 1093;
		$faq_page = get_post($faq_page_id);
		$content = $faq_page->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		$faq_page_title = $faq_page->post_title;

		$section_1 = get_field("section_1", $faq_page_id);

		$section_1_h2 = $section_1['h2'];

		$section_1_paragraph = $section_1['paragraph'];

		$section_1_image = $section_1['image'];

?>
	<div id="primary" class="content-area">
	<?php
		// if ( function_exists('yoast_breadcrumb') ) {
		// yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		// }
	?>
		<main id="main" class="site-main faq-archive">


		<div class="faq-archive__section-1 welcome-view welcome-view-subpage">

			<div class="welcome-view__container image-content-row">

				<div class="welcome-view__left">

					<div class="entry-header">

						<h1 class="entry-title fs--1800 mb--2"><?php echo $faq_page_title ?></h1>

					</div><!-- .entry-header -->

					<h2 class="mb--2">
						<span class="fs--1400 fw--700 lh--125 text--blue"><?php echo $section_1_h2 ?></span>
					</h2>

					<div class="fs--1000 fw--600 ff--secondary"><?php echo $section_1_paragraph ?></div>

				</div>

				<div class="welcome-view__right image-holder w--fit-content">

					<?php
						if ($section_1_image) {
							?>
								<img src="<?php echo $section_1_image['url'] ?>" alt="<?php echo $section_1_image['alt'] ?>" loading="lazy">
							<?php
						}
						?>
				</div>

			</div>

		</div>

		<?php

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
			
		echo '<ol>';

		foreach( $cat_terms as $term ) :
			
			echo '<div class="ol-list-item-wrapper mb--2">';
				echo '<li class="mb--1"><h3>'. $term->name .'</h3></li>';

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

			echo '</div>'; //ol-list-item-wrapper
		endforeach;

		echo '</ol>';

		the_posts_navigation();

		endif;

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();