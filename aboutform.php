<?php

function gallery_image_uploader($user_post_id) {

	ob_start(); 

		// show any error messages after form submission
		gallery_image_uploader_form_messages();

		$stylesheet_directory_uri = get_stylesheet_directory_uri();
		?>

	<form id="upload_image_to_gallery_form" method="post" enctype="multipart/form-data">

				<label class="file-input__label">

					<div class="input-preview__wrapper">
						<img class="input-preview">
					</div>

					<input type="file" id="image-to-gallery__input" name="image-to-gallery__input" class="custom-file-input input-preview__src" size="25" accept=".png,.jpg,.jpeg" required />

				</label>

				<input type="hidden" name="post_id" id="post_id" value="<?php echo $user_post_id ?>"><br>
				<input type="submit" name="submit_image_to_gallery" value="Zaktualizuj zdjęcie" />
				<?php wp_nonce_field( "handle_image_to_gallery_upload", "image_to_gallery_nonce" ); ?>
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

	//Stop immidiately if form is not submitted
	// if ( ! isset( $_POST['submit_image_to_gallery'] ) ) {
	// 	return;
	// }

	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['image_to_gallery_nonce'], 'handle_image_to_gallery_upload' ) ) {
		wp_die( esc_html__( 'Nonce mismatched', 'theme-text-domain' ) );
	}

	// Throws a message if no file is selected
	if ( ! $_FILES['image-to-gallery__input']['name'] ) {
		wp_die( esc_html__( 'Please choose a file', 'theme-text-domain' ) );
	}

	// $new_file_mime = mime_content_type( $_FILES['image-to-gallery__input']['tmp_name'] );
	

	// if( !in_array( $new_file_mime, get_allowed_mime_types() ) ) {
	// 	die( 'WordPress doesn\'t allow this type of uploads.' );
	// }

	// if (is_uploaded_file( $_FILES['image-to-gallery__input']['tmp_name'] )) {
	// 	    // Notice how to grab MIME type
	// 		$mime_type = mime_content_type($_FILE['image-to-gallery__input']['tmp_name']);

	// 		// If you want to allow certain files
	// 		$allowed_file_types = ['image/png', 'image/jpeg', ];
	// 		if (! in_array($mime_type, $allowed_file_types)) {
	// 			// File type is NOT allowed
	// 			die( 'WordPress doesn\'t allow this type of uploads.' );
	// 		}
	// }

	$finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['image-to-gallery__input']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
		echo '<div class="php-error__wrapper"><div class="php-error__content">Nieprawidłowy format pliku</div></div>';
		throw new Exception('Exception message');
        throw new RuntimeException('Invalid file format.');
    }


	// $allowed_extensions = array( 'jpg', 'jpeg', 'png' );
	// $file_type = wp_check_filetype( $_FILES['image-to-gallery__input'] );
	// $file_extension = $file_type['ext'];

	// // Check for valid file extension
	// if ( ! in_array( $file_extension, $allowed_extensions ) ) {
	// 	die("Invalid file extension, only allowe");
	// 	error_log ( esc_html__( 'Invalid file extension, only allowed: %s', 'theme-text-domain' ), implode( ', ', $allowed_extensions ));
	// 	wp_die( sprintf(  esc_html__( 'Invalid file extension, only allowed: %s', 'theme-text-domain' ), implode( ', ', $allowed_extensions ) ) );
	// }

	// $file_name = preg_replace('/\s+/', '-', $_FILES["file"]["name"]);

	$file_size = $_FILES['image-to-gallery__input']['size'];
	$allowed_file_size = 3145728; // Here we are setting the file size limit to 3MB

	// Check for file size limit
	if ( $file_size >= $allowed_file_size ) {
		wp_die( sprintf( esc_html__( 'File size limit exceeded, file size should be smaller than %d KB', 'theme-text-domain' ), $allowed_file_size / 1000 ) );
	}

	// These files need to be included as dependencies when on the front end.
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once( ABSPATH . 'wp-admin/includes/media.php' );

	// Get post_id
	$post_id = $_POST['post_id'];

	// Let WordPress handle the upload.
	// Remember, 'wpcfu_file' is the name of our file input in our form above.
	// Here post_id is 0 because we are not going to attach the media to any post.
	$attachment_id = media_handle_upload( 'image-to-gallery__input', $post_id );

	set_post_thumbnail( $post_id, $attachment_id );

	// 	$array = get_field('field_5693402ab8561', $post[0]->ID, false);
	// if (!is_array($array)) {
	// $array = array();
	// }
	// $array[] = $attach_id;
	// update_field('field_5693402ab8561', $array, $post[0]->ID );

	if ( is_wp_error( $attachment_id ) ) {
		// There was an error uploading the image.
		wp_die( $attachment_id->get_error_message() );
	} else {
		// We will redirect the user to the attachment page after uploading the file successfully.
		wp_redirect( get_the_permalink(18) );
		exit;
	}

	die();
}

/**
 * Hook the function that handles the file upload request.
 */
// add_action( 'init', 'handle_image_to_gallery_upload' );

add_action( 'wp_ajax_nopriv_handle_image_to_gallery_upload',  'handle_image_to_gallery_upload' );
add_action( 'wp_ajax_handle_image_to_gallery_upload','handle_image_to_gallery_upload' );

	/* 	Upload profile picture Form */

	var uploadImageToGalleryForm = ajax_forms_params.upload_image_to_gallery_form;

	$(uploadImageToGalleryForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		console.log(this);

		var formData = new FormData(this);

		$.ajax({
			url: ajaxurl + "?action=handle_image_to_gallery_upload",
			type: "POST",
			data: formData,
			async: true,
			cache: false,
			contentType: false,
			enctype: "multipart/form-data",
			processData: false,

			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				uploadPicturePreview.classList.remove("has-image");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				// const dataJSON = JSON.parse(data);
				// console.log(dataJSON);

				return data;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				modalContent.appendChild(errorMessageNode[0]);

				toggleModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});