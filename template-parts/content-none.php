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
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'pstk' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
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
			
			$ip_address="159.205.25.176";
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
				'hide_empty' => false,
				'orderby'    => 'ID',
			) );

			$three_closest = array();

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
	
				//   echo '<p>'.$city_latitude.'</p>';
				//   echo '<p>'.$city_longitude.'</p>';

				  $distance_from_user = distance($user_lat, $user_lon, $city_latitude, $city_longitude, "K");

				//   echo $distance_from_user . " Kilometers<br>";

				  $city_object = (object)[];

				  $city_object->city_name = $term->name;
				  $city_object->distance_from_user = $distance_from_user;

				  array_push($three_closest, $city_object);


				}

				echo '</div>';

			endforeach;

			usort($three_closest,function($first,$second){
				return $first->distance_from_user > $second->distance_from_user;
			});

			var_dump($three_closest);


		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
