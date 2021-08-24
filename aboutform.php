<?php

/* SOUND GALLERY CONTAINER */

echo '<div class="account__box-container">';

	/* CONTENT BOX */

	echo '<div class="content-box info-box">';

		echo '<div><p class="info-box__header">Próbka głosu</p></div>';

		echo '<div class="info-box__subbox wrapper-flex-drow-mcol">';

			$sounds_to_gallery_array = get_field('translator_sound_gallery');

			echo '<div class="my-videos__wrapper ajax-content-wrapper">';

				/* AJAX LOADER */

				echo '<div class="my-ajax-loader">';

					echo '<div class="my-ajax-loader__spinner"></div>';

				echo '</div>';

				echo '<p class="info-box__subbox-header">Filmy</p>';
				
				echo '<div class="my-sounds__gallery">';

				// var_dump($sounds_to_gallery_array);

				if ($sounds_to_gallery_array) {

					//start at 1 because acf repeater rows indexes start with 1

					$i = 1;

					foreach ($sounds_to_gallery_array as $sound) :

							$sound_link = $sound['translator_single_video'];

							if($sound_link) {

								$sound_id = attachment_url_to_postid($sound_link);

								echo '<div class="my-sounds__gallery-attachment">';

									echo '<a class="remove-item" href="#" data-id="'.$i.'"></a>';

									echo '<svg height="384pt" viewBox="0 0 384 384" width="384pt" xmlns="http://www.w3.org/2000/svg">
									<path d="m176 288c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-192c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
									<path d="m16 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
									<path d="m152 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
									<path d="m80 240c8.832031 0 16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16zm0 0"/>
									<path d="m264 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
									<path d="m368 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
									<path d="m304 144c-8.832031 0-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16zm0 0"/>
									<path d="m176 368c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
									<path d="m192 48c8.832031 0 16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v16c0 8.832031 7.167969 16 16 16zm0 0"/></svg>';

									$sound_name = basename(get_attached_file( $sound_id ));

									echo '<p>'.$sound_name.'</p>';

								echo '</div>';
							} 

							$i++;

					endforeach;

				} else {

					echo '<p>Aktualnie nie masz dodanych żadnych filmów w galerii</p>';
					
				};

				echo '</div>';

				echo gallery_video_uploader($user_post_id);

				echo '<div id="newVideoInGalleryPlaceholder" class="my-sounds__gallery-attachment" style="display:none;" >';

					echo '<a class="remove-item remove" data-id="clear-input" href="#"></a>';

					echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					viewBox="0 0 298 298" style="enable-background:new 0 0 298 298;" xml:space="preserve">
					   <path d="M298,33c0-13.255-10.745-24-24-24H24C10.745,9,0,19.745,0,33v232c0,13.255,10.745,24,24,24h250c13.255,0,24-10.745,24-24V33
				   z M91,39h43v34H91V39z M61,259H30v-34h31V259z M61,73H30V39h31V73z M134,259H91v-34h43V259z M123,176.708v-55.417
				   c0-8.25,5.868-11.302,12.77-6.783l40.237,26.272c6.902,4.519,6.958,11.914,0.056,16.434l-40.321,26.277
				   C128.84,188.011,123,184.958,123,176.708z M207,259h-43v-34h43V259z M207,73h-43V39h43V73z M268,259h-31v-34h31V259z M268,73h-31V39
				   h31V73z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';

					echo '<p></p>';

				echo '</div>';

			echo '</div>';

		echo '</div>';

	echo '</div>';


echo '</div>';

/* END OF SOUND GALLERY CONTAINER */

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

	$sounds_gallery_array = get_field("translator_video_gallery", $post_id);

	//if there are some files to delete

	if ($_POST["videos_to_delete"]) {

		$sounds_to_delete_array = explode(',', $_POST["videos_to_delete"]);

		// var_dump($sounds_to_delete_array);

		foreach ($sounds_to_delete_array as $sound_to_delete) :

			$deleted_row_index = $sound_to_delete;

			delete_row('translator_video_gallery', $deleted_row_index, $post_id);

			// print_r("deleted_row_index: ".$deleted_row_index);

			// update_row('translator_video_gallery', $deleted_row_index, false);

			// -1 because acf rows count starts at 1 and array from 0
			// var_dump($sounds_gallery_array[$deleted_row_index - 1]["translator_single_video"]);

			$url = $sounds_gallery_array[$deleted_row_index - 1]["translator_single_video"];
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
			  $sound_url = $movefile["url"];
			  $upload_dir = wp_upload_dir();
			  $image_data = file_get_contents($sound_url);
			  $filename = basename($sound_url);
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

				// var_dump($sounds_gallery_array);

				// var_dump(count($sounds_gallery_array));

			  /*end file uploader*/
		}

	}

	die();

}

/**
* Hook the function that handles the file upload request.
*/
// add_action( 'init', 'handle_video_to_gallery_upload' );

add_action( 'wp_ajax_nopriv_handle_video_to_gallery_upload',  'handle_video_to_gallery_upload' );
add_action( 'wp_ajax_handle_video_to_gallery_upload','handle_video_to_gallery_upload' );

	/* 	Upload video to gallery Form */

	var uploadVideoToGalleryForm = ajax_forms_params.upload_video_to_gallery_form;

	$(uploadVideoToGalleryForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		const videoToGalleryInput = this.querySelector("#video-to-gallery__input");

		// console.log(this);

		var videoGalleryFormData = new FormData(this);

		const progress = this.querySelector(".progress");
		const progressBar = progress.querySelector(".progress-bar");
		const progressPercents = progress.querySelector(".progress-percents");

		$.ajax({
			xhr: function() {
				const xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener(
					"progress",
					function(e) {
						if (e.lengthComputable) {
							const percentComplete = (e.loaded / e.total) * 100;
							console.log(percentComplete);
							progress.classList.add("progress-show");
							progressBar.style.width = percentComplete + "%";
							progressPercents.innerText = Math.round(percentComplete) + "%";
						}
					},
					false
				);
				return xhr;
			},
			url: ajaxurl + "?action=handle_video_to_gallery_upload",
			type: "POST",
			data: videoGalleryFormData,
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
				progress.classList.remove("progress-show");
				// uploadPicturePreview.classList.remove("has-image");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				// const dataJSON = JSON.parse(data);

				// console.log(dataJSON);

				let newlyAddedVideo = $("#newVideoInGalleryPlaceholder").clone();

				newlyAddedVideo
					.css("transform", "scale(0)")
					.css("transition", "all 0.3s ease-in")
					.appendTo(".my-sounds__gallery")
					.attr("id", "newlyAddedVideo");

				setTimeout(function() {
					$("#newlyAddedVideo .remove-item").attr("data-id", data);

					$("#newlyAddedVideo")
						.css("transform", "scale(1)")
						.attr("id", "");
				}, 100);

				$("#newVideoInGalleryPlaceholder").css("display", "none");

				//clear input

				videoToGalleryInput.value = null;

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

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	$("#video-to-gallery__input").change(function(event) {
		$("#newVideoInGalleryPlaceholder").fadeIn(300);
		$("#newVideoInGalleryPlaceholder p").text(event.target.files[0].name);
	});