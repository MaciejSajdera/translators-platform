<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'pstk' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php

			?>

			<p><?php esc_html_e( 'Brak wyników w wybranym mieście. Sprawdź tłumaczy najbliżej wybranego miasta:', 'pstk' ); ?></p>
			<?php

				/* Get name of the city user was looking for */

				//TODO: handle edge case where no city was chosen

			if ($_GET && $_GET['_sft_translator_localization']) {
				$target_city_name = $_GET['_sft_translator_localization'];
			}

			if ($target_city_name) {

				/* Get geolocation of the city user was looking for */

				$apiKey = 'AIzaSyAPJ8o7xD9vqydfgZ6XrJKvLdnhmL_YTxA'; // Google maps now requires an API key.

				$geo_target_city = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($target_city_name).'&sensor=false&key='.$apiKey);
				$geo_target_city = json_decode($geo_target_city, true); // Convert the JSON to an array

				if (isset($geo_target_city['status']) && ($geo_target_city['status'] == 'OK')) {
					$target_city_latitude = $geo_target_city['results'][0]['geometry']['location']['lat']; // Latitude
					$target_city_longitude = $geo_target_city['results'][0]['geometry']['location']['lng']; // Longitude
				}

				print_r('Szukane miasto: '.$target_city_name);
				echo '<br />';
				print_r('Latitude: '.$target_city_latitude);
				echo '<br />';
				print_r('Longitude: '.$target_city_longitude);

				/* Get all not empty cities from the database and calculate distance from target city */

				$translator_localizations = get_terms( array(
					'taxonomy' => 'translator_localization',
					'hide_empty' => true,
					'orderby'    => 'ID',
				) );

				$cities_objects_arr = array();

				foreach( $translator_localizations as $term ) :

					// echo '<div style="border: 1px solid black; margin: 1rem; padding: 1em;">';

					// echo '<label>';

					// echo $term->name;

					// echo '</label>';


					$translator_city_name = $term->name; // Address

					/* Get JSON results from this request */
					$geo_translator_city = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($translator_city_name).'&sensor=false&key='.$apiKey);
					$geo_translator_city = json_decode($geo_translator_city, true); // Convert the JSON to an array

					if (isset($geo_translator_city['status']) && ($geo_translator_city['status'] == 'OK')) {
					$translator_city_latitude = $geo_translator_city['results'][0]['geometry']['location']['lat']; // Latitude
					$translator_city_longitude = $geo_translator_city['results'][0]['geometry']['location']['lng']; // Longitude

					$distance_from_target = distance($target_city_latitude, $target_city_longitude, $translator_city_latitude, $translator_city_longitude, "K");
		
					//   echo '<p>'.$translator_city_latitude.'</p>';
					//   echo '<p>'.$translator_city_longitude.'</p>';
					//   echo $distance_from_target . " Kilometers<br>";

					$city_object = (object)[];

					$city_object->city_name = $term->name;
					$city_object->distance_from_target = round($distance_from_target, 0);

					array_push($cities_objects_arr, $city_object);

					}

					// echo '</div>';

				endforeach;

				/* Sort cities objects starting from the closest one*/

				usort($cities_objects_arr,function($first,$second){
					return $first->distance_from_target > $second->distance_from_target;
				});

				/* Get 3 closest cities */
				
				$closest_cities_arr = array_slice($cities_objects_arr, 0, 3);

				/* Get names of the 3 closest cities */

				echo '<br />';
				echo 'Najbliższe miasta: ';

				$closest_cities_names = array();

				foreach( $closest_cities_arr as $city_obj ) :
					
					array_push($closest_cities_names, $city_obj->city_name);

					echo $city_obj->city_name.', ';

				endforeach;


				/* Get IDs of translators in order with closest cities */

				$closest_translators_ids_in_order = array();

				foreach( $closest_cities_names as $city_name) :

					// echo $city_name;

					$my_posts = get_posts(array(
						'post_type' => 'translator',
						// 'numberposts' => 3,
						'tax_query' => array(
						  array(
							'taxonomy' => 'translator_localization',
							'field' => 'slug',
							'terms' => $city_name // Where term_id of Term 1 is "1".
						  )
						)
					));

					foreach($my_posts as $post) :

						// echo $post->ID;
						array_push($closest_translators_ids_in_order, $post->ID);

					endforeach;

				endforeach;


				/* Query translators posts in given order  */

				$post_ids = $closest_translators_ids_in_order;

				$args = array(
				'post_type' => 'translator',
					'tax_query' => array(             
						array(
							'taxonomy' => 'translator_localization',
							'field' => 'slug',
							'terms' => $closest_cities_names,
						),
					),
				'post__in' => $post_ids,
				'orderby' => 'post__in',
				);

				// var_dump($args);
			
				$query = new WP_Query($args);
			
				if ($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post();

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

						<p>Odległość:

						<?php

							$index_of_matched_city;

							$i = 0;

							if ( $translator_localizations ) {

								$matched_cities_arr = array();

								foreach( $translator_localizations as $term ) :

											if (in_array($term->name, array_column($closest_cities_arr, "city_name"))) { 

												foreach($closest_cities_arr as $obj) :

													if ($obj->city_name == $term->name) {
														array_push($matched_cities_arr, $obj->distance_from_target);
														$index_of_matched_city = $i;
														$i++;
													}

												endforeach;

											}

								endforeach;

								if (count($matched_cities_arr) > 0) {

									// print_r($matched_cities_arr);

									echo $matched_cities_arr[$index_of_matched_city]. 'KM';
								} else {
									echo $matched_cities_arr[0]. 'KM';
								}
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
				
											echo '<div class="info-tile"><p>'.$term->name.'</p></div>';
										
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

			
				<?php
					
				}
			}
		}

			wp_reset_postdata();

			// $arr_vals = array_values((array)$closest_cities_arr);

			// var_dump($arr_vals);

		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->