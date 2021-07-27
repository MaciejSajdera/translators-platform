<?php

// Add contact user data form
function contact_user_data_form() {

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
		contact_user_data_form_messages(); ?>
		
		<form name="contact_user_data_form" id="contact_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>


				<label>Inne Lokalizacje</input>


				<div class="repeater-input__holder">

					<button class="repeater-input__add-button">+</button>

					<div class="repeater-input__wrapper">

						<input name="user_localizations[]" id="user_localizations" class="user_localizations user_localizations__repeater" type="text" value="" />

					</div>

				</div>


				<p>
					<input type="submit" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
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
// 		die ( 'Busted!');
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

	print_r(json_encode($_POST));
	
	$current_user = wp_get_current_user();
	
	$current_user_nickname = $current_user->user_login;

    $user_localizations		= $_POST["user_localizations"];

	if ( ! wp_verify_nonce( $_POST["add_contact_user_data_nonce"], "add_contact_user_data") ) {
		die ( 'Busted!');
	}

		$user_id = get_current_user_id();

		//Get ID of the current user post
		$user_post_title = $current_user_nickname; 

		if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
			$user_post_id = $post->ID;
		else
			$user_post_id = 0;

		// Save/Update values to user meta data or user post

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
		
    die();

}

add_action( 'wp_ajax_nopriv_add_contact_user_data_with_ajax',  'add_contact_user_data_with_ajax' );
add_action( 'wp_ajax_add_contact_user_data_with_ajax','add_contact_user_data_with_ajax' );