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
		// if ( is_home() && current_user_can( 'publish_posts' ) ) :

		// 	printf(
		// 		'<p>' . wp_kses(
		// 			/* translators: 1: link to WP admin new post page. */
		// 			__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'pstk' ),
		// 			array(
		// 				'a' => array(
		// 					'href' => array(),
		// 				),
		// 			)
		// 		) . '</p>',
		// 		esc_url( admin_url( 'post-new.php' ) )
		// 	);

		if ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'pstk' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'pstk' ); ?></p>
			<?php
			// get_search_form();

			//Get user localization with https://ip-api.com/

			// var_dump($_SERVER['REMOTE_ADDR']) ;
			
			$ip_address="91.167.182.101";
			/*Get user ip address details with geoplugin.net*/
			$geopluginURL='http://ip-api.com/php/'.$ip_address;
			$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
			/*Get City name by return array*/
			$city = $addrDetailsArr['city'];
			/*Get Country name by return array*/
			$country = $addrDetailsArr['country'];
			$user_lat = $addrDetailsArr['lat'];
			$user_lon = $addrDetailsArr['lon'];
			/*Comment out these line to see all the posible details*/
			/*echo '<pre>';
			print_r($addrDetailsArr);
			die();*/
			if(!$city){
			   $city='Not Define';
			}if(!$country){
			   $country='Not Define';
			}
			echo '<strong>IP Address</strong>:- '.$ip_address.'<br/>';
			echo '<strong>City</strong>:- '.$city.'<br/>';
			echo '<strong>Country</strong>:- '.$country.'<br/>';
			echo '<strong>Lat</strong>:- '.$user_lat.'<br/>';
			echo '<strong>Lon</strong>:- '.$user_lon.'<br/>';


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

				$address = $term->name; // Address
				$apiKey = 'AIzaSyAPJ8o7xD9vqydfgZ6XrJKvLdnhmL_YTxA'; // Google maps now requires an API key.
				// Get JSON results from this request
				$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
				$geo = json_decode($geo, true); // Convert the JSON to an array
				
				if (isset($geo['status']) && ($geo['status'] == 'OK')) {
				  $city_latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
				  $city_longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude

				  $distance_from_user = distance($user_lat, $user_lon, $city_latitude, $city_longitude, "K");
	
				//   echo '<p>'.$city_latitude.'</p>';
				//   echo '<p>'.$city_longitude.'</p>';
				//   echo $distance_from_user . " Kilometers<br>";

				  $city_object = (object)[];

				  $city_object->city_name = $term->name;
				  $city_object->distance_from_user = round($distance_from_user, 0);

				  array_push($cities_objects_arr, $city_object);

				}

				// echo '</div>';

			endforeach;

			usort($cities_objects_arr,function($first,$second){
				return $first->distance_from_user > $second->distance_from_user;
			});

			// var_dump($cities_objects_arr);

			
			$closest_cities_arr = array_slice($cities_objects_arr, 0, 3);

			var_dump($closest_cities_arr);

			// var_dump($term);

			$closest_cities_names = array();


			foreach( $closest_cities_arr as $city_obj ) :

				// get_term_by('name', 'Grzegórzki', 'translator_localization')

				// var_dump($city_obj->city_name);
				
				array_push($closest_cities_names, $city_obj->city_name);

			endforeach;

			// var_dump($closest_cities_names);

			$args = array(
			'post_type' => 'translator',
			// 'order'      => 'ASC',
			'tax_query' => array(             
				array(
					'taxonomy' => 'translator_localization',
					'field' => 'slug',
					'terms' => $closest_cities_names,
				),
			),
			);
		
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

						if ( $translator_localizations ) {

							$matched_cities_arr = array();

							foreach( $translator_localizations as $term ) :

										if (in_array($term->name, array_column($closest_cities_arr, "city_name"))) { 
											
											foreach($closest_cities_arr as $obj) :

												if ($obj->city_name == $term->name)

											
												array_push($matched_cities_arr, $obj->distance_from_user);



											endforeach;

										}
									
							endforeach;

							echo $matched_cities_arr[0]. 'KM';
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

		
			<?php
				}
			}
			wp_reset_postdata();

			// $arr_vals = array_values((array)$closest_cities_arr);

			// var_dump($arr_vals);

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
