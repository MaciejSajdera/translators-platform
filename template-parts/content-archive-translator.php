<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */
$translator__linkedin_link = get_field("translator_linkedin_link"); 
$linkedin_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/linkedin.svg");
$translator_about = get_field('translator_about');
// var_dump($translator__linkedin_link);

// data is currenty passed from the following files:
// - content-none.php

$args = wp_parse_args(
    $args,
    array(
        'data' => array(
            'distance_from_target_city_to_the_closest_city' => false, // default value
        )
    )
);

if ( $args['data'] ) {
	$distance_from_target_city_to_the_closest_city = $args['data']['distance_from_target_city_to_the_closest_city'];
  }

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="translator__top">

  		<a href="<?php echo get_permalink(); ?>">

			<div class="profile-picture__wrapper text--center">

					<div class="corner__decoration corner__decoration--left"></div>

					<img src="<?php echo get_the_post_thumbnail_url() ?>" loading="lazy" />

					<div class="corner__decoration corner__decoration--right"></div>

			</div>

		</a>

		<div class="translator__icons-wrapper text--right">
		<?php

			if ($translator__linkedin_link)  {

				echo '<a href="'.esc_url($translator__linkedin_link).'" class="contact-icon contact-icon__linkedin" target="_blank">
				'.$linkedin_icon.'
				</a>';
			}

		?>
		</div>


	</div>

	<div class="translator__middle">

		<header class="entry-header mb--2">
			
			<?php

				$translator_first_name = get_field("translator_first_name");
				$translator_last_name = get_field("translator_last_name");

				echo '
				<a href="'.get_permalink().'" rel="bookmark">
					<h2 class="entry-title fs--1000 text--blue mb--05">'.$translator_first_name.' '. $translator_last_name.'</h2>
				</a>
				';

			?>

			<p class="fw--700">
				<?php
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

				?>
			</p>

			<?php

			if ($distance_from_target_city_to_the_closest_city) {
				echo '<p class="fw--300">Odległość: '.$distance_from_target_city_to_the_closest_city.'km</p>';
			}

			?>

		</header><!-- .entry-header -->

		<?php
			if (strlen($translator_about) > 0) {
			?>

			<div class="translator__about mb--3">
				<p class="info-tile text--turquoise fw--700 fs--800 mb--05">
					O mnie
				</p>

				<p class="fw--300">
					<?php echo $translator_about ?>
				</p>

			</div>

			<?php
			}
		?>

		<div class="read-more desktop-only">
			<?php
				echo '<a href="'.get_permalink().'" class="button button__filled--turquoise" rel="bookmark">Więcej</a>';
			?>
		</div>



	</div>

	<div class="translator__bottom">

		<div class="wrapper-flex translator__specializations">
			<?php

			$tax_label_specializations = get_taxonomy('translator_specialization')->label;

			$translator_specializations = wp_get_object_terms( $post->ID, 'translator_specialization' );

			if ( $translator_specializations ) {

				echo '<ul>
						<p class="info-tile text--turquoise fw--700 fs--800">'.$tax_label_specializations.'</p>
						';

				foreach( $translator_specializations as $term ) :
							echo '<li class="info-tile">'.$term->name.'</li>';
				endforeach;

				echo '</ul>';
			}
			?>
		</div>

		<div class="wrapper-flex translator__languages">
			<?php

			$tax_label_languages = get_taxonomy('translator_language')->label;
			$translator_languages = wp_get_object_terms( $post->ID, 'translator_language' );

			if ( $translator_languages ) {

				echo '<ul>
						<p class="info-tile text--turquoise fw--700 fs--800">'.$tax_label_languages.'</p>
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

	</div><!-- .entry-summary -->


	<div class="read-more mobile-only">
		<?php
			echo '<a href="'.get_permalink().'" class="button button__filled--turquoise" rel="bookmark">Więcej</a>';
		?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
