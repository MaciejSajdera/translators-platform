<?php

/*
 * Template Name: Join Us Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

$section_1 = get_field("section_1");
$section_1_h1_part_1 = $section_1['h1_part_1'];
$section_1_h1_part_2 = $section_1['h1_part_2'];
$section_1_h2 = $section_1['h2'];
$section_1_image = $section_1['image'];

$section_2 = get_field("section_2");
$section_2_title = $section_2['title'];
$section_2_repeater_fields = $section_2['repeater_fields'];
$section_2_image = $section_2['image'];

$section_3 = get_field("section_3");
$section_3_title = $section_3['title'];
$section_3_repeater_fields = $section_3['repeater_fields'];
$section_3_image = $section_3['image'];

$section_4 = get_field("section_4");
$section_4_title = $section_4['title'];
$section_4_repeater_fields = $section_4['repeater_fields'];
$section_4_image = $section_4['image'];

$section_5 = get_field("section_5");
$section_5_title_part_1 = $section_5['title_part_1'];
$section_5_title_part_2 = $section_5['title_part_2'];
$section_5_repeater_fields = $section_5['repeater_fields'];

$circles_pair_bg = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-pair-bg.svg");

?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main joinus">

		<div class="welcome-view welcome-view-subpage relative">

			<div class="welcome-view__container">

				<div class="content-holder welcome-view__left">

					<div class="entry-header">

						<h1 class="entry-title uppercase fs--1800 mb--2"><?php echo $section_1_h1_part_1 . ' <span class="text--outline-blue">'.$section_1_h1_part_2.'<span>' ?>

					</div><!-- .entry-header -->

					<h2 class="fs--800 fw--500 lh--150 ff--secondary text--turquoise"><?php echo $section_1_h2 ?></h2>

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

		</div>

		<section class="joinus__section-2">

			<div class="wrapper-flex-drow-mcol content-between image-content-row">

				<div class="content-holder bulletpoints-box">
					<div class="bulletpoints-box__title">
						<h2 class="text--turquoise fw--700 fs--1200"><?php echo $section_2_title ?></h2>
					</div>

					<div class="bulletpoints-box__list-holder">
						<?php

						if ($section_2_repeater_fields) {

							echo '<ul>';

							foreach($section_2_repeater_fields as $row) :
								$textarea = $row['textarea'];
								echo '<li class="fs--600">'.$textarea.'</li>';
							endforeach;

							echo '</ul>';
						}

						?>
					</div>
				</div>

				<div class="image-holder w--fit-content">
						<?php
						if ($section_2_image) {
							?>
							<img class="image-border-shadow" src="<?php echo $section_2_image['url'] ?>" alt="<?php echo $section_2_image['alt'] ?>" loading="lazy">
							<?php
						}
						?>
				</div>
				
			</div>

		</section>

		<section class="joinus__section-3">

			<div class="wrapper-flex-drow-mcol drow-reverse content-between image-content-row">
				<div class="content-holder bulletpoints-box">

					<div class="bulletpoints-box__title">
						<h2 class="text--turquoise fw--700 fs--1200"><?php echo $section_3_title ?></h2>
					</div>

					<div class="bulletpoints-box__list-holder">
						<?php

						if ($section_3_repeater_fields) {

							echo '<ul>';

							foreach($section_3_repeater_fields as $row) :
								$textarea = $row['textarea'];
								echo '<li class="fs--600">'.$textarea.'</li>';
							endforeach;

							echo '</ul>';
						}

						?>
					</div>

				</div>

				<div class="image-holder w--fit-content">

						<?php
						if ($section_3_image) {
							?>
							<img class="image-border-shadow" src="<?php echo $section_3_image['url'] ?>" alt="<?php echo $section_3_image['alt'] ?>" loading="lazy">
							<?php
						}
						?>

				</div>
			</div>

		</section>

		<section class="joinus__section-4">

			<div class="wrapper-flex-drow-mcol content-between image-content-row">
				<div class="content-holder bulletpoints-box">

					<div class="bulletpoints-box__title">
						<h2 class="text--turquoise fw--700 fs--1200"><?php echo $section_4_title ?></h2>
					</div>

					<div class="bulletpoints-box__list-holder">
						<?php

						if ($section_4_repeater_fields) {

							echo '<ul>';

							foreach($section_4_repeater_fields as $row) :
								$textarea = $row['textarea'];
								echo '<li class="fs--600">'.$textarea.'</li>';
							endforeach;

							echo '</ul>';
						}

						?>
					</div>

				</div>

				<div class="image-holder w--fit-content">

						<?php
						if ($section_4_image) {
							?>
							<img class="image-border-shadow" src="<?php echo $section_4_image['url'] ?>" alt="<?php echo $section_4_image['alt'] ?>" loading="lazy">
							<?php
						}
						?>
				
				</div>
			</div>

		</section>

		<section class="joinus__section-5">

			<div class="title relative mb--2">

				<?php
					echo $circles_pair_bg;
				 ?>

				<div class="holder">
					<h2 class="fw--700 fs--1800 text--blue mb--1"><?php echo $section_5_title_part_1 ?></h2>
					<p class="fw--700 fs--800 lh--125 text--turquoise"><?php echo $section_5_title_part_2 ?></p>
				</div>

			</div>

			<div class="advantages">

				<?php

				if ($section_5_repeater_fields) {

					foreach($section_5_repeater_fields as $row) :

						$icon = $row['icon'];
						$title = $row['title'];
						$paragraph = $row['paragraph'];

						echo '<div class="flex flex-col advantage">
								<div class="advantage__wrapper flex flex-col content-center items-center">
									<div class="advantage__img-wrapper w--fit-content relative">
										<div class="corner__decoration corner__decoration--left"></div>
										<img src="'.$icon["url"].'" alt="'.$icon["alt"].'" loading="lazy">
										<div class="corner__decoration corner__decoration--right"></div>
									</div>

									<div class="advantage__title-wrapper"><p class="fw--700 fs--600 text--turquoise">'.$title.'</p></div>
									<div class="advantage__paragraph-wrapper pd--standard relative"><p class="fw--700">'.$paragraph.'</p></div>
								</div>
							</div>';

					endforeach;

				}

				?>
			</div>

		</section>

		<section class="joinus__section-5">

			<?php
				get_template_part( 'template-parts/partials/follow-us' );
			?>

		</section>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();