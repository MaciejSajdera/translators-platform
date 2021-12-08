<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */
$translator__linkedin_link = get_field("translator_linkedin_link"); 
$translator_about_short = get_field('translator_about_short');
$linkedin_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/linkedin.svg");
$localization_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/localization.svg");
$distance_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/distance.svg");
$approved_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/approved_icon.svg");

// data is currenty passed from the following files:
// - content-none.php

$args = wp_parse_args(
    $args,
    array(
        'data' => array(
            'distance_from_target_city_to_the_closest_city' => false, // default value
			'target_city_name' => false,
        )
    )
);

if ( $args['data'] ) {
	$distance_from_target_city_to_the_closest_city = strval($args['data']['distance_from_target_city_to_the_closest_city']);
	$target_city_name = $args['data']['target_city_name'];
  }

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  	<div class="translator__upper relative">

	  <div class="translator__top">

			<a href="<?php echo get_permalink(); ?>">

			<div class="profile-picture__wrapper text--center">

					<?php

					if (get_the_post_thumbnail_url()) {
						echo '<img src="'.get_the_post_thumbnail_url().'" loading="lazy">';
										
					} else {
						echo '<img style="transform: scale(1.1);" src="'.get_stylesheet_directory_uri(). '/dist/dist/img/avatarplaceholder.jpg" loading="lazy">';
					}

					?>
			</div>

			</a>

			<div class="translator__icons-wrapper translator__websites-wrapper text--right">
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

				<div class="post-title flex items-center mb--1 relative">

					<?php

						$translator_first_name = get_field("translator_first_name");
						$translator_last_name = get_field("translator_last_name");

						echo '
						<a class="block relative" href="'.get_permalink().'" rel="bookmark">
							<h2 class="entry-title fs--600 text--blue">'.$translator_first_name.' '. $translator_last_name.'</h2>

							<div class="translator__icons-wrapper text--right account__approved">
							'.$approved_icon.'
							</div>
						</a>
						';

					?>



				</div>
			
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

						?>

						<div class="flex translator__localizations fs--300 mb--1">

						<div class="icon flex">
							<?php echo $localization_icon ?>
						</div>

						<p class="fw--400">

						<ul>

						<?php

						$i = 0;

						foreach( $temporary_array as $unique_localization ) :

							echo '<li>'.$unique_localization;

							$i++;

							if (count($translator_localizations) > $i ) {
								echo ",<wbr>&nbsp;";
							}

							echo '</li>';

						endforeach;

						?>

						</ul>

						</p>

						</div>

						<?php
					}

				?>
				
			<?php

			// var_dump($distance_from_target_city_to_the_closest_city);

			if ($distance_from_target_city_to_the_closest_city || $distance_from_target_city_to_the_closest_city == '0') {

				?>
				<div class="flex items-center translator__distance">

				<div class="icon flex">
					<?php echo $distance_icon ?>
				</div>

				<?php
				// Odległość od '.$target_city_name.'

				echo '<p class="fw--700">Odległość od szukanego miasta: '.$distance_from_target_city_to_the_closest_city.'km</p>';
				?>

				</div>
				<?php
			}

			?>

			</header><!-- .entry-header -->

				<div class="translator__languages">
				<?php

				$tax_label_languages = get_taxonomy('translator_language')->label;
				$translator_languages = wp_get_object_terms( $post->ID, 'translator_language' );

				if ( $translator_languages ) {

					$j = 0;

					echo '<ul>
							<p class="text--turquoise fw--700">'.$tax_label_languages.':&nbsp;</p>
							';

					foreach( $translator_languages as $term ) :

						// $queried_object = get_queried_object();
						// var_dump($queried_object);
						// $taxonomy = $queried_object->taxonomy;
						// $term_id = $queried_object->term_id;

						// 		$flag_image = get_field('flag_image', $taxonomy . '_' . $term_id);
						// 		echo '<img src="'.$flag_image['url'].'" alt="'.$flag_image['alt'].'" />';

								echo '<li class="">'.$term->name;

						$j++;

						if (count($translator_languages) > $j ) {
							echo ",<wbr>&nbsp;";
						}

						echo '</li>';

					endforeach;

					echo '</ul>';
				}

				?>
				</div>

			<div class="translator__specializations">
				<?php

				$tax_label_specializations = get_taxonomy('translator_specialization')->label;

				$translator_specializations = wp_get_object_terms( $post->ID, 'translator_specialization' );

				if ( $translator_specializations ) {

					$k = 0;

					echo '<ul>
							<p class="text--turquoise fw--700">'.$tax_label_specializations.':&nbsp;</p>
							';

					foreach( $translator_specializations as $term ) :
								echo '<li class="">'.$term->name;

					$k++;

					if (count($translator_specializations) > $k ) {
						echo ",&nbsp;";
					}

					echo '</li>';

					endforeach;

					echo '</ul>';
				}
				?>
			</div>

		</div>

		<div class="translator__bottom">

			<?php
			if (strlen($translator_about_short) > 0) {
			?>

			<div class="translator__about">
				<p class="text--turquoise fw--700 fs--600 mb--05 info-tile translator__about-header">
					O mnie
				</p>

				<p class="fw--300 fs--400 translator__about-content">
					<?php echo $translator_about_short ?>
				</p>

			</div>

			<?php
			}
			?>

		</div><!-- .entry-summary -->


		<!-- <div class="read-more mobile-only">
		<?php
		echo '<a href="'.get_permalink().'" class="button button__filled--turquoise" rel="bookmark">Więcej</a>';
		?>
		</div> -->
	</div>

	<div class="translator__lower">


		<!-- <div class="read-more desktop-only">
		<?php
			echo '<a href="'.get_permalink().'" class="button button__filled--turquoise" rel="bookmark">Więcej</a>';
		?>
		</div> -->
	</div>


</article><!-- #post-<?php the_ID(); ?> -->
