<?php

/*
 * Template Name: User Account Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

// var_dump($_POST);
// echo '<br>';
// var_dump($_FILES);
?>

	

	<div id="primary" class="content-area">
		<main id="main" class="site-main account">

		<?php

		if ( !is_user_logged_in() ) {
			?>

			<div class="login-and-registration login-and-registration__welcome-view">

				<div class="login-and-registration__forms">

					<div class="login-panel">
						<?php get_template_part( 'template-parts/custom-login-form' ); ?>
					</div>

					<div class="registration-panel">
						<?php echo do_shortcode("[register_form]"); ?>
					</div>

				</div>

				<div class="login-and-registration__our-mission">
						<h1>Nasza misja</h1>
				</div>

			</div>

			<?php
		} else {

			?>
				<a class="logout-link" href="<?php echo wp_logout_url() ?>">Wyloguj</a>
			<?php

				//User data from wp_usermeta
	
				$current_user = wp_get_current_user();
				$current_user_id = get_current_user_id();
				$current_user_nickname = $current_user->user_login;
				$current_user_login_email = $current_user->user_email;
	
				$user_post_title = $current_user_nickname; 
	
				if ( $post = get_page_by_path( $user_post_title, OBJECT, 'translator' ) )
					$user_post_id = $post->ID;
				else
					$user_post_id = 0;


				//User data from user post ACF's

				$translator_first_name = get_field("translator_first_name", $user_post_id);
				$translator_last_name = get_field("translator_last_name", $user_post_id);
	
				if ( ! ( $current_user instanceof WP_User ) ) {
					 return;
				} else {

					// print_r($_POST);
					// print_r($_REQUEST);

					echo '<div class="account__container">';

						echo '<div class="account__side-menu">';

							echo '<div class="profile-picture__wrapper ajax-content-wrapper">';

								if(wp_get_attachment_image_url(get_post_thumbnail_id($user_post_id))) {
									pstk_post_thumbnail($user_post_id);
								} else {
									echo '<div class="post-thumbnail">';
									echo '<img src="'.get_stylesheet_directory_uri(). '/dist/dist/img/avatarplaceholder.jpg">';
									
									
									echo '</div>';
								}

								echo profile_picture_uploader($user_post_id);

								echo '<div class="my-ajax-loader">';

									echo '<div class="my-ajax-loader__spinner"></div>';
									
						
								echo '</div>';

							echo '</div>';

							echo '<h3 class="account__user-name">'.$translator_first_name.' '.$translator_last_name.'</h3>';

							 echo '<div class="account__navigation">';

								echo '<ul>';

									echo '<li><a href="#" data-profile-section="profile-section-1">Edycja Profilu</a></li>';
									echo '<li><a href="#" data-profile-section="profile-section-2">Ustawienia</a></li>';
									echo '<li><a href="#" data-profile-section="profile-section-3">Płatności</a></li>';
									echo '<li><a href="#" data-profile-section="profile-section-4">Materiały tylko dla członków PSTK</a></li>';

								echo '</ul>';

							 echo '</div>';

						echo '</div>';

						echo '<div class="account__main">';

							echo '<div id="profile-section-1" class="profile-section profile-section--active account__edit-profile">';

								echo '<div class="account__welcome-message account__header">';

								$user_nickname = $current_user->user_login;

								echo '<p>Cześć '.$user_nickname.'</p>';

								echo '</div>';

								/* BASIC INFO CONTAINER */

								echo '<div class="account__box-container ajax-content-wrapper">';

									/* EDIT BUTTON */

									echo '<button data-profile-edit="edit-basic-info" id="button__edit-basic-info" class="button button__edit-account-content"></button>';

									/* AJAX LOADER */
									
									echo '<div class="my-ajax-loader">';

										echo '<div class="my-ajax-loader__spinner"></div>';
								
									echo '</div>';

									/* CONTENT BOX */

									echo '<div class="content-box info-box">';

										echo '<div><p class="info-box__header">Podstawowe dane</p></div>';

										echo '<div class="info-box__subbox">';

											if (strlen(get_field('translator_bio')) > 0) {
												$translator_bio = get_field('translator_bio');
												$placeholder_mode = '';
											} else {
												$translator_bio = 'Napisz jedno zdanie o sobie';
												$placeholder_mode = 'placeholder_mode';
											}

											echo '<p id="user_bio_text" class="info-box__content '.$placeholder_mode.'">'.$translator_bio.'</p>';

										echo '</div>';
										
										echo '<div class="info-box__subbox">';

											$translator_languages_taxonomy = get_taxonomy( 'translator_language' );

											$translator_languages = get_terms( array(
												'taxonomy' => 'translator_language',
												'hide_empty' => false,
											) );

											$current_user_languages_array_terms = wp_get_post_terms($user_post_id, 'translator_language', array('fields' => 'names'));

											echo '<p class="info-box__subbox-header">'.$translator_languages_taxonomy->label.'</p>';

											echo '<p id="user_languages_text" class="info-box__content">';
											
											if ( $translator_languages ) {
												foreach( $translator_languages as $term ) :
														if ($current_user_languages_array_terms && in_array($term->name, $current_user_languages_array_terms)) {
															echo $term->name;
															echo ", ";
														} 
												endforeach;
											}
											
											echo '</p>';

										echo '</div>';

										echo '<div class="info-box__subbox">';

											$translator_specializations_taxonomy = get_taxonomy( 'translator_specialization' );

											$translator_specializations = get_terms( array(
												'taxonomy' => 'translator_specialization',
												'hide_empty' => false,
											) );

											$current_user_specializations_array_terms = wp_get_post_terms($user_post_id, 'translator_specialization', array('fields' => 'names'));

											echo '<p class="info-box__subbox-header">'.$translator_specializations_taxonomy->label.'</p>';

											echo '<p id="user_specializations_text" class="info-box__content">';
											
											if ( $translator_specializations ) {
												foreach( $translator_specializations as $term ) :
														if ($current_user_specializations_array_terms && in_array($term->name, $current_user_specializations_array_terms)) {
															echo $term->name;
															echo ", ";
														} 
												endforeach;
											}
											
											echo '</p>';

										echo '</div>';


									echo '</div>';

									/* EDIT BOX */

									echo '<div id="edit-basic-info" class="edit-box info-box">';

										echo '<div><p class="info-box__header">Podstawowe dane - edycja</p></div>';

										echo basic_user_data_form();


									echo '</div>';

								echo '</div>';

								/* END OF BASIC INFO CONTAINER */


								/* ABOUT INFO CONTAINER */

								echo '<div class="account__box-container ajax-content-wrapper">';

									/* EDIT BUTTON */

									echo '<button data-profile-edit="edit-about-info" class="button button__edit-account-content"></button>';

									/* AJAX LOADER */

									echo '<div class="my-ajax-loader">';

										echo '<div class="my-ajax-loader__spinner"></div>';
								
									echo '</div>';

									/* CONTENT BOX */

									echo '<div class="content-box info-box ajax-content-wrapper">';

										echo '<div><p class="info-box__header">O mnie</p></div>';

										echo '<div class="info-box__subbox">';

											if (strlen(get_field("translator_about")) > 0) {
												$translator_about = get_field("translator_about");
												$placeholder_mode = '';
											} else {
												$translator_about = 'Napisz o sobie kilka zdań, które pozwolą potencjalnym klientom poznać Cię z najlepszej strony, zrozumieć, w czym masz doświadczenie i co Cię wyróżnia.';
												$placeholder_mode = 'placeholder_mode';
											}

											echo '<p id="user_about_text" class="info-box__content '.$placeholder_mode.'">'.$translator_about.'</p>';

										echo '</div>';

									echo '</div>';

									/* EDIT BOX */

									echo '<div id="edit-about-info" class="edit-box info-box">';

										echo '<div><p class="info-box__header">O mnie - edycja</p></div>';

										echo about_user_data_form();

									echo '</div>';

								echo '</div>';

								/* END OF ABOUT INFO CONTAINER */


								/* CONTACT INFO CONTAINER */

								echo '<div id="contact-info-container" class="account__box-container ajax-content-wrapper">';

								/* EDIT BUTTON */
								
								echo '<button data-profile-edit="edit-contact-info" class="button button__edit-account-content"></button>';
								
								/* AJAX LOADER */
								
								echo '<div class="my-ajax-loader">';
								
									echo '<div class="my-ajax-loader__spinner"></div>';
								
								echo '</div>';
								
								/* CONTENT BOX */
								
								echo '<div class="content-box info-box ajax-content-wrapper">';
								
									echo '<div><p class="info-box__header">Dane kontaktowe</p></div>';

									echo '<div class="info-box__subbox">';

											

											if (strlen(get_field("translator_contact_phone")) > 0) {
												$translator_contact_phone = get_field("translator_contact_phone");
												$placeholder_mode = '';
											} else {
												$translator_contact_phone = '+48 123 456 789';
												$placeholder_mode = 'placeholder_mode';
											}


										echo '<p id="user_contact_phone_text" class="info-box__content '.$placeholder_mode.'">'.$translator_contact_phone.'</p>';

									echo '</div>';

									echo '<div class="info-box__subbox">';

											if (strlen(get_field("translator_contact_email")) > 0) {
												$translator_contact_email = get_field("translator_contact_email");
												$placeholder_mode = '';
											} else {
												$translator_contact_email = $current_user_login_email;
												$placeholder_mode = 'placeholder_mode';
											}

										echo '<p id="user_contact_email_text" class="info-box__content '.$placeholder_mode.'">'.$translator_contact_email.'</p>';

									echo '</div>';

									echo '<div class="info-box__subbox">';

									$translator_localizations_taxonomy = get_taxonomy( 'translator_localization' );

									//Exclude #user_city from being displayed in the list

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

									$current_user_localizations_array_terms = wp_get_post_terms($user_post_id, 'translator_localization', array('fields' => 'names'));

									echo '<p class="info-box__subbox-header">'.$translator_localizations_taxonomy->label.'</p>';

									echo '<div class="wrapper-flex-drow-mcol">';

										echo '<p class="wrapper-flex-drow-mcol__first-element info-box__content">Miasto zamieszkania</p>';

										echo '<p id="user_city_text" class="info-box__content">'.get_field("translator_city").'</p>';

									echo '</div>';

									echo '<div class="wrapper-flex-drow-mcol">';

										echo '<p class="wrapper-flex-drow-mcol__first-element">Inne lokalizacje</p>';
								
										echo '<div class="user_localizations__column">';

											if ( $translator_localizations ) {
												foreach( $translator_localizations as $term ) :
														if ($current_user_localizations_array_terms && in_array($term->name, $current_user_localizations_array_terms)) {
															echo '<p class="user_localization info-box__content">'.$term->name.'</p>';
														} 
												endforeach;
											}

										echo '</div>';

									echo '</div>';

									echo '</div>';
								
								echo '</div>';
								
								/* EDIT BOX */
								
								echo '<div id="edit-contact-info" class="edit-box info-box">';
								
									echo '<div><p class="info-box__header">Dane kontaktowe - edycja</p></div>';
								
									echo contact_user_data_form();
								
								echo '</div>';
								
								echo '</div>';

								/* END OF CONTACT INFO CONTAINER */


								/* SOUND GALLERY CONTAINER */

								echo '<div class="account__box-container">';

									/* CONTENT BOX */

									echo '<div class="content-box info-box">';

										echo '<div><p class="info-box__header">Próbka głosu</p></div>';

										echo '<div class="info-box__subbox">';

											$sounds_to_gallery_array = get_field('translator_sound_gallery');

											echo '<div class="my-sounds__wrapper ajax-content-wrapper">';

												/* AJAX LOADER */

												echo '<div class="my-ajax-loader">';

													echo '<div class="my-ajax-loader__spinner"></div>';

												echo '</div>';

												echo '<p class="info-box__subbox-header">Wybierz tekst i dodaj nagranie</p>';
												
												echo '<div class="my-sounds__gallery">';

												// var_dump($sounds_to_gallery_array);

												if ($sounds_to_gallery_array) {

													//start at 1 because acf repeater rows indexes start with 1

													$i = 1;

													foreach ($sounds_to_gallery_array as $sound) :

														$translator_single_voice_recording_label = $sound["translator_single_voice_recording_label"];
														$translator_single_voice_recording_text = $sound["translator_single_voice_recording_text"];
														$sound_link = $sound['translator_single_voice_recording'];



														if ( $translator_single_voice_recording_label != "" || $translator_single_voice_recording_text != "" || $sound_link) {

															// echo '$translator_single_voice_recording_label: '.$translator_single_voice_recording_label;
															// echo  '$translator_single_voice_recording_text: '. $translator_single_voice_recording_text;
															// echo '$sound_link: '.$sound_link;


															echo '<div class="row-wrapper my-sounds__gallery-row-wrapper wrapper-flex-drow-mcol">';
															
																echo '<a class="remove-item" href="#" data-id="'.$i.'"></a>';

																echo '<div class="my-sounds__gallery-text-wrapper col-d50">';

																	echo '<div class="my-sounds__gallery-attachment--label">';

																		echo '<p>'.$translator_single_voice_recording_label.'</p>';

																	echo '</div>';

																	echo '<div class="my-sounds__gallery-attachment--description">';

																		echo '<p>'.$translator_single_voice_recording_text.'</p>';

																	echo '</div>';

																echo '</div>';
															
														


															if($sound_link) {

																$sound_id = attachment_url_to_postid($sound_link);

																echo '<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info col-d50">';


																	echo '<svg viewBox="0 0 384 384" xmlns="http://www.w3.org/2000/svg">
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
														
															echo '</div>';

														}

														$i++;

													endforeach;

												} else {

													echo '<p>Aktualnie nie masz dodanych żadnych próbek głosu.</p>';
													
												};

												echo '</div>';

												echo gallery_sound_uploader($user_post_id);

												echo '<div id="newSoundInGalleryPlaceholder" class="my-sounds__gallery-attachment" style="display:none;" >';

													echo '<a class="remove-item remove" data-id="clear-input" href="#"></a>';

													echo '<svg viewBox="0 0 384 384" xmlns="http://www.w3.org/2000/svg">
													<path d="m176 288c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-192c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
													<path d="m16 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
													<path d="m152 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
													<path d="m80 240c8.832031 0 16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16zm0 0"/>
													<path d="m264 256v-128c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v128c0 8.832031 7.167969 16 16 16s16-7.167969 16-16zm0 0"/>
													<path d="m368 96c-8.832031 0-16 7.167969-16 16v160c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-160c0-8.832031-7.167969-16-16-16zm0 0"/>
													<path d="m304 144c-8.832031 0-16 7.167969-16 16v64c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-64c0-8.832031-7.167969-16-16-16zm0 0"/>
													<path d="m176 368c0 8.832031 7.167969 16 16 16s16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16zm0 0"/>
													<path d="m192 48c8.832031 0 16-7.167969 16-16v-16c0-8.832031-7.167969-16-16-16s-16 7.167969-16 16v16c0 8.832031 7.167969 16 16 16zm0 0"/></svg>';

													echo '<p></p>';

												echo '</div>';

											echo '</div>';

										echo '</div>';

									echo '</div>';


								echo '</div>';

								/* END OF SOUND GALLERY CONTAINER */


								/* LINKEDIN INFO CONTAINER */

								echo '<div class="account__box-container ajax-content-wrapper">';

									/* EDIT BUTTON */

									echo '<button data-profile-edit="edit-linkedin-info" class="button button__edit-account-content"></button>';

									/* AJAX LOADER */

									echo '<div class="my-ajax-loader">';

										echo '<div class="my-ajax-loader__spinner"></div>';

									echo '</div>';

									/* CONTENT BOX */

									echo '<div class="content-box info-box ajax-content-wrapper">';

										echo '<div><p class="info-box__header">Profil LinkedIn</p></div>';

										echo '<div class="info-box__subbox">';

											$linkedin_subheader_text = "Wpisz lub wklej link do profilu LinkedIn";
											$linkedin_subheader_note = "Jeśli nie podasz adresu swojego profilu na LinkedIn, to link do niej nie będzie widoczny na Twoim profilu PSTK.";

											echo '<p class="info-box__content">'.$linkedin_subheader_text.'</p>';

											echo '<p class="info-box__note">'.$linkedin_subheader_note.'</p>';

										echo '</div>';

										echo '<div class="info-box__subbox">';

											if (strlen(get_field("translator_linkedin_link")) > 0) {
												$translator_linkedin_link = get_field("translator_linkedin_link");
												$placeholder_mode = '';
											} else {
												$translator_linkedin_link = 'linkedin.com/';
												$placeholder_mode = 'placeholder_mode';
											}

											echo '<p id="user_linkedin_text" class="info-box__content '.$placeholder_mode.'">'.$translator_linkedin_link.'</p>';

										echo '</div>';

									echo '</div>';

									/* EDIT BOX */

									echo '<div id="edit-linkedin-info" class="edit-box info-box">';

										echo '<div><p class="info-box__header">Profil LinkedIn - edycja</p></div>';

										echo '<div class="info-box__subbox">';

											$linkedin_subheader_text = "Wpisz lub wklej link do profilu LinkedIn";
											$linkedin_subheader_note = "Jeśli nie podasz adresu swojego profilu na LinkedIn, to link do niej nie będzie widoczny na Twoim profilu PSTK.";

											echo '<p class="info-box__content">'.$linkedin_subheader_text.'</p>';

											echo '<p class="info-box__note">'.$linkedin_subheader_note.'</p>';

										echo '</div>';

										echo linkedin_user_data_form();

									echo '</div>';

								echo '</div>';

								/* END OF LINKEDIN INFO CONTAINER */

								/* WORK INFO CONTAINER */

								echo '<div class="account__box-container ajax-content-wrapper">';

									/* EDIT BUTTON */

									echo '<button data-profile-edit="edit-work-info" class="button button__edit-account-content"></button>';

									/* AJAX LOADER */

									echo '<div class="my-ajax-loader">';

										echo '<div class="my-ajax-loader__spinner"></div>';

									echo '</div>';

									/* CONTENT BOX */

									echo '<div class="content-box info-box ajax-content-wrapper">';

										echo '<div><p class="info-box__header">Gdzie najczęściej pracuję?</p></div>';

										echo '<div class="info-box__subbox">';

											if (strlen(get_field("translator_work")) > 0) {
												$translator_work = get_field("translator_work");
												$placeholder_mode = '';
											} else {
												$translator_work = 'Napisz kilka zdań o tym gdzie najczęściej pracujesz';
												$placeholder_mode = 'placeholder_mode';
											}

											echo '<p id="user_work_text" class="info-box__content '.$placeholder_mode.'">'.$translator_work.'</p>';

										echo '</div>';

									echo '</div>';

									/* EDIT BOX */

									echo '<div id="edit-work-info" class="edit-box info-box">';

										echo '<div><p class="info-box__header">Gdzie najczęściej pracuję? - edycja</p></div>';

										echo work_user_data_form();

									echo '</div>';

								echo '</div>';

								/* END OF work INFO CONTAINER */



								/* PICTURES AND VIDEOS CONTAINER */

								echo '<div class="account__box-container">';

									/* CONTENT BOX */

									echo '<div class="content-box info-box">';

										echo '<div><p class="info-box__header">Zdjęcia i filmy</p></div>';

										echo '<div class="info-box__subbox wrapper-flex-drow-mcol">';

										/* IMAGES GALLERY PANEL */

										$images_to_gallery_array = get_field('translator_gallery');

											echo '<div class="my-pictures__wrapper ajax-content-wrapper col-d50">';

												/* AJAX LOADER */

												echo '<div class="my-ajax-loader">';

													echo '<div class="my-ajax-loader__spinner"></div>';
		
												echo '</div>';

												echo '<p class="info-box__subbox-header">Zdjęcia</p>';
												
												echo '<div class="my-pictures__gallery">';

												if ($images_to_gallery_array) {

													foreach ($images_to_gallery_array as $image) :

															if(wp_get_attachment_image_url(attachment_url_to_postid($image))) {

																echo '<div class="my-pictures__gallery-attachment">';

																	echo '<a class="remove-item" href="#" data-id="'.attachment_url_to_postid($image).'"></a>';

																	echo '<img src="'.wp_get_attachment_image_url(attachment_url_to_postid($image), 'full').'" width="">';

																echo '</div>';
															} 

													endforeach;

												} else {

													echo '<p>Aktualnie nie masz dodanych żadnych zdjęć do galerii</p>';
													
												};

												echo '</div>';

												echo gallery_image_uploader($user_post_id);


											echo '</div>';

											/* VIDEO GALLERY PANEL */

											$videos_to_gallery_array = get_field('translator_video_gallery');

											echo '<div class="my-videos__wrapper ajax-content-wrapper col-d50">';

												/* AJAX LOADER */

												echo '<div class="my-ajax-loader">';

													echo '<div class="my-ajax-loader__spinner"></div>';
		
												echo '</div>';

												echo '<p class="info-box__subbox-header">Filmy</p>';
												
												echo '<div class="my-videos__gallery">';

												// var_dump($videos_to_gallery_array);

												if ($videos_to_gallery_array) {

													//start at 1 because acf repeater rows indexes start with 1

													$i = 1;

													foreach ($videos_to_gallery_array as $video) :

															$video_link = $video['translator_single_video'];

															if($video_link) {

																$video_id = attachment_url_to_postid($video_link);

																echo '<div class="my-videos__gallery-attachment">';

																	echo '<a class="remove-item" href="#" data-id="'.$i.'"></a>';

																	echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
																	viewBox="0 0 298 298" style="enable-background:new 0 0 298 298;" xml:space="preserve">
															   		<path d="M298,33c0-13.255-10.745-24-24-24H24C10.745,9,0,19.745,0,33v232c0,13.255,10.745,24,24,24h250c13.255,0,24-10.745,24-24V33
																   z M91,39h43v34H91V39z M61,259H30v-34h31V259z M61,73H30V39h31V73z M134,259H91v-34h43V259z M123,176.708v-55.417
																   c0-8.25,5.868-11.302,12.77-6.783l40.237,26.272c6.902,4.519,6.958,11.914,0.056,16.434l-40.321,26.277
																   C128.84,188.011,123,184.958,123,176.708z M207,259h-43v-34h43V259z M207,73h-43V39h43V73z M268,259h-31v-34h31V259z M268,73h-31V39
																   h31V73z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';

																	$video_name = basename(get_attached_file( $video_id ));

																	echo '<p>'.$video_name.'</p>';

																echo '</div>';
															} 

															$i++;

													endforeach;

												} else {

													echo '<p>Aktualnie nie masz dodanych żadnych filmów w galerii</p>';
													
												};

												echo '</div>';

												echo gallery_video_uploader($user_post_id);

												echo '<div id="newVideoInGalleryPlaceholder" class="my-videos__gallery-attachment" style="display:none;" >';

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

								/* END OF PICTURES AND VIDEOS CONTAINER */

							echo '</div>';


							/* END OF profile-section-1 */

							echo '<div id="profile-section-2" class="profile-section profile-section--not-active account__settings">';

								echo '<div class="account__header">';
								
									echo '<p>Edycja ustawień</p>';

								echo '</div>';


								/* UPDATE LOGIN EMAIL ADDRESS FORM */

								?>

								<div class="info-box">

									<p class="info-box__header">Adres e-mail</p>
									<p class="info-box__tip">Adres ten wyświetla się na Twoim profilu i służy do logowania do konta PSTK </p>
				
				
									<div class="info-box__subbox info-box__single-setting account__box-container ajax-content-wrapper">

										<div class="my-ajax-loader">

											<div class="my-ajax-loader__spinner"></div>

										</div>
				
										<button data-profile-edit="edit-settings-login-email-address" id="button__edit-login_email" class="button button__edit-account-content"></button>
				
										<p id="user_current_login_email" class="content-box info-box__content">
											<?php
												echo $current_user_login_email;
											?>
										</p>

										<div id="edit-settings-login-email-address" class="edit-box info-box">

											<?php echo settings_user_login_email_form(); ?>
				
										</div>
				
									</div>
				
								</div>

								<?php
								
								/* UPDATE LOGIN EMAIL ADDRESS FORM  */

								?>

								<div class="info-box">

									<p class="info-box__header">Hasło</p>
									<p class="info-box__tip">Hasło służy do logowania do konta PSTK. Musi zawierać minimum 8 znaków, w tym jedną wielką literę i jeden znak specjalny.</p>


									<div class="info-box__subbox info-box__single-setting account__box-container ajax-content-wrapper">

										<div class="my-ajax-loader">

											<div class="my-ajax-loader__spinner"></div>

										</div>

										<button data-profile-edit="edit-settings-password" id="button__edit-basic-info" class="button button__edit-account-content"></button>

										<div class="content-box info-box__content">
											<?php

												// show any error messages after form submission

													$errors = vicode_errors()->get_error_messages();

													// var_dump($errors);
													
													if (isset( $_POST['submit_user_new_password']) && empty($errors)) {
														echo '<p class="php-success__text">Hasło zostało zmienione</p>';
													} else {

														echo '<div class="php-error__content">';

														foreach($errors as $error) :

															echo '<p>'.$error.'</p>';

														endforeach;

														echo '</div>';
													}

												echo '<p>***********</p>';
											?>
										</div>

										<div id="edit-settings-password" class="edit-box info-box">

											<?php echo settings_user_password_form(); ?>

										</div>

									</div>

								</div>

								<?php
								
								/* UPDATE VISIBILITY SETTINGS  */

								?>

								<div class="info-box">

									<div><p class="info-box__header">Widoczność profilu</p></div>

									<div class="info-box__subbox account__box-container info-box__single-setting ajax-content-wrapper">

										<div class="my-ajax-loader">

											<div class="my-ajax-loader__spinner"></div>

										</div>

										<?php
										
										echo settings_user_data_visibility_form();
										
										?>

									</div>

								</div>

								<?php



							echo '</div>';


						echo '</div>';

					echo '</div>';
				}
		}

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();