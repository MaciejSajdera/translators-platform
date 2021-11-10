<?php

/*
 * Template Name: Training Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

$section_1 = get_field("section_1");
$section_1_h2 = $section_1['h2'];
$section_1_image = $section_1['image'];

$section_2 = get_field("section_2");
$section_2_title = $section_2['title'];
$section_2_repeater_fields = $section_2['repeater_fields'];
$section_2_image = $section_2['image'];

$section_3 = get_field("section_3");
$section_3_title = $section_3['title'];
$section_3_paragraph = $section_3['paragraph'];
$section_3_image = $section_3['image'];
$section_3_link = $section_3['link'];

$section_4 = get_field("section_4");
$section_4_title_1 = $section_4['title_1'];
$section_4_repeater_fields = $section_4['repeater_fields'];
$section_4_image = $section_4['image'];
$section_4_title_2 = $section_4['title_2'];
$section_4_paragraph = $section_4['paragraph'];

$section_5 = get_field("section_5");
$section_5_title = $section_5['title'];
$section_5_image = $section_5['image'];
$section_5_paragraph = $section_5['paragraph'];

$section_6 = get_field("section_6");
$section_6_title = $section_6['title'];
$section_6_image = $section_6['image'];
$section_6_paragraph = $section_6['paragraph'];

$section_7 = get_field("section_7");
$section_7_slogan_1 = $section_7['slogan_1'];
$section_7_slogan_2 = $section_7['slogan_2'];
$section_7_slogan_3 = $section_7['slogan_3'];
$section_7_slogan_4 = $section_7['slogan_4'];


?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main training">

		<div class="welcome-view welcome-view-subpage">

			<div class="welcome-view__container image-content-row">

				<div class="content-holder welcome-view__left">

					<div class="entry-header">
						<?php
							the_title( '<h1 class="entry-title uppercase fs--1800 mb--2">', '</h1>' );
						?> 
					</div><!-- .entry-header -->

					<h2 class="fs--800 fw--500 lh--150 ff--secondary text--turquoise"><?php echo $section_1_h2 ?></h2>

				</div>

				<div class="welcome-view__right image-holder">

						<?php
						if ($section_1_image) {
							?>
							<img class="image-border-shadow" src="<?php echo $section_1_image['url'] ?>" alt="<?php echo $section_1_image['alt'] ?>">
							<?php
						}
						?>

				</div>

			</div>

		</div>

		<section class="training__section-2">

			<div class="wrapper-flex-drow-mcol drow-reverse content-between image-content-row">
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

				<div class="image-holder image-to-the-right">

					<?php
						if ($section_2_image) {
							?>
							<img class="image-border-shadow" src="<?php echo $section_2_image['url'] ?>" alt="<?php echo $section_2_image['alt'] ?>">
							<?php
						}
					?>

				</div>
			</div>

		</section>

		<section class="training__section-3">

			<div class="wrapper-flex-drow-mcol content-between image-content-row">

				<div class="content-holder">
					<h2 class="fs--1200 fw--700 text--blue mb--2"><?php echo $section_3_title ?></h2>

					<div class="paragraph-wrapper mb--5">
						<p class="fs--600"><?php echo $section_3_paragraph ?></p>
					</div>

					<div class="cta-wrapper">
						<a href="<?php echo $section_3_link ?>" class="read-more fs--600 button button__filled--turquoise">Czytaj więcej</a>
					</div>
				</div>


				<div class="image-holder image-to-the-left">

					<?php
						if ($section_3_image) {
							?>
							<img src="<?php echo $section_3_image['url'] ?>" alt="<?php echo $section_3_image['alt'] ?>" />
							<?php
						}
					?>

				</div>

			</div>

		</section>

		<section class="training__section-4">

			<div class="wrapper-flex-drow-mcol drow-reverse content-between image-content-row mb--4">

				<div class="content-holder bulletpoints-box">

					<div class="bulletpoints-box__title">
						<h2 class="text--turquoise fw--700 fs--1200"><?php echo $section_4_title_1 ?></h2>
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

				<div class="image-holder image-to-the-right">

					<?php
						if ($section_4_image) {
							?>
							<img class="image-border-shadow" src="<?php echo $section_4_image['url'] ?>" alt="<?php echo $section_4_image['alt'] ?>">
							<?php
						}
					?>

				</div>

			</div>

			<div class="text--center">
					<h2 class="text--turquoise fw--700 fs--1200 mb--2"><?php echo $section_4_title_2 ?></h2>
					<p class="fw--400 fs--600 pd--standard"> <?php echo $section_4_paragraph ?> </p>
			</div>

		</section>

		<section class="training__section-5">

			<div class="wrapper-flex-drow-mcol content-between image-content-row mb--4">

				<div class="content-holder">

					<h2 class="text--blue fw--700 fs--1200 mb--2"><?php echo $section_5_title ?></h2>
					<p class="fw--400 fs--600"> <?php echo $section_5_paragraph ?> </p>
				</div>

				<?php
				if ($section_5_image) {
					?>
					<div class="image-holder image-to-the-right">
						<img class="image-border-shadow" src="<?php echo $section_5_image['url'] ?>" alt="<?php echo $section_5_image['alt'] ?>">
					</div>
					<?php
				}
				?>

			</div>

		</section>

		<section class="training__section-6">

			<div class="wrapper-flex-drow-mcol drow-reverse content-between image-content-row mb--4">

				<div class="content-holder">
					<h2 class="text--blue fw--700 fs--1200 mb--2"><?php echo $section_6_title ?></h2>
					<p class="fw--400 fs--600"> <?php echo $section_6_paragraph ?> </p>
				</div>

				<?php
				if ($section_6_image) {
					?>
					<div class="image-holder image-to-the-right">
						<img class="image-border-shadow" src="<?php echo $section_6_image['url'] ?>" alt="<?php echo $section_6_image['alt'] ?>">
					</div>
					<?php
				}
				?>

			</div>

		</section>
		
		<section class="training__section-7">

			<div class="content-holder text--center m--auto mb--4">
				<h3 class="fs--1000 fw--900 text--turquoise"><?php echo $section_7_slogan_1 ?></h3>
				<h3 class="fs--1000 fw--900 text--blue"><?php echo $section_7_slogan_2 ?></h3>
			</div>

			<div class="content-holder text--center m--auto">
				<h3 class="fs--1000 fw--900 text--blue"><?php echo $section_7_slogan_3 ?></h3>
				<h3 class="fs--1000 fw--900 text--blue"><?php echo $section_7_slogan_4 ?></h3>
			</div>

		</section>

		<section class="training__section-8">

			<?php
				get_template_part( 'template-parts/search-basic-section' );
			?>

		</section>

		<section class="training__section-9">

			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();