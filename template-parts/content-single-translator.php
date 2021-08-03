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

			<?php pstk_post_thumbnail(); ?>

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

</article><!-- #post-<?php the_ID(); ?> -->
