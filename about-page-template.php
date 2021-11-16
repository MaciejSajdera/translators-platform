<?php

/*
 * Template Name: About Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

$section_1 = get_field("section_1");
$section_1_h2 = $section_1['h2'];
$section_1_paragraph = $section_1['paragraph'];
$section_1_image = $section_1['image'];

$section_2 = get_field("section_2");
$section_2_title = $section_2['title'];
$section_2_repeater_fields = $section_2['repeater_fields'];

$section_3 = get_field("section_3");
$section_3_title_part_1 = $section_3['title_part_1'];
$section_3_title_part_2 = $section_3['title_part_2'];
$section_3_repeater_fields = $section_3['repeater_fields'];

$circles_group = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group.svg");
$circles_group_big = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group-big.svg");

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main about">

		<div class="welcome-view welcome-view-subpage">

			<div class="welcome-view__container image-content-row">

				<div class="welcome-view__left">

					<div class="entry-header">
						<?php
							the_title( '<h1 class="entry-title fs--1800 mb--2">', '</h1>' );
						?> 
					</div><!-- .entry-header -->

					<h2 class="mb--2">
						<span class="fs--1400 fw--700 lh--125 text--blue"><?php echo $section_1_h2 ?></span>
					</h2>

					<p class="fs--800 fw--500 ff--secondary text--turquoise"><?php echo $section_1_paragraph ?></p>

				</div>

				<div class="welcome-view__right image-holder w--fit-content image-to-the-right">

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

		<section class="about__section-2">

			<div class="section-2__title">
				<p class="text--big-header"><span class="text--blue"><?php echo $section_2_title  ?></span> <span class="text--outline-blue"><?php echo $section_3_title_part_2 ?></span></p>
			</div>

			<div class="wrapper-flex-drow-mcol content-between">
				<div class="advantages">

						<?php

						if ($section_2_repeater_fields) {

							$i = 0;

							foreach($section_2_repeater_fields as $row) :

								$title_part_1 = $row['title_part_1'];
								$title_part_2 = $row['title_part_2'];
								$textarea = $row['textarea'];
								$image = $row['image'];

								if ( $i % 2) {
									$decoration_direction_class = 'pseudo-decoration__rt';
								} else {
									$decoration_direction_class = 'pseudo-decoration__lt';
								}


								echo '
									<div class="flex flex-col advantage">
										<div class="advantage__wrapper flex flex-col content-center items-center">
											<div class="text-holder">
												<div class="pd--standard"><p class="fw--700 fs--600"><span class="text--turquoise">'.$title_part_1.'</span> <span class="text--blue">'.$title_part_2.'</span></p></div>
												<div class="pd--standard pb--3 relative pseudo-decoration '.$decoration_direction_class.'"><p class="fw--500">'.$textarea.'</p></div>
											</div>
											
											<div class="image-holder w--fit-content">';

											if ($image) {

												 echo '<img class="image-border-shadow" src="'.$image['url'].'" alt="'.$image['alt'].'" loading="lazy" />';

											}

											echo '</div>
										</div>
									</div>
									';

								$i++;

							endforeach;

						}

						?>
					</div>

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

		<section class="about__section-3">

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
								<div class="advantage__wrapper flex flex-col content-center items-center">
									<div class="advantage__img-wrapper w--fit-content relative">
										<div class="corner__decoration corner__decoration--left"></div>
										<img src="'.$icon["url"].'" alt="'.$icon["alt"].'" loading="lazy">
										<div class="corner__decoration corner__decoration--right"></div>
									</div>

									<div class="advantage__title-wrapper"><p class="fw--700 fs--600 text--turquoise">'.$title.'</p></div>
									<div class="advantage__paragraph-wrapper pd--standard relative pseudo-decoration pseudo-decoration__lt"><p class="fw--700">'.$paragraph.'</p></div>
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

		<section class="about__section-4">

			<?php
				get_template_part( 'template-parts/search-basic-section' );
			?>

		</section>

		<section class="about__section-5">

			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();