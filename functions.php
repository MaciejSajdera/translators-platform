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
				'menu-1' => esc_html__( 'Primary', 'pstk' ),
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

	if (is_page(18)) {
		wp_enqueue_script( 'pstk-user-profile', get_template_directory_uri() . '/dist/js/user-profile.js', array(), '', true );
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


// remove admin bar for all users except administrators
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

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
		vicode_register_messages();
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
					<input type="submit" value="<?php _e('Register Your Account'); ?>"/>
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
          vicode_errors()->add('username_unavailable', __('Username already taken'));
      }
      if(!validate_username($user_login)) {
          // invalid username
          vicode_errors()->add('username_invalid', __('Invalid username'));
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
      
      // if no errors then cretate user
      if(empty($errors)) {
          
          $new_user_id = wp_insert_user(array(
                  'user_login'		=> $user_login,
                  'user_pass'	 		=> $user_pass,
                  'user_email'		=> $user_email,
                  'first_name'		=> $user_first,
                  'last_name'			=> $user_last,
                  'user_registered'	=> date('Y-m-d H:i:s'),
                  'role'				=> 'subscriber'
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
		update_field( "translator_id_acf", $user_id, $user_post_id );
    }
}
add_action( 'user_register', 'create_post_for_user', 10, 1 );

// used for tracking error messages
function vicode_errors(){
    static $wp_error; // global variable handle
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function vicode_register_messages() {
	if($codes = vicode_errors()->get_error_codes()) {
		echo '<div class="vicode_errors">';
		    // Loop error codes and display errors
		   foreach($codes as $code){
		        $message = vicode_errors()->get_error_message($code);
		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		    }
		echo '</div>';
	}	
}

// basic_user_data_form shortcode
// function show_basic_user_data_form() {
// 		$output = basic_user_data_form();
// 		return $output;
// }
// add_shortcode('display_basic_user_data_form', 'show_basic_user_data_form');

// Add basic user data form
function basic_user_data_form() {

	$current_user = wp_get_current_user();

	//Get ID of the current user post
	$current_user_nickname = $current_user->user_login;
	$user_post_title = $current_user_nickname; 

	if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
		$user_post_id = $post->ID;
	else
		$user_post_id = 0;

	$current_user_languages_array_terms = wp_get_post_terms($user_post_id, 'translator_language', array('fields' => 'names'));

	$current_user_specializations_array_terms = wp_get_post_terms($user_post_id, 'translator_specialization', array('fields' => 'names'));

		// var_dump($current_user_languages_array_terms);

	ob_start(); ?>	

		<?php 
		// show any error messages after form submission
		basic_user_data_form_messages(); ?>
		
		<form name="basic_user_data_form" id="basic_user_data_form" class="vicode_form" action="test" method="POST">

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
					<textarea form="basic_user_data_form" name="user_bio" id="user_bio" class="user_bio" type="text"><?php echo get_field("translator_bio_acf", $user_post_id) ?></textarea>
				</p>

				<p>
					<label for="user_languages"><?php _e('Języki'); ?></label>

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
									<input name="user_languages[]" id="user_languages" class="user_languages" type="checkbox" value="<?php echo $term->name ?>"

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
					<label for="user_specializations"><?php _e('Specjalizacje'); ?></label>

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
									<input name="user_specializations[]" id="user_specializations" class="user_specializations" type="checkbox" value="<?php echo $term->name ?>"
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
<!-- 
					<input type="hidden" name="vicode_csrf" value="<?php echo wp_create_nonce('basic_user_data_form-csrf'); ?>"/> -->
					<input type="submit" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
					<?php wp_nonce_field( 'ajax-basic-user-data-nonce', 'security' ); ?>
				</p>

			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}

// Save Basic user data form information
function add_basic_user_data() {

	$current_user = wp_get_current_user();
	
	$current_user_nickname = $current_user->user_login;

    if ( isset( $_POST["user_first_name"] ) || isset( $_POST["user_last_name"]) || isset( $_POST["user_bio"] ) || isset( $_POST["user_languages"] ) || isset( $_POST["user_specializations"] ) && wp_verify_nonce($_POST['basic_user_data_form_csrf'], 'basic_user_data_form-csrf')) {

		$user_id = get_current_user_id();

		//Get ID of the current user post
		$user_post_title = $current_user_nickname; 

		if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
			$user_post_id = $post->ID;
		else
			$user_post_id = 0;

		// Save/Update values to user meta data or user post

		if (isset( $_POST["user_first_name"] )) {
			$user_first_name		= $_POST["user_first_name"];	

			//Update User meta data
			update_user_meta( $user_id, 'first_name', $user_first_name);
			//Update ACF field for user post
			update_field( "translator_first_name", $user_first_name, $user_post_id );
		}

		if (isset( $_POST["user_last_name"] )) {
			$user_last_name		= $_POST["user_last_name"];	
			
			//Update User meta data
			update_user_meta( $user_id, 'last_name', $user_last_name);
			//Update ACF field for user post
			update_field( "translator_last_name", $user_last_name, $user_post_id );
		}


		if (isset( $_POST["user_bio"] )) {
			$user_bio		= $_POST["user_bio"];
			update_user_meta( $user_id, 'description', $user_bio);
			//Update ACF field for user post
			update_field( "translator_bio_acf", $user_bio, $user_post_id );
		}

		if ( isset( $_POST["user_languages"] )) {
			$user_languages_array		= $_POST["user_languages"];
			// update_user_meta( $user_id, '_user_languages', $user_languages_array);

			//clears previous values
			wp_set_post_terms( $user_post_id, null, 'translator_language' );

			//sets updated values
			wp_set_post_terms( $user_post_id, $user_languages_array, 'translator_language' );

		}

		// if all user_languages checkboxes are marked as false and the form is submitted

		if ( !isset( $_POST["user_languages"] ) && isset( $_POST["user_first_name"] ) ) {
			
			$user_languages_array = 0;
			// update_user_meta( $user_id, '_user_languages', $user_languages_array);

			//clears previous values
			wp_set_post_terms( $user_post_id, null, 'translator_language' );

			//sets updated values
			wp_set_post_terms( $user_post_id, $user_languages_array, 'translator_language' );

		}

		if ( isset( $_POST["user_specializations"] )) {
			$user_specializations_array		= $_POST["user_specializations"];

			//clears previous values
			wp_set_post_terms( $user_post_id, null, 'translator_specialization' );

			//sets updated values
			wp_set_post_terms( $user_post_id, $user_specializations_array, 'translator_specialization' );

		}

		// if all user__specialization checkboxes are marked as false and the form is submitted

		if ( !isset( $_POST["user_specializations"] ) && isset( $_POST["user_first_name"] ) ) {
	
			$user_languages_array = 0;
			// update_user_meta( $user_id, '_user_languages', $user_languages_array);

			//clears previous values
			wp_set_post_terms( $user_post_id, null, 'translator_specialization' );

			//sets updated values
			wp_set_post_terms( $user_post_id, $user_languages_array, 'translator_specialization' );

		}

  	}
}
add_action('init', 'add_basic_user_data');


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

//Ajaxify basic user data form

function ajax_basic_user_data_init(){

    wp_register_script('ajax-basic-user-data-script', get_template_directory_uri() . '/assets/js/ajax-basic-user-data-script.js', array('jquery') ); 

    wp_localize_script( 'ajax-basic-user-data-script', 'ajax_basic_user_data_object', array( 
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'redirecturl' => get_permalink(18),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

	wp_enqueue_script('ajax-basic-user-data-script');

	// add_action( 'wp_ajax_ajax_add_basic_user_data', 'ajax_add_basic_user_data' );

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajax_add_basic_user_data', 'ajax_add_basic_user_data' );

}

// print_r(get_page_template_slug());

$tmp = get_page_template_slug(18); // provide page/post ID

/* TO DO: PREVENT THIS ACTION INIT ON PAGES OTHER THEN USER ACCOUNT */

if(is_user_logged_in() && 'user-account-page-template.php' == $tmp) {
    // enqueue scripts here
	    add_action('init', 'ajax_basic_user_data_init');
}

function ajax_add_basic_user_data(){

	print_r('ajax send?');

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-basic-user-data-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();

	$info['user_first_name'] = $_POST["user_first_name"];	
	// $info['user_last_name']		= $_POST["user_last_name"];	
	// $info['user_bio']		= $_POST["user_bio"];
	// $info['user_languages_array']		= $_POST["user_languages"];
	// $info['user_specializations_array']		= $_POST["user_specializations"];

    if ( is_wp_error() ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('error ajax')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
    }

    die();
}

/* https://rudrastyh.com/wordpress/how-to-add-images-to-media-library-from-uploaded-files-programmatically.html */

add_shortcode( 'misha_uploader', 'misha_uploader_callback' );

function misha_uploader_callback($user_post_id) {
	return '<form id="upload-profile-picture" action="' . get_stylesheet_directory_uri() . '/process_upload.php" method="post" enctype="multipart/form-data">

				<label class="file-input__label">

					<div class="input-preview__wrapper">
						<img class="input-preview">
					</div>

					<input type="file" id="profile-picture__input" name="profile-picture__input" class="custom-file-input input-preview__src" size="25" accept=".png,.jpg,.jpeg" required />

				</label>

				<input type="hidden" name="post_id" id="post_id" value="'.$user_post_id.'"><br>
				<input type="submit" name="submit" value="Zaktualizuj zdjęcie" />
			</form>';
}

// <span class="file-input__button-text">Wybierz zdjęcie</span>

function redirect_login_page() {
	$login_page  = get_permalink(18);
	$page_viewed = basename($_SERVER['REQUEST_URI']);
   
	if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
	  wp_redirect($login_page);
	  exit;
	}
}
add_action('init','redirect_login_page');

function redirect_nonadmin_users_after_login() {
	if(!is_admin()){
		$login_page  = get_permalink(18);
		// wp_redirect($login_page);
		return $login_page;
		die; // You have to die here
	  }
}
  
add_filter('login_redirect', 'redirect_nonadmin_users_after_login');

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
