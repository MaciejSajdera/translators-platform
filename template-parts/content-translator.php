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

		<?php pstk_post_thumbnail(); ?>

	<div class="archive-translators__translator-info-wrapper">

		<header class="entry-header">
			
			<?php

				$translator_first_name = get_field("translator_first_name");
				$translator_last_name = get_field("translator_last_name");

				echo '<h2 class="entry-title">'.$translator_first_name.' '. $translator_last_name.'</h2>';

			?>

			<!-- <?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				pstk_posted_on();
				pstk_posted_by();
				?>
			</div>

			<?php endif; ?> -->

		</header><!-- .entry-header -->

		<p>
			<?php
				echo get_field("translator_city");
			?>
		</p>

		<p>Other cities:

		<?php

			$translator_localizations = wp_get_object_terms( $post->ID, 'translator_localization' );
			
			if ( $translator_localizations ) {
				foreach( $translator_localizations as $term ) :
	
							echo $term->name;
							echo ", ";
						
				endforeach;
			}

			?>

			</p>

		<p>

		<?php

		$translator_languages = wp_get_object_terms( $post->ID, 'translator_language' );

		if ( $translator_languages ) {
			foreach( $translator_languages as $term ) :

						echo $term->name;
						echo ", ";
					
			endforeach;
		}

		?>

		</p>


		<div class="wrapper-flex">

			<?php

			$translator_specializations = wp_get_object_terms( $post->ID, 'translator_specialization' );

			if ( $translator_specializations ) {
				foreach( $translator_specializations as $term ) :

							echo '<div class="info-tile">'.$term->name.'</div>';
						
				endforeach;
			}

			?>

		</div>

	</div>

	<div class="entry-summary">
		<p>
		<?php echo get_field('translator_about') ?>
		</p>
		<?php
			echo '<a href="'.get_permalink().'" rel="bookmark">Więcej</a>';
		?>
	</div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->
