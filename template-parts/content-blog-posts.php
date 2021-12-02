<?php

/*
 * Template Name: Materiały i Publikacje Page Template
 * description: >-
  Page template without sidebar
 */
// $section_1 = get_field("section_1");
// $section_1_paragraph = $section_1['paragraph'];
// $section_1_image = $section_1['image'];

get_header();

?>

	<div id="primary" class="content-area">

	<?php
		// if ( function_exists('yoast_breadcrumb') ) {
		// yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		// }
	?>

		<main id="main" class="site-main blog-posts">

			<div class="welcome-view__left">
				<h1 class="entry-title text--blue fs--1800">
					<?php echo get_the_title( get_option('page_for_posts', true) ); ?>
				</h1>
				<h2 class="fs--800 fw--700 lh--150 ff--secondary text--turquoise mb--2"><?php echo get_field('h2', get_option( 'page_for_posts' )) ?></h2>

				<p class="title-paragraph fs--600 mb--5">
					<?php echo get_field('paragraph', get_option( 'page_for_posts' )) ?>
				</p>
			</div>

			<!-- <div class="welcome-view welcome-view-subpage">

				<div class="welcome-view__container image-content-row">

					<div class="welcome-view__left">

						<div class="entry-header"> -->
							<?php
								// the_title( '<h1 class="entry-title fs--1800 mb--2">', '</h1>' );
							?> 
						</div><!-- .entry-header -->

						<!-- <p class="fs--800 fw--500 ff--secondary text--turquoise"><?php echo $section_1_paragraph ?></p>

					</div>

					<div class="welcome-view__right image-holder">

						<?php
							if ($section_1_image) {
								?>
									<img src="<?php echo $section_1_image['url'] ?>" alt="<?php echo $section_1_image['alt'] ?>" loading="lazy">
								<?php
							}
							?>
					</div>

				</div> -->

				<!-- <?php get_template_part( 'template-parts/partials/scroll-down' ); ?> -->

			<!-- </div> -->

			<?php

				$cat_terms = get_terms(
					array('category'),
					array(
							'hide_empty'    => true,
							'orderby'       => 'ID',
							'order'         => 'DESC',
					)
				);

				if( $cat_terms ) :

				foreach( $cat_terms as $term ) :

					echo '<div class="blog-posts__category-wrapper">';

						//var_dump( $term );
						echo '<h2 class="fs--1000 w--60 border--standard mb--4">'. $term->name .'</h3>';

						$args = array(
								'post_type'             => 'post',
								'posts_per_page'        => -1,
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

						echo '<div class="blog-posts-grid">';

						if( $posts->have_posts() ) :
							while( $posts->have_posts() ) : $posts->the_post();

								get_template_part( 'template-parts/content', 'post-in-archive' );

							endwhile;
						endif;

						echo '</div>';

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