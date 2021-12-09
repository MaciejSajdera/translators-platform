<?php

/*
 * Template Name: Admission Criteria Page Template
 * description: >-
  Page template without sidebar
 */

get_header();
$section_1 = get_field("section_1");
$section_1_paragraph = $section_1['paragraph'];
$section_1_image = $section_1['image'];

$section_2 = get_field("section_2");
$section_2_title = $section_2['title'];
$section_2_paragraph = $section_2['paragraph'];

$section_3 = get_field("section_3");
$section_3_title = $section_3['title'];
$section_3_repeater_fields = $section_3['repeater_fields'];

$circles_group = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group.svg");
$circles_group_big = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group-big.svg");
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main admission-criteria">

			<section class="welcome-view welcome-view-subpage relative">

				<div class="welcome-view__container image-content-row">

					<div class="welcome-view__left">

						<div class="entry-header">
							<?php
								the_title( '<h1 class="entry-title fs--1800 mb--1">', '</h1>' );
							?> 
						</div><!-- .entry-header -->

						<p class="fs--800 fw--700 ff--secondary text--turquoise"><?php echo $section_1_paragraph ?></p>

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
					
				</div>

				<?php get_template_part( 'template-parts/partials/scroll-down' ); ?>

			</section>

			<section class="admission-criteria__section-2">

				<div class="section-2__title">
					<p class="fs--1200 fw--700 text--center mb--2"><span class="text--blue"><?php echo $section_2_title  ?></span></p>
				</div>

				<div class="section-2__paragraph fs--400">
						<?php echo $section_2_paragraph ?>
				</div>

				<div class="bg-decoration__holder">
					<div class="bg-decoration__content">
						<?php
						echo $circles_group;
						?>
					</div>
				</div>

			</section>

			<section class="admission-criteria__section-3">

				<div class="section-3__title">
					<p class="fs--1200 fw--700 text--center mb--4"><span class="text--blue"><?php echo $section_3_title ?></span></p>
				</div>

				<div class="advantages">

					<?php

					if ($section_3_repeater_fields) {

						foreach($section_3_repeater_fields as $row) :

							$title = $row['title'];
							$textarea = $row['textarea'];

							echo '<div class="flex flex-col advantage">
									<div class="advantage__wrapper flex flex-col content-center items-center">
										<div class="advantage__title-wrapper mb--2"><p class="fw--700 fs--800">'.$title.'</p></div>
										<div class="advantage__paragraph-wrapper relative"><p class="fs--400">'.$textarea.'</p></div>
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

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();