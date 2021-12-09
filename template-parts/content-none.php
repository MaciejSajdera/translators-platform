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

		<?php

			/* Get name of the city user was looking for */

			if (!isset($_GET['_sft_translator_localization'])) {
				$target_city_name = '';
			}

			if (isset($_GET['_sft_translator_localization'])) {
				$target_city_name = $_GET['_sft_translator_localization'];
			}

			$target_languages_arr = array();

			if (isset($_GET['_sft_translator_language'])) {
				$target_languages = $_GET['_sft_translator_language'];
				$target_languages_arr = explode(" ", $target_languages);
			}

			$target_specializations_arr = array();

			if (isset($_GET['_sft_translator_specialization'])) {
				$target_specializations = $_GET['_sft_translator_specialization'];
				$target_specializations_arr = explode(" ", $target_specializations);
			}

			// var_dump($target_languages_arr);

			//if no city is provided and no translator matches all provided languages

			if (!$target_city_name && ($target_languages_arr && count($target_languages_arr))) {

				$all_translators_with_one_of_the_target_languages = array(
					'post_type' => 'translator',
					'tax_query' => array(
						array(
							'taxonomy' => 'translator_language',
							'field' => 'slug',
							'terms' => $target_languages_arr, // Where term_id of Term 1 is "1".
							'operator' => 'IN',
						)
					),
				);

				if ($all_translators_with_one_of_the_target_languages) {

					$query_all_translators_with_one_of_the_target_languages = new WP_Query($all_translators_with_one_of_the_target_languages);

					if ($query_all_translators_with_one_of_the_target_languages->have_posts()) {
	
						echo '
						<div class="no-results-message wrapper-flex-drow-mcol items-center">
							<div class="no-results-message__text">
								<p class="fs--400 fw--700">
									Nie znalazłeś tłumacza, który posługuje się wszystkimi wybranymi przez Ciebie językami?
								</p>
								<p class="text--turquoise fs--400 fw--700">
									Sprawdź tłumaczy posługujących się przynajmniej jednym z nich: 
								</p>
							</div>
							<div class="no-results-message__image svg-icon-wrapper text--center">'.$no_results_icon.'</div>
						</div>';
	
						?> 
						<div id="search__results-wrapper" class="wrapper-flex-drow-mcol">
	
							<div class="archive-translator__article-list-wrapper flex column">
	
							<?php
	
							while ($query_all_translators_with_one_of_the_target_languages->have_posts()) {
								$query_all_translators_with_one_of_the_target_languages->the_post();
		
								get_template_part( 'template-parts/content', 'archive-translator', array( 
									'data'  => array(
									'distance_from_target_city_to_the_closest_city' => '',
									'target_city_name' => '',
									)) 
								);
							}
	
							?>
							</div> <!-- archive-translator__article-list-wrapper -->

							<div class="search__side-bar relative">
								<div class="fixed-side-bar">
									<?php get_template_part( 'template-parts/blog-promo-posts' ) ?>
								</div>
							</div>

						</div> <!-- search__results-wrapper -->
						
					<?php
					}
				}
			}

			//if all matches except of specialization

			//if nothing matches

			//if no city matched but languages match and target city is provided

			if ($target_city_name) {

				//get other translators with language that user is looking for

				$all_translators_with_target_languages = array();
				$all_locations_from_translators_with_target_languages = array();

				if ($target_languages_arr && count($target_languages_arr)) {

					$all_translators_with_target_languages = get_posts(array(
						'post_type' => 'translator',
						// 'numberposts' => 3,
						'tax_query' => array(
						array(
							'taxonomy' => 'translator_language',
							'field' => 'slug',
							'terms' => $target_languages_arr, // Where term_id of Term 1 is "1".
							'operator' => 'AND',
						)
						),
					));

					if ($all_translators_with_target_languages) {

						foreach( $all_translators_with_target_languages as $translator_with_target_languages) :

							// echo $translator_with_target_languages->post_title;

							if (get_the_terms( $translator_with_target_languages->ID, 'translator_localization' )) {
								foreach ( get_the_terms( $translator_with_target_languages->ID, 'translator_localization' ) as $tax ) {
									array_push($all_locations_from_translators_with_target_languages, $tax);
								}
							}

						endforeach;
					}

				}

				$closest_cities_arr = calculate_distance_from_each_location_to_target_location($all_locations_from_translators_with_target_languages, $target_city_name)->locations_objects_arr;

				$closest_cities_names = array();

				foreach( $closest_cities_arr as $city_obj ) :

					// echo $city_obj->city_name;
					// echo '<br />';
					// var_dump(json_encode($city_obj));
					// echo '<br />';
					
					array_push($closest_cities_names, $city_obj->city_name);

					
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
							),
						array(
							'taxonomy' => 'translator_language',
							'field' => 'slug',
							'terms' => $target_languages_arr,
						),
							),
					));

					foreach($my_posts as $post) :

						array_push($closest_translators_ids_in_order, $post->ID);

					endforeach;

				endforeach;

				// var_dump($closest_translators_ids_in_order);

				/* Query translators posts in given order  */

				$post_ids = $closest_translators_ids_in_order;

				// var_dump($closest_cities_names);
				// echo '<br />';
				// var_dump($target_languages_arr);

				$args = array(
				'post_type' => 'translator',
					'tax_query' => array(             
						array(
							'taxonomy' => 'translator_localization',
							'field' => 'slug',
							'terms' => $closest_cities_names,
						),
						// array(
						// 	'taxonomy' => 'translator_language',
						// 	'field' => 'slug',
						// 	'terms' => $target_languages_arr,
						// ),
						// array(
						// 	'taxonomy' => 'translator_specialization',
						// 	'field' => 'slug',
						// 	'terms' => $target_specializations_arr,
						// )
					),
				'post__in' => $post_ids,
				'orderby' => 'post__in',
				);

				// var_dump($args);
			
				$query = new WP_Query($args);

				if ($query->have_posts()) {

					echo '
					<div class="no-results-message wrapper-flex-drow-mcol items-center">
						<div class="no-results-message__text">
							<p class="fs--400 fw--700">
								Nie znalazłeś tłumacza w wybrany mieście? Bez obaw. <br />
								Większość tłumaczy lubi podróżować i przyjmuje zlecenia w całym kraju i za granicą. 
							</p>
							<p class="text--turquoise fs--400 fw--700">
								Skontaktuj się z tłumaczem najbliżej wybranego przez Ciebie miasta: 
							</p>
						</div>
						<div class="no-results-message__image svg-icon-wrapper text--center">'.$no_results_icon.'</div>
					</div>';

					?> 
					<div id="search__results-wrapper" class="wrapper-flex-drow-mcol">

						<div class="archive-translator__article-list-wrapper flex column">

						<?php

						while ($query->have_posts()) {
							$query->the_post();
	
							$translator_localizations = wp_get_object_terms( $post->ID, 'translator_localization' );
	
							if ( $translator_localizations ) {
	
								$distances_from_target_city_arr = array();
	
								foreach( $translator_localizations as $localization ) :
	
									// $index_of_matched_city;
	
									$i = 0;
	
											if (in_array($localization->name, array_column($closest_cities_arr, "city_name"))) { 
	
												foreach($closest_cities_arr as $city) :
	
													if ($city->city_name == $localization->name) {
														array_push($distances_from_target_city_arr, $city->distance_from_target);
														// $index_of_matched_city = $i;
														$i++;
													}
	
												endforeach;
	
											}
	
								endforeach;

								sort($distances_from_target_city_arr);
	
								$distance_from_target_city_to_the_closest_city;

								// if (count($distances_from_target_city_arr) > 0) {
	
								// 	$distance_from_target_city_to_the_closest_city = $distances_from_target_city_arr[$index_of_matched_city];
	
								// } else {
	
								// }

								$distance_from_target_city_to_the_closest_city = $distances_from_target_city_arr[0];
								
							}
	
							get_template_part( 'template-parts/content', 'archive-translator', array( 
								'data'  => array(
								'distance_from_target_city_to_the_closest_city' => $distance_from_target_city_to_the_closest_city,
								'target_city_name' => $target_city_name,
								)) 
							);
						}

						?>
						</div> <!-- archive-translator__article-list-wrapper -->
						<?php
					
				} else {

					echo '<div class="no-results-message wrapper-flex-drow-mcol items-center">
							<p class="fs--400 fw--700">
							Brak tłumaczy spełniających podane kryteria. Spróbuj zmienić parametry wyszukiwania.
							</p>
							<div class="svg-icon-wrapper text--center">'.$no_results_icon.'</div>
						</div>';

						?>
						<div class="archive-translator__article-list-wrapper flex column">
							<!-- //inni sugerowani tlumacze -->
						</div> <!-- archive-translator__article-list-wrapper -->
						<?php
				}
				?>

						<div class="search__side-bar relative">
							<div class="fixed-side-bar">
								<?php get_template_part( 'template-parts/blog-promo-posts' ) ?>
							</div>
						</div>

					</div> <!-- search__results-wrapper -->
					
				<?php 

			}

		wp_reset_postdata();

?>
