<?php

/*
 * Template Name: Home Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

$section_1 = get_field("section_1");
$h1 = $section_1['h1'];
$h2 = $section_1['h2'];

$section_2 = get_field("section_2");
$section_2_title = $section_2['title'];
$section_2_repeater_fields = $section_2['repeater_fields'];

$section_3 = get_field("section_3");
$section_3_title = $section_3['title'];
$section_3_repeater_fields = $section_3['repeater_fields'];

$section_4 = get_field("section_4");
$section_4_title = $section_4['title'];
$section_4_paragraph = $section_4['paragraph'];
$section_4_link = $section_4['link'];

$section_6 = get_field("section_6");
$translator_of_the_month = $section_6['translator_of_the_month'];
$management_member_of_the_month = $section_6["management_member_of_the_month"];

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main home">


		<section class="home__section-1 home__welcome-view">

			<h1><?php echo $h1 ?></h1>

			<div class="home-search__container">

				<h2><?php echo $h2 ?></h2>

				<!--
				Example of multidropdown checkbox select
				https://codepen.io/elmahdim/embed/hlmri?height=565&theme-id=0&slug-hash=hlmri&default-tab=result&user=elmahdim&embed-version=2&pen-title=Dropdown%20with%20Multiple%20checkbox%20select%20with%20jQuery -->

				<?php
					get_template_part( 'template-parts/searchfilter-basic' );
				?>

			</div>

		</section>

		<section class="home__section-2">
			<div class="section-2__title">
				<h3><?php echo $section_2_title ?></h3>
			</div>

			<div class="section-2__mission_statements">
				<?php

				if ($section_2_repeater_fields) {

					echo '<ul>';

					foreach($section_2_repeater_fields as $row) :

						$textarea = $row['textarea'];

						echo '<li><p>'.$textarea.'</p></li>';

					endforeach;

					echo '</ul>';
				}

				?>
			</div>

		</section>

		<section class="home__section-3">

			<div class="section-3__title">
				<h3><?php echo $section_3_title ?></h3>
			</div>

			<div class="section-3__our_translators">
				<?php

				if ($section_3_repeater_fields) {

					foreach($section_3_repeater_fields as $row) :

						$icon = $row['icon'];
						$title = $row['title'];
						$paragraph = $row['paragraph'];

						echo '<div class="wrapper-flex-col-center">';
						
							echo '<img src="'.$icon["url"].'" alt="'.$icon["alt"].'">';
							echo '<p>'.$title.'</p>';
							echo '<p>'.$paragraph.'</p>';
						
						echo '</div>';

					endforeach;

				}

				?>
			</div>

		</section>

		<section class="home__section-4">

			<div class="section-4__title">
				<h3><?php echo $section_4_title ?></h3>
			</div>

			<div class="section-4__paragraph-wrapper">
				<p><?php echo $section_4_paragraph ?></p>
			</div>

			<a href="<?php echo $section_4_link ?>" class="read-more">Czytaj więcej</a>

		</section>

		<section class="home__section-5">

			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</section>

		<section class="home__section-6">

				<div class="get-to-know-us">
					<div class="wrapper-flex-drow-mcol get-to-know-us__container">

						<div class="get-to-know-us__element-wrapper wrapper-flex-col-center">

							Tłumacz miesiąca

							<?php

							// Relationship field approach

							echo '<a href="'.get_permalink($translator_of_the_month->ID).'">';
							
								echo '<img src="'.get_the_post_thumbnail_url($translator_of_the_month->ID).'">';

								$translator_of_the_month_first_name =  get_field('translator_first_name', $translator_of_the_month->ID);
								$translator_of_the_month_last_name =  get_field('translator_last_name', $translator_of_the_month->ID);


								echo '<p>'.$translator_of_the_month_first_name.' '.$translator_of_the_month_last_name.'</p>';
							
							echo '</a>';

							// Custom Taxonomy approach

							// $args = array(
							// 	'post_type' => 'translator', 
							// 	'posts_per_page'        => 1, 
							// 	'post_status'           => 'publish',
							// 	'tax_query' => array(
							// 		array(
							// 			'taxonomy' => 'merits', 
							// 			'field'    => 'slug',
							// 			'terms'    => 'translator-of-the-month',
							// 		),
							// 	),
							// );
							// $posts = new WP_Query( $args );

							// if( $posts->have_posts() ) :
							// 	while( $posts->have_posts() ) : $posts->the_post();

				
							// 		echo '<a href="'.get_permalink().'">'. get_the_title();
									
							// 		echo '<img src="'.get_the_post_thumbnail_url().'">';
									
							// 		echo '</a>';
				
							// 	endwhile;
							// endif;
							// wp_reset_postdata(); //important
							?>

						</div>

						<div class="get-to-know-us__element-wrapper wrapper-flex-col-center">

							<p>Członek władz</p>

							<?php

							$management_member_of_the_month_image = $management_member_of_the_month['image'];
							$management_member_of_the_month_title = $management_member_of_the_month['title'];
							$management_member_of_the_month_paragraph = $management_member_of_the_month['paragraph'];

							echo '<a href="'.get_permalink(1139).'">';
							
								echo '<img src="'.$management_member_of_the_month_image['url'].'" alt="'.$management_member_of_the_month_image['alt'].'">';

								echo '<p>'.$management_member_of_the_month_title.'</p>';
								echo '<p>'.$management_member_of_the_month_paragraph.'</p>';
						
							echo '</a>';

							?>
						</div>


					</div>
				</div>

		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();