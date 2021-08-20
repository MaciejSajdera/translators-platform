<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="single-translator__section single-translator__section--1">

		<div class="single-translator__contact">

			<?php pstk_post_thumbnail();

			
			echo '<p>'.get_field('translator_contact_phone').'</p>';

			echo '<p>'.get_field('translator_contact_email').'</p>';

			echo '<p>'.get_field('translator_city').'</p>';

			echo '<p>';

			$translator_localizations = wp_get_object_terms( $post->ID, 'translator_localization' );
			
			if ( $translator_localizations ) {
				foreach( $translator_localizations as $term ) :
	
							echo $term->name;
							echo ", ";
						
				endforeach;
			}

			echo '</p>';

			echo '<p>'.get_field('translator_linkedin_link').'</p>';
			
			?>

			

		</div>

		<div class="single-translator__info">

			<div class="content-box info-box">

				<header class="entry-header">
					
					<?php

					$translator_first_name = get_field("translator_first_name");
					$translator_last_name = get_field("translator_last_name");

					echo '<h2 class="entry-title">'.$translator_first_name.' '. $translator_last_name.'</h2>';

					?>

				</header><!-- .entry-header -->

				<div class="info-box__subbox">

					<?php

					echo '<p>';

					$translator_languages = wp_get_object_terms( $post->ID, 'translator_language' );
			
					if ( $translator_languages ) {
						foreach( $translator_languages as $term ) :
			
									echo $term->name;
									echo ", ";
								
						endforeach;
					}

					echo '</p>';

					echo '<p>';
			
						echo get_field("translator_bio");

					echo '</p>';

					?>

				</div>

				<div class="info-box__subbox">

					<?php

					$translator_specializations_taxonomy = get_taxonomy( 'translator_specialization' );

					echo '<p class="info-box__subbox-header">';

						echo $translator_specializations_taxonomy->label;

					echo '</p>';

					$translator_specializations = wp_get_object_terms( $post->ID, 'translator_specialization' );

					if ( $translator_specializations ) {
						foreach( $translator_specializations as $term ) :

									echo '<div class="info-tile">'.$term->name.'</div>';
								
						endforeach;
					}

					?>

				</div>

				<div class="info-box__subbox">

					<?php

					echo '<p>';
			
						echo get_field("translator_about");

					echo '</p>';

					?>

				</div>

			</div>

		</div>

		<div class="single-translator__certificate">

			[“Certyfikat” jakości PSTK”]

		</div>

	</div>
	 <!-- end of section-1 -->

	 <div class="single-translator__section single-translator__section--2">

		<div class="wrapper-flex">
			<h2>
				Posłuchaj próbki głosu
			</h2>
		</div>

	</div>
	<!-- end of section-2 -->

	<div class="single-translator__section single-translator__section--3">

		<div class="wrapper-flex">
				<h2>
					Gdzie najczęściej pracuję?
				</h2>

				<div class="wrapper-flex">
					<?php

						echo '<p>';
						
							echo get_field("translator_work");

						echo '</p>';

					?>
				</div>
		</div>

	</div>
	<!-- end of section-3 -->

	<div class="single-translator__section single-translator__section--4">

		<div class="wrapper-flex">
				<h2>
					Zdjęcia i filmy
				</h2>

				<div class="wrapper-flex">
						<!-- Slider main container -->
							<div class="swiper-container swiper-container--single-translator-multimedia-gallery">
							<!-- Additional required wrapper -->
							<div class="swiper-wrapper">
								<!-- Slides -->
								
								<?php
									$single_translator_pictures_gallery = get_field("translator_gallery");

									$single_translator_videos_repeater = get_field("translator_video_gallery");

									$single_translator_videos_gallery = [];

									foreach($single_translator_videos_repeater as $repeater_field) :

										if ($repeater_field["translator_single_video"]) {
											array_push($single_translator_videos_gallery, $repeater_field["translator_single_video"]);
										}

									endforeach;

										//operations below are for determing which array is longer and for adding empty-link value(s) as placeholders
										//otherwise array_combine wouldn't be possible, arrays lengths need to be equal to do that

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
		
														if (!($picture_element == "empty-link")) {
															echo '<img src="'.$picture_element.'">';
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



								?>

							</div>
							<!-- If we need pagination -->
							<div class="swiper-pagination"></div>

							<!-- If we need navigation buttons -->
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>

							<!-- If we need scrollbar -->
							<!-- <div class="swiper-scrollbar"></div> -->
							</div>
				</div>
		</div>

	</div>
	<!-- end of section-4 -->

	<div class="single-translator__section single-translator__section--5">

		<div class="wrapper-flex">
				<h2>
					Czy ten tłumacz sprawdzi się na moim wydarzeniu?
				</h2>

				<div class="wrapper-flex">
						
				</div>
		</div>

	</div>
	<!-- end of section-5 -->

	<?php

		$translator_tag_full_name = trim($translator_first_name . '-' . $translator_last_name);

		$original_query = $wp_query;
		$wp_query = null;
		$args = array('posts_per_page' => -1, 'tag' => $translator_tag_full_name);
		$wp_query = new WP_Query($args);

		if (have_posts()) :
	?>

	<div class="single-translator__section single-translator__section--6">

		<div class="wrapper-flex">
				<h2>
					Moje publikacje
				</h2>

				<div class="wrapper-flex">

						<!-- Slider main container -->
						<div class="swiper-container swiper-container--translator-publications">
							<!-- Additional required wrapper -->
							<div class="swiper-wrapper">
								<!-- Slides -->
								<?php

										while (have_posts()) : the_post();
											echo '<div class="swiper-slide">';
											echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
											echo '</div>';
										endwhile;

								?>
							</div>
							<!-- If we need pagination -->
							<div class="swiper-pagination"></div>

							<!-- If we need navigation buttons -->
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>

						</div>

						<?php



						$wp_query = null;
						$wp_query = $original_query;
						wp_reset_postdata();

						?>
				</div>
		</div>

	</div>

	<?php 
		endif;
	?>
	<!-- end of section-6 -->


</article><!-- #post-<?php the_ID(); ?> -->
