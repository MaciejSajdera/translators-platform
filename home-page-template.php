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
$section_6_h2 = $section_6['h2'];
$section_6_title_1 = $section_6['title_1'];
$translator_of_the_month = $section_6['translator_of_the_month'];
$section_6_title_2 = $section_6['title_2'];
$management_member_of_the_month = $section_6["management_member_of_the_month"];

$circles_group = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group.svg");
$circles_group_big = file_get_contents(get_template_directory() . "/dist/dist/svg/circles-group-big.svg");
$linkedin_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/linkedin.svg");
$email_icon_blue = file_get_contents(get_template_directory() . "/dist/dist/svg/email_blue.svg");

$circles_home_section_4 = file_get_contents(get_template_directory() . "/dist/dist/svg/circles_home_section_4.svg");

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main home">


		<section class="home__section-1">

			<div class="welcome-view__container">

					<h1 class="fw--900"><span class="text--outline-blue"><?php echo $h1_part_1 ?></span>
						<br />
						<span class="text--blue"><?php echo $h1_part_2 ?></span>
					</h1>

					<div class="image-holder w--fit-content image-holder-decorated image-holder-decorated--turquoise">

						<?php
						if ($image) {
							?>
							<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>" loading="lazy">
							<?php
						}
						?>
					</div>

					<h2 class="fs--600 fw--700 text--turquoise ff--secondary"><?php echo $h2 ?></h2>

					<?php
						get_template_part( 'template-parts/searchfilter-basic' );
					?>

					<!-- <div class="prizes-wrapper">

						<img src="https://pstk.blossom-is.online/wp-content/uploads/2021/09/HSYTP_main_image-removebg-preview-1.png">
						<img src="https://pstk.blossom-is.online/wp-content/uploads/2021/09/society-removebg-preview-1.png">

					</div> -->

			</div>

			<?php get_template_part( 'template-parts/partials/scroll-down' ); ?>

		</section>

		<section class="home__section-2">

			<div class="wrapper-flex-drow-mcol content-between">
				
				<div class="bulletpoints-box">

					<div class="bulletpoints-box__title">
						<h2 class="text--turquoise fw--700 fs--1200"><?php echo $section_2_title ?></h2>
					</div>

					<div class="bulletpoints-box__list-holder fs--600">
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

				<div class="text--center">
					<?php
						if ($section_2_image) {
							?>
							<img class="image-border-shadow" src="<?php echo $section_2_image['url'] ?>" alt="<?php echo $section_2_image['alt'] ?>" loading="lazy">
							<?php
						}
					?>
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
				<h2 class="text--big-header text--center text--blue"><span class=""><?php echo $section_3_title_part_1 ?></span> <span class=""><?php echo $section_3_title_part_2 ?></span></h2>
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
									<div class="advantage__paragraph-wrapper pseudo-decoration pseudo-decoration__rb-half"><p class="fw--500 fs--400">'.$paragraph.'</p></div>
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
				<div class="section-4__bg">

					<?php
						if ($section_4_image) {
							?>
							<img class="image-border-shadow" width="100%" height="100%" src="<?php echo $section_4_image['url'] ?>" alt="<?php echo $section_4_image['url'] ?>" loading="lazy"/>
							<?php
						}
					?>

					<h2 class="text--big-header pb--1 text--white"><?php echo $section_4_title_part_1 ?></h2>
				</div>
				<p class="text--big-header pt--1 text--blue"><?php echo $section_4_title_part_2 ?></p>

			</div>

			<div class="bg-decoration__holder">
				<div class="bg-decoration__content">
					<?php
						echo $circles_home_section_4;
					?>
				</div>
			</div>

			<div class="section-4__paragraph-wrapper">
				<p class="text--blue fs--600 fw--500"><?php echo $section_4_paragraph ?></p>
			</div>

			<div class="section-4__cta-wrapper text--center">
				<a href="<?php echo $section_4_link ?>" class="read-more fs--600 m--auto button button__filled--turquoise button--readmore">Czytaj więcej</a>
			</div>


		</section>

		<section class="home__section-5">

			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</section>

		<?php
			if ($translator_of_the_month || $management_member_of_the_month) :
		?>

		<section class="home__section-6">

			<h2 class="text--blue fw--900 fs--1800 mb--8 text--big-header">
				<?php echo $section_6_h2 ?>
			</h2>

				<div class="get-to-know-us">
					<div class="wrapper-flex-drow-mcol get-to-know-us__container">

					<?php

					if ($translator_of_the_month) {
												
						?>

						<div class="get-to-know-us__element-wrapper wrapper-flex-col-center">

							<p class="text--blue fs--1200 fw--700 mb--5">
							<?php echo $section_6_title_1 ?>
							</p>

							<div class="translator__top">

								<a class="wrapper-flex-col-center mb--2" href="<?php echo get_permalink($translator_of_the_month->ID) ?>">

									<div class="profile-picture__wrapper text--center mb--4">

											<div class="corner__decoration corner__decoration--left"></div>

											<img src="<?php echo get_the_post_thumbnail_url($translator_of_the_month->ID) ?>" loading="lazy">

											<div class="corner__decoration corner__decoration--right"></div>

									</div>

								</a>

							</div>

							<?php

								$translator_of_the_month_first_name = get_field('translator_first_name', $translator_of_the_month->ID);
								$translator_of_the_month_last_name = get_field('translator_last_name', $translator_of_the_month->ID);

								echo '<p class="fs--800 fw--700 text--blue text--center mb--2">'.$translator_of_the_month_first_name.' '.$translator_of_the_month_last_name.'</p>';

								?>

								<div class="flex content-between items-center">
									<div class="flex items-center text--right icons-wrapper">

									<?php

										$translator_of_the_month_contact_email = get_field('translator_contact_email', $translator_of_the_month->ID);

										if ($translator_of_the_month_contact_email)  {

											echo '<a href="mailto:'.esc_url($translator_of_the_month_contact_email).'" class="contact-icon contact-icon__email" target="_blank">
											'.$email_icon_blue.'
											</a>';
										}

										$translator_of_the_month_linkedin_link = get_field('translator_linkedin_link', $translator_of_the_month->ID);

										if ($translator_of_the_month_linkedin_link)  {

											echo '<a href="'.esc_url($translator_of_the_month_linkedin_link).'" class="contact-icon contact-icon__linkedin" target="_blank">
											'.$linkedin_icon.'
											</a>';
										}

									?>

									</div>

									<div class="cta-holder text--center">
										<a class="button button__filled--turquoise button--readmore" href="<?php echo get_permalink($translator_of_the_month->ID) ?>">Profil</a>
									</div>

								</div>
						</div>

					<?php
					}

					if ($management_member_of_the_month) {
												
						?>

						<div class="get-to-know-us__element-wrapper wrapper-flex-col-center">

							<p class="text--turquoise fs--1200 fw--700 mb--5">
							<?php echo $section_6_title_2 ?>
							</p>

							<div class="translator__top">

								<a class="wrapper-flex-col-center mb--2" href="<?php echo get_permalink($management_member_of_the_month->ID) ?>">

									<div class="profile-picture__wrapper text--center mb--4">

											<div class="corner__decoration corner__decoration--left"></div>

											<?php
												if(get_the_post_thumbnail_url($management_member_of_the_month->ID)) {
														echo '<img src="'.get_the_post_thumbnail_url($management_member_of_the_month->ID).'" loading="lazy">';
												} else {
														echo '<img src="'.get_stylesheet_directory_uri(). '/dist/dist/img/avatarplaceholder.jpg" loading="lazy">';
												}
											?>

											<div class="corner__decoration corner__decoration--right"></div>

									</div>

								</a>

							</div>

							<?php

								$management_member_of_the_month_first_name = get_field('translator_first_name', $management_member_of_the_month->ID);
								$management_member_of_the_month_last_name = get_field('translator_last_name', $management_member_of_the_month->ID);

								echo '<p class="fs--800 fw--700 text--blue text--center mb--2">'.$management_member_of_the_month_first_name.' '.$management_member_of_the_month_last_name.'</p>';

								?>

								<div class="flex content-between items-center">
									<div class="flex items-center text--right icons-wrapper">

									<?php

										$management_member_of_the_month_contact_email = get_field('translator_contact_email', $management_member_of_the_month->ID);

										if ($management_member_of_the_month_contact_email)  {

											echo '<a href="mailto:'.esc_url($management_member_of_the_month_contact_email).'" class="contact-icon contact-icon__email" target="_blank">
											'.$email_icon_blue.'
											</a>';
										}

										$management_member_of_the_month_linkedin_link = get_field('translator_linkedin_link', $management_member_of_the_month->ID);

										if ($management_member_of_the_month_linkedin_link)  {

											echo '<a href="'.esc_url($management_member_of_the_month_linkedin_link).'" class="contact-icon contact-icon__linkedin" target="_blank">
											'.$linkedin_icon.'
											</a>';
										}

									?>

									</div>

									<div class="cta-holder text--center">
										<a class="button button__filled--turquoise button--readmore" href="<?php echo get_permalink($management_member_of_the_month->ID) ?>">Profil</a>
									</div>

								</div>
						</div>

					<?php
					}

					?>

					</div>
				</div>

		</section>

		<?php
			endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();