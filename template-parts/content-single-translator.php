<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */


$translator_first_name = get_field("translator_first_name");
$translator_last_name = get_field("translator_last_name");
$translator_about_short = get_field('translator_about_short');
$translator_about = get_field('translator_about');

$translator__linkedin_link = get_field("translator_linkedin_link"); 
$linkedin_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/linkedin.svg");

$translator_contact_phone = get_field("translator_contact_phone");
$translator_contact_phone_public = get_field("translator_contact_phone_public");
$phone_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/phone.svg");

$translator_contact_email = get_field("translator_contact_email");
$translator_contact_email_public = get_field("translator_contact_email_public");
$at_symbol_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/email.svg");

$translator_city = get_field("translator_city");
$translator_city_public = get_field("translator_city_public");
$localization_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/localization.svg");

$radio_waves = file_get_contents(get_template_directory() . "/dist/dist/svg/radio-waves.svg");

$arrow_controls_left = file_get_contents(get_template_directory() . "/dist/dist/svg/arrow_controls_left.svg");
$arrow_controls_right = file_get_contents(get_template_directory() . "/dist/dist/svg/arrow_controls_right.svg");

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<section class="single-translator__section single-translator__section--1">

		<div class="desktop-only mb--6">

			<div class="flex translator__basic-data-wrapper">
		
				<div class="translator__top">

					<div class="profile-picture__wrapper text--center mb--4">

							<div class="corner__decoration corner__decoration--left"></div>

							<img src="<?php echo get_the_post_thumbnail_url() ?>" loading="lazy" />

							<div class="corner__decoration corner__decoration--right"></div>

					</div>

					<div class="translator__icons-wrapper text--right mb--2">
					<?php

						if ($translator__linkedin_link)  {
							echo  '<a href="'.esc_url($translator__linkedin_link).'" class="contact-icon contact-icon__linkedin" target="_blank">
							'.$linkedin_icon.'
							</a>';
						}

					?>
					</div>



					<div class="translator__contact">

						<?php

							if ($translator_contact_phone_public || $translator_contact_email_public || $translator_city_public) {
								echo '<h2 class="text--turquoise fw--700 fs--600 mb--05 border--standard">Kontakt</h2>';
							}	

						?>

						<?php
							if ($translator_contact_phone_public && strlen($translator_contact_phone) > 0) {

								echo '<div class="flex items-center info-tile">
										<div class="icon">'.$phone_icon.'</div>
										<a href="tel:'.$translator_contact_phone.'">'.$translator_contact_phone.'</a>
									</div>';
							}

							if ($translator_contact_email_public && strlen($translator_contact_email) > 0) {
								echo '<div class="flex items-center info-tile">
										<div class="icon">'.$at_symbol_icon.'</div>
										<a href="mailto:'.$translator_contact_email.'">'.$translator_contact_email.'</a>
									</div>';
							}

							if ($translator_city_public && strlen($translator_city) > 0) {

								echo '<div class="flex items-center info-tile">
										<div class="icon">'.$localization_icon.'</div>
										<span>';
										
										// .$translator_city;

										// if (strlen(get_field("translator_city")) > 0) {
										// 	echo get_field("translator_city").', ';
										// }
		
										$translator_localizations = wp_get_object_terms( $post->ID, 'translator_localization' );

										$temporary_array = array();

										if ( $translator_localizations ) {
		
											foreach( $translator_localizations as $localization ) :

												array_push($temporary_array, $localization->name);

											endforeach;
										}

										$temporary_array = array_reverse(array_unique($temporary_array));

										if ( $temporary_array ) {
		
											$i = 0;
		
											foreach( $temporary_array as $unique_localization ) :
		
												echo $unique_localization;
		
												$i++;
		
												if (count($translator_localizations) > $i ) {
													echo ", ";
												}
		
											endforeach;
										}

									echo '</span>

									</div>';
							}

						?>
					</div>

				</div>

				<div class="translator__bottom">

					<div class="translator__middle mb--3">

						<header class="entry-header mb--2">
							
							<?php
								echo '
									<h1 class="entry-title fs--1200 text--blue mb--05">'.$translator_first_name.' '. $translator_last_name.'</h1>
								';

							?>

						</header><!-- .entry-header -->

						<?php
							if (strlen($translator_about_short) > 0) {
							?>

							<div>
								<h2 class="info-tile text--turquoise fw--700 fs--600 mb--05 border--standard">
									Jedno zdanie o mnie
								</h2>

								<p class="fw--500 info-tile">
									<?php echo $translator_about_short ?>
								</p>

							</div>

							<?php
							}
						?>

					</div>

					<div class="wrapper-flex translator__languages mb--3">
						<?php

						$tax_label_languages = get_taxonomy('translator_language')->label;
						$translator_languages = wp_get_object_terms( $post->ID, 'translator_language' );

						if ( $translator_languages ) {

							echo '<ul>
									<h2 class="info-tile text--turquoise fw--700 fs--600 border--standard">'.$tax_label_languages.'</h2>
								';

							foreach( $translator_languages as $term ) :

								// $queried_object = get_queried_object();
								// var_dump($queried_object);
								// $taxonomy = $queried_object->taxonomy;
								// $term_id = $queried_object->term_id;

								// 		$flag_image = get_field('flag_image', $taxonomy . '_' . $term_id);
								// 		echo '<img src="'.$flag_image['url'].'" alt="'.$flag_image['alt'].'" />';

										echo '<li class="info-tile">'.$term->name.'</li>';
							endforeach;

							echo '</ul>';
						}

						?>
					</div>

					<div class="wrapper-flex translator__specializations mb--3">
						<?php

						$tax_label_specializations = get_taxonomy('translator_specialization')->label;

						$translator_specializations = wp_get_object_terms( $post->ID, 'translator_specialization' );

						if ( $translator_specializations ) {

							echo '<ul>
									<h2 class="info-tile text--turquoise fw--700 fs--600 border--standard">'.$tax_label_specializations.'</h2>
									';

							foreach( $translator_specializations as $term ) :
										echo '<li class="info-tile">'.$term->name.'</li>';
							endforeach;

							echo '</ul>';
						}
						?>
					</div>

					<div class="translator__about">
						
						<h2 class="info-tile text--turquoise fw--700 fs--600 mb--1 border--standard">O mnie</h2>

						<p>
							<?php
								echo $translator_about;
							?>
						</p>

					</div>

				</div>

			</div>

		</div><!-- desktop-only -->

		<div class="mobile-only mb--4">

				<div class="translator__top">

					<div class="profile-picture__wrapper text--center mb--4">

							<div class="corner__decoration corner__decoration--left"></div>

							<img src="<?php echo get_the_post_thumbnail_url() ?>" loading="lazy" />

							<div class="corner__decoration corner__decoration--right"></div>

					</div>

					<div class="translator__middle">

						<header class="entry-header mb--4">
							
							<?php
								echo '
									<h1 class="entry-title fs--800 text--blue mb--05">'.$translator_first_name.' '. $translator_last_name.'</h1>
								';

							?>

						</header><!-- .entry-header -->

						<?php
							if (strlen($translator_about_short) > 0) {
							?>

							<div class="translator__about mb--2">
								<h2 class="text--turquoise fw--700 fs--600 mb--05 border--standard">
									Jedno zdanie o mnie
								</h2>

								<p class="fw--500 info-tile">
									<?php echo $translator_about_short ?>
								</p>

							</div>

							<?php
							}
						?>

					</div>

					<div class="translator__contact">
						<h2 class="text--turquoise fw--700 fs--600 mb--05 border--standard">Kontakt</h2>

						<?php
							if ($translator_contact_phone_public) {

								echo '<div class="flex items-center info-tile">
										<div class="icon">'.$phone_icon.'</div>
										<a href="tel:'.$translator_contact_phone.'">'.$translator_contact_phone.'</a>
									</div>';
							}

							if ($translator_contact_email_public) {
								echo '<div class="flex items-center info-tile">
										<div class="icon">'.$at_symbol_icon.'</div>
										<a href="mailto:'.$translator_contact_email.'">'.$translator_contact_email.'</a>
									</div>';
							}

							if ($translator_city_public) {

								echo '<div class="flex items-center info-tile">
										<div class="icon">'.$localization_icon.'</div>
										<span>';
										
										// .$translator_city;

										// if (strlen(get_field("translator_city")) > 0) {
										// 	echo get_field("translator_city").', ';
										// }
		
										$translator_localizations = wp_get_object_terms( $post->ID, 'translator_localization' );

										$temporary_array = array();

										if ( $translator_localizations ) {
		
											foreach( $translator_localizations as $localization ) :

												array_push($temporary_array, $localization->name);

											endforeach;
										}

										$temporary_array = array_reverse(array_unique($temporary_array));

										if ( $temporary_array ) {
		
											$i = 0;
		
											foreach( $temporary_array as $unique_localization ) :
		
												echo $unique_localization;
		
												$i++;
		
												if (count($translator_localizations) > $i ) {
													echo ", ";
												}
		
											endforeach;
										}

									echo '</span>

									</div>';
							}

						?>
					</div>

					<div class="translator__icons-wrapper text--right mt--4 mb--4">
					<?php

						if ($translator__linkedin_link)  {

							echo  '<div class="translator__linkedin text--left">
										<h2 class="text--turquoise fw--700 fs--600 mb--1 border--standard">Linkedin</h2>
										<a href="'.esc_url($translator__linkedin_link).'" class="contact-icon contact-icon__linkedin" target="_blank">
										'.$linkedin_icon.'
										</a>
								  </div>';
						}

					?>
					</div>

				</div>

				<div class="translator__bottom">

					<div class="wrapper-flex translator__languages mt--4 mb--4">
						<?php

						$tax_label_languages = get_taxonomy('translator_language')->label;
						$translator_languages = wp_get_object_terms( $post->ID, 'translator_language' );

						if ( $translator_languages ) {

							echo '<ul>
									<h2 class="text--turquoise fw--700 fs--600 border--standard">'.$tax_label_languages.'</h2>
								';

							foreach( $translator_languages as $term ) :

								// $queried_object = get_queried_object();
								// var_dump($queried_object);
								// $taxonomy = $queried_object->taxonomy;
								// $term_id = $queried_object->term_id;

								// 		$flag_image = get_field('flag_image', $taxonomy . '_' . $term_id);
								// 		echo '<img src="'.$flag_image['url'].'" alt="'.$flag_image['alt'].'" />';

										echo '<li class="info-tile">'.$term->name.'</li>';
							endforeach;

							echo '</ul>';
						}

						?>
					</div>

					<div class="wrapper-flex translator__specializations mb--4">
						<?php

						$tax_label_specializations = get_taxonomy('translator_specialization')->label;

						$translator_specializations = wp_get_object_terms( $post->ID, 'translator_specialization' );

						if ( $translator_specializations ) {

							echo '<ul>
									<h2 class="text--turquoise fw--700 fs--600 border--standard">'.$tax_label_specializations.'</h2>
									';

							foreach( $translator_specializations as $term ) :
										echo '<li class="info-tile">'.$term->name.'</li>';
							endforeach;

							echo '</ul>';
						}
						?>
					</div>

					<div class="translator__about">

						<h2 class="text--turquoise fw--700 fs--600 mb--1 border--standard">O mnie</h2>

						<p>
							<?php
								echo $translator_about;
							?>
						</p>

					</div>

				</div>

			</div>

	</section><!-- end of section-1 desktop -->
		
	 <?php
	 	$translator_sounds_repeater = get_field("translator_sound_gallery");

		 $voice_recordings_title_array = [];
		 $is_gallery_empty;

		 if ($translator_sounds_repeater) {
			foreach($translator_sounds_repeater as $repeater_field) :
				if ($repeater_field["translator_single_voice_recording"]) {
					array_push($voice_recordings_title_array, $repeater_field["translator_single_voice_recording"]);
				}
			 endforeach;
	
			 if (count($voice_recordings_title_array) > 0) {
				$is_gallery_empty = false;
			 } else {
				$is_gallery_empty = true;
			 }
		 }

	if ($translator_sounds_repeater && !$is_gallery_empty) :
	 ?>

		<section class="single-translator__section single-translator__section--2">

			<div class="wrapper-flex">
				<div class="text-content-holder">	
					<h2 class="fs--1000 text--blue text--center mb--4 border--standard">
						Posłuchaj próbki głosu
					</h2>
				</div>

				<div class="wrapper-flex relative">
					<!-- Slider main container -->
					<div class="swiper-container swiper-container--single-translator-sound-gallery">
					<!-- Additional required wrapper -->
						<div class="swiper-wrapper">

							<?php

								foreach($translator_sounds_repeater as $repeater_field) :

									if ($repeater_field["translator_single_voice_recording"]) {
										echo '<div class="swiper-slide wrapper-flex-col-center">';

											echo '<div class="text-content-holder">';
												echo '<p class="fw--700 fs--600 mb--1">'.$repeater_field["translator_single_voice_recording_label"].'</p>';
												echo '<p class="fs--400 mb--2">'.$repeater_field["translator_single_voice_recording_text"].'</p>';
											echo '</div>';

											echo '<template>
													<style>
														.flex {
															display: flex;
														}
														 .content-center {
															justify-content: center;
														 }

														 .items-center {
															 align-items: center;
														 }

														 .w--25 svg {
															 width: 25%;
														 }

														 .h--auto svg {
															height: auto;
														 }

														button {
															padding: 0;
															border: 0;
															background: transparent;
															cursor: pointer;
															outline: none;
															width: 40px;
															height: 40px;
															float: left;
														}
														#audio-player-container {
															position: relative;
															margin: 2rem auto;
															width: 95%;
															max-width: 500px;
															font-family: Arial, Helvetica, sans-serif;
															--seek-before-width: 0%;
															--volume-before-width: 100%;
															--buffered-width: 0%;
															letter-spacing: -0.5px;
														}
														#audio-player-container::before {
															position: absolute;
															content: "";
															width: calc(100% + 4px);
															height: calc(100% + 4px);
															left: -2px;
															top: -2px;
															z-index: -1;
														}
														p {
															position: absolute;
															top: -18px;
															right: 5%;
															padding: 0 5px;
															margin: 0;
															font-size: 28px;
															background: #fff;
														}
														#play-icon {
															margin: 20px 2.5% 10px 2.5%;
														}
														#play-icon path, #mute-icon path {
															stroke: #007db5;
														}
														.time {
															display: inline-block;
															width: 37px;
															text-align: center;
															font-size: 20px;
															margin: 28.5px 0 18.5px 0;
															float: left;
														}
														output {
															display: inline-block;
															width: 32px;
															text-align: center;
															font-size: 20px;
															float: left;
															clear: left;
														}
														#volume-slider {
															margin: 10px 2.5%;
															width: 58%;
															display: none;
														}
														#volume-output {
															display: none;
														}
														#volume-slider::-webkit-slider-runnable-track {
															background: rgba(0, 125, 181, 0.6);
														}
														#volume-slider::-moz-range-track {
															background: rgba(0, 125, 181, 0.6);
														}
														#volume-slider::-ms-fill-upper {
															background: rgba(0, 125, 181, 0.6);
														}
														#volume-slider::before {
															width: var(--volume-before-width);
														}
														#mute-icon {
															margin: 28.5px 0 18.5px 20px;
														}
														input[type="range"] {
															position: relative;
															-webkit-appearance: none;
															width: 48%;
															margin: 0;
															padding: 0;
															height: 19px;
															margin: 30px 2.5% 20px 2.5%;
															float: left;
															outline: none;
															background: transparent;
														}
														input[type="range"]::-webkit-slider-runnable-track {
															width: 100%;
															height: 3px;
															cursor: pointer;
															background: linear-gradient(to right, rgba(0, 125, 181, 0.6) var(--buffered-width), rgba(0, 125, 181, 0.2) var(--buffered-width));
														}
														input[type="range"]::before {
															position: absolute;
															content: "";
															top: 8px;
															left: 0;
															width: var(--seek-before-width);
															height: 3px;
															background-color: #007db5;
															cursor: pointer;
														}
														input[type="range"]::-webkit-slider-thumb {
															position: relative;
															-webkit-appearance: none;
															box-sizing: content-box;
															border: 1px solid #007db5;
															height: 15px;
															width: 15px;
															border-radius: 50%;
															background-color: #fff;
															cursor: pointer;
															margin: -7px 0 0 0;
														}
														input[type="range"]:active::-webkit-slider-thumb {
															transform: scale(1.2);
															background: #007db5;
														}
														input[type="range"]::-moz-range-track {
															width: 100%;
															height: 3px;
															cursor: pointer;
															background: linear-gradient(to right, rgba(0, 125, 181, 0.6) var(--buffered-width), rgba(0, 125, 181, 0.2) var(--buffered-width));
														}
														input[type="range"]::-moz-range-progress {
															background-color: #007db5;
														}
														input[type="range"]::-moz-focus-outer {
															border: 0;
														}
														input[type="range"]::-moz-range-thumb {
															box-sizing: content-box;
															border: 1px solid #007db5;
															height: 15px;
															width: 15px;
															border-radius: 50%;
															background-color: #fff;
															cursor: pointer;
														}
														input[type="range"]:active::-moz-range-thumb {
															transform: scale(1.2);
															background: #007db5;
														}
														input[type="range"]::-ms-track {
															width: 100%;
															height: 3px;
															cursor: pointer;
															background: transparent;
															border: solid transparent;
															color: transparent;
														}
														input[type="range"]::-ms-fill-lower {
															background-color: #007db5;
														}
														input[type="range"]::-ms-fill-upper {
															background: linear-gradient(to right, rgba(0, 125, 181, 0.6) var(--buffered-width), rgba(0, 125, 181, 0.2) var(--buffered-width));
														}
														input[type="range"]::-ms-thumb {
															box-sizing: content-box;
															border: 1px solid #007db5;
															height: 15px;
															width: 15px;
															border-radius: 50%;
															background-color: #fff;
															cursor: pointer;
														}
														input[type="range"]:active::-ms-thumb {
															transform: scale(1.2);
															background: #007db5;
														}
													</style>
													<div id="audio-player-container">
														<audio src="" preload="metadata" loop></audio>
														<div class="flex content-center w--25 h--auto">'.$radio_waves.'</div>
														<div class="flex content-center items-center">
															<button id="play-icon"></button>
															<span id="current-time" class="time">0:00</span>
															<input type="range" id="seek-slider" max="100" value="0">
															<span id="duration" class="time">0:00</span>
															<div class="flex content-center items-center">
																<output id="volume-output">100</output>
																<input type="range" id="volume-slider" max="100" value="100">
																<button id="mute-icon"></button>
															</div>
														</div>

													</div>
												</template>
											';

											echo '<audio-player  class="audio-player" data-src="'.$repeater_field["translator_single_voice_recording"].'"></audio-player>';

										echo '</div>';
									}

								endforeach;

							?>

						</div>
						<!-- If we need pagination -->
						<div class="swiper-pagination"></div>
					</div>

					<!-- If we need navigation buttons -->
					<div class="controls-container">
						<div class="swiper-button-prev swiper-button-prev--sound">
							<?php echo $arrow_controls_left; ?>
						</div>
						<div class="swiper-button-next swiper-button-next--sound">
							<?php echo $arrow_controls_right; ?>
						</div>
					</div>
				</div>
			</div>

		</section>

	<?php
		endif;
	?>
	<!-- end of section-2 -->

	<?php
	 	$translator_work = get_field("translator_work");

		if ($translator_work) :
	 ?>

	<section class="single-translator__section single-translator__section--3">

		<div class="wrapper-flex">
			<div class="text-content-holder">
				<h2 class="fs--1000 text--blue text--center mb--4 border--standard">
				Gdzie najczęściej pracuję?
				</h2>
				
				<div class="wrapper-flex">
					<?php
						echo '<p>';
							echo $translator_work;
						echo '</p>';
					?>
				</div>
			</div>
		</div>

	</section>

	<?php
		endif;
	?>
	<!-- end of section-3 -->

	<?php

		$single_translator_pictures_gallery = get_field("translator_gallery");
		$single_translator_videos_repeater = get_field("translator_video_gallery");

		$video_gallery_title_array = [];
		$is_video_gallery_empty;

		if ($single_translator_videos_repeater) {
		   foreach($single_translator_videos_repeater as $repeater_field) :
			   if ($repeater_field["translator_single_video"]) {
				   array_push($video_gallery_title_array, $repeater_field["translator_single_video"]);
			   }
			endforeach;
   
			if (count($video_gallery_title_array) > 0) {
			   $is_video_gallery_empty = false;
			} else {
			   $is_video_gallery_empty = true;
			}
		}

		if (($single_translator_pictures_gallery || $single_translator_videos_repeater) && !$is_video_gallery_empty) :
	 ?>

	<section class="single-translator__section single-translator__section--4">

		<div class="wrapper-flex">

				<div class="text-content-holder">
					<h2 class="fs--1000 text--blue text--center mb--2">
						Zdjęcia i filmy
					</h2>
				</div>

				<div class="wrapper-flex relative">
						<!-- Slider main container -->
							<div class="swiper-container swiper-container--single-translator-multimedia-gallery">
								<!-- Additional required wrapper -->
								<div class="swiper-wrapper">
									<!-- Slides -->

									<?php

										$single_translator_videos_gallery = [];

										if ($single_translator_videos_repeater) :

											foreach($single_translator_videos_repeater as $repeater_field) :

												if ($repeater_field["translator_single_video"]) {
													array_push($single_translator_videos_gallery, $repeater_field["translator_single_video"]);
												}

											endforeach;

										endif;

											//operations below are for determing which array is longer, and for adding empty-link value(s) as placeholders
											//otherwise array_combine wouldn't be possible, arrays lengths must be equal

										if ($single_translator_pictures_gallery) {

											$count_pictures = count($single_translator_pictures_gallery);

											$count_videos = count($single_translator_videos_gallery);

											if($count_pictures > $count_videos) {

												//count
												$longer_array_count = $count_pictures;
												$shorter_array_count = $count_videos;

												//arrays
												$longer_array = $single_translator_pictures_gallery;
												$shorter_array = $single_translator_videos_gallery;

											} elseif($count_pictures < $count_videos) {

												//count
												$longer_array_count = $count_videos;
												$shorter_array_count = $count_pictures;

												//arrays
												$longer_array = $single_translator_videos_gallery;
												$shorter_array = $single_translator_pictures_gallery;

											} else {
												//doesnt matter which is which, if they are equal length

												//count
												$longer_array_count = $count_videos;
												$shorter_array_count = $count_pictures;

												//arrays
												$longer_array = $single_translator_videos_gallery;
												$shorter_array = $single_translator_pictures_gallery;
											}

											$length_difference = $longer_array_count - $shorter_array_count;

											//add placeholder 'empty-link' value(s) to shorter array as many times as needed to make its length equal to the longer one

											if ($length_difference !== 0) {
												for ($j = 0; $j < $length_difference; $j++) {
													array_push($shorter_array, "empty-link");
												}
											}

											//now we can combine these 2 arrays

											$multimedia_array = array_combine($longer_array, $shorter_array);

											if (count($multimedia_array) > 0) {

												foreach($multimedia_array as $longer_array_element => $shorter_array_element) :

													//file extension check 

													if ($longer_array_element && $shorter_array_element) {

														$longer_array_element_info = pathinfo($longer_array_element);
														$longer_array_element_extension = $longer_array_element_info['extension'];
			
														$pictures_proper_formats = array('png','jpg','jpeg');
														$videos_proper_formats = array('mp4','mov','wmv','mpg');
			
														//to recognize which one is which
			
														if (in_array($longer_array_element_extension, $pictures_proper_formats) ) {
															$picture_element = $longer_array_element;
															$video_element = $shorter_array_element;
														}
			
														if (in_array($longer_array_element_extension, $videos_proper_formats) ) {
															$video_element = $longer_array_element;
															$picture_element = $shorter_array_element;
														}
			
														//finally we can echo elements in swiper slide
			
														echo '<div class="swiper-slide">';
			
															if (!($picture_element == "empty-link") && !($video_element == "empty-link")) {
																echo '<img class="image-next-to-video" src="'.$picture_element.'">';
															}

															if (!($picture_element == "empty-link") && ($video_element == "empty-link")) {
																echo '<img class="image-solo" src="'.$picture_element.'">';
															}
			
															if (!($video_element == "empty-link")) {
																echo '<div class="video-container">';
																	echo '<video controls src="'.$video_element.'">';
																echo '</div>';
															}


															
														echo '</div>';
														
													}

												endforeach;

											}
										}
									?>

									</div>
								<!-- If we need pagination -->
								<div class="swiper-pagination"></div>

								<!-- If we need scrollbar -->
								<!-- <div class="swiper-scrollbar"></div> -->
							</div>

					<!-- If we need navigation buttons -->
					<div class="controls-container">
						<div class="swiper-button-prev swiper-button-prev--multimedia">
							<?php echo $arrow_controls_left; ?>
						</div>
						<div class="swiper-button-next swiper-button-next--multimedia">
							<?php echo $arrow_controls_right; ?>
						</div>
					</div>

				</div>
		</div>

	</section>
	<!-- end of section-4 -->
	<?php
		endif;
	?>

	<section class="single-translator__section single-translator__section--5">

		<div class="wrapper-flex">

				<div class="text-content-holder">
					<h2 class="fs--1000 text--blue text--center mb--2 border--standard">
						Czy ten tłumacz sprawdzi się na moim wydarzeniu?
					</h2>
				</div>

				<div class="wrapper-flex">
						
				</div>
		</div>

	</section>
	<!-- end of section-5 -->

	<?php

		$translator_tag_full_name = trim($translator_first_name . '-' . $translator_last_name);

		$original_query = $wp_query;
		$wp_query = null;
		$args = array('posts_per_page' => -1, 'tag' => $translator_tag_full_name);
		$wp_query = new WP_Query($args);

		if (have_posts()) :
	?>

	<section class="single-translator__section single-translator__section--6">

		<div class="wrapper-flex">
				<div class="text-content-holder">
					<h2 class="fs--1000 text--blue text--center mb--2">
						Moje publikacje
					</h2>
				</div>

				<div class="blog-posts-grid">
					<?php
						while (have_posts()) : the_post();
							get_template_part( 'template-parts/content', 'post-in-archive' );
						endwhile;

					?>


						<!-- Slider main container -->
						<!-- <div class="swiper-container swiper-container--translator-publications"> -->
							<!-- Additional required wrapper -->
							<!-- <div class="swiper-wrapper"> -->
								<!-- Slides -->
								<?php

										// while (have_posts()) : the_post();
										// 	echo '<div class="swiper-slide">';

										// 	echo '</div>';
										// endwhile;

								?>
							<!-- </div> -->
							<!-- If we need pagination -->
							<!-- <div class="swiper-pagination"></div> -->

							<!-- If we need navigation buttons -->
							<!-- <div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div> -->

						<!-- </div> -->

						<?php

						$wp_query = null;
						$wp_query = $original_query;
						wp_reset_postdata();

						?>
				</div>
		</div>

	</section>

	<?php 
		endif;
	?>
	<!-- end of section-6 -->

	<div class="dnone">
		<p>Click the button to create a new PDF document with <code>pdf-lib</code></p>
		<button id="createPDFTrigger">Create PDF</button>
		<p class="small">(Your browser will download the resulting file)</p>

	</div>


</article><!-- #post-<?php the_ID(); ?> -->
