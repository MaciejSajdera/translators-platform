<?php

/*
 * Template Name: Why Us Page Template
 * description: >-
  Page template without sidebar
*/

get_header();

$section_1 = get_field("section_1");
$section_1_h1_part_1 = $section_1['h1_part_1'];
$section_1_h1_part_2 = $section_1['h1_part_2'];
$section_1_h1_part_3 = $section_1['h1_part_3'];
$section_1_h2 = $section_1['h2'];
$section_1_image = $section_1['image'];

$section_2 = get_field("section_2");
$section_2_h2 = $section_2['h2'];
$section_2_paragraph = $section_2['paragraph'];

$section_3 = get_field("section_3");
$section_3_h2 = $section_3['h2'];
$section_3_repeater_fields = $section_3['repeater_fields'];

$section_4 = get_field("section_4");
$section_4_image = $section_4['image'];

$circles_group = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group.svg");
$circles_contact_page = file_get_contents(get_template_directory() . "/dist/dist/svg/circles_contact_page.svg");

?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main whyus">

		<section class="welcome-view welcome-view-subpage relative">

			<div class="whyus__section-1 welcome-view__container image-content-row">

				<div class="content-holder welcome-view__left">

					<div class="entry-header">

						<h1 class="entry-title uppercase text--blue fs--1800 mb--2"><?php echo $section_1_h1_part_1 . ' <span class="text--outline-blue">'.$section_1_h1_part_2.'</span>' . $section_1_h1_part_3 ?>

					</div><!-- .entry-header -->

					<h2 class="fs--800 fw--700 lh--150 ff--secondary text--turquoise"><?php echo $section_1_h2 ?></h2>

				</div>

				<div class="welcome-view__right image-holder">

						<?php
						if ($section_1_image) {
							?>
								<img class="image-border-shadow" src="<?php echo $section_1_image['url'] ?>" alt="<?php echo $section_1_image['alt'] ?>" loading="lazy">
							<?php
						}
						?>

				</div>

			</div>

			<div class="bg-decoration__holder desktop-only">
				<div class="bg-decoration__content">
					<?php
					echo $circles_contact_page;
					?>
				</div>
			</div>

			<?php get_template_part( 'template-parts/partials/scroll-down' ); ?>

		</section>

		<section class="whyus__section-2 relative">

			<h2 class="text--big-header lh--125 text--turquoise text--center"><?php echo $section_2_h2 ?></h2>

			<div class="content fs--600 fw--500">
				<?php echo $section_2_paragraph ?>
			</div>

		</section>

		<section class="whyus__section-3">

			<div class="title relative mb--8">

				<div class="holder">
					<h2 class="text--big-header lh--125 text--turquoise text--center"><?php echo $section_3_h2 ?></h2>
				</div>

			</div>

			<div class="cards-wrapper flex wrap">

				<?php

				if ($section_3_repeater_fields) {

					foreach($section_3_repeater_fields as $row) :

						$icon = $row['icon'];
						$title = $row['title'];
						$paragraph = $row['paragraph'];

						echo '<div class="card flex flex-col">
								<div class="flex flex-col content-center items-center">
									<div class="w--fit-content mb--2">
										<img src="'.$icon["url"].'" alt="'.$icon["alt"].'" loading="lazy">
									</div>

									<div class="mb--1 w--full"><p class="fs--800 fw--700 text--blue mb--1">'.$title.'</p></div>
									<div><p class="fs--600 fw--500">'.$paragraph.'</p></div>
								</div>
							</div>';

					endforeach;

				}

				?>
			</div>

		</section>

		<section class="whyus__section-4">

			<?php
			if ($section_4_image) {
				?>
				<div class="flex content-center">
					<div class="image-holder w--fit-content content-center image-holder-decorated image-holder-decorated--turquoise">
						<img class="image-border-shadow" src="<?php echo $section_4_image['url'] ?>" alt="<?php echo $section_4_image['alt'] ?>" loading="lazy">
					</div>
				</div>

				<?php
			}
			?>

		</section>

		<section class="whyus__section-5">

			<?php
				get_template_part( 'template-parts/search-basic-section' );
			?>

		</section>

		<section class="whyus__section-6">

			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</section>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();