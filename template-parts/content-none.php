<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */
$no_results_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/no_results.svg");
?>

<section class="no-results not-found">

	<div class="page-content">
		<?php


			/* Get name of the city user was looking for */

			if (isset($_GET['_sft_translator_localization'])) {
				$target_city_name = $_GET['_sft_translator_localization'];
			}

			if (isset($target_city_name)) {

				/* Get geolocation of the city user was looking for */

				$apiKey = 'AIzaSyAPJ8o7xD9vqydfgZ6XrJKvLdnhmL_YTxA'; // Google maps now requires an API key.

				$ch_geo_target_city = curl_init();

				$options_geo_target_city = [
					CURLOPT_SSL_VERIFYPEER => false,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_URL            => 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($target_city_name).'&sensor=false&key='.$apiKey
				];

				curl_setopt_array($ch_geo_target_city, $options_geo_target_city);

				$data_curl_geo_target_city = json_decode(curl_exec($ch_geo_target_city));
				curl_close($ch_geo_target_city);

				$geo_target_city = $data_curl_geo_target_city;

				$geo_target_city = json_decode(json_encode($geo_target_city), true); // Convert the JSON to an array

				// var_dump(json_encode($geo_target_city['results'][0]['geometry']['location']['lat']));
				// var_dump(json_encode($geo_target_city['results'][0]['geometry']['location']['lng']));

				if (!isset($geo_target_city['status']) || ($geo_target_city['status'] != 'OK')) {
					echo '<p class="text--error mb--6">Wystąpił błąd podczas próby uzyskania danych geolokalizacyjnych szukanego miasta, prosimy spróbować ponownie za parę minut.</p>';
					return;
				}

				if (isset($geo_target_city['status']) && ($geo_target_city['status'] == 'OK')) {
					$target_city_latitude = $geo_target_city['results'][0]['geometry']['location']['lat']; // Latitude
					$target_city_longitude = $geo_target_city['results'][0]['geometry']['location']['lng']; // Longitude
				} 

				/* Get all not empty cities from the database and calculate distance from target city */

				$translator_localizations = get_terms( array(
					'taxonomy' => 'translator_localization',
					'hide_empty' => true,
					'orderby'    => 'ID',
				) );

				$cities_objects_arr = array();
				$errors_arr = array();

				foreach( $translator_localizations as $localization ) :

					$translator_city_name = $localization->name; // Address

					$ch_geo_translator_city = curl_init();

					$options_geo_translator_city = [
						CURLOPT_SSL_VERIFYPEER => false,
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_URL            => 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($translator_city_name).'&sensor=false&key='.$apiKey
					];
	
					curl_setopt_array($ch_geo_translator_city, $options_geo_translator_city);
	
					$data_curl_geo_translator_city = json_decode(curl_exec($ch_geo_translator_city));
					curl_close($ch_geo_translator_city);


					$geo_translator_city = $data_curl_geo_translator_city;

					$geo_translator_city = json_decode(json_encode($geo_translator_city), true); // Convert the JSON to an array

					// var_dump(json_encode($geo_translator_city['results'][0]['geometry']['location']['lat']));
					// var_dump(json_encode($geo_translator_city['results'][0]['geometry']['location']['lng']));

					if (isset($geo_translator_city['status']) && ($geo_translator_city['status'] == 'OK')) {
						$translator_city_latitude = $geo_translator_city['results'][0]['geometry']['location']['lat']; // Latitude
						$translator_city_longitude = $geo_translator_city['results'][0]['geometry']['location']['lng']; // Longitude

						$distance_from_target = distance($target_city_latitude, $target_city_longitude, $translator_city_latitude, $translator_city_longitude, "K");
			
						//   echo '<p>'.$translator_city_latitude.'</p>';
						//   echo '<p>'.$translator_city_longitude.'</p>';
						//   echo $distance_from_target . " Kilometers<br>";

						$city_object = (object)[];

						$city_object->city_name = $localization->name;
						$city_object->distance_from_target = round($distance_from_target, 0);

						array_push($cities_objects_arr, $city_object);
					} 
					elseif (isset($geo_translator_city['status']) && ($geo_translator_city['status'] != 'OK')) {
						array_push($errors_arr, $geo_translator_city['status']);

					}

				endforeach;

				// var_dump($errors_arr);

			// if no translator has chosen languages

			if (isset($_GET['_sft_translator_language']) && !isset($_GET['_sft_translator_localization'])) {
				echo '<p>Brak tłumaczy spełniających podane kryteria. Spróbuj zmienić parametry wyszukiwania.</p>';
			}
			
			// if no translator with chosen langs and in chosen location

			if (isset($_GET['_sft_translator_language']) && isset($_GET['_sft_translator_localization'])) {
				echo '
					  <div class="no-results-message flex flex-col">
					  	<div class="svg-icon-wrapper text--center mb--4">'.$no_results_icon.'</div>
						<p class="fs--800 fw--700">
						Nie znalazłeś tłumacza w wybrany mieście? Bez obaw. <br />
						Większość tłumaczy lubi podróżować i przyjmuje zlecenia w całym kraju i za granicą. 
					 	</p>
						 <p class="text--turquoise fs--800 fw--700">
						 Skontaktuj się z tłumaczem z innego miasta: 
						</p>
					  </div>';
			}

				/* Sort cities objects starting from the closest one*/

				usort($cities_objects_arr,function($first,$second){
					return $first->distance_from_target > $second->distance_from_target;
				});

				/* Get 3 closest cities */
				
				$closest_cities_arr = array_slice($cities_objects_arr, 0, 3);

				/* Get names of the 3 closest cities */

				// echo '<div style="margin-bottom: 2rem">';

				// 	echo '<p>For dev purposes:</p>';

				// 	print_r('Szukane miasto: '.$target_city_name);
				// 	echo '<br />';
				// 	print_r('Latitude: '.$target_city_latitude);
				// 	echo '<br />';
				// 	print_r('Longitude: '.$target_city_longitude);

				// 	echo '<br />';
				// 	echo 'Najbliższe miasta: ';


				$closest_cities_names = array();

				foreach( $closest_cities_arr as $city_obj ) :
					
					array_push($closest_cities_names, $city_obj->city_name);

					// echo $city_obj->city_name.', ';

				endforeach;

				// echo '</div>';


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

						$translator_localizations = wp_get_object_terms( $post->ID, 'translator_localization' );

						if ( $translator_localizations ) {

							$distances_from_target_city_arr = array();

							foreach( $translator_localizations as $localization ) :

								$index_of_matched_city;

								$i = 0;

										if (in_array($localization->name, array_column($closest_cities_arr, "city_name"))) { 

											foreach($closest_cities_arr as $city) :

												if ($city->city_name == $localization->name) {
													array_push($distances_from_target_city_arr, $city->distance_from_target);
													$index_of_matched_city = $i;
													$i++;
												}

											endforeach;

										}

							endforeach;

							$distance_from_target_city_to_the_closest_city;

							if (count($distances_from_target_city_arr) > 0) {

								$distance_from_target_city_to_the_closest_city = $distances_from_target_city_arr[$index_of_matched_city];

							} else {

								$distance_from_target_city_to_the_closest_city = $distances_from_target_city_arr[0];

							}
							
						}

						get_template_part( 'template-parts/content', 'archive-translator', array( 
							'data'  => array(
							  'distance_from_target_city_to_the_closest_city' => $distance_from_target_city_to_the_closest_city,
							)) 
						  );
				}
			}
		}

			wp_reset_postdata();


		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->