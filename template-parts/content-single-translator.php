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
			
						echo get_field("translator_bio_acf");

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
