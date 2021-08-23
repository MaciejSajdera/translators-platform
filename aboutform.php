<?php

function change_settings_user_data_visibility_with_ajax() {

// if ( ! isset( $_POST["user_work"] ) ) {
// 	return;
// }

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

	/* UPDATE VISIBILITY SETTINGS FORM */

	var userDataVisibilityForm = ajax_forms_params.settings_user_data_visibility_form;

	$(userDataVisibilityForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=change_settings_user_data_visibility_with_ajax",
			type: "post",
			data: $(userDataVisibilityForm).serialize(),
			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);

				const userworkText = document.querySelector("#user_work_text");

				userworkText.innerText = `${dataJSON.user_work}`;

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});