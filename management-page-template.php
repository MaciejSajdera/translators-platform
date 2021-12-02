<?php

/*
 * Template Name: Managemen Page Template
 * description: >-
  Page template without sidebar
 */

get_header();


$section_1 = get_field("section_1");
$h2 = $section_1['h2'];
// $PSTK_letters_filled = file_get_contents(get_template_directory() . "/dist/dist/svg/PSTK_letters_filled.svg");
// $PSTK_letters_outline = file_get_contents(get_template_directory() . "/dist/dist/svg/PSTK_letters_outline.svg");

$cards = get_field('cards');

?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main management">

		<div class="welcome-view welcome-view-subpage relative">

			<div class="welcome-view__container">

				<div class="welcome-view__left">

					<?php
						// if ( function_exists('yoast_breadcrumb') ) {
						// 	yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
						// }
					?>

					<div class="entry-header">
						<?php
							the_title( '<h1 class="entry-title fs--1800 mb--2">', '</h1>' );
						?> 
					</div><!-- .entry-header -->


					<div class="svg-holder">

							<div class="svg-bg"></div>
							<div class="svg-bg"></div>
							<div class="svg-bg"></div>

					</div>


				</div>

				<div class="welcome-view__right">
					<p class="fs--800 fw--700 text--turquoise ff--secondary"><?php echo $h2 ?></p>
				</div>

			</div>

			<?php get_template_part( 'template-parts/partials/scroll-down' ); ?>

		</div>

		<section class="management__section-2 management__tabs">

			<div class="tabs-menu">

				<?php 

					$tabs_menu_counter = 1;

					if ($cards) {
						foreach($cards as $card) {

							$card_state;
	
							if ($tabs_menu_counter == 1) {
								$card_state = '--active';
							} else {
								$card_state = '';
							}
	
							echo '
								<div class="flex items-center content-center tab-menu__position tab-menu__position'.$card_state.'" data-tab="tab-'.$tabs_menu_counter.'">
									<p class="management__tab-title fw--700">'.$card['title'].'</p>
								</div>
							';
	
							$tabs_menu_counter++;
						}
					}

				?>

			</div>

			<div class="tabs-content">

				<?php 
					$tabs_counter = 1;

					if ($cards) {

						foreach($cards as $card) {

							$tab_state = '';
	
							if ($tabs_counter == 1) {
								$tab_state = '--active';
							}

							echo '
								<div id="tab-'.$tabs_counter.'" class="management__card-content management__card-content--card-'.$tabs_counter.' tab'.$tab_state.' tab--loaded">
	
									<div class="management__card-title">
										<p class="fs--1800 uppercase fw--900 text--outline-blue">'.$card['title'].'</p>
										<p class="fs--1800 uppercase fw--900 text--blue">'.$card['years'].'</p>
									</div>
				
									<div class="management__squad">
									';
								
									if ($card['repeater_fields']) {
	
										$translators_counter = 1;

										foreach($card['repeater_fields'] as $row) :
	
											$number_of_translators = count($card['repeater_fields']);
				
											$translator = $row['translator'];

											if (!$translator) {
												$image_url = get_stylesheet_directory_uri(). '/dist/dist/img/avatarplaceholder.jpg';
												$title = 'Członek zarządu';
												$translator_link = '#';
												$translator_email = 'annachweduczak@gmail.com';
											}

											if ($translator) {
												$image_url = get_the_post_thumbnail_url($translator->ID);
												$title = $row['title'];
												$translator_link = get_the_permalink($translator->ID);
												$translator_email = get_field("translator_contact_email", $translator->ID);
											}

											if (!$image_url) {
												$image_url = get_stylesheet_directory_uri(). '/dist/dist/img/avatarplaceholder.jpg';
											}
	
											$order_status = '';
	
											if (($number_of_translators == $translators_counter) && ($translators_counter % 2 == 0)) {
												$order_status = 'management__person--last-even';
											}
	
	
											//add css class to two last persons if the number of members is even
	
											if (($number_of_translators % 2 !== 0) && ((($number_of_translators - 1) == $translators_counter) || ($number_of_translators == $translators_counter))) {
												$order_status = 'management__person--last-pair';
											}
	
											echo '<div class="management__person '.$order_status.'">';
				
												echo '<div class="management__person-wrapper">';
				
													if ($image_url) {
														echo '
				
															<div class="image-wrapper w--fit-content relative mb--4">
																<a href="mailto:'.$translator_email.'" class="svg-icon-bg svg-icon-bg--email"></a>
																<div class="corner__decoration corner__decoration--left"></div>
																<img src="'.$image_url.'" alt="'.$translator->post_title.'" loading="lazy">
																<div class="corner__decoration corner__decoration--right"></div>
															</div>
															';
													}
				
													echo '<div class="text-wrapper">';
				
															if ($translator->post_title) {
																echo '<p class="person-name text--center fs--600 fw--700 text--blue mb--1">'.$translator->post_title.'</p>';
															}
	
															if ($title) {
																echo '<p class="person-role text--center fs--400 fw--500 mb--2">'.$title.'</p>';
															}
	
															if ($translator_link) {
																echo '<a href="'.$translator_link.'" class="flex content-center items-center up-down-decoration up-down-decoration--turquoise text--turquoise">
																	Czytaj więcej
																<span class="svg-icon-bg svg-icon-bg--pointer-right"></span>
																</a>';
															}
	
													echo '</div>
													</div>
												</div>';
	
												$translators_counter++;
	
										endforeach;
	
								echo '</div>
	
									<div class="management__description">
										<p class="text--big-header text--center text--turquoise mb--2">
											<span class="text--outline-turquoise">'.$card['description_title_1'].'</span>
											<br />
											<span class="text--turquoise">'.$card['description_title_2'].'</span>
										</p>
										<p class="fs--600">'.$card['description_content'].'</p>
									</div>
	
								</div>';
								}
	
							$tabs_counter++;
						}
					}


				?>

			</div>
		</section>

		<section class="management__section-2">
			<?php get_template_part( 'template-parts/blog-new-posts' ); ?>
		</section>

		<?php
			// get_template_part( 'template-parts/back-to-home-page' );
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();