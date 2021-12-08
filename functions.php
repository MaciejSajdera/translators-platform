<?php
/**
 * pstk functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pstk
 */

if ( ! function_exists( 'pstk_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pstk_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pstk, use a find and replace
		 * to change 'pstk' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pstk', get_template_directory() . '/assets/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'pstk' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'pstk' ),
			)
		);
		

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		// add_theme_support(
		// 	'custom-background',
		// 	apply_filters(
		// 		'pstk_custom_background_args',
		// 		array(
		// 			'default-color' => 'ffffff',
		// 			'default-image' => '',
		// 		)
		// 	)
		// );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'pstk_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pstk_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pstk_content_width', 640 );
}
add_action( 'after_setup_theme', 'pstk_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pstk_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pstk' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pstk' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pstk_widgets_init' );

/* Remove admin bar margin-top */

add_theme_support( 'admin-bar', array( 'callback' => 'my_admin_bar_css') );
function my_admin_bar_css()
{
?>
<style type="text/css" media="screen">	
	html body { margin-top: 28px !important; }
</style>
<?php
}

/**
 * Enqueue scripts and styles.
 */
function pstk_scripts() {

	wp_enqueue_style( 'pstk-style', get_template_directory_uri() . '/dist/css/style.css', array(), '1.40');
	wp_enqueue_script( 'pstk-app', get_template_directory_uri() . '/dist/js/main.js', array(), '1.40', true );

	if (is_page_template('registration-page-template.php') || is_page_template('user-account-page-template.php')) {
		wp_enqueue_script( 'pstk-user-profile', get_template_directory_uri() . '/dist/js/user-profile.js', array(), '1.40', true );
	}

	if (is_page_template('user-account-page-template.php') && is_user_logged_in()) {
		wp_enqueue_script('jquery');
		wp_register_script('ajax_forms', get_template_directory_uri() . '/dist/js/ajax-forms.js', array('jquery'), '1.40', true );

		wp_localize_script('ajax_forms', 'ajax_forms_params', 
			array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'initial_percent_value_of_account_fill_completness' => get_percent_value_of_account_fill_completness(),
			)
		);
	
		wp_enqueue_script('ajax_forms');
	}

	if (is_singular( 'translator' )) {
		wp_enqueue_script( 'swipers', get_template_directory_uri() . '/dist/js/swipers.js', array(), '', true );
		wp_enqueue_script( 'players', get_template_directory_uri() . '/dist/js/players.js', array(), '', true );
		wp_enqueue_script( 'pdf-generator', get_template_directory_uri() . '/dist/js/pdf-generator.js', array(), '', true );
	}

	if (is_page_template('management-page-template.php')) {
		wp_enqueue_script( 'tabs', get_template_directory_uri() . '/dist/js/tabs.js', array(), '', true );
	}

	if (is_page_template('contact-page-template.php')) {
		wp_enqueue_script( 'contact-page', get_template_directory_uri() . '/dist/js/contact-page.js', array(), '', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'pstk_scripts' );

add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

function add_type_attribute($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ( 'ajax_forms' !== $handle ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

// function wpb_add_google_fonts() {
// 	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700;900&display=swap', false );
// }
// add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );


// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

add_filter( 'scriptlesssocialsharing_locations', 'prefix_change_sss_locations' );
function prefix_change_sss_locations( $locations ) {
	$locations['before'] = array(
		'hook'     => 'generate_after_entry_header',
		'filter'   => false,
		'priority' => 8,
	);
	if ( wp_is_mobile() ) {
		$locations['before'] = array(
			'hook'     => 'generate_after_content',
			'filter'   => false,
			'priority' => 8,
		);
	}

	return $locations;
}

add_action( 'set_logged_in_cookie', 'my_update_cookie' );
function my_update_cookie( $logged_in_cookie ){
    $_COOKIE[LOGGED_IN_COOKIE] = $logged_in_cookie;
}

// remove admin bar for all users except administrators
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	show_admin_bar(false);
	}
}

// remove prefix at archive pages
add_filter('get_the_archive_title_prefix','__return_false');

//For hiding Custom Post Types from google search results

function inject_custom_metadata() {

	global $post;
	
	if ( is_singular( 'membership_package' ) || is_singular( 'secret_posts' ) || is_singular('marketing_support') ) {
	
	?>
	
	<meta name="robots" content="noindex, nofollow" />
	
	<?php
	
	}
}
add_action( 'wp_head', 'inject_custom_metadata' );

function posts_only_for_logged_in( $content ) {
    global $post;

	if (!$post) {
		return;
	}

	$is_approved = get_post_meta($post->ID, 'is_approved', true);

    if ( $post && ($post->post_type == 'membership_package' || $post->post_type == 'secret_posts' || $post->post_type == 'marketing_support') ) {

        if ( !is_user_logged_in() || !$is_approved) {
            $content = 'Prosimy o zalogowanie się aby zobaczyć treść posta.';
        }
    }

    return $content;
}

add_filter( 'the_content', 'posts_only_for_logged_in' );

function redirect_login_page() {
	$login_page  = get_permalink(18);
	$page_viewed = basename($_SERVER['REQUEST_URI']);
   
	if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
	  wp_redirect($login_page);
	  exit;
	}
}

add_action('init','redirect_login_page');

function redirect_users_after_login() {
	if(!current_user_can( 'manage_options' )){
		$url  = get_permalink(18);
		// wp_redirect($login_page);
		return $url ."";
		die; // You have to die here
	}

    if ( current_user_can( 'manage_options' ) ) {
		$url = esc_url( admin_url( 'edit.php' ) );
		return $url;
		die;
    }

}

add_filter('login_redirect', 'redirect_users_after_login');


function login_failed() {
	$login_page  = get_permalink(18);
	wp_safe_redirect( $login_page . '?login=failed' );
	exit;
}

add_action( 'wp_login_failed', 'login_failed' );
   
function verify_username_password( $user, $username, $password ) {
	$login_page  = get_permalink(18);
		if( $username == "" || $password == "" ) {
			wp_redirect( $login_page . "?login=empty" );
			exit;
		}
}

add_filter( 'authenticate', 'verify_username_password', 1, 3);

function logout_page() {
	$login_page  = get_permalink(18);
	wp_redirect( $login_page . "?login=logged-out" );
	exit;
}

add_action('wp_logout','logout_page');

/**
 * Block wp-admin access for non-admins
 */
function block_wp_admin() {
	$login_page  = get_permalink(18);
	if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_safe_redirect( $login_page );
		exit;
	}
}

add_action( 'admin_init', 'block_wp_admin' );


add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	
	// loop
	foreach( $items as &$item ) {
		// $item->title .= '<span>'. $item->classes . '</span>';
		// vars
		$menu_thumbnail_image = get_field('menu_item_image', $item);
		
				// append bg image
		if( $menu_thumbnail_image ) {
					// $item->title .= '<span>'. $item->classes . '</span>';
			$item->title .= '<img class="menu-thumbnail-image" src="'.$menu_thumbnail_image['url'].'" loading="lazy" />';

			// var_dump($item->title);
		
		}
	}
	// return
	return $items;
}

//Exclude pages from WordPress Search
// if (!is_admin()) {
// 	function wpb_search_filter($query) {
// 	if ($query->is_search) {
// 	$query->set('post_type', 'post');
// 	}
// 	return $query;
// 	}
// 	add_filter('pre_get_posts','wpb_search_filter');
// }


//Search Filter PRO

add_filter('wp_title','search_form_title');

function search_form_title($title){
 
 	global $searchandfilter;
 
	if ( $searchandfilter->active_sfid() == 35889) {
		return 'Search Results';
	} else {
		return $title;
	}
 
}


// function distance($lat1, $lon1, $lat2, $lon2, $unit) {
// 	if (($lat1 == $lat2) && ($lon1 == $lon2)) {
// 	  return 0;
// 	}
// 	else {
// 	  $theta = $lon1 - $lon2;
// 	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
// 	  $dist = acos($dist);
// 	  $dist = rad2deg($dist);
// 	  $miles = $dist * 60 * 1.1515;
// 	  $unit = strtoupper($unit);
  
// 	  if ($unit == "K") {
// 		return ($miles * 1.609344);
// 	  } else if ($unit == "N") {
// 		return ($miles * 0.8684);
// 	  } else {
// 		return $miles;
// 	  }
// 	}
// }

function geo_distance($lat1, $lon1, $lat2, $lon2, $unit) {
	if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	  return 0;
	}
	else {
	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);
  
	  if ($unit == "K") {
		return ($miles * 1.609344);
	  } else if ($unit == "N") {
		return ($miles * 0.8684);
	  } else {
		return $miles;
	  }
	}
}

function calculate_distance_from_each_location_to_target_location($array_of_location_objects, $target_location_name) {

	/* Get geolocation of the city user was looking for */
	$apiKey = 'AIzaSyAPJ8o7xD9vqydfgZ6XrJKvLdnhmL_YTxA'; // Google maps now requires an API key.

	$ch_geo_target_location = curl_init();

	$options_geo_target_location = [
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_URL            => 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($target_location_name).'&sensor=false&key='.$apiKey
	];

	curl_setopt_array($ch_geo_target_location, $options_geo_target_location);

	$data_curl_geo_target_location = json_decode(curl_exec($ch_geo_target_location));
	curl_close($ch_geo_target_location);

	$geo_target_location = $data_curl_geo_target_location;

	$geo_target_location = json_decode(json_encode($geo_target_location), true); // Convert the JSON to an array

	// var_dump(json_encode($geo_target_location['results'][0]['geometry']['location']['lat']));
	// var_dump(json_encode($geo_target_location['results'][0]['geometry']['location']['lng']));

	if (!isset($geo_target_location['status']) || ($geo_target_location['status'] != 'OK')) {
		echo '<p class="text--error mb--6">Wystąpił błąd podczas próby uzyskania danych geolokalizacyjnych szukanego miasta, prosimy spróbować ponownie za parę minut.</p>';
		return;
	}

	if (isset($geo_target_location['status']) && ($geo_target_location['status'] == 'OK')) {
		$target_city_latitude = $geo_target_location['results'][0]['geometry']['location']['lat']; // Latitude
		$target_city_longitude = $geo_target_location['results'][0]['geometry']['location']['lng']; // Longitude
	} 


	$locations_objects_arr = array();
	$errors_arr = array();

	foreach( $array_of_location_objects as $localization ) :

		$location_name = $localization->name; // Address

		$ch_geo_translator_city = curl_init();

		$options_geo_translator_city = [
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_URL            => 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($location_name).'&sensor=false&key='.$apiKey
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

			$distance_from_target = geo_distance($target_city_latitude, $target_city_longitude, $translator_city_latitude, $translator_city_longitude, "K");

			//   echo '<p>'.$translator_city_latitude.'</p>';
			//   echo '<p>'.$translator_city_longitude.'</p>';
			//   echo $distance_from_target . " Kilometers<br>";

			$city_object = (object)[];

			$city_object->city_name = $localization->name;
			$city_object->distance_from_target = round($distance_from_target, 0);

			array_push($locations_objects_arr, $city_object);
		} 
		elseif (isset($geo_translator_city['status']) && ($geo_translator_city['status'] != 'OK')) {
			array_push($errors_arr, $geo_translator_city['status']);

		}

	endforeach;

	usort($locations_objects_arr, function($first,$second){
		return $first->distance_from_target > $second->distance_from_target;
	});
	
	$result_object = (object) [
		'locations_objects_arr' => $locations_objects_arr,
		'errors_arr' => $errors_arr,
	];

	return $result_object;
}

/* ADDITIONAL DASHBOARD FUNCTIONALITIES */

// display ACF fiels on the post listing

function add_admin_column($column_title, $post_type, $cb){

    // Column Header
    add_filter( 'manage_' . $post_type . '_posts_columns', function($columns) use ($column_title) {
        $columns[ sanitize_title($column_title) ] = $column_title;
        return $columns;
    } );

    // Column Content
    add_action( 'manage_' . $post_type . '_posts_custom_column' , function( $column, $post_id ) use ($column_title, $cb) {

        if(sanitize_title($column_title) === $column){
            $cb($post_id);
        }

    }, 10, 2 );
}

add_admin_column(__('Name'), 'translator', function($post_id){

	$translator_first_name = get_post_meta( $post_id , 'translator_first_name' , true );
	$translator_last_name = get_post_meta( $post_id , 'translator_last_name' , true );

    echo $translator_first_name.' '.$translator_last_name; 
});


add_filter('acf/fields/post_object/result', 'my_acf_fields_post_object_result', 10, 4);
function my_acf_fields_post_object_result( $text, $post, $field, $post_id ) {
	
	$translator_first_name = get_field('translator_first_name', $post->ID );
	$translator_last_name = get_field('translator_last_name', $post->ID );

	if ($translator_first_name && $translator_last_name) {
		$text = $translator_first_name.' '.$translator_last_name;
	}

    return $text;
}


/* HELPER FUNCTIONS */	

function get_page_url($template_name)
{
	$pages = get_posts([
        'post_type' => 'page',
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_wp_page_template',
                'value' => $template_name.'.php',
                'compare' => '='
            ]
        ]
    ]);
    if(!empty($pages))
    {
      foreach($pages as $pages__value)
      {
          return get_permalink($pages__value->ID);
      }
    }
    return get_bloginfo('url');
}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

function list_of_child_pages() { 
 
	global $post; 
	 
	if ( is_page() && $post->post_parent )
	 
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	else
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	 
	if ( $childpages ) {
	 
		$string = '<ul class="child-pages-list">' . $childpages . '</ul>';

		return $string;

	} else {

		return;

	}
}


/* https://support.advancedcustomfields.com/forums/topic/fix-for-displaying-fields-according-to-field-order-using-get_field_objects/ */

function array_sort($array, $on, $order=SORT_ASC){
	$new_array = array();
	$sortable_array = array();

	if (count($array) > 0) {
		foreach ($array as $k => $v) {
			if (is_array($v)) {
				foreach ($v as $k2 => $v2) {
					if ($k2 == $on) {
						$sortable_array[$k] = $v2;
					}
				}
			} else {
				$sortable_array[$k] = $v;
			}
		}

		switch ($order) {
			case SORT_ASC:
				asort($sortable_array);
			break;
			case SORT_DESC:
				arsort($sortable_array);
			break;
		}

		foreach ($sortable_array as $k => $v) {
			$new_array[$k] = $array[$k];
		}
	}

	return $new_array;
}


function add_field_if_post_approved( $post_id, $post ) {

	if (get_post_status($post_id) == "publish") {

		$is_approved = get_post_meta($post_id, 'is_approved', true);
		if( !$is_approved ) {
			add_post_meta( $post_id, 'is_approved', 'yes' );

			$to = $post->translator_contact_email;
			$subject = 'PSTK - Twój profil został opublikowany';
			$body = 'Twój profil został opublikowany i można go teraz znaleźć za pośrednictwem naszej wyszukiwarki.';
			$headers = array('Content-Type: text/html; charset=UTF-8','From: PSTK <pstk@pstktest.pl>');
			
			wp_mail( $to, $subject, $body, $headers );
		}
	}
}

add_action('save_post', 'add_field_if_post_approved', 10, 2);


function update_post_title_and_slug( $post_id, $new_title ) {
	// if new_title isn't defined, return
	if ( empty ( $new_title ) ) {
		return;
	}

	$current_title = get_the_title($post_id);

	// ensure title case of $new_title
	$new_title = mb_convert_case( $new_title, MB_CASE_TITLE, "UTF-8" );
  
	// if $new_title is defined, but it matches the current title, return
	if ( $current_title === $new_title ) {
		return;
	}

	$new_slug = sanitize_title($new_title);
  
	// place the current post and $new_title into array
	$post_update = array(
	  'ID'         => $post_id,
	  'post_title' => $new_title,
	  'post_name' => $new_slug,
	);
  
	wp_update_post( $post_update );
  }


// TODO: Send email when post is added to the term translator-of-the-month


///////////////////////// MENUS ////////////////////////////

add_filter( 'wp_nav_menu_objects', 'wpdocs_add_menu_parent_class', 11, 3 );

function wpdocs_add_menu_parent_class( $items ) {
    $parents = array();

    // Collect menu items with parents.
    foreach ( $items as $item ) {
        if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
            $parents[] = $item->menu_item_parent;
        }
    }

    // Add class.
    foreach ( $items as $item ) {
        if ( in_array( $item->ID, $parents ) ) {
            $item->classes[] = 'menu-parent-link'; //here attach the class
			// $item->title .= ' <span class="expand-menu-toggle"></span>';
        }
    }

    return $items;
}

function prefix_add_button_after_menu_item_children( $item_output, $item, $depth, $args ) {

	if ( in_array( 'menu-item-has-children', $item->classes ) || in_array( 'page_item_has_children', $item->classes ) ) {
		$item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><span class="show-submenu" aria-expanded="false" aria-pressed="false"></span>', $item_output );
	}

return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_add_button_after_menu_item_children', 10, 4 );


class Has_Child_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
        $element->has_children = ! empty( $children_elements[ $element->{$this->db_fields['id']} ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}


/////////////////////////////////// FORMS ////////////////////////////////////////////////////

// user registration login form
function vicode_registration_form() {
 
	// only show the registration form to non-logged-in members
	if(!is_user_logged_in()) {
 
		// check if registration is enabled
		$registration_enabled = get_option('users_can_register');
 
		// if enabled
		if($registration_enabled) {
			$output = vicode_registration_fields();
		} else {
			$output = __('User registration is not enabled');
		}
		return $output;
	}
}
add_shortcode('register_form', 'vicode_registration_form');

// registration form fields
function vicode_registration_fields() {

	ob_start(); ?>	

		<div class="login-branding">
			<div class="login-logo">
				<img height="auto" width="50" src="<?php echo get_site_icon_url() ?>" />
			</div>
		</div>
<!-- 
		<h3 class="vicode_header"><?php _e('Zarejestruj się'); ?></h3> -->
		
		<?php 
		// show any error messages after form submission
		// vicode_error_messages();
		?>
		
		<form id="vicode_registration_form" class="vicode_form" action="" method="POST">
				<p class="animated-label-holder">
					<label for="vicode_user_Login"><?php _e('Username'); ?></label>
					<input name="vicode_user_login" id="vicode_user_login" class="vicode_user_login" type="text" required/>
				</p>
				<p class="animated-label-holder">
					<label for="vicode_user_email"><?php _e('Email'); ?></label>
					<input name="vicode_user_email" id="vicode_user_email" class="vicode_user_email" type="email" required/>
				</p>
				<p class="animated-label-holder">
					<label for="vicode_user_first"><?php _e('Imię'); ?></label>
					<input name="vicode_user_first" id="vicode_user_first" type="text" class="vicode_user_first" required />
				</p>
				<p class="animated-label-holder">
					<label for="vicode_user_last"><?php _e('Nazwisko'); ?></label>
					<input name="vicode_user_last" id="vicode_user_last" type="text" class="vicode_user_last" required/>
				</p>
				<p class="animated-label-holder">
					<label for="password"><?php _e('Hasło'); ?></label>
					<input name="vicode_user_pass" id="password" class="password" type="password" required/>
				</p>
				<p class="animated-label-holder">
					<label for="password_again"><?php _e('Powtórz hasło'); ?></label>
					<input name="vicode_user_pass_confirm" id="password_again" class="password_again" type="password" required/>
				</p>
				<p>
					<input type="hidden" name="vicode_csrf" value="<?php echo wp_create_nonce('vicode-csrf'); ?>"/>
					<input type="submit" name="register_new_account" class="button button__filled--blue"  value="<?php _e('Załóż konto'); ?>"/>
				</p>
		</form>
	<?php
	return ob_get_clean();
}

// Registers a new user
function vicode_add_new_user() {
	
		if (isset( $_POST["vicode_user_login"] ) && wp_verify_nonce($_POST['vicode_csrf'], 'vicode-csrf')) {
		$user_login		= $_POST["vicode_user_login"];	
		$user_email		= $_POST["vicode_user_email"];
		$user_first 	    = $_POST["vicode_user_first"];
		$user_last	 	= $_POST["vicode_user_last"];
		$user_pass		= $_POST["vicode_user_pass"];
		$pass_confirm 	= $_POST["vicode_user_pass_confirm"];
		
		// this is required for username checks
		require_once(ABSPATH . WPINC . '/registration.php');

		$errors = array();
		// Check for errors

		if(username_exists($user_login)) {
			// Username already registered
			// $errors[] = 'Ta nazwa użytkownika jest już zajęta, proszę wybrać inną nazwę';
			vicode_errors()->add('username_unavailable', __('Ta nazwa użytkownika jest już zajęta, proszę wybrać inną nazwę'));
		}

		if(!validate_username($user_login)) {
			// invalid username
			// $errors[] = 'Nieprawidłowa nazwa użytkownika';
			vicode_errors()->add('username_invalid', __('Nieprawidłowa nazwa użytkownika'));
		}

		if($user_login == '') {
			// empty username
			// $errors[] = 'Prosimy o podanie nazwy użytkownika';
			vicode_errors()->add('username_empty', __('Prosimy o podanie nazwy użytkownika'));
		}

		if(!is_email($user_email)) {
			//invalid email
			// $errors[] = 'Niepoprawny format adresu e-mail';
			vicode_errors()->add('email_invalid', __('Niepoprawny format adresu e-mail'));
		}

		if(email_exists($user_email)) {
			//Email address already registered
			$errors[] = 'Istnieje już konto z podanym adresem e-mail.';
			vicode_errors()->add('email_used', __('Istnieje już konto z podanym adresem e-mail.'));
		}

		if($user_first == '') {
		// empty username
		// $errors[] = 'Pole z imieniem jest wymagane';
		vicode_errors()->add('username_empty', __('Pole z imieniem jest wymagane'));
		}

		if($user_last == '') {
		// empty username
		// $errors[] = 'Pole z nazwiskiem jest wymagane';
		vicode_errors()->add('username_empty', __('Pole z nazwiskiem jest wymagane'));
		}
		
		if($user_pass == '') {
			// empty password
			// $errors[] = 'Pole z hasłem jest wymagane';
			vicode_errors()->add('password_empty', __('Pole z hasłem jest wymagane'));
		}

		if($user_pass != $pass_confirm) {
			// passwords do not match
			// $errors[] = 'Podane hasła różnią się od siebie';
			vicode_errors()->add('password_mismatch', __('Podane hasła różnią się od siebie'));
		}

		// if (strlen($user_pass) < 8) {
		// 	$errors[] = 'Hasło powinno zawierać conajmniej 8 znaków';
		// 	vicode_errors()->add('username_empty', __('Hasło powinno zawierać conajmniej 8 znaków'));
		// }

		// if (!preg_match("/[A-Z]/", $user_pass)) {
		// 	$errors[] = "Hasło powinno zawierać conajmniej jedną wielką literę";
		// 	vicode_errors()->add('username_empty', __('Hasło powinno zawierać conajmniej jedną wielką literę'));
		// }

		// if (!preg_match("/\W/", $user_pass)) {
		// 	$errors[] = "Hasło powinno zawierać conajmniej jeden znak specjalny";
		// 	vicode_errors()->add('username_empty', __('Hasło powinno zawierać conajmniej jeden znak specjalny'));
		// }

		// if (preg_match("/\s/", $user_pass)) {
		// 	$errors[] = "Hasło nie może zawierać spacji";
		// 	vicode_errors()->add('username_empty', __('Hasło nie może zawierać spacji'));
		// }
      
      $errors = vicode_errors()->get_error_messages();

	//   if (!empty($errors)) {
	// 	add_query_arg( 'registration', 'error');
	//   }
      
      // if no errors then create user
      if(empty($errors)) {
          
          $new_user_id = wp_insert_user(array(
                  'user_login'		=> $user_login,
                  'user_pass'	 		=> $user_pass,
                  'user_email'		=> $user_email,
                  'first_name'		=> $user_first,
                  'last_name'			=> $user_last,
                  'user_registered'	=> date('Y-m-d H:i:s'),
                  'role'				=> 'subscriber',
				  'show_admin_bar_front' => 'false',
              )
          );

          if($new_user_id) {
              // send an email to the admin
              wp_new_user_notification($new_user_id);
              
              // log the new user in
              wp_setcookie($user_login, $user_pass, true);
              wp_set_current_user($new_user_id, $user_login);	
              do_action('wp_login', $user_login);


              // send the newly created user to the home page after logging them in
            	//   wp_redirect(home_url()); exit;
          }
          
      }
  }
}
add_action('init', 'vicode_add_new_user');

/* Creates custom post every time new user registers */

function create_post_for_user( $user_id ) {
    // Get user info
    $user_info = get_userdata( $user_id );
    $user_roles = $user_info->roles;

    $this_user_role = implode(', ', $user_roles );

    if ($this_user_role == 'subscriber') {

        // Create a new post
        $user_post = array(
            'post_title'   => $user_info->first_name.' '.$user_info->last_name,
            'post_status'  => 'private', 
            'post_type'    => 'translator', 
        );

        // Insert the post into the database
        $user_post_id = wp_insert_post( $user_post );

		// Add custom meta data to be able to easily find post by users_id;

		add_post_meta( $user_post_id, 'user_id', $user_id, true );

		// Save values from register form as ACFs in post

		$user_first_name = $user_info->first_name;
		$user_last_name = $user_info->last_name;

		update_field( "translator_first_name", $user_first_name, $user_post_id );
		update_field( "translator_last_name", $user_last_name, $user_post_id );
		update_field( "translator_contact_email", $user_info->user_email, $user_post_id );
		// update_field( "translator_id", $user_id, $user_post_id );

		$to = $user_info->user_email;
		$subject = 'Potwierdzenie założenia konta';
		$body = 'Dziękujemy za utworzenie profilu.';
		$headers = array('Content-Type: text/html; charset=UTF-8','From: PSTK <pstk@pstktest.pl>');
		
		wp_mail( $to, $subject, $body, $headers );
    }
}
add_action( 'user_register', 'create_post_for_user', 10, 1 );

// used for tracking error messages
function vicode_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function vicode_error_messages() {
	$cross_error = file_get_contents(get_template_directory() . "/dist/dist/svg/cross_error.svg");
	if($codes = vicode_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = vicode_errors()->get_error_message($code);
		        // echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
				echo '<p class="php-error__text flex show-in-modal fw--500">
				<span class="svg-holder">'.$cross_error.'</span>
				'.$message.'
			  </p>';
		    }
		echo '</div>';
	} else {
		return false;
	}
}

// Tool functions for forms at account page

function get_current_user_post_id() {

	$current_user_id = get_current_user_id();

	$args = array(
		'post_type' => 'translator',
		'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
		'meta_query' => array(
			array(
				'key' => 'user_id',
				'value' => $current_user_id
			)
		)
	 );

	 $my_posts = get_posts( $args ); // fetch post and store in array

	if (!$my_posts) {
		return;
	} 
	
	if ($my_posts) {
		$current_user_post = $my_posts[0];

		$current_user_post_id = $current_user_post->ID;

		return $current_user_post_id;
	}
}

function get_count_of_all_valueable_fields() {

	if (!get_current_user_post_id()) {
		return;
	}

	$count_of_all_valueable_fields = 0;

	$non_acf_valueable_fields = ['profile-picture', 'languages-taxonomy', 'specializations-taxonomy', 'localizations-taxonomy'];

	if ($non_acf_valueable_fields) {
		foreach($non_acf_valueable_fields as $field) :
			$count_of_all_valueable_fields++;
		endforeach;
	}

	$groups = acf_get_field_groups(array('post_id' => get_current_user_post_id()));

	// print_r(json_encode(acf_get_fields($groups[0]['key'])));

	if ($groups) {
		$all_acf_fields_of_post = acf_get_fields($groups[0]['key']);
	}

	if ($all_acf_fields_of_post && is_array($all_acf_fields_of_post) && count($all_acf_fields_of_post) > 0 ) {
		$all_acf_fields_of_post_sorted = array_sort($all_acf_fields_of_post, 'menu_order', SORT_ASC);

		foreach($all_acf_fields_of_post_sorted as $acf_field) {

			$field_object_name = $acf_field['name'];

			//Dont include privacy settings
			if (str_contains($field_object_name, 'public') || !$acf_field) {
				continue;
			} else {
				$count_of_all_valueable_fields++;
			}
		}
	}

	return $count_of_all_valueable_fields;
}

function get_count_of_all_filled_fields() {

	if (!get_current_user_post_id()) {
		return;
	}

	$count_of_all_filled_fields = 0;
	$all_acf_fields_of_post = get_field_objects(get_current_user_post_id());

	if ( is_array($all_acf_fields_of_post) && count($all_acf_fields_of_post) > 0 ) {
		$all_acf_fields_of_post_sorted = array_sort($all_acf_fields_of_post, 'menu_order', SORT_ASC);

		foreach($all_acf_fields_of_post_sorted as $acf_field) {

			$field_object_name = $acf_field['name'];

			// echo $field_object_name.'<br>';

			$is_null = $acf_field["value"] == null;
			$is_string = gettype($acf_field["value"]) == 'string';
			$is_array = gettype($acf_field["value"]) == 'array';
			$is_boolean = gettype($acf_field["value"]) == 'boolean';

			// Dont include privacy settings
			if (str_contains($field_object_name, 'public') || !$acf_field) {
				continue;
			}

			if ( $is_array ) {

				// echo $field_object_name;
			
				if (count($acf_field["value"]) > 0) {
					$count_of_all_filled_fields++;
				} 
			};

			if ( $is_string ) {

				// echo $field_object_name;
			
				// echo $field_object_content["label"];
				
				// echo strlen($field_object_content["value"]);

				if (strlen($acf_field["value"]) > 0) {
					$count_of_all_filled_fields++;
				} 
			}
		}
	}

	// For non acf fields

	$is_profile_picture_added = has_post_thumbnail(get_current_user_post_id());

	if ($is_profile_picture_added) {
		$count_of_all_filled_fields++;
	}
	
	$is_language_added = has_term( '', 'translator_language', get_current_user_post_id() );

	if ($is_language_added) {
		$count_of_all_filled_fields++;
	}

	$is_specialization_added = has_term( '', 'translator_specialization', get_current_user_post_id() );

	if ($is_specialization_added) {
		$count_of_all_filled_fields++;
	}

	$is_localization_added = has_term( '', 'translator_localization', get_current_user_post_id() );

	if ($is_localization_added) {
		$count_of_all_filled_fields++;
	}

	return $count_of_all_filled_fields;
}

function get_percent_value_of_account_fill_completness() {

	if (!get_current_user_post_id()) {
		return;
	}

	$percent_value_of_account_fill_completness = 0;
	
	$count_of_all_valueable_fields = get_count_of_all_valueable_fields();
	$count_of_all_filled_fields = get_count_of_all_filled_fields();

	$percent_value_of_single_field = 100 / $count_of_all_valueable_fields;
	$percent_value_of_account_fill_completness = round($count_of_all_filled_fields / $count_of_all_valueable_fields * 100);

	return $percent_value_of_account_fill_completness;
}


function get_labels_of_empty_translator_fields() {

	if (!get_current_user_post_id()) {
		return;
	}

	$groups = acf_get_field_groups(array('post_id' => get_current_user_post_id()));
	// $all_user_acf_field_objects = acf_get_fields($groups[0]['key']);

	// $all_user_acf_field_objects = get_field_objects(get_current_user_post_id());
	$empty_field_labels = [];

	foreach( $groups as $group_key => $group ) {
		$fields = acf_get_fields($group);

		if( $fields ) {
			foreach( $fields as $field_name => $field ){

				//Dont include privacy settings
				if (str_contains($field["name"], 'public')) {
					continue;
				}

				// echo json_encode($field['label'], get_current_user_post_id());
				// echo json_encode(get_field($field['name'], get_current_user_post_id()));
				// echo '<br />';

				if (!get_field($field['name'], get_current_user_post_id())) {
					array_push($empty_field_labels, $field['label']);
				}

			}
		}
	}

	// For non acf fields

	$is_profile_picture_added = has_post_thumbnail(get_current_user_post_id());

	if (!$is_profile_picture_added) {
		array_push($empty_field_labels, "Zdjęcie profilowe");
	}

	$is_language_added = has_term( '', 'translator_language', get_current_user_post_id() );

	if (!$is_language_added) {
		array_push($empty_field_labels, "Języki");
	}

	$is_specialization_added = has_term( '', 'translator_specialization', get_current_user_post_id() );

	if (!$is_specialization_added) {
		array_push($empty_field_labels, "Specjalizacje");
	}

	$is_localization_added = has_term( '', 'translator_localization', get_current_user_post_id() );

	if (!$is_localization_added) {
		array_push($empty_field_labels, "Lokalizacje");
	}

	return $empty_field_labels;
}


/* ADD BASIC USER DATA FORM */
function basic_user_data_form() {

	$current_user = wp_get_current_user();
	$user_post_id = get_current_user_post_id();
	$current_user_languages_array_terms = wp_get_post_terms($user_post_id, 'translator_language', array('fields' => 'names'));
	$current_user_specializations_array_terms = wp_get_post_terms($user_post_id, 'translator_specialization', array('fields' => 'names'));

	// var_dump($current_user_languages_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		basic_user_data_form_messages(); ?>
		
		<form name="basic_user_data_form" id="basic_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<div class="info-box__subbox mb--3">
					<p>
						<label class="info-box__subbox-header mb--05" for="user_first_name"><?php _e('Imię'); ?></label>
						<input name="user_first_name" id="user_first_name" class="user_first_name" type="text" value="<?php echo $current_user->first_name ?>"/>
					</p>
				</div>


				<div class="info-box__subbox mb--3">
					<p>
						<label class="info-box__subbox-header mb--05" for="user_last_name"><?php _e('Nazwisko'); ?></label>
						<input name="user_last_name" id="user_last_name" class="user_last_name" type="text" value="<?php echo $current_user->last_name ?>"/>
					</p>
				</div>

				<div class="info-box__subbox mb--3">
					<p>
						<label class="info-box__subbox-header mb--05" for="user_about_short"><?php _e('Jedno zdanie o mnie'); ?></label>
						<textarea form="basic_user_data_form" name="user_about_short" id="user_about_short" class="user_about_short" type="text" maxlength="300"><?php echo get_field("translator_about_short", $user_post_id) ?></textarea>
						<label class="characters-counter" for="user_about">0/300</label>
					</p>
				</div>

				<div class="info-box__subbox mb--3">
					<p>

						<?php
						$translator_languages_taxonomy = get_taxonomy( 'translator_language' );
						?>

						<label class="info-box__subbox-header mb--05" for="user_languages"><?php echo $translator_languages_taxonomy->label ?></label>

						<?php
						
							$translator_languages = get_terms( array(
								'taxonomy' => 'translator_language',
								'hide_empty' => false,
							) );


							if ( $translator_languages ) {

								foreach( $translator_languages as $term ) :

									echo '<div class="info-box__checkbox-wrapper">';

									echo '<label class="mb--05 lowercase">';

										?>
										<input name="user_languages[]" class="user_languages" type="checkbox" value="<?php echo $term->name ?>"

										<?php
										
										if ($current_user_languages_array_terms && in_array($term->name, $current_user_languages_array_terms)) { echo "checked"; } ?>/>

										<?php

										echo $term->name;

									echo '</label>';

									echo '</div>';
		
								endforeach;

							}

						?>
					</p>
				</div>

				<div class="info-box__subbox mb--3">
				<p>

					<?php
						$translator_specializations_taxonomy = get_taxonomy( 'translator_specialization' );
					?>

					<label class="info-box__subbox-header mb--05" for="user_specializations"><?php echo $translator_specializations_taxonomy->label ?></label>

					<?php
					
						$translator_specializations = get_terms( array(
							'taxonomy' => 'translator_specialization',
							'hide_empty' => false,
						) );

						if ( $translator_specializations ) {

							foreach( $translator_specializations as $term ) :

								echo '<div class="info-box__checkbox-wrapper">';

								echo '<label class="mb--05">';
								
									?>
									<input name="user_specializations[]" class="user_specializations" type="checkbox" value="<?php echo $term->name ?>"
									<?php
									 if ($current_user_specializations_array_terms && in_array($term->name, $current_user_specializations_array_terms)) { echo "checked"; } ?>/>
									<?php

								echo $term->name;

								echo '</label>';

								echo '</div>';
	
							endforeach;

						};
						
					?>
				</p>
				</div>

				<!-- <p class="status"></p> -->

				<div class="info-box__subbox">
					<p>

						<input class="button button__filled--blue" type="submit" name="submit_basic_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
						<?php wp_nonce_field( "add_basic_user_data", "add_basic_user_data_nonce" ); ?>
					</p>
				</div>

			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}



// used for tracking error messages
function basic_user_data_form_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}


// displays error messages from form submissions
function basic_user_data_form_messages() {
	if($codes = basic_user_data_form_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = basic_user_data_form_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}

//Ajaxify basic user data form https://support.advancedcustomfields.com/forums/topic/use-update_field-with-ajax/


function add_basic_user_data_with_ajax() {
	
	$current_user = wp_get_current_user();
	
	$user_id = get_current_user_id();

	//Get ID of the current user post

	$user_post_id = get_current_user_post_id();

	$error_array = array();

	if ( ! wp_verify_nonce( $_POST["add_basic_user_data_nonce"], "add_basic_user_data") ) {
		// array_push($error_array, "Nonce mismatched!");
		die ( 'Nonce mismatched!');
	}

		// Save/Update values to user meta data or user post

		$user_first_name		= $_POST["user_first_name"];
		$user_last_name		= $_POST["user_last_name"];
		$user_about_short		= $_POST["user_about_short"];	
		$user_languages_array		= $_POST["user_languages"];
		$user_specializations_array		= $_POST["user_specializations"];

		if (isset( $user_first_name )) {

			//Update User meta data
			update_user_meta( $user_id, 'first_name', $user_first_name);
			//Update ACF field for user post
			update_field( "translator_first_name", $user_first_name, $user_post_id );

		}

		if (isset( $user_last_name )) {
	
			//Update User meta data
			update_user_meta( $user_id, 'last_name', $user_last_name);
			//Update ACF field for user post
			update_field( "translator_last_name", $user_last_name, $user_post_id );
		}

		if (isset( $user_first_name ) || isset( $user_last_name )) {
			// Update post title and slug

			$new_title = $user_first_name.' '.$user_last_name;

			update_post_title_and_slug( $user_post_id, $new_title );
		}

		if (isset( $user_about_short )) {
			
			//Update User meta data
			update_user_meta( $user_id, 'description', $user_about_short);
			//Update ACF field for user post
			update_field( "translator_about_short", $user_about_short, $user_post_id );
		}

		if ( isset( $user_languages_array )) {
			
			//clears previous values
			wp_set_post_terms( $user_post_id, null, 'translator_language' );

			//sets updated values
			wp_set_post_terms( $user_post_id, $user_languages_array, 'translator_language' );

		}

		// if all user_languages checkboxes are marked as false and the form is submitted

		if ( !isset( $user_languages_array ) && isset( $user_first_name ) ) {
			
			$user_languages_array = 0;

			//clears previous values
			wp_set_post_terms( $user_post_id, null, 'translator_language' );

			//sets updated values
			wp_set_post_terms( $user_post_id, $user_languages_array, 'translator_language' );

		}

		if ( isset( $user_specializations_array )) {
			
			//clears previous values
			wp_set_post_terms( $user_post_id, null, 'translator_specialization' );

			//sets updated values
			wp_set_post_terms( $user_post_id, $user_specializations_array, 'translator_specialization' );

		}

		// if all user__specialization checkboxes are marked as false and the form is submitted

		if ( !isset( $user_specializations_array ) && isset( $user_first_name ) ) {
	
			$user_languages_array = 0;

			//clears previous values
			wp_set_post_terms( $user_post_id, null, 'translator_specialization' );

			//sets updated values
			wp_set_post_terms( $user_post_id, $user_languages_array, 'translator_specialization' );

		}

		$_POST['errors'] = $error_array;

		$basic_user_data_object_for_ajax  = (object) [
			'post_data' => $_POST,
			'percent_value_of_account_fill_completness' => get_percent_value_of_account_fill_completness(),
			'labels_of_empty_translator_fields' => get_labels_of_empty_translator_fields(),
			'console_log' => []
		];

		print_r(json_encode($basic_user_data_object_for_ajax));

    die();

}

add_action( 'wp_ajax_nopriv_add_basic_user_data_with_ajax',  'add_basic_user_data_with_ajax' );
add_action( 'wp_ajax_add_basic_user_data_with_ajax','add_basic_user_data_with_ajax' );


/* ADD ABOUT USER DATA FORM */
function about_user_data_form() {

	$current_user = wp_get_current_user();

	//Get ID of the current user post
	$user_post_id = get_current_user_post_id();

	// var_dump($current_user_languages_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		about_user_data_form_messages(); ?>

		<p class="mb--2">Napisz o sobie kilka zdań, które pozwolą potencjalnym klientom poznać Cię z najlepszej strony, zrozumieć, w czym masz doświadczenie i co Cię wyróżnia.</p>
		
		<form name="about_user_data_form" id="about_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<p class="mb--2">
					<textarea form="about_user_data_form" name="user_about" id="user_about" class="user_about mb--1" type="text" maxlength="300"><?php echo get_field("translator_about", $user_post_id) ?></textarea>
					<label class="characters-counter" for="user_about">0/300</label>
				</p>

				<p>
					<input class="button button__filled--blue" type="submit" name="submit_about_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
					<?php wp_nonce_field( 'add_about_user_data', 'add_about_user_data_nonce' ); ?>
				</p>

			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

// used for tracking error messages
function about_user_data_form_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}


// displays error messages from form submissions
function about_user_data_form_messages() {
	if($codes = about_user_data_form_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = about_user_data_form_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}

//Ajaxify about user data form https://support.advancedcustomfields.com/forums/topic/use-update_field-with-ajax/


function add_about_user_data_with_ajax() {

	//Get ID of the current user post
	$user_post_id = get_current_user_post_id();

	$user_about		= $_POST["user_about"];

	if ( ! wp_verify_nonce( $_POST["add_about_user_data_nonce"], "add_about_user_data") ) {
		die ( 'Nonce mismatched!');
	}

	//Update ACF field for user post
	update_field( "translator_about", $user_about, $user_post_id );

	$about_user_data_object_for_ajax  = (object) [
		'post_data' => $_POST,
		'percent_value_of_account_fill_completness' => get_percent_value_of_account_fill_completness(),
		'labels_of_empty_translator_fields' => get_labels_of_empty_translator_fields(),
		'console_log' => []
	];

	print_r(json_encode($about_user_data_object_for_ajax));
		
    die();

}

add_action( 'wp_ajax_nopriv_add_about_user_data_with_ajax',  'add_about_user_data_with_ajax' );
add_action( 'wp_ajax_add_about_user_data_with_ajax','add_about_user_data_with_ajax' );


/* ADD CONTACT USER DATA FORM */

function contact_user_data_form() {

	$current_user = wp_get_current_user();

	//Get ID of the current user post
	$user_post_id = get_current_user_post_id();

	$current_user_localizations_array_terms = wp_get_post_terms($user_post_id, 'translator_localization', array('fields' => 'names'));

	$translator_contact_phone = get_field("translator_contact_phone", $user_post_id);

	$translator_contact_email = get_field("translator_contact_email", $user_post_id);

	$translator_city = get_field("translator_city", $user_post_id);

	// var_dump($current_user_localizations_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		contact_user_data_form_messages(); ?>
		
		<form name="contact_user_data_form" id="contact_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<div class="info-box__subbox mb--3">
					<p>
						<label class="info-box__subbox-header mb--05" for="user_contact_phone"><?php _e('Numer telefonu'); ?></label>
						<input name="user_contact_phone" id="user_contact_phone" class="user_contact_phone" type="text" value="<?php echo $translator_contact_phone ?>"/>
					</p>
				</div>

				<div class="info-box__subbox mb--3">
					<p>
						<label class="info-box__subbox-header mb--05" for="user_contact_email"><?php _e('Adres e-mail'); ?></label>
						<input name="user_contact_email" id="user_contact_email" class="user_contact_email" type="text" value="<?php echo $translator_contact_email ?>"/>
					</p>
				</div>

					<?php
						$translator_specializations_taxonomy = get_taxonomy( 'translator_localization' );
					?>

					<label class="info-box__subbox-header mb--05" for="user_localizations"><?php echo $translator_specializations_taxonomy->label ?></label>

					<div class="info-box__subbox mb--3">

						<div class="wrapper-flex-drow-mcol">

							<p class="wrapper-flex-drow-mcol__first-element">Miejsce zamieszkania:</p>

							<input name="user_city" id="user_city" class="user_city_input" placeholder="Nazwa miasta" type="text" value="<?php echo $translator_city ?>"/>

							<input hidden name="user_localizations[]" id="user_localization_city" class="user_localization_input" placeholder="Nazwa miasta" type="text" value=""/>

						</div>

					</div>

					<div class="info-box__subbox mb--3">

						<div class="wrapper-flex-drow-mcol">

							<p class="wrapper-flex-drow-mcol__first-element">Inne lokalizacje:</p>

							<div>

							<?php

								if (get_field("translator_city") && strlen(get_field("translator_city")) > 0) {
									$excluded_term = get_term_by( 'name', get_field("translator_city"), 'translator_localization' );
									$excluded_term_ID = $excluded_term->term_id;
								} else {
									$excluded_term_ID = false;
								}

								$translator_localizations = get_terms( array(
									'taxonomy' => 'translator_localization',
									'hide_empty' => false,
									'orderby'    => 'ID',
									'exclude' => ($excluded_term_ID),
								) );

								if ( $translator_localizations ) {

									//only 3 first

									foreach( array_slice($translator_localizations, 0, 3) as $term ) :

										echo '<div class="info-box__checkbox-wrapper">';

										echo '<label class="mb--05">';
										
											?>
											<input name="user_localizations[]" class="user_localization_input" type="checkbox" value="<?php echo $term->name ?>"
											<?php
											if ($current_user_localizations_array_terms && in_array($term->name, $current_user_localizations_array_terms)) { echo "checked"; } ?>/>
											<?php

										echo $term->name;

										echo '</label>';

										echo '</div>';
			
									endforeach;


									//only custom ones added by this user
									//dont include 3 first ones

									foreach( array_slice($translator_localizations, 3) as $term ) :

										if ($current_user_localizations_array_terms && in_array($term->name, $current_user_localizations_array_terms)) {

											echo '<div class="info-box__checkbox-wrapper">';

											echo '<label class="mb--05">';
											
												?>
												<input name="user_localizations[]" class="user_localizations" type="checkbox" value="<?php echo $term->name ?>" checked/>
												<?php
			
											echo $term->name;
			
											echo '</label>';
			
											echo '</div>';

										}

									endforeach;

									?>

											<div class="repeater__holder">

												<div class="repeater__field-wrapper">

													<div class="repeater__field info-box__checkbox-wrapper" data-repeater-id="0">

														<input name="user_localizations[]" id="user_localizations" class="user_localizations user_localizations__repeater" placeholder="Nazwa lokalizacji" type="text" value="" />

														<!-- <button class="repeater__button repeater__button--delete">-</button> -->

													</div>

												</div>

												<button class="button repeater__button button__outline--blue repeater__button--add w--full">Dodaj nową lokalizację</button>

											</div>

									<?php

								};
								
							?>

							</div>

						</div>

					</div>

				<div class="info-box__subbox">

					<p>
						<input class="button w--full button__filled--blue" type="submit" name="submit_contact_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
						<?php wp_nonce_field( 'add_contact_user_data', 'add_contact_user_data_nonce' ); ?>
					</p>

				</div>

			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

// Save Basic user data form information
// function add_about_user_data() {

// 	$current_user = wp_get_current_user();
	
// 	$current_user_nickname = $current_user->user_login;

// 	if ( ! wp_verify_nonce( $_POST["add_about_user_data_nonce"], "add_about_user_data") ) {
// 		die ( 'Nonce mismatched!');
// 	}

// 		user_localizations = $_POST["user_about"];

// 		$user_id = get_current_user_id();

// 		//Get ID of the current user post
// 		$user_post_title = $current_user_nickname; 

// 		if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
// 			$user_post_id = $post->ID;
// 		else
// 			$user_post_id = 0;

// 		// Save/Update values to user meta data or user post

//         //Update ACF field for user post
//         update_field( "translator_about", user_localizations, $user_post_id );
		
//   	die();
// }
// add_action('init', 'add_about_user_data');


// used for tracking error messages
function contact_user_data_form_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}


// displays error messages from form submissions
function contact_user_data_form_messages() {
	if($codes = contact_user_data_form_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = contact_user_data_form_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}

//Ajaxify about user data form https://support.advancedcustomfields.com/forums/topic/use-update_field-with-ajax/

function add_contact_user_data_with_ajax() {

	//Get ID of the current user post
	$user_post_id = get_current_user_post_id();

	$user_contact_phone = $_POST["user_contact_phone"];
	$user_contact_email = $_POST["user_contact_email"];
	$user_city = $_POST["user_city"];
    $user_localizations		= $_POST["user_localizations"];

	if ( ! wp_verify_nonce( $_POST["add_contact_user_data_nonce"], "add_contact_user_data") ) {
		die ( 'Nonce mismatched!');
	}

	// Save/Update values to user meta data or user post

	if ( isset( $user_contact_phone )) {
		//Update ACF field for user post
		update_field( "translator_contact_phone", $user_contact_phone, $user_post_id );
	}

	if ( isset( $user_contact_email )) {
		//Update ACF field for user post
		update_field( "translator_contact_email", $user_contact_email, $user_post_id );
	}

	if ( isset( $user_city )) {
		//Update ACF field for user post
		update_field( "translator_city", $user_city, $user_post_id );
	}

	if ( isset( $user_localizations )) {
		
		//clears previous values
		wp_set_post_terms( $user_post_id, null, 'translator_localization' );

		//sets updated values
		wp_set_post_terms( $user_post_id, $user_localizations, 'translator_localization' );

	}

		// if all user__specialization checkboxes are marked as false and the form is submitted

		// if ( !isset( $user_localizations ) ) {
	
		// 	$user_languages_array = 0;

		// 	//clears previous values
		// 	wp_set_post_terms( $user_post_id, null, 'translator_specialization' );

		// 	//sets updated values
		// 	wp_set_post_terms( $user_post_id, $user_languages_array, 'translator_specialization' );

		// }

	$contact_user_data_object_for_ajax  = (object) [
		'post_data' => $_POST,
		'percent_value_of_account_fill_completness' => get_percent_value_of_account_fill_completness(),
		'labels_of_empty_translator_fields' => get_labels_of_empty_translator_fields(),
		'console_log' => []
	];

	print_r(json_encode($contact_user_data_object_for_ajax));
		
    die();

}

add_action( 'wp_ajax_nopriv_add_contact_user_data_with_ajax',  'add_contact_user_data_with_ajax' );
add_action( 'wp_ajax_add_contact_user_data_with_ajax','add_contact_user_data_with_ajax' );

//Ajaxify about user data form https://support.advancedcustomfields.com/forums/topic/use-update_field-with-ajax/

/* ADD LINKEDIN USER DATA FORM */
function linkedin_user_data_form() {

	$user_post_id = get_current_user_post_id();

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		linkedin_user_data_form_messages(); ?>
		
		<form name="linkedin_user_data_form" id="linkedin_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<p class="mb--2">
					<input name="user_linkedin" id="user_linkedin" class="user_linkedin" type="text" value="<?php echo get_field("translator_linkedin_link", $user_post_id) ?>" placeholder="Adres do profilu Linkedin"></textarea>
				</p>

				<p>
					<input class="button button__filled--blue" type="submit" name="submit_linkedin_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
					<?php wp_nonce_field( 'add_linkedin_user_data', 'add_linkedin_user_data_nonce' ); ?>
				</p>

			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

// used for tracking error messages
function linkedin_user_data_form_errors(){
	static $wp_error; // global variable handle
	return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}


// displays error messages from form submissions
function linkedin_user_data_form_messages() {
	if($codes = linkedin_user_data_form_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
			// Loop error codes and display errors
			foreach($codes as $code){
				$message = linkedin_user_data_form_errors()->get_error_message($code);
				echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
			}
		echo '</div>';
	}	
}

//Ajaxify linkedin user data form https://support.advancedcustomfields.com/forums/topic/use-update_field-with-ajax/


function add_linkedin_user_data_with_ajax() {

	$user_linkedin = $_POST["user_linkedin"];

	if ( ! wp_verify_nonce( $_POST["add_linkedin_user_data_nonce"], "add_linkedin_user_data") ) {
		die ( 'Nonce mismatched!');
	}

	$user_post_id = get_current_user_post_id();

	// Save/Update values to user meta data or user post

	//Update ACF field for user post
	update_field( "translator_linkedin_link", $user_linkedin, $user_post_id );

	$linkedin_user_data_for_ajax  = (object) [
		'user_linkedin' => $user_linkedin,
		'percent_value_of_account_fill_completness' => get_percent_value_of_account_fill_completness(),
		'labels_of_empty_translator_fields' => get_labels_of_empty_translator_fields(),
		'console_log' => []
	];

	print_r(json_encode($linkedin_user_data_for_ajax));
		
	die();

}

add_action( 'wp_ajax_nopriv_add_linkedin_user_data_with_ajax',  'add_linkedin_user_data_with_ajax' );
add_action( 'wp_ajax_add_linkedin_user_data_with_ajax','add_linkedin_user_data_with_ajax' );


/* ADD WORK USER DATA FORM */
function work_user_data_form() {

	$current_user = wp_get_current_user();

	$user_post_id = get_current_user_post_id();

		// var_dump($current_user_languages_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		work_user_data_form_messages(); ?>

		<p class="mb--2">Napisz kilka zdań o tym gdzie najczęściej pracujesz</p>
		
		<form name="work_user_data_form" id="work_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<p class="mb--2">
					<textarea form="work_user_data_form" name="user_work" id="user_work" class="user_work" type="text" maxlength="250"><?php echo get_field("translator_work", $user_post_id) ?></textarea>
					<label class="characters-counter">0/250</label>
				</p>

				<p>
					<input class="button button__filled--blue" type="submit" name="submit_work_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
					<?php wp_nonce_field( 'add_work_user_data', 'add_work_user_data_nonce' ); ?>
				</p>

			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

// used for tracking error messages
function work_user_data_form_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}


// displays error messages from form submissions
function work_user_data_form_messages() {
	if($codes = work_user_data_form_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = work_user_data_form_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}

//Ajaxify work user data form https://support.advancedcustomfields.com/forums/topic/use-update_field-with-ajax/

function add_work_user_data_with_ajax() {

	if ( ! isset( $_POST["user_work"] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST["add_work_user_data_nonce"], "add_work_user_data") ) {
		die ( 'Nonce mismatched!');
	}

	$user_work = $_POST["user_work"];

	$user_post_id = get_current_user_post_id();

	//Update ACF field for user post
	update_field( "translator_work", $user_work, $user_post_id );


	$work_user_data_for_ajax  = (object) [
		'user_work' => $user_work,
		'percent_value_of_account_fill_completness' => get_percent_value_of_account_fill_completness(),
		'labels_of_empty_translator_fields' => get_labels_of_empty_translator_fields(),
		'console_log' => []
	];

	print_r(json_encode($work_user_data_for_ajax));
		
    die();

}

// add_action( 'init',  'add_work_user_data_with_ajax' );

add_action( 'wp_ajax_nopriv_add_work_user_data_with_ajax',  'add_work_user_data_with_ajax' );
add_action( 'wp_ajax_add_work_user_data_with_ajax','add_work_user_data_with_ajax' );


/* https://rudrastyh.com/wordpress/how-to-add-images-to-media-library-from-uploaded-files-programmatically.html */

// add_shortcode( 'profile_picture_uploader', 'profile_picture_uploader_callback' );

function profile_picture_uploader($user_post_id) {

	ob_start(); 

		// show any error messages after form submission
		profile_picture_uploader_form_messages();
		?>

	<form id="upload_profile_picture_form" method="post" enctype="multipart/form-data">

				<!-- <a class="remove-item remove" data-id="clear-profile-picture" href="#"></a> -->

					<label class="file-input__label relative">

							<div class="input-preview__wrapper">
								<img class="input-preview" style="">
							</div>

							<input type="file" id="profile-picture__input" name="profile-picture__input" class="custom-file-input input-preview__src" accept=".png,.jpg,.jpeg" required />

							<div class="my-ajax-loader">
								<div class="my-ajax-loader__spinner"></div>
							</div>
					</label>



				<input type="hidden" name="post_id" value="<?php echo $user_post_id ?>"><br>
				<input class="button button__filled--blue" type="submit" class="submit_profile_picture" name="submit_profile_picture" value="Zaktualizuj zdjęcie" />
				<?php wp_nonce_field( "handle_profile_picture_upload", "profile_picture_nonce" ); ?>
	</form>

	<?php
	return ob_get_clean();
}

// used for tracking error messages
function profile_picture_uploader_form_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}


// displays error messages from form submissions
function profile_picture_uploader_form_messages() {
	if($codes = basic_user_data_form_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = profile_picture_uploader_form_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}


/**
 * Handles the file upload request.
 */
function handle_profile_picture_upload() {

	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['profile_picture_nonce'], 'handle_profile_picture_upload' ) ) {
		wp_die( esc_html__( 'Nonce mismatched', 'theme-text-domain' ) );
	}

	// Throws a message if no file is selected
	if ( ! $_FILES['profile-picture__input']['name'] ) {
		wp_die( esc_html__( 'Please choose a file', 'theme-text-domain' ) );
	}

	// Get post_id
	$post_id = $_POST['post_id'];


	$finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['profile-picture__input']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
        ),
        true
    )) {
		echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">Nieprawidłowy format pliku</div></div>';
		throw new Exception('Exception message');
        throw new RuntimeException('Invalid file format.');
		die();
    }

	$file_size = $_FILES['profile-picture__input']['size'];
	$allowed_file_size = 3145728; // Here we are setting the file size limit to 3MB

	// Check for file size limit
	if ( $file_size >= $allowed_file_size ) {
		echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">'.sprintf( esc_html__( 'Zbyt duży rozmiar pliku, proszę wybrać plik o maksymalnym rozmiarze %d MB', 'theme-text-domain' ), round($allowed_file_size / 1000000) ).'</div></div>';
		throw new Exception('Exception message');
		throw new RuntimeException('File size is too big.');
		die();
		;
	}

	// upload.

	$attachment_id = media_handle_upload( 'profile-picture__input', $post_id );

	set_post_thumbnail( $post_id, $attachment_id );

	if ( is_wp_error( $attachment_id ) ) {
		// There was an error uploading the image.
		wp_die( $attachment_id->get_error_message() );
	}

	$profile_picture_data_for_ajax  = (object) [
		'percent_value_of_account_fill_completness' => get_percent_value_of_account_fill_completness(),
		'labels_of_empty_translator_fields' => get_labels_of_empty_translator_fields(),
		'console_log' => []
	];

	print_r(json_encode($profile_picture_data_for_ajax));

	die();
}

/**
 * Hook the function that handles the file upload request.
 */
// add_action( 'init', 'handle_profile_picture_upload' );

add_action( 'wp_ajax_nopriv_handle_profile_picture_upload',  'handle_profile_picture_upload' );
add_action( 'wp_ajax_handle_profile_picture_upload','handle_profile_picture_upload' );


function gallery_sound_uploader($user_post_id) {

	ob_start(); 



	// show any error messages after form submission
	// gallery_sound_uploader_form_messages();
	?>

	<form name="upload_sound_to_gallery_form" id="upload_sound_to_gallery_form" method="POST" enctype="multipart/form-data">

			<div class="form-content-wrapper">

				<div class="repeater__holder">

					<div class="repeater__field-wrapper">

						<div class="repeater__field mb--2 pb--2" data-repeater-id="0">

							<fieldset>

								<p class="info-box__subbox-header mb--2 pr--2">Wpisz tekst i dodaj nagranie</p>

								<div class="row-wrapper wrapper-flex-drow-mcol">

									<div class="wrapper-flex-col-start col-m100-d50">

										<p class="mb--2">
											<input name="sound-label__input[]" id="sound-label__input" class="input-text input-preview__src" type="text" value="" placeholder="Tytuł nagrania"/>
										</p>

										<p class="mb--2">
											<textarea form="upload_sound_to_gallery_form" name="sound-textarea__input[]" id="sound-textarea__input" class="input-textarea input-preview__src" type="text" maxlength="200" placeholder="Tekst"></textarea>
											<label class="characters-counter">0/200</label>
										</p>

									</div>

									<div class="col-m100-d50">

										<label class="file-input__label button button--upload-file content-center">
											Wybierz plik
											<input type="file" name="sound-to-gallery__input[]" id="sound-to-gallery__input" class="custom-file-input input-preview__src" accept=".mp3,.wav,.m4a"/>
										</label>

										<div class="new-attachment__wrapper my-sounds__gallery-row-wrapper ">

											<div id="newSoundInGalleryPlaceholder" class="new-attachment__placeholder" style="display:none;" width=""></div>

										</div>

									</div>

								</div>

							</fieldset>

						</div>

					</div>

					<button class="button repeater__button button__outline--blue repeater__button--add w--full">Dodaj próbkę głosu</button>

				</div>

				<input type="hidden" name="post_id" value="<?php echo $user_post_id ?>"><br>

				<input type="hidden" name="sounds_to_delete" id="sounds_to_delete" value=""/>

				<div class="info-box__subbox">
					<p>
						<input type="submit" class="button button__filled--blue" name="submit_sound_to_gallery" value="Zaktualizuj galerię" />
					</p>
				</div>

				<?php wp_nonce_field( "handle_sound_to_gallery_upload", "sound_to_gallery_nonce" ); ?>

				<div class="progress">
					<div class="progress-bar"></div>
					<div class="progress-percents"></div>
				</div>

			</div>
	</form>

	<?php
	return ob_get_clean();
}


/**
* Handles the sound file upload request.
*/
function handle_sound_to_gallery_upload() {

	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['sound_to_gallery_nonce'], 'handle_sound_to_gallery_upload' ) ) {
		wp_die( esc_html__( 'Nonce mismatched', 'theme-text-domain' ) );
	}

	$post_id = $_POST['post_id'];

	$sounds_object_for_ajax  = (object) [
		'added_files_ids' => [],
		'added_rows' => [],
		'deleted_rows' => [],
		'console_log' => [],
	];

	// Handle file and text inputs
	
	$all_sound_label_inputs = $_POST["sound-label__input"];

	$all_sound_textarea__inputs = $_POST["sound-textarea__input"];

	$all_file_names = $_FILES["sound-to-gallery__input"]["name"];

	$array_of_objects = array();

	$index = 0;

	foreach($all_file_names as $file_name) :

		$single_file_obj = new stdClass();

		foreach($_FILES['sound-to-gallery__input'] as $key => $value) :

			$single_file_obj->$key = $value[$index];

			$single_file_obj->label = $all_sound_label_inputs[$index];

			$single_file_obj->textarea = $all_sound_textarea__inputs[$index];

		endforeach;

		// var_dump($single_file_obj);

		//ignore empty ones

		if ($single_file_obj->name || $single_file_obj->label || $single_file_obj->textarea ) {

			array_push($array_of_objects, $single_file_obj);
		}

		$index++;

	endforeach;

	// var_dump($array_of_objects);

	//validation

	if ( count($array_of_objects) > 0 ) {

		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');

		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$allowed_file_size = 10145728; // Here we are setting the file size limit to 3MB

		foreach($array_of_objects as $file_object) :

			if ($file_object->name) {

				//VALIDATION

				//Check for file size limit
				$file_size = $file_object->size;

				if ( $file_size >= $allowed_file_size ) {
					echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">'.sprintf( esc_html__( 'Zbyt duży rozmiar pliku, proszę wybrać plik o maksymalnym rozmiarze %d MB', 'theme-text-domain' ), round($allowed_file_size / 1000000) ).'</div></div>';
					throw new Exception('Exception message');
					throw new RuntimeException('Invalid file format.');
					die();
				}

				//Check mime type
				$file_tmp_name = $file_object->tmp_name;

				if (false === $ext = array_search(
					$finfo->file($file_tmp_name),
					array(
						'mp3' => 'audio/mpeg',
						'wav' => 'audio/wav',
						'm4a' => 'audio/m4a',
					),
					true
				)) {
					echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">Nieprawidłowy format pliku</div></div>';
					throw new Exception('Exception message');
					throw new RuntimeException('Invalid file format.');
					die();
				}

			} else {
				// var_dump('no file');
			}

		endforeach;
	}

		//if there are some files to delete
	
		$post_id = $_POST['post_id'];

		$sounds_gallery_array = get_field("translator_sound_gallery", $post_id);
	
		if ($_POST["sounds_to_delete"]) {
	
			$sounds_to_delete_array = explode(',', $_POST["sounds_to_delete"]);

			sort($sounds_to_delete_array);

			$number_of_deleted_rows = 0;

			foreach ($sounds_to_delete_array as $sound_to_delete) :
	
				array_push($sounds_object_for_ajax->deleted_rows, $sound_to_delete);

				// in acf way, row #1 has index 1, not 0
				$index_of_row_to_delete = $sound_to_delete - $number_of_deleted_rows;

				delete_row('translator_sound_gallery', $index_of_row_to_delete, $post_id);

				// -1 because acf rows count starts at index 1 and array from 0

				$url = $sounds_gallery_array[$index_of_row_to_delete - 1]["translator_single_voice_recording"];
				$deleted_file_id = attachment_url_to_postid($url);
				// $path = parse_url($url, PHP_URL_PATH);
				// $fullPath = get_home_path() . $path;
	
				// // wp_delete_file($fullPath);
				// // unlink($fullPath);
				wp_delete_attachment($deleted_file_id);

				$number_of_deleted_rows++;
	
			endforeach;
	
		}


	//if file has been attached

	if ( count($array_of_objects) > 0 ) {

		foreach ($array_of_objects as $file_object) :

			//transforming object to nested array needed for wp_handle_upload to be possible
			$uploadedfile = json_decode(json_encode($file_object), true);

			if ($uploadedfile["name"]) {

				$upload_overrides = array( 'test_form' => false );
				$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		
				if ( $movefile ) {
					  $video_url = $movefile["url"];
					  $upload_dir = wp_upload_dir();
					  $image_data = file_get_contents($video_url);
					  $filename = basename($video_url);
					  if(wp_mkdir_p($upload_dir['path']))
						  $file = $upload_dir['path'] . '/' . $filename;
					  else
						  $file = $upload_dir['basedir'] . '/' . $filename;
					  file_put_contents($file, $image_data);
		
					  $wp_filetype = wp_check_filetype($filename, null );
		
					  $attachment = array(
						  'post_mime_type' => $wp_filetype['type'],
						  'post_title' => sanitize_file_name($filename),
						  'post_content' => '',
						  'post_status' => 'inherit'
					  );
		
					  $listing_post_id = $post_id ; //your post id to which you want to attach the video
					  $attach_id = wp_insert_attachment( $attachment, $file, $listing_post_id);
		
						//   $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
						//   wp_update_attachment_metadata( $attach_id, $attach_data );
		
						//   print_r($attach_id);
						array_push($sounds_object_for_ajax->added_files_ids, $attach_id);
		
						$row = array(
							'translator_single_voice_recording' => $attach_id,
							'translator_single_voice_recording_label' => $uploadedfile["label"],
							'translator_single_voice_recording_text' => $uploadedfile["textarea"],
						);
		
						add_row('translator_sound_gallery', $row, $post_id);

						$count = count(get_field('translator_sound_gallery', $post_id));

						array_push($sounds_object_for_ajax->added_rows, $count);
		
					  /*end file uploader*/
				} 

			} else {

				$row = array(
					'translator_single_voice_recording_label' => $uploadedfile["label"],
					'translator_single_voice_recording_text' => $uploadedfile["textarea"],
				);

				add_row('translator_sound_gallery', $row, $post_id);

				$count = count(get_field('translator_sound_gallery', $post_id));

				array_push($sounds_object_for_ajax->added_rows, $count);
			}

		endforeach;
	}

	$sounds_object_for_ajax->percent_value_of_account_fill_completness = get_percent_value_of_account_fill_completness();
	$sounds_object_for_ajax->labels_of_empty_translator_fields = get_labels_of_empty_translator_fields();

	print_r(json_encode($sounds_object_for_ajax ));

	die();

}

/**
* Hook the function that handles the file upload request.
*/
// add_action( 'init', 'handle_sound_to_gallery_upload' );

add_action( 'wp_ajax_nopriv_handle_sound_to_gallery_upload',  'handle_sound_to_gallery_upload' );
add_action( 'wp_ajax_handle_sound_to_gallery_upload','handle_sound_to_gallery_upload' );


function gallery_image_uploader($user_post_id) {

	ob_start(); 

	// show any error messages after form submission
	gallery_image_uploader_form_messages();

	$stylesheet_directory_uri = get_stylesheet_directory_uri();

	?>

	<form id="upload_image_to_gallery_form" method="POST" enctype="multipart/form-data">

		<div class="form-content-wrapper">

			<div class="repeater__holder">

				<div class="repeater__field-wrapper">

					<div class="repeater__field pb--2 mb--2" data-repeater-id="0">

						<div class="row-wrapper my-pictures__gallery-row-wrapper">

							<label class="file-input__label button button--upload-file content-center">
								Wybierz plik
								<input type="file" name="image-to-gallery__input[]" id="image-to-gallery__input" class="custom-file-input input-preview__src" accept=".png,.jpg,.jpeg" />
							</label>

							<div class="new-attachment__wrapper" >

								<img id="newImageInGalleryPlaceholder" class="new-attachment__placeholder" style="display:none;" src="" width=""/>

								<a class="remove-item remove" data-id="clear-input" href="#"></a>

							</div>

						
						</div>

					</div>

					<!-- <button class="repeater__button repeater__button--delete">-</button> -->

				</div>

				<button class="button button__outline--blue repeater__button repeater__button--add w--full">Dodaj zdjęcie</button>

			</div>

			<input type="hidden" name="post_id" value="<?php echo $user_post_id ?>"><br>
			<input type="hidden" name="pictures_to_delete" id="pictures_to_delete" value=""/>
			<input type="submit" class="button button__filled--blue w--full" name="submit_image_to_gallery" value="Zaktualizuj galerię" />
			<?php wp_nonce_field( "handle_image_to_gallery_upload", "image_to_gallery_nonce" ); ?>

		</div>

	</form>

	<?php
	return ob_get_clean();
}

// used for tracking error messages
function gallery_image_uploader_form_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}


// displays error messages from form submissions
function gallery_image_uploader_form_messages() {
	if($codes = basic_user_data_form_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = gallery_image_uploader_form_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}

/**
 * Handles the file upload request.
 */
function handle_image_to_gallery_upload() {

	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['image_to_gallery_nonce'], 'handle_image_to_gallery_upload' ) ) {
		wp_die( esc_html__( 'Nonce mismatched', 'theme-text-domain' ) );
	}

	$post_id = $_POST['post_id'];

	$all_file_names_to_upload = $_FILES["image-to-gallery__input"]["name"];

	$image_gallery_object_for_ajax  = (object) [
		'added_files_ids' => [],
		'deleted_files' => [],
		'console_log' => []
	];

	$array_of_objects = array();

	$pictures_to_delete_array = explode(',', $_POST["pictures_to_delete"]);

	// print_r("pictures_to_delete_array:");
	// var_dump($pictures_to_delete_array);

	$images_already_in_gallery_array = get_field('translator_gallery', $post_id);

	$images_to_upload = array();

	// print_r("'already in array':");
	// var_dump($images_already_in_gallery_array);

	foreach ($images_already_in_gallery_array as $image) :

		$image_id = attachment_url_to_postid($image);


		//include only ids that are NOT in the pictures_to_delete_array
		if (!in_array($image_id, $pictures_to_delete_array)) {
			array_push($images_to_upload, $image_id);
		}

		if (in_array($image_id, $pictures_to_delete_array)) {
			array_push($image_gallery_object_for_ajax->deleted_files, $image_id);
			wp_delete_attachment($image_id);
		}

	endforeach;


	$index = 0;

	foreach($all_file_names_to_upload as $file_name) :

		$single_file_obj = new stdClass();

		foreach($_FILES['image-to-gallery__input'] as $key => $value) :

			$single_file_obj->$key = $value[$index];

		endforeach;

		//ignore empty ones

		if ($single_file_obj->name) {
			array_push($array_of_objects, $single_file_obj);
		}

		$index++;

	endforeach;

	//VALIDATION

	if ( count($array_of_objects) > 0 ) {

		$allowed_file_size = 3145728; // Here we are setting the file size limit to 3MB
		$finfo = new finfo(FILEINFO_MIME_TYPE);

		foreach($array_of_objects as $file_object) :

			if ($file_object->name) {

			//Check for file size limit
			$file_size = $file_object->size;
 
			if ( $file_size >= $allowed_file_size ) {
				echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">'.sprintf( esc_html__( 'Zbyt duży rozmiar pliku, proszę wybrać plik o maksymalnym rozmiarze %d MB', 'theme-text-domain' ), round($allowed_file_size / 1000000) ).'</div></div>';
				throw new Exception('Exception message');
				throw new RuntimeException('Invalid file format.');
				die();
				;
			}

			//Check mime type
			$file_tmp_name = $file_object->tmp_name;

			if (false === $ext = array_search(
				$finfo->file($file_tmp_name),
				array(
					'jpg' => 'image/jpeg',
					'png' => 'image/png',
				),
				true
			)) {
				echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">Nieprawidłowy format pliku</div></div>';
				throw new Exception('Exception message');
				throw new RuntimeException('Invalid file format.');
				die();
			}

		}

		endforeach;
	}


	//if file has been attached

	if ( count($array_of_objects) > 0 ) {

		foreach($array_of_objects as $file_object) :

			//transforming object to nested array needed for media_handle_upload to be possible
			$uploadedfile = json_decode(json_encode($file_object), true);

			if ($uploadedfile["name"]) {

				$_FILES = array("upload_file" => $uploadedfile);
				$attachment_id = media_handle_upload("upload_file", 0);

				if (is_wp_error($attachment_id)) {
					// There was an error uploading the image.
					echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">Podczas wysyłania zdjęcia wystąpił błąd, proszę odświeżyć stronę i spróbować ponownie.</div></div>';
					throw new Exception('Exception message');
					throw new RuntimeException('Invalid file format.');
					die();
				} else {
					// The image was uploaded successfully!

					array_push($images_to_upload, $attachment_id);

					array_push($image_gallery_object_for_ajax->added_files_ids, $attachment_id);

				}
			}

		endforeach;

	}

	// print_r("'images to upload':");
	// var_dump($images_to_upload);

	update_field('translator_gallery', $images_to_upload, $post_id);

	$image_gallery_object_for_ajax->percent_value_of_account_fill_completness = get_percent_value_of_account_fill_completness();
	$image_gallery_object_for_ajax->labels_of_empty_translator_fields = get_labels_of_empty_translator_fields();

	// print_r(json_encode($attachment_ids));
	// array_push($image_gallery_object_for_ajax->console_log, $single_file_obj);
	print_r(json_encode( $image_gallery_object_for_ajax ));

	die();
}

/**
 * Hook the function that handles the file upload request.
 */
// add_action( 'init', 'handle_image_to_gallery_upload' );

add_action( 'wp_ajax_nopriv_handle_image_to_gallery_upload',  'handle_image_to_gallery_upload' );
add_action( 'wp_ajax_handle_image_to_gallery_upload','handle_image_to_gallery_upload' );



function gallery_video_uploader($user_post_id) {

	ob_start(); 

	// show any error messages after form submission
	// gallery_video_uploader_form_messages();
	?>

	<form id="upload_video_to_gallery_form" method="POST" enctype="multipart/form-data">

				<label class="file-input__label button button--upload-file content-center">
					Wybierz plik
					<input type="file" name="video-to-gallery__input" id="video-to-gallery__input" class="custom-file-input input-preview__src" accept=".mp4,.mov,.wmv,.mpg" />

				</label>

				<input type="hidden" name="post_id" value="<?php echo $user_post_id ?>"><br>


				<input type="hidden" name="videos_to_delete" id="videos_to_delete" value=""/>

				<input type="submit" class="button button__filled--blue w--full" name="submit_video_to_gallery" value="Zaktualizuj galerię" />
				
				<?php wp_nonce_field( "handle_video_to_gallery_upload", "video_to_gallery_nonce" ); ?>

	</form>

	<?php
	return ob_get_clean();
}



/**
* Handles the file upload request.
*/
function handle_video_to_gallery_upload() {

	// print_r($_FILES);

	// if (!isset( $_POST["submit_video_to_gallery"] )) {
	// 	return;
	// }

	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['video_to_gallery_nonce'], 'handle_video_to_gallery_upload' ) ) {
		wp_die( esc_html__( 'Nonce mismatched', 'theme-text-domain' ) );
	}

	//validation

	if ( $_FILES['video-to-gallery__input']['name'] ) {

		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');

		//validation

		// $_FILES['video-to-gallery__input']['name'] = preg_replace('/\s+/', '-', $_FILES["file"]["name"]);

		$file_size = $_FILES['video-to-gallery__input']['size'];
		$allowed_file_size = 10145728; // Here we are setting the file size limit to 3MB

		// Check for file size limit
		if ( $file_size >= $allowed_file_size ) {
			echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">'.sprintf( esc_html__( 'Zbyt duży rozmiar pliku, proszę wybrać plik o maksymalnym rozmiarze %d MB', 'theme-text-domain' ), round($allowed_file_size / 1000000) ).'</div></div>';
			throw new Exception('Exception message');
			throw new RuntimeException('Invalid file format.');
			die();
		}

		$finfo = new finfo(FILEINFO_MIME_TYPE);
		if (false === $ext = array_search(
			$finfo->file($_FILES['video-to-gallery__input']['tmp_name']),
			array(
				'mp4' => 'video/mp4',
				'mov' => 'video/mov',
				'wmv' => 'video/wmv',
				'mpg' => 'video/mpg',
			),
			true
		)) {
			echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">Nieprawidłowy format pliku</div></div>';
			throw new Exception('Exception message');
			throw new RuntimeException('Invalid file format.');
			die();
		}
	}


	$post_id = $_POST['post_id'];

	$videos_gallery_array = get_field("translator_video_gallery", $post_id);

	$videos_object_for_ajax  = (object) [
		'added_files_ids' => [],
		'added_rows' => [],
		'deleted_rows' => [],
		'console_log' => []
	];

	//if there are some files to delete

	if ($_POST["videos_to_delete"]) {

		$videos_to_delete_array = explode(',', $_POST["videos_to_delete"]);

		// var_dump($videos_to_delete_array);

		foreach ($videos_to_delete_array as $video_to_delete) :

			$deleted_row_index = $video_to_delete;

			array_push($videos_object_for_ajax->deleted_rows, $deleted_row_index);

			//'while' because delete_row returns a boolean based on if it succeeds or not
			while (delete_row('translator_video_gallery', $deleted_row_index, $post_id));

			// -1 because acf rows count starts at 1 and array from 0
			// var_dump($videos_gallery_array[$deleted_row_index - 1]["translator_single_video"]);

			$url = $videos_gallery_array[$deleted_row_index - 1]["translator_single_video"];
			$deleted_file_id = attachment_url_to_postid($url);
			$path = parse_url($url, PHP_URL_PATH);
			$fullPath = get_home_path() . $path;

			// wp_delete_file($fullPath);
			// unlink($fullPath);
			wp_delete_attachment($deleted_file_id);

		endforeach;
	
	}



	//if file has been attached

	if ( $_FILES['video-to-gallery__input']['name'] ) {

		$uploadedfile = $_FILES['video-to-gallery__input'];

		$upload_overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

		if ( $movefile )
		{
			  $video_url = $movefile["url"];
			  $upload_dir = wp_upload_dir();
			  $image_data = file_get_contents($video_url);
			  $filename = basename($video_url);
			  if(wp_mkdir_p($upload_dir['path']))
				  $file = $upload_dir['path'] . '/' . $filename;
			  else
				  $file = $upload_dir['basedir'] . '/' . $filename;
			  file_put_contents($file, $image_data);

			  $wp_filetype = wp_check_filetype($filename, null );

			  $attachment = array(
				  'post_mime_type' => $wp_filetype['type'],
				  'post_title' => sanitize_file_name($filename),
				  'post_content' => '',
				  'post_status' => 'inherit'
			  );

			  $listing_post_id = $post_id ; //your post id to which you want to attach the video
			  $attach_id = wp_insert_attachment( $attachment, $file, $listing_post_id);

				//   $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				//   wp_update_attachment_metadata( $attach_id, $attach_data );

				//   print_r($attach_id);

				$row = array(
					'translator_single_video' => $attach_id,
				);

				add_row('translator_video_gallery', $row, $post_id);

				$count = count(get_field('translator_video_gallery', $post_id));

				array_push($videos_object_for_ajax->added_rows, $count);

				// var_dump($videos_gallery_array);

				// var_dump(count($videos_gallery_array));

			  /*end file uploader*/
		}

	}

	$videos_object_for_ajax->percent_value_of_account_fill_completness = get_percent_value_of_account_fill_completness();
	$videos_object_for_ajax->labels_of_empty_translator_fields = get_labels_of_empty_translator_fields();

	print_r(json_encode($videos_object_for_ajax ));

	die();

}

/**
* Hook the function that handles the file upload request.
*/
// add_action( 'init', 'handle_video_to_gallery_upload' );

add_action( 'wp_ajax_nopriv_handle_video_to_gallery_upload',  'handle_video_to_gallery_upload' );
add_action( 'wp_ajax_handle_video_to_gallery_upload','handle_video_to_gallery_upload' );










/* UPDATE USER'S LOGIN EMAIL FORM */
function settings_user_login_email_form() {

	$current_user = wp_get_current_user();

	$current_user_id = $current_user->id;

	//Get ID of the current user post
	$current_user_login_email = $current_user->user_email;

		// var_dump($current_user_languages_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		// settings_user_data_form_messages(); ?>
		
		<form name="settings_user_login_email_form" id="settings_user_login_email_form" class="vicode_form" action="" method="POST">

			<p class="animated-label-holder mb--2">
				<label>Nowy adres e-mail</label>
				<input name="user_new_login_email" id="user_new_login_email" class="user_new_login_email" type="text" value="<?php echo $current_user_login_email; ?>"/>
			</p>

			<p>
				<input type="submit" name="submit_user_new_login_email" class="button button__filled--blue" value="<?php _e('Zaktualizuj adres email'); ?>"/>
				<?php wp_nonce_field( 'user_new_login_email', 'user_new_login_email_nonce' ); ?>
			</p>
		</form>

	<?php
	return ob_get_clean();
}


function change_settings_user_login_email_with_ajax() {

		$current_user = wp_get_current_user();

		$user_current_login_email = $current_user->user_email;

		if ( ! wp_verify_nonce( $_POST["user_new_login_email_nonce"], "user_new_login_email") ) {
			die ( 'Nonce mismatched!');
		}

		$user_id = get_current_user_id();

		if (isset( $_POST["user_new_login_email"])) {

			$user_new_login_email = $_POST["user_new_login_email"];

			// check if user is really updating the value
			if ($user_current_login_email != $user_new_login_email) {       
				// check if email is free to use
					if (email_exists( $user_new_login_email )){

						echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">'.sprintf( esc_html__( 'Podany adres e-mail jest już zajęty, proszę podać inny adres.', 'theme-text-domain' )).'</div></div>';
						throw new Exception('Exception message');
						throw new RuntimeException('Invalid file format.');
						die();

					}
					
					elseif (!filter_var($user_new_login_email, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE)) {

						echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">'.sprintf( esc_html__( 'Podany adres e-mail ma niepoprawny format.', 'theme-text-domain' )).'</div></div>';
						throw new Exception('Exception message');
						throw new RuntimeException('Invalid file format.');
						die();
					
					} else {
						$args = array(
							'ID'         => $user_id,
							'user_email' => esc_attr( $user_new_login_email ),
						);            
						wp_update_user( $args );

						print_r(json_encode($user_new_login_email));
					}   
			} else {
				echo '<div class="modal-notification php-error__wrapper"><div class="php-error__content">'.sprintf( esc_html__( 'Podany adres e-mail jest już przypisany do tego konta.', 'theme-text-domain' )).'</div></div>';
				throw new Exception('Exception message');
				throw new RuntimeException('Invalid file format.');
				die();
			}
		}  
		
	die();

}

add_action( 'wp_ajax_nopriv_change_settings_user_login_email_with_ajax',  'change_settings_user_login_email_with_ajax' );
add_action( 'wp_ajax_change_settings_user_login_email_with_ajax','change_settings_user_login_email_with_ajax' );



/* UPDATE USER'S PASSWORD FORM */

function settings_user_password_form() {

	$current_user = wp_get_current_user();

	$current_user_id = $current_user->id;

	//Get ID of the current user post
	$current_user_login_email = $current_user->user_email;

		// var_dump($current_user_languages_array_terms);

	ob_start(); ?>



		<form name="settings_user_password_form" id="settings_user_password_form" class="vicode_form" action="" method="POST">

				<p class="animated-label-holder mb--2">
					<label for="current_password">Wprowadź aktualne hasło:</label>
					<input id="current_password" type="password" name="current_password" title="current_password" placeholder="">
				</p>

				<p class="animated-label-holder mb--2">
					<label for="new_password">Nowe hasło:</label>
					<input id="new_password" type="password" name="new_password" title="new_password" placeholder="">
				</p>

				<p class="animated-label-holder mb--3">
					<label for="confirm_new_password">Potwierdź nowe hasło:</label>
					<input id="confirm_new_password" type="password" name="confirm_new_password" title="confirm_new_password" placeholder="">
				</p>
				
				<p>
					<input type="submit" name="submit_user_new_password" class="button button__filled--blue" value="<?php _e('Zmień hasło'); ?>"/>
					<?php wp_nonce_field( 'user_new_password', 'user_new_password_nonce' ); ?>
				</p>

		</form>

	<?php
	return ob_get_clean();
}


function change_settings_user_password() {
// function change_settings_user_password_with_ajax() {

	if (isset( $_POST['submit_user_new_password']) && wp_verify_nonce( $_POST["user_new_password_nonce"], "user_new_password")) {

		$user_id = get_current_user_id();
	
		if (isset( $_POST['current_password'])) {
	
			// print_r($_POST);
	
			$_POST = array_map('stripslashes_deep', $_POST);
			$current_password = sanitize_text_field($_POST['current_password']);
			$new_password = sanitize_text_field($_POST['new_password']);
			$confirm_new_password = sanitize_text_field($_POST['confirm_new_password']);
			$user_id = get_current_user_id();
			$current_user = get_user_by('id', $user_id);
	
			$errors = array();
			// Check for errors
			if (empty($current_password) && empty($new_password) && empty($confirm_new_password) ) {
					$errors[] = 'Wymagane jest wypełnienie wszystkich pól';
			}
			if ($current_user && wp_check_password($current_password, $current_user->data->user_pass, $current_user->ID)){
			//match
			} else {
				$errors[] = 'Podane hasło jest nieprawidłowe';
				vicode_errors()->add('username_empty', __('Podane hasło jest nieprawidłowe'));
			}
			if ($new_password != $confirm_new_password){
				$errors[] = 'Podane hasła różnią się od siebie';
				vicode_errors()->add('username_empty', __('Podane hasła różnią się od siebie'));
			}
			if (strlen($new_password) < 8) {
				$errors[] = 'Hasło powinno zawierać conajmniej 8 znaków';
				vicode_errors()->add('username_empty', __('Hasło powinno zawierać conajmniej 8 znaków'));
			}
	
			if (!preg_match("/[A-Z]/", $new_password)) {
				$errors[] = "Hasło powinno zawierać conajmniej jedną wielką literę";
				vicode_errors()->add('username_empty', __('Hasło powinno zawierać conajmniej jedną wielką literę'));
			}
	
			if (!preg_match("/\W/", $new_password)) {
				$errors[] = "Hasło powinno zawierać conajmniej jeden znak specjalny";
				vicode_errors()->add('username_empty', __('Hasło powinno zawierać conajmniej jeden znak specjalny'));
			}
	
			if (preg_match("/\s/", $new_password)) {
				$errors[] = "Hasło nie może zawierać spacji";
				vicode_errors()->add('username_empty', __('Hasło nie może zawierać spacji'));
			}
	
			if(empty($errors)){
				wp_set_password( $new_password, $current_user->ID );
	
				wp_set_auth_cookie($current_user->ID);
				wp_set_current_user($current_user->ID);
				do_action('wp_login', $current_user->user_login, $current_user);
	
			}
		}

	} else {
		return;
	}

}

add_action( 'init',  'change_settings_user_password' );
// add_action( 'wp_ajax_nopriv_change_settings_user_password_with_ajax',  'change_settings_user_password_with_ajax' );
// add_action( 'wp_ajax_change_settings_user_password_with_ajax','change_settings_user_password_with_ajax' );




/* CHANGE USER'S DATA VISIBILITY FORM */
function settings_user_data_visibility_form() {

	$user_post_id = get_current_user_post_id();
	$user_post_status = get_post_status($user_post_id);

	$translator_contact_phone_status = get_field("translator_contact_phone_public", $user_post_id);
	$translator_contact_email_status = get_field("translator_contact_email_public", $user_post_id);
	$translator_city_public_status = get_field("translator_city_public", $user_post_id);

	ob_start(); ?>	

		
					<form name="settings_user_data_visibility_form" id="settings_user_data_visibility_form" class="vicode_form" action="" method="POST">

                        <ul class="options mb--2">

							<?php

								$is_approved = get_post_meta( $user_post_id, 'is_approved', true );

								if( $is_approved ) {
									?>

									<li>
										<div class="options__position">Mój profil tłumacza</div>

										<div class="options__switch
										<?php if ($user_post_status == "publish") { echo 'options__switch--on'; } ?>
										">
											<label for="switch" >
												<input name="user_settings_visibility_public_profile" type="checkbox" class="switch" <?php if ( $user_post_status == "publish" ) { echo 'checked'; } ?>/>
											</label>

										</div>
									</li>

									<?php

								} else {

									$not_activated_yet_icon = file_get_contents(get_template_directory() . "/dist/dist/svg/not_activated_yet_icon.svg");

									?>
									<li>

										<div class="options__position">Mój profil tłumacza</div>
									
										<div class="options__switch options__to-be-approved
										">

											<label for="switch">

											<?php echo $not_activated_yet_icon ?>

											</label>

										</div>

									</li>

								<?php
								}

							?>



							<li>

								<div class="options__position">Numer telefonu</div>

								<div class="options__switch
								<?php if ($translator_contact_phone_status) { echo 'options__switch--on'; } ?>
								">

									<label for="switch">
										<input name="user_settings_visibility_contact_phone" type="checkbox" class="switch" <?php if ($translator_contact_phone_status) { echo 'checked'; } ?>/>
									</label>

								</div>

							</li>
							
							<li>

								<div class="options__position">Adres e-mail</div>

								<div class="options__switch
								<?php if ($translator_contact_email_status) { echo 'options__switch--on'; } ?>
								">

									<label for="switch">
										<input name="user_settings_visibility_contact_email" type="checkbox" class="switch" <?php if ($translator_contact_email_status) { echo 'checked'; } ?>/>
									</label>

								</div>

							</li>

							<li>

								<div class="options__position">Miejsce zamieszkania</div>

								<div class="options__switch
								<?php if ($translator_city_public_status) { echo 'options__switch--on'; } ?>
								">

									<label for="switch">
										<input name="user_settings_visibility_city" type="checkbox" class="switch" <?php if ($translator_city_public_status) { echo 'checked'; } ?>/>
									</label>

								</div>

							</li>

                        </ul>

						<p>
							<input type="submit" name="submit_settings_user_data_visibility_form" class="mb--3 button button__filled--blue" value="<?php _e('Zaktualizuj widoczność profilu'); ?>"/>
							<?php wp_nonce_field( 'settings_user_data_visibility_form', 'settings_user_data_visibility_form_nonce' ); ?>
						</p>

					</form>

	<?php
	return ob_get_clean();
}

function change_settings_user_data_visibility_with_ajax() {

		if ( ! wp_verify_nonce( $_POST["settings_user_data_visibility_form_nonce"], "settings_user_data_visibility_form") ) {
			die ( 'Nonce mismatched!');
		}
	
		$user_post_id = get_current_user_post_id();

		$user_settings_visibility_public_profile = $_POST["user_settings_visibility_public_profile"];
		$user_settings_visibility_contact_phone = $_POST["user_settings_visibility_contact_phone"];
		$user_settings_visibility_contact_email = $_POST["user_settings_visibility_contact_email"];
		$user_settings_visibility_city = $_POST["user_settings_visibility_city"];

		$user_data_visibility_object_for_ajax = (object) [
			'profile_is_public' => "",
			'console_log' => [],
		];

		if ($user_settings_visibility_public_profile === "on") {
			wp_update_post(array(
				'ID'    =>  $user_post_id,
				'post_status'   =>  'publish',
			));

			$user_data_visibility_object_for_ajax->profile_is_public = true;

		} else {
			wp_update_post(array(
				'ID'    =>  $user_post_id,
				'post_status'   =>  'private',
			));

			$user_data_visibility_object_for_ajax->profile_is_public = false;
		}
		

		if ($user_settings_visibility_contact_phone === "on") {
			update_field( "translator_contact_phone_public", 1, $user_post_id );
		} else {
			update_field( "translator_contact_phone_public", 0, $user_post_id );
		}

		if ($user_settings_visibility_contact_email === "on") {
			update_field( "translator_contact_email_public", 1, $user_post_id );
		} else {
			update_field( "translator_contact_email_public", 0, $user_post_id );
		}

		if ($user_settings_visibility_city === "on") {
			update_field( "translator_city_public", 1, $user_post_id );
		} else {
			update_field( "translator_city_public", 0, $user_post_id );
		}
	
		print_r(json_encode( $user_data_visibility_object_for_ajax ));
		
		die();
	
	}
	
add_action( 'wp_ajax_nopriv_change_settings_user_data_visibility_with_ajax',  'change_settings_user_data_visibility_with_ajax' );
add_action( 'wp_ajax_change_settings_user_data_visibility_with_ajax','change_settings_user_data_visibility_with_ajax' );



function footer_copyright() {
	global $wpdb;
	$first_date = '2021';
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
	$copyright = "&copy; " . $first_date;
	if($first_date != $copyright_dates[0]->lastdate) {
	$copyright .= '-' . $copyright_dates[0]->lastdate;
	}
	$output = $copyright;
	}
	return $output;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Generating dynamic sytles.
 */
require get_template_directory() . '/inc/dynamic-styles.php';
