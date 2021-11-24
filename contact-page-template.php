<?php

/*
 * Template Name: Contact Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

$section_1 = get_field("section_1");
$section_1_h2_part_1 = $section_1['h2_part_1'];
$section_1_h2_part_2 = $section_1['h2_part_2'];

$section_2 = get_field("section_2");
$section_2_title = $section_2['title'];
$section_2_paragraph = $section_2['paragraph'];
$section_2_repeater_fields = $section_2['repeater_fields'];
$section_2_image = $section_2['image'];

$section_3 = get_field("section_3");
$section_3_title = $section_3['title'];
$section_3_paragraph = $section_3['paragraph'];
$section_3_repeater_fields = $section_3['repeater_fields'];
$section_3_image = $section_3['image'];

$section_4 = get_field("section_4");
$section_4_title = $section_4['title'];
$section_4_paragraph = $section_4['paragraph'];
$section_4_repeater_fields = $section_4['repeater_fields'];
$section_4_image = $section_4['image'];

$circles_group = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group.svg");
$circles_group_big = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group-big.svg");
$circles_3_bg = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-3-bg.svg");

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main contact">

		<div class="welcome-view welcome-view-subpage relative">

			<div class="welcome-view__container image-content-row">

				<div class="welcome-view__left">

					<div class="entry-header">
						<?php
							the_title( '<h1 class="entry-title fs--1800 mb--2">', '</h1>' );
						?> 
					</div><!-- .entry-header -->

					<h2 class="mb--2">
						<span class="fs--1400 fw--700 lh--125 text--blue"><?php echo $section_1_h2_part_1 ?></span>
						<br />
						<span class="fs--1400 fw--700 lh--125 text--turquoise"><?php echo $section_1_h2_part_2 ?></span>
					</h2>

				</div>

				<div class="welcome-view__right image-holder image-to-the-right">

					<div class="form-holder">
						<?php echo do_shortcode('[formidable id=2]') ?>
					</div>


				</div>

			</div>

			<?php get_template_part( 'template-parts/partials/scroll-down' ); ?>

		</div>

		<section class="contact__section-2 contact-type-section">

			<div class="wrapper-flex-drow-mcol content-between">

				<div class="content-center image-holder">
					<?php
						if ($section_2_image) {
							?>
							<img src="<?php echo $section_2_image['url'] ?>" alt="<?php echo $section_2_image['alt'] ?>" loading="lazy">
							<?php
						}
					?>
				</div>

				<div class="contact-info-holder">

					<div class="info-tile">
						<h2 class="fw--700 fs--1000 text--blue mb--1"><?php echo $section_2_title ?></h2>
						<p class="text--turquoise fw--500 fs--600 mb--1"><?php echo $section_2_paragraph ?></p>
					</div>

						<?php

						if ($section_2_repeater_fields) {

							echo '<ul>';

							foreach($section_2_repeater_fields as $row) :

								$contact_icon = $row['contact_icon'];
								$contact_type = $row['contact_type'];
								$contact_data = $row['contact_data'];

								$contact_type_href;

								if ($contact_type == 'phone number') {
									$contact_type_href = 'href="tel:'.$contact_data.'"';
								}

								if ($contact_type == 'e-mail') {
									$contact_type_href = 'href="mailto:'.$contact_data.'"';
								}

								if ($contact_type == 'other') {
									$contact_type_href = 'href="#"';
								}

								echo '<li class="info-tile wrapper-flex-row">
										<span class="icon mr--1"><img src="'.$contact_icon['url'].'" /></span>
										<p><a '.$contact_type_href.'>'.$contact_data.'</a></p>
									</li>';

							endforeach;

							echo '</ul>';
						}

						?>
				</div>

			</div>

		</section>

		<section class="contact__section-3 contact-type-section">

			<div class="wrapper-flex-drow-mcol content-between">

				<div class="content-center image-holder">
					<?php
						if ($section_3_image) {
							?>
							<img src="<?php echo $section_3_image['url'] ?>" alt="<?php echo $section_3_image['alt'] ?>" loading="lazy">
							<?php
						}
					?>
				</div>

				<div class="contact-info-holder">

					<div class="info-tile">
						<h2 class="fw--700 fs--1000 text--blue mb--1"><?php echo $section_3_title ?></h2>
						<p class="text--turquoise fw--500 fs--600 mb--1"><?php echo $section_3_paragraph ?></p>
					</div>

						<?php

						if ($section_3_repeater_fields) {

							echo '<ul>';

							foreach($section_3_repeater_fields as $row) :

								$contact_icon = $row['contact_icon'];
								$contact_type = $row['contact_type'];
								$contact_data = $row['contact_data'];

								$contact_type_href;

								if ($contact_type == 'phone number') {
									$contact_type_href = 'href="tel:'.$contact_data.'"';
								}

								if ($contact_type == 'e-mail') {
									$contact_type_href = 'href="mailto:'.$contact_data.'"';
								}

								if ($contact_type == 'other') {
									$contact_type_href = 'href="#"';
								}

								echo '<li class="info-tile wrapper-flex-row">
										<span class="icon mr--1"><img src="'.$contact_icon['url'].'" /></span>
										<p><a '.$contact_type_href.'>'.$contact_data.'</a></p>
									</li>';

							endforeach;

							echo '</ul>';
						}

						?>
				</div>

			</div>

		</section>

		<section class="contact__section-4 contact-type-section">

			<div class="wrapper-flex-drow-mcol content-between">

				<div class="content-center image-holder">
					<?php
						if ($section_4_image) {
							?>
							<img src="<?php echo $section_4_image['url'] ?>" alt="<?php echo $section_4_image['alt'] ?>" loading="lazy">
							<?php
						}
					?>
				</div>

				<div class="contact-info-holder">

					<div class="info-tile">
						<h2 class="fw--700 fs--1000 text--blue mb--1"><?php echo $section_4_title ?></h2>
						<p class="text--turquoise fw--500 fs--600 mb--1"><?php echo $section_4_paragraph ?></p>
					</div>

						<?php

						if ($section_4_repeater_fields) {

							echo '<ul>';

							foreach($section_4_repeater_fields as $row) :

								$contact_icon = $row['contact_icon'];
								$contact_type = $row['contact_type'];
								$contact_data = $row['contact_data'];

								$contact_type_href;

								if ($contact_type == 'phone number') {
									$contact_type_href = 'href="tel:'.$contact_data.'"';
								}

								if ($contact_type == 'e-mail') {
									$contact_type_href = 'href="mailto:'.$contact_data.'"';
								}

								if ($contact_type == 'other') {
									$contact_type_href = 'href="#"';
								}

								echo '<li class="info-tile wrapper-flex-row">
										<span class="icon mr--1"><img src="'.$contact_icon['url'].'" /></span>
										<p><a '.$contact_type_href.'>'.$contact_data.'</a></p>
									</li>';

							endforeach;

							echo '</ul>';
						}

						?>
				</div>

			</div>

		</section>

		<section class="contact__section-5">

			<?php
				get_template_part( 'template-parts/partials/follow-us' );
			?>
						
		</section>

		<section class="contact__section-6">

			<?php
				get_template_part( 'template-parts/search-basic-section' );
			?>

		</section>

		<section class="contact__section-7">

			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();