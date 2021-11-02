<?php

/*
 * Template Name: Home Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

$section_1 = get_field("section_1");
$h1_part_1 = $section_1['h1_part_1'];
$h1_part_2 = $section_1['h1_part_2'];
$h2 = $section_1['h2'];
$image = $section_1['image'];

$section_2 = get_field("section_2");
$section_2_title = $section_2['title'];
$section_2_repeater_fields = $section_2['repeater_fields'];
$section_2_image = $section_2['image'];

$section_3 = get_field("section_3");
$section_3_title_part_1 = $section_3['title_part_1'];
$section_3_title_part_2 = $section_3['title_part_2'];
$section_3_repeater_fields = $section_3['repeater_fields'];

$section_4 = get_field("section_4");
$section_4_image = $section_4['image'];
$section_4_title_part_1 = $section_4['title_part_1'];
$section_4_title_part_2 = $section_4['title_part_2'];
$section_4_paragraph = $section_4['paragraph'];
$section_4_link = $section_4['link'];

$section_6 = get_field("section_6");
$translator_of_the_month = $section_6['translator_of_the_month'];
$management_member_of_the_month = $section_6["management_member_of_the_month"];

$circles_group = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group.svg");
$circles_group_big = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group-big.svg");

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main home">


		<section class="home__section-1">

			<div class="welcome-view__container">

					<h1><span class="text--outline-blue"><?php echo $h1_part_1 ?></span>
						<br />
						<?php echo $h1_part_2 ?>
					</h1>

					<div class="image-holder image-holder-decorated image-holder-decorated--turquoise">
						<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
					</div>

					<h2 class="fs--800 text--turquoise ff--secondary"><?php echo $h2 ?></h2>

					<?php
						get_template_part( 'template-parts/searchfilter-basic' );
					?>

					<!-- <div class="prizes-wrapper">

						<img src="https://pstk.blossom-is.online/wp-content/uploads/2021/09/HSYTP_main_image-removebg-preview-1.png">
						<img src="https://pstk.blossom-is.online/wp-content/uploads/2021/09/society-removebg-preview-1.png">

					</div> -->

			</div>

		</section>

		<section class="home__section-2">

			<div class="wrapper-flex-drow-mcol content-between">
				<div class="bulletpoints-box">

					<div class="bulletpoints-box__title">
						<h3 class="text--turquoise fw--700 fs--1200"><?php echo $section_2_title ?></h3>
					</div>

					<div class="bulletpoints-box__list-holder">
						<?php

						if ($section_2_repeater_fields) {

							echo '<ul>';

							foreach($section_2_repeater_fields as $row) :

								$textarea = $row['textarea'];

								echo '<li>'.$textarea.'</li>';

							endforeach;

							echo '</ul>';
						}

						?>
					</div>

				</div>

				<div class="text--right">
					<img src="<?php echo $section_2_image['url'] ?>" alt="<?php echo $section_2_image['alt'] ?>">
				</div>
			</div>

			<div class="bg-decoration__holder">
				<div class="bg-decoration__content">
					<?php
					echo $circles_group;
					?>
				</div>
			</div>

		</section>



		<section class="home__section-3">

			<div class="section-3__title">
				<p class="text--big-header"><span class="text--blue"><?php echo $section_3_title_part_1 ?></span> <span class="text--outline-blue"><?php echo $section_3_title_part_2 ?></span></p>
			</div>

			<div class="advantages">

				<?php

				if ($section_3_repeater_fields) {

					foreach($section_3_repeater_fields as $row) :

						$icon = $row['icon'];
						$title = $row['title'];
						$paragraph = $row['paragraph'];

						echo '<div class="flex flex-col advantage">
								<div class="advantage__wrapper">
									<div class="advantage__img-wrapper pseudo-decoration pseudo-decoration__rb"><img src="'.$icon["url"].'" alt="'.$icon["alt"].'"></div>
									<div class="advantage__title-wrapper pseudo-decoration pseudo-decoration__lb"><p class="fw--700 fs--600">'.$title.'</p></div>
									<div class="advantage__paragraph-wrapper pseudo-decoration pseudo-decoration__rb-half"><p class="fw--700">'.$paragraph.'</p></div>
								</div>
							</div>';

					endforeach;

				}

				?>
			</div>


			<div class="bg-decoration__holder">
				<div class="bg-decoration__content">
					<?php
					echo $circles_group_big;
					?>
				</div>
			</div>

		</section>

		<section class="home__section-4">

			<div class="section-4__title">
				<div class="section-4__bg" style="background-image: url()">
					<img width="100%" height="100%" src="<?php echo $section_4_image['url'] ?>" alt="<?php echo $section_4_image['url'] ?>" loading="lazy"/>
					<p class="fs--1200 fw--700 text--white"><?php echo $section_4_title_part_1 ?></p>
				</div>
				<p class="fs--1200 fw--700 text--blue"><?php echo $section_4_title_part_2 ?></p>

			</div>

			<div class="section-4__paragraph-wrapper">
				<p><?php echo $section_4_paragraph ?></p>
			</div>

			<div class="section-4__cta-wrapper text--center">
				<a href="<?php echo $section_4_link ?>" class="read-more button button__filled--turquoise">Czytaj więcej</a>
			</div>


		</section>

		<section class="home__section-5">

			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</section>

		<section class="home__section-6">

				<div class="get-to-know-us">
					<div class="wrapper-flex-drow-mcol get-to-know-us__container">

					<?php

					if ($translator_of_the_month) {

						?>

						<div class="get-to-know-us__element-wrapper wrapper-flex-col-center">

						Tłumacz miesiąca

						<?php

						// Relationship field approach

						echo '<a class="wrapper-flex-col-center" href="'.get_permalink($translator_of_the_month->ID).'">';
						
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

						<?php

					}

					?>

						<div class="get-to-know-us__element-wrapper wrapper-flex-col-center">

							<p>Członek władz</p>

							<?php

							$management_member_of_the_month_image = $management_member_of_the_month['image'];
							$management_member_of_the_month_title = $management_member_of_the_month['title'];
							$management_member_of_the_month_paragraph = $management_member_of_the_month['paragraph'];

							echo '<a class="wrapper-flex-col-center" href="'.get_permalink(1139).'">';
							
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