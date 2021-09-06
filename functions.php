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



/**
 * Enqueue scripts and styles.
 */
function pstk_scripts() {
	wp_enqueue_style( 'pstk-style', get_template_directory_uri() . '/dist/css/style.css' );

	// Include our dynamic styles.
	// $custom_css = pstk_dynamic_styles();
	// wp_add_inline_style( 'pstk-style', $custom_css );

	wp_enqueue_script( 'pstk-app', get_template_directory_uri() . '/dist/js/main.js', array(), '', true );
	wp_enqueue_script( 'multiselect', get_template_directory_uri() . '/dist/js/multiselect.js', array(), '', true );

	if (is_page(18)) {

		wp_enqueue_script('jquery');
		
		wp_enqueue_script( 'pstk-user-profile', get_template_directory_uri() . '/dist/js/user-profile.js', array(), '', true );

		wp_register_script('ajax_forms', get_template_directory_uri() . '/assets/js/ajax-forms.js', array('jquery') ); 

		wp_localize_script('ajax_forms', 'ajax_forms_params', 
			array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'basic_user_data_form' => '#basic_user_data_form',
				'about_user_data_form' => '#about_user_data_form',
				'contact_user_data_form' => '#contact_user_data_form',
				'upload_profile_picture_form' => '#upload_profile_picture_form',
				'linkedin_user_data_form' => '#linkedin_user_data_form',
				'work_user_data_form' => '#work_user_data_form',
				'upload_image_to_gallery_form' => "#upload_image_to_gallery_form",
				'upload_video_to_gallery_form' => "#upload_video_to_gallery_form",
				'settings_user_login_email_form' => "#settings_user_login_email_form",
				'settings_user_password_form' => "#settings_user_password_form",
				'settings_user_data_visibility_form' => "#settings_user_data_visibility_form",
				'upload_sound_to_gallery_form' => "#upload_sound_to_gallery_form",
			)
		);
	
		wp_enqueue_script('ajax_forms');
	}

	if (is_singular( 'translator' )) {
		wp_enqueue_script( 'swipers', get_template_directory_uri() . '/dist/js/swipers.js', array(), '', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'pstk_scripts' );

function wpb_add_google_fonts() {
	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );


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

//For hiding Custom Post Types from google search results

function inject_custom_metadata() {

	global $post;
	
	if ( is_singular( 'membership_package' ) || is_singular( 'secret_posts' ) ) {
	
	?>
	
	<meta name="robots" content="noindex, nofollow" />
	
	<?php
	
	}
	
}
add_action( 'wp_head', 'inject_custom_metadata' );

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
		return $url;
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
	wp_redirect( $login_page . '?login=failed' );
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
	wp_redirect( $login_page . "?login=false" );
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

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
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

//change url of the lost password page
// add_filter( 'lostpassword_url',  'my_lostpassword_url', 10, 0 );
// function my_lostpassword_url() {
//     return site_url('/password-reset/');
// }

// // Information needed for creating the plugin's pages
// $page_definitions = array(
//     'member-login' => array(
//         'title' => __( 'Sign In', 'personalize-login' ),
//         'content' => '[custom-login-form]'
//     ),
//     'member-account' => array(
//         'title' => __( 'Your Account', 'personalize-login' ),
//         'content' => '[account-info]'
//     ),
//     'member-register' => array(
//         'title' => __( 'Register', 'personalize-login' ),
//         'content' => '[custom-register-form]'
//     ),
//     'member-password-lost' => array(
//         'title' => __( 'Forgot Your Password?', 'personalize-login' ),
//         'content' => '[custom-password-lost-form]'
//     ),
//     'member-password-reset' => array(
//         'title' => __( 'Pick a New Password', 'personalize-login' ),
//         'content' => '[custom-password-reset-form]'
//     )
// );

// add_action( 'login_form_lostpassword', array( $this, 'redirect_to_custom_lostpassword' ) );

/**
 * Redirects the user to the custom "Forgot your password?" page instead of
 * wp-login.php?action=lostpassword.
 */
// public function redirect_to_custom_lostpassword() {
//     if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
//         if ( is_user_logged_in() ) {
//             $this->redirect_logged_in_user();
//             exit;
//         }
 
//         wp_redirect( home_url( 'member-password-lost' ) );
//         exit;
//     }
// }

//helper functions

function wpb_list_child_pages() { 
 
	global $post; 
	 
	if ( is_page() && $post->post_parent )
	 
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
	else
		$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
	 
	if ( $childpages ) {
	 
		$string = '<ul class="wpb_page_list">' . $childpages . '</ul>';

		return $string;

	} else {

		return;

	}
	 
}
	 
add_shortcode('wpb_childpages', 'wpb_list_child_pages');

// Mark posts when they are published for the first time (Approved by moderator)

// function add_field_if_post_approved($post_id) {
//     $is_approved = get_post_meta($post_id, 'is_approved', true);
//     if( !$is_approved ) {
// 		add_post_meta( $post_id, 'is_approved', 'yes' );
//     }
// }

// add_action('save_post', 'add_field_if_post_approved', 99);




// function add_custom_field_automatically($post_id) {

// 	global $wpdb;

//     $is_approved = get_post_meta($post_id, 'is_approved', true);
// 	if( $is_approved == '') {
// 		add_post_meta($post_id, 'is_approved', 'yes');
// 	}

// }

// add_action('publish_post', 'add_custom_field_automatically');


// function wpse120996_add_custom_field_automatically($post_id) {
//     global $wpdb;
//     $votes_count = get_post_meta($post_id, 'votes_count', true);
//     if( empty( $votes_count ) && ! wp_is_post_revision( $post_id ) ) {
//         update_post_meta($post_id, 'votes_count', '0');
//     }
// }
// add_action('publish_post', 'wpse120996_add_custom_field_automatically');


function add_field_if_post_approved( $post_id, $post ) {
	//do whatever
	if (get_post_status($post_id) == "publish") {

		$is_approved = get_post_meta($post_id, 'is_approved', true);
		if( !$is_approved ) {
			add_post_meta( $post_id, 'is_approved', 'yes' );
		}
	}
}

add_action('save_post', 'add_field_if_post_approved', 10, 2);

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
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><span class="expand-menu-toggle" aria-expanded="false" aria-pressed="false"></span>', $item_output );
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
		<h3 class="vicode_header"><?php _e('Register New Account'); ?></h3>
		
		<?php 
		// show any error messages after form submission
		vicode_error_messages();
		?>
		
		<form id="vicode_registration_form" class="vicode_form" action="" method="POST">
				<p>
					<label for="vicode_user_Login"><?php _e('Username'); ?></label>
					<input name="vicode_user_login" id="vicode_user_login" class="vicode_user_login" type="text"/>
				</p>
				<p>
					<label for="vicode_user_email"><?php _e('Email'); ?></label>
					<input name="vicode_user_email" id="vicode_user_email" class="vicode_user_email" type="email"/>
				</p>
				<p>
					<label for="vicode_user_first"><?php _e('First Name'); ?></label>
					<input name="vicode_user_first" id="vicode_user_first" type="text" class="vicode_user_first" />
				</p>
				<p>
					<label for="vicode_user_last"><?php _e('Last Name'); ?></label>
					<input name="vicode_user_last" id="vicode_user_last" type="text" class="vicode_user_last"/>
				</p>
				<p>
					<label for="password"><?php _e('Password'); ?></label>
					<input name="vicode_user_pass" id="password" class="password" type="password"/>
				</p>
				<p>
					<label for="password_again"><?php _e('Password Again'); ?></label>
					<input name="vicode_user_pass_confirm" id="password_again" class="password_again" type="password"/>
				</p>
				<p>
					<input type="hidden" name="vicode_csrf" value="<?php echo wp_create_nonce('vicode-csrf'); ?>"/>
					<input type="submit" name="register_new_account" value="<?php _e('Register Your Account'); ?>"/>
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
      
      if(username_exists($user_login)) {
          // Username already registered
          vicode_errors()->add('username_unavailable', __('Ta nazwa użytkownika jest już zajęta, proszę wybrać inną nazwę.'));
      }
      if(!validate_username($user_login)) {
          // invalid username
          vicode_errors()->add('username_invalid', __('Nieprawidłowa nazwa użytkownika'));
      }
      if($user_login == '') {
          // empty username
          vicode_errors()->add('username_empty', __('Please enter a username'));
      }
      if(!is_email($user_email)) {
          //invalid email
          vicode_errors()->add('email_invalid', __('Invalid email'));
      }
      if(email_exists($user_email)) {
          //Email address already registered
          vicode_errors()->add('email_used', __('Email already registered'));
      }
	  if($user_first == '') {
		// empty username
		vicode_errors()->add('username_empty', __('Please enter your first name'));
	  }
	  if($user_last == '') {
		// empty username
		vicode_errors()->add('username_empty', __('Please enter your last name'));
	  }
      if($user_pass == '') {
          // passwords do not match
          vicode_errors()->add('password_empty', __('Please enter a password'));
      }
      if($user_pass != $pass_confirm) {
          // passwords do not match
          vicode_errors()->add('password_mismatch', __('Passwords do not match'));
      }
      
      $errors = vicode_errors()->get_error_messages();
      
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

    // New code added 
    $this_user_role = implode(', ', $user_roles );

    if ($this_user_role == 'subscriber') {

        // Create a new post
        $user_post = array(
            'post_title'   => $user_info->nickname,
            'post_status'  => 'private', 
            'post_type'    => 'translator', // <- change to your cpt
        );
        // Insert the post into the database
        $user_post_id = wp_insert_post( $user_post );

		// Save values from register form as ACFs in post

		$user_first_name = $user_info->first_name;
		$user_last_name = $user_info->last_name;

		update_field( "translator_first_name", $user_first_name, $user_post_id );
		update_field( "translator_last_name", $user_last_name, $user_post_id );
		update_field( "translator_contact_email", $user_info->user_email, $user_post_id );
		// update_field( "translator_id", $user_id, $user_post_id );
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
	if($codes = vicode_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = vicode_errors()->get_error_message($code);
		        // echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
				echo '<p class="login-msg php-error__text">' . $message . '</p>';
		    }
		echo '</div>';
	} else {
		return false;
	}
}

// Tool functions for forms at account page

function get_current_user_post_id() {
	$current_user = wp_get_current_user();

	//Get ID of the current user post
	$current_user_nickname = $current_user->user_login;
	$user_post_title = $current_user_nickname; 

	if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
		$user_post_id = $post->ID;
	else
		$user_post_id = 0;

	return $user_post_id;
}

function get_percent_value_of_account_fill_completness() {
	

	$all_user_acf_field_objects = get_field_objects(get_current_user_post_id());

	$count_of_all_valueable_fields = 0;
	$count_of_all_filled_fields = 0;

	if ($all_user_acf_field_objects) {

		foreach($all_user_acf_field_objects as $field_object_name => $field_object_content) :

			$is_string = gettype($field_object_content["value"]) == 'string';
			$is_array = gettype($field_object_content["value"]) == 'array';
			$is_boolean = gettype($field_object_content["value"]) == 'boolean';

			// To do: fix missing array on basic user form data

			//Dont include privacy settings
			if ( !$is_array && $is_boolean ) {
				continue;
			};

			if ( $is_array )  {

				$count_of_all_valueable_fields++;
				
				if (count($field_object_content["value"]) > 0) {
					$count_of_all_filled_fields++;
				} 
			};

			if ( $is_string ) {

				$count_of_all_valueable_fields++;

				if (strlen($field_object_content["value"]) > 0) {
					$count_of_all_filled_fields++;
				}
			}

		endforeach;

	}

	$percent_value_of_single_field = 100 / $count_of_all_valueable_fields;

	$percent_value_of_account_fill_completness = round($count_of_all_filled_fields / $count_of_all_valueable_fields * 100);

	return $percent_value_of_account_fill_completness;
}


function get_labels_of_empty_translator_fields() {
	$all_user_acf_field_objects = get_field_objects(get_current_user_post_id());

	$empty_field_labels = [];

	if ($all_user_acf_field_objects) {

		foreach($all_user_acf_field_objects as $field_object_name => $field_object_content) :

			$is_string = gettype($field_object_content["value"]) == 'string';
			$is_array = gettype($field_object_content["value"]) == 'array';
			$is_boolean = gettype($field_object_content["value"]) == 'boolean';

			//Dont include privacy settings
			if ( !$is_array && $is_boolean ) {
				continue;
			};

			if ( $is_array )  {

				if (count($field_object_content["value"]) == 0) {
					array_push($empty_field_labels, $field_object_content["label"]);
				}
			};

			if ( $is_string ) {

				if (strlen($field_object_content["value"]) == 0) {
					array_push($empty_field_labels, $field_object_content["label"]);
				} 
			}

		endforeach;

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

				<p>
					<label for="user_first_name"><?php _e('First Name'); ?></label>
					<input name="user_first_name" id="user_first_name" class="user_first_name" type="text" value="<?php echo $current_user->first_name ?>"/>
				</p>

				<p>
					<label for="user_last_name"><?php _e('Last Name'); ?></label>
					<input name="user_last_name" id="user_last_name" class="user_last_name" type="text" value="<?php echo $current_user->last_name ?>"/>
				</p>

				<p>
					<label for="user_bio"><?php _e('Bio'); ?></label>
					<textarea form="basic_user_data_form" name="user_bio" id="user_bio" class="user_bio" type="text"><?php echo get_field("translator_bio", $user_post_id) ?></textarea>
				</p>

				<p>

					<?php
					$translator_languages_taxonomy = get_taxonomy( 'translator_language' );
					?>

					<label for="user_languages"><?php echo $translator_languages_taxonomy->label ?></label>

					<?php
					
						$translator_languages = get_terms( array(
							'taxonomy' => 'translator_language',
							'hide_empty' => false,
						) );


						if ( $translator_languages ) {

							foreach( $translator_languages as $term ) :

								echo '<div class="info-box__checkbox-wrapper">';

								echo '<label>';

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


				<p>

					<?php
						$translator_specializations_taxonomy = get_taxonomy( 'translator_specialization' );
					?>

					<label for="user_specializations"><?php echo $translator_specializations_taxonomy->label ?></label>

					<?php
					
						$translator_specializations = get_terms( array(
							'taxonomy' => 'translator_specialization',
							'hide_empty' => false,
						) );

						if ( $translator_specializations ) {

							foreach( $translator_specializations as $term ) :

								echo '<div class="info-box__checkbox-wrapper">';

								echo '<label>';
								
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

				<p class="status"></p>

				<p>

					<input type="submit" name="submit_basic_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
					<?php wp_nonce_field( "add_basic_user_data", "add_basic_user_data_nonce" ); ?>
				</p>

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
		$user_bio		= $_POST["user_bio"];	
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


		if (isset( $user_bio )) {
			
			//Update User meta data
			update_user_meta( $user_id, 'description', $user_bio);
			//Update ACF field for user post
			update_field( "translator_bio", $user_bio, $user_post_id );
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
		
		<form name="about_user_data_form" id="about_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<p>
					<textarea form="about_user_data_form" name="user_about" id="user_about" class="user_about" type="text" maxlength="300"><?php echo get_field("translator_about", $user_post_id) ?></textarea>
					<label for="user_about">0/300</label>
				</p>

				<p>
					<input type="submit" name="submit_about_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
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

	// var_dump($current_user_localizations_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		contact_user_data_form_messages(); ?>
		
		<form name="contact_user_data_form" id="contact_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<p>
					<label for="user_contact_phone"><?php _e('Numer telefonu'); ?></label>
					<input name="user_contact_phone" id="user_contact_phone" class="user_contact_phone" type="text" value="<?php if(strlen(get_field("translator_contact_phone") > 0)) { echo get_field("translator_contact_phone"); } else { echo "+48 123 456 789"; }  ?>"/>
				</p>

				<p>
					<label for="user_contact_email"><?php _e('Adres e-mail'); ?></label>
					<input name="user_contact_email" id="user_contact_email" class="user_contact_email" type="text" value="<?php if(strlen(get_field("translator_contact_email") > 0)) { echo get_field("translator_contact_email"); } else { echo $current_user->user_email; }  ?>"/>
				</p>

					<?php
						$translator_specializations_taxonomy = get_taxonomy( 'translator_localization' );
					?>

					<label for="user_localizations"><?php echo $translator_specializations_taxonomy->label ?></label>

					<div class="wrapper-flex-drow-mcol">

						<p class="wrapper-flex-drow-mcol__first-element">Miasto zamieszkania</p>

						<input name="user_city" id="user_city" class="user_city_input" placeholder="Nazwa miasta" type="text" value="<?php echo get_field("translator_city") ?>"/>

						<input hidden name="user_localizations[]" id="user_localization_city" class="user_localization_input" placeholder="Nazwa miasta" type="text" value=""/>

					</div>


					<div class="wrapper-flex-drow-mcol">

						<p class="wrapper-flex-drow-mcol__first-element">Inne lokalizacje</p>

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

									echo '<label>';
									
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

										echo '<label>';
										
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

										<button class="repeater__button repeater__button--add">+</button>

										<div class="repeater__field-wrapper">

											<div class="repeater__field" data-repeater-id="0">

												<input name="user_localizations[]" id="user_localizations" class="user_localizations user_localizations__repeater" placeholder="Dodaj inną lokalizację" type="text" value="" />

												<!-- <button class="repeater__button repeater__button--delete">-</button> -->

											</div>

										</div>

										</div>

								<?php

							};
							
						?>

						</div>

					</div>



				<p>
					<input type="submit" name="submit_contact_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
					<?php wp_nonce_field( 'add_contact_user_data', 'add_contact_user_data_nonce' ); ?>
				</p>

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

	$current_user = wp_get_current_user();

	//Get ID of the current user post
	$current_user_nickname = $current_user->user_login;
	$user_post_title = $current_user_nickname; 

	if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
		$user_post_id = $post->ID;
	else
		$user_post_id = 0;

		// var_dump($current_user_languages_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		linkedin_user_data_form_messages(); ?>
		
		<form name="linkedin_user_data_form" id="linkedin_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<p>
					<input name="user_linkedin" id="user_linkedin" class="user_linkedin" type="text" value="<?php echo get_field("translator_linkedin_link", $user_post_id) ?>"></textarea>
				</p>

				<p>
					<input type="submit" name="submit_linkedin_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
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

	print_r(json_encode($_POST));
	
	$current_user = wp_get_current_user();
	
	$current_user_nickname = $current_user->user_login;

	$user_linkedin		= $_POST["user_linkedin"];

	if ( ! wp_verify_nonce( $_POST["add_linkedin_user_data_nonce"], "add_linkedin_user_data") ) {
		die ( 'Nonce mismatched!');
	}

		$user_id = get_current_user_id();

		//Get ID of the current user post
		$user_post_title = $current_user_nickname; 

		if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
			$user_post_id = $post->ID;
		else
			$user_post_id = 0;

		// Save/Update values to user meta data or user post

		//Update ACF field for user post
		update_field( "translator_linkedin_link", $user_linkedin, $user_post_id );
		
	die();

}

add_action( 'wp_ajax_nopriv_add_linkedin_user_data_with_ajax',  'add_linkedin_user_data_with_ajax' );
add_action( 'wp_ajax_add_linkedin_user_data_with_ajax','add_linkedin_user_data_with_ajax' );


/* ADD WORK USER DATA FORM */
function work_user_data_form() {

	$current_user = wp_get_current_user();

	//Get ID of the current user post
	$current_user_nickname = $current_user->user_login;
	$user_post_title = $current_user_nickname; 

	if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
		$user_post_id = $post->ID;
	else
		$user_post_id = 0;

		// var_dump($current_user_languages_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		work_user_data_form_messages(); ?>
		
		<form name="work_user_data_form" id="work_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<p>
					<textarea form="work_user_data_form" name="user_work" id="user_work" class="user_work" type="text" maxlength="250"><?php echo get_field("translator_work", $user_post_id) ?></textarea>
					<label for="user_work">0/250</label>
				</p>

				<p>
					<input type="submit" name="submit_work_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
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

	print_r(json_encode($_POST));
	
	$current_user = wp_get_current_user();
	
	$current_user_nickname = $current_user->user_login;

    $user_work = $_POST["user_work"];


	if ( ! wp_verify_nonce( $_POST["add_work_user_data_nonce"], "add_work_user_data") ) {
		die ( 'Nonce mismatched!');
	}

		$user_id = get_current_user_id();

		//Get ID of the current user post
		$user_post_title = $current_user_nickname; 

		if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
			$user_post_id = $post->ID;
		else
			$user_post_id = 0;

		// Save/Update values to user meta data or user post

        //Update ACF field for user post
        update_field( "translator_work", $user_work, $user_post_id );
		
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

				<label class="file-input__label">

					<div class="input-preview__wrapper">
						<img class="input-preview" style="">
					</div>

					<input type="file" id="profile-picture__input" name="profile-picture__input" class="custom-file-input input-preview__src" accept=".png,.jpg,.jpeg" required />

				</label>

				<input type="hidden" name="post_id" value="<?php echo $user_post_id ?>"><br>
				<input type="submit" name="submit_profile_picture" value="Zaktualizuj zdjęcie" />
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

	// Get post_id
	$post_id = $_POST['post_id'];

	// upload.

	$attachment_id = media_handle_upload( 'profile-picture__input', $post_id );

	set_post_thumbnail( $post_id, $attachment_id );

	if ( is_wp_error( $attachment_id ) ) {
		// There was an error uploading the image.
		wp_die( $attachment_id->get_error_message() );
	}

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

					<button class="repeater__button repeater__button--add">+</button>

					<div class="repeater__field-wrapper">

						<div class="repeater__field" data-repeater-id="0">

							<div class="row-wrapper wrapper-flex-drow-mcol">

								<div class="wrapper-flex-col-start col-d50">

									<p>
										<input name="sound-label__input[]" id="sound-label__input" class="input-text input-preview__src" type="text" value="" placeholder="Tytuł nagrania"/>
									</p>

									<p>
										<textarea form="upload_sound_to_gallery_form" name="sound-textarea__input[]" id="sound-textarea__input" class="input-textarea input-preview__src" type="text" maxlength="100"></textarea>
										<label for="user_work">0/100</label>
									</p>

								</div>

								<div class="col-d50">

									<input type="file" name="sound-to-gallery__input[]" id="sound-to-gallery__input" class="custom-file-input input-preview__src" accept=".mp3,.wav,.m4a"/>

									<div class="new-attachment__wrapper my-sounds__gallery-row-wrapper ">

										<div id="newSoundInGalleryPlaceholder" class="new-attachment__placeholder" style="display:none;" width="">
											<?php

											// echo '<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper">';

											// 		echo '<a class="remove-item remove" data-id="clear-input" href="#"></a>';

											// 		echo '<div class="my-sounds__gallery-text-wrapper">';

											// 			echo '<div class="my-sounds__gallery-attachment--label" style="display: none">';

											// 				echo '<p></p>';

											// 			echo '</div>';

											// 			echo '<div class="my-sounds__gallery-attachment--description" style="display: none">';

											// 				echo '<p></p>';

											// 			echo '</div>';

											// 		echo '</div>';

											// 		echo '<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info">';

											// 			echo '<div class="new-attachment__icon ">';

											// 				echo '<svg viewBox="0 0 384 384" xmlns="http://www.w3.org/2000/svg">
											// 				<path d="m176 288c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-192c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
											// 				<path d="m16 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
											// 				<path d="m152 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
											// 				<path d="m80 240c8.832031 0 16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16zm0 0"/>
											// 				<path d="m264 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
											// 				<path d="m368 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
											// 				<path d="m304 144c-8.832031 0-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16zm0 0"/>
											// 				<path d="m176 368c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
											// 				<path d="m192 48c8.832031 0 16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v16c0 8.832031 7.167969 16 16 16zm0 0"/></svg>';

											// 			echo '</div>';

											// 			echo '<div class="new-attachment__description">';

											// 				echo '<p class="sound-title"></p>';

											// 			echo '</div>';

											// 		echo '</div>';

											// echo '</div>';
											?>
										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

				<input type="hidden" name="post_id" value="<?php echo $user_post_id ?>"><br>

				<input type="hidden" name="sounds_to_delete" id="sounds_to_delete" value=""/>

				<input type="submit" name="submit_sound_to_gallery" value="Zaktualizuj galerię" />

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
		'console_log' => []
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


				// -1 because acf rows count starts at 1 and array from 0

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

				<button class="repeater__button repeater__button--add">+</button>

				<div class="repeater__field-wrapper">

					<div class="repeater__field" data-repeater-id="0">

						<div class="row-wrapper my-pictures__gallery-row-wrapper">

							<label class="file-input__label">

								<input type="file" name="image-to-gallery__input[]" id="image-to-gallery__input" class="custom-file-input input-preview__src" accept=".png,.jpg,.jpeg" />

							</label>

							<div class="new-attachment__wrapper" >

								<img class="new-attachment__placeholder" style="display:none;" src="" width=""/>

								<a class="remove-item remove" data-id="clear-input" href="#"></a>

							</div>

						
						</div>

					</div>

					<!-- <button class="repeater__button repeater__button--delete">-</button> -->

				</div>

			</div>

			<input type="hidden" name="post_id" value="<?php echo $user_post_id ?>"><br>
			<input type="hidden" name="pictures_to_delete" id="pictures_to_delete" value=""/>
			<input type="submit" name="submit_image_to_gallery" value="Zaktualizuj galerię" />
			<?php wp_nonce_field( "handle_image_to_gallery_upload", "image_to_gallery_nonce" ); ?>

			<div class="progress">
				<div class="progress-bar"></div>
				<div class="progress-percents"></div>
			</div>

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

				<label class="file-input__label">

					<input type="file" name="video-to-gallery__input" id="video-to-gallery__input" class="custom-file-input input-preview__src" accept=".mp4,.mov,.wmv,.mpg" />

				</label>

				<input type="hidden" name="post_id" value="<?php echo $user_post_id ?>"><br>


				<input type="hidden" name="videos_to_delete" id="videos_to_delete" value=""/>

				<input type="submit" name="submit_video_to_gallery" value="Zaktualizuj galerię" />
				
				<?php wp_nonce_field( "handle_video_to_gallery_upload", "video_to_gallery_nonce" ); ?>

				<div class="progress">
					<div class="progress-bar"></div>
					<div class="progress-percents"></div>
				</div>
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

			<p>
				<input name="user_new_login_email" id="user_new_login_email" class="user_new_login_email" type="text" value="<?php echo $current_user_login_email; ?>"/>
			</p>

			<p>
				<input type="submit" name="submit_user_new_login_email" value="<?php _e('Zaktualizuj adres email'); ?>"/>
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


				<label for="current_password">Wprowadź aktualne hasło:</label>
				<input id="current_password" type="password" name="current_password" title="current_password" placeholder="">
				<label for="new_password">Nowe hasło:</label>
				<input id="new_password" type="password" name="new_password" title="new_password" placeholder="">
				<label for="confirm_new_password">Potwierdź nowe hasło:</label>
				<input id="confirm_new_password" type="password" name="confirm_new_password" title="confirm_new_password" placeholder="">

				
				<p>
					<input type="submit" name="submit_user_new_password" value="<?php _e('Zmień hasło'); ?>"/>
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
			$errors = array();
			$current_user = get_user_by('id', $user_id);
	
	
			// Check for errors
			if (empty($current_password) && empty($new_password) && empty($confirm_new_password) ) {
					$errors[] = 'All fields are required';
			}
			if ($current_user && wp_check_password($current_password, $current_user->data->user_pass, $current_user->ID)){
			//match
			} else {
				$errors[] = 'Password is incorrect';
				vicode_errors()->add('username_empty', __('Password is incorrect'));
			}
			if ($new_password != $confirm_new_password){
				$errors[] = 'Password does not match';
				vicode_errors()->add('username_empty', __('Password does not match'));
			}
			if (strlen($new_password) < 8) {
				$errors[] = 'Password is too short, minimum of 8 characters';
				vicode_errors()->add('username_empty', __('Password is too short, minimum of 8 characters'));
			}
	
			if (!preg_match("/[A-Z]/", $new_password)) {
				$errors[] = "Password should contain at least one Capital Letter";
				vicode_errors()->add('username_empty', __('Password should contain at least one Capital Letter'));
			}
	
			if (!preg_match("/\W/", $new_password)) {
				$errors[] = "Password should contain at least one special character";
				vicode_errors()->add('username_empty', __('Password should contain at least one special character'));
			}
	
			if (preg_match("/\s/", $new_password)) {
				$errors[] = "Password should not contain any white space";
				vicode_errors()->add('username_empty', __('Password should not contain any white space'));
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

	$current_user = wp_get_current_user();

	$current_user_id = $current_user->id;

	
	//Get ID of the current user post
	$current_user_login_email = $current_user->user_email;
	$current_user_nickname = $current_user->user_login;
	$user_post_title = $current_user_nickname; 

	if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
		$user_post_id = $post->ID;
	else
		$user_post_id = 0;

	$user_post_status = get_post_status($user_post_id);

	$translator_contact_phone_status = get_field("translator_contact_phone_public");
	$translator_contact_email_status = get_field("translator_contact_email_public");
	$translator_city_public_status = get_field("translator_city_public");

		// var_dump(get_field("translator_contact_email_public", $user_post_id));

	ob_start(); ?>	

		
					<form name="settings_user_data_visibility_form" id="settings_user_data_visibility_form" class="vicode_form" action="" method="POST">

                        <ul class="options">

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
									?>
									<li>

										<div class="options__position">Mój profil tłumacza</div>
									
										<div class="options__switch options__to-be-approved
										">

											<label for="switch">
												<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
														viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
													<g>
														<g>
															<g>
																<path d="M458.406,380.681c-8.863-6.593-21.391-4.752-27.984,4.109c-3.626,4.874-7.506,9.655-11.533,14.21
																	c-7.315,8.275-6.538,20.915,1.737,28.231c3.806,3.364,8.531,5.016,13.239,5.016c5.532,0,11.04-2.283,14.992-6.754
																	c4.769-5.394,9.364-11.056,13.658-16.829C469.108,399.803,467.269,387.273,458.406,380.681z"/>
																<path d="M491.854,286.886c-10.786-2.349-21.447,4.496-23.796,15.288c-1.293,5.937-2.855,11.885-4.646,17.681
																	c-3.261,10.554,2.651,21.752,13.204,25.013c1.967,0.607,3.955,0.896,5.911,0.896c8.54,0,16.448-5.514,19.102-14.102
																	c2.126-6.878,3.98-13.937,5.514-20.98C509.492,299.89,502.647,289.236,491.854,286.886z"/>
																<path d="M362.139,444.734c-5.31,2.964-10.808,5.734-16.34,8.233c-10.067,4.546-14.542,16.392-9.996,26.459
																	c3.34,7.396,10.619,11.773,18.239,11.773c2.752,0,5.549-0.571,8.22-1.777c6.563-2.964,13.081-6.249,19.377-9.764
																	c9.645-5.384,13.098-17.568,7.712-27.212C383.968,442.803,371.784,439.35,362.139,444.734z"/>
																<path d="M236,96v151.716l-73.339,73.338c-7.81,7.811-7.81,20.474,0,28.284c3.906,3.906,9.023,5.858,14.143,5.858
																	c5.118,0,10.237-1.953,14.143-5.858l79.196-79.196c3.75-3.75,5.857-8.838,5.857-14.142V96c0-11.046-8.954-20-20-20
																	C244.954,76,236,84.954,236,96z"/>
																<path d="M492,43c-11.046,0-20,8.954-20,20v55.536C425.448,45.528,344.151,0,256,0C187.62,0,123.333,26.629,74.98,74.98
																	C26.629,123.333,0,187.62,0,256s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512c0.169,0,0.332-0.021,0.5-0.025
																	c0.168,0.004,0.331,0.025,0.5,0.025c7.208,0,14.487-0.304,21.637-0.902c11.007-0.922,19.183-10.592,18.262-21.599
																	c-0.923-11.007-10.58-19.187-21.6-18.261C269.255,471.743,263.099,472,257,472c-0.169,0-0.332,0.021-0.5,0.025
																	c-0.168-0.004-0.331-0.025-0.5-0.025c-119.103,0-216-96.897-216-216S136.897,40,256,40c76.758,0,147.357,40.913,185.936,106
																	h-54.993c-11.046,0-20,8.954-20,20s8.954,20,20,20H448c12.18,0,23.575-3.423,33.277-9.353c0.624-0.356,1.224-0.739,1.796-1.152
																	C500.479,164.044,512,144.347,512,122V63C512,51.954,503.046,43,492,43z"/>
															</g>
														</g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													<g>
													</g>
													</svg>
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

								<div class="options__position">Miasto zamieszkania</div>

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
							<input type="submit" name="submit_settings_user_data_visibility_form" class="info-box__subbox--max-width" value="<?php _e('Zaktualizuj widoczność profilu'); ?>"/>
							<?php wp_nonce_field( 'settings_user_data_visibility_form', 'settings_user_data_visibility_form_nonce' ); ?>
						</p>

					</form>

	<?php
	return ob_get_clean();
}

function change_settings_user_data_visibility_with_ajax() {
	
		$user_id = get_current_user_id();
		$current_user = wp_get_current_user();
		$current_user_nickname = $current_user->user_login;
		$user_post_title = $current_user_nickname; 

		$user_data_visibility_object_for_ajax = (object) [
			'profile_is_public' => "",
			'console_log' => [],
		];

		if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
			$user_post_id = $post->ID;
		else
			$user_post_id = 0;

		if ( ! wp_verify_nonce( $_POST["settings_user_data_visibility_form_nonce"], "settings_user_data_visibility_form") ) {
			die ( 'Nonce mismatched!');
		}

		$user_settings_visibility_public_profile = $_POST["user_settings_visibility_public_profile"];
		$user_settings_visibility_contact_phone = $_POST["user_settings_visibility_contact_phone"];
		$user_settings_visibility_contact_email = $_POST["user_settings_visibility_contact_email"];
		$user_settings_visibility_city = $_POST["user_settings_visibility_city"];


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

		if ($user_settings_visibility_contact_phone === "on") {
			update_field( "translator_contact_email_public", 1, $user_post_id );
		} else {
			update_field( "translator_contact_email_public", 0, $user_post_id );
		}

		if ($user_settings_visibility_contact_phone === "on") {
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
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(min(post_date_gmt)) AS firstdate,
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
	$copyright = "&copy; " . $copyright_dates[0]->firstdate;
	if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
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
