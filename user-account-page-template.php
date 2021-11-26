<?php

/*
 * Template Name: User Account Page Template
 * description: >-
  Page template without sidebar
 */

 // if post is not published 
$acf_fields_active = false;

get_header();

$fields_for_login_page = get_field("fields_for_login_page", 1705);
$fields_for_login_page_image = $fields_for_login_page['image'];
$fields_for_login_page_paragraph = $fields_for_login_page['paragraph'];

// var_dump($_POST);
// echo '<br>';
// var_dump($_FILES);
?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main account">

		<?php

		if ( !is_user_logged_in() ) {

			vicode_error_messages();

			?>

			<div class="wrapper-flex-drow-mcol login-and-registration login-and-registration__welcome-view">

				<div class="login-and-registration__forms">

					<div class="login-panel sign-in-wrapper form-active form-activated">
						<?php get_template_part( 'template-parts/custom-login-form' ); ?>
						<p id="switch-sign-up" class="text--turquoise fw--500">Nie masz konta? Dołącz do PSTK</p>
					</div>

					<div class="registration-panel sign-up-wrapper form-deactivated">
						<?php echo do_shortcode("[register_form]"); ?>
						<p id="switch-sign-in" class="text--turquoise fw--500">Masz już konto? Zaloguj się</p>
					</div>

				</div>

				<div class="login-and-registration__our-mission">
						<?php
						if ($fields_for_login_page_image) {
							?>
							<div class="image-holder">
								<img src="<?php echo $fields_for_login_page_image['url'] ?>" alt="<?php echo $fields_for_login_page_image['alt'] ?>" loading="lazy">
							</div>
							<?php
						}
						?>
						<h1 class="text--blue fs--1000 fw--900 text--center"><?php echo $fields_for_login_page_paragraph ?></h1>
				</div>

			</div>

			<?php
		}

		if (is_user_logged_in() && current_user_can( 'manage_options' )) {
			echo '<h1>Witaj admin</h1>';
		}
		
		if ( is_user_logged_in() && !current_user_can( 'manage_options' ) ) {


				//User data from wp_usermeta
	
				$current_user = wp_get_current_user();
				$current_user_id = get_current_user_id();
				$current_user_nickname = $current_user->user_login;
				$current_user_login_email = $current_user->user_email;
				$current_user_first_name = $current_user->first_name;
				$current_user_last_name = $current_user->last_name;
	
				$user_post_title = $current_user_nickname; 

				$user_post_id = get_current_user_post_id();

				if ( ! ( $current_user instanceof WP_User ) ) {
					 return;
				} else {

					//ACFs

					$translator_about_short = get_field('translator_about_short', $user_post_id);
					$translator_about = get_field('translator_about', $user_post_id);
					$translator_contact_phone = get_field('translator_contact_phone', $user_post_id);
					$translator_contact_email = get_field('translator_contact_email', $user_post_id);
					$translator_city = get_field('translator_city', $user_post_id);
					$sounds_to_gallery_array = get_field('translator_sound_gallery', $user_post_id);
					$translator_linkedin_link = get_field('translator_linkedin_link', $user_post_id);
					$translator_work = get_field('translator_work', $user_post_id);
					$images_to_gallery_array = get_field('translator_gallery', $user_post_id);
					$videos_to_gallery_array = get_field('translator_video_gallery', $user_post_id);

					// print_r($_POST);
					// print_r($_REQUEST);

					echo '<div class="account__container">';

						echo '<div class="account__side-menu content-box relative">';

							$is_approved = get_post_meta( $user_post_id, 'is_approved', true );
							$account_privacy_status = get_post_status($user_post_id);
							$account_privacy_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/earth.svg');
							
							if ( !$is_approved ) {
								$account_privacy_status_icon = '<div class="account__privacy-status-holder">
																	<div class="icon account__privacy-status account__private w--fit-content">'.$account_privacy_icon.'</div>
																</div>';
							}

							if( $is_approved && $account_privacy_status !== "publish" ) {
								$account_privacy_status_icon = '<div class="account__privacy-status-holder">
																	<div class="icon account__privacy-status account__private w--fit-content">'.$account_privacy_icon.'</div>
																</div>';
							}

							if ( $is_approved && $account_privacy_status == "publish" ) {
								$account_privacy_status_icon = '<div class="account__privacy-status-holder">
																	<div class="icon account__privacy-status account__public w--fit-content">'.$account_privacy_icon.'</div>
																</div>';
							}

							echo '<div class="profile-picture__wrapper ajax-content-wrapper mb--3">';

								echo $account_privacy_status_icon;

								echo '<div class="post-thumbnail">';

									echo '<div class="post-thumbnail__wrapper">';

										echo '<div class="corner__decoration corner__decoration--left"></div>';

									if(wp_get_attachment_image_url(get_post_thumbnail_id($user_post_id))) {
										// pstk_post_thumbnail($user_post_id);
										echo '<img src="'.wp_get_attachment_image_url(get_post_thumbnail_id($user_post_id), "full").'">';
										
									} else {

										echo '<img style="transform: scale(1.1);" src="'.get_stylesheet_directory_uri(). '/dist/dist/img/avatarplaceholder.jpg">';
										
									}

										echo '<div class="account__approval-status-holder">';

											if( $is_approved ) {

												echo '<div class="icon account__approval-status account__approved">
												<svg id="Layer_1" enable-background="new 0 0 511.375 511.375" height="512" viewBox="0 0 511.375 511.375" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m511.375 255.687-57.89-64.273 9.064-86.045-84.65-17.921-43.18-75.011-79.031 35.32-79.031-35.32-43.18 75.011-84.65 17.921 9.063 86.045-57.89 64.273 57.889 64.273-9.063 86.045 84.65 17.921 43.18 75.011 79.031-35.321 79.031 35.321 43.18-75.011 84.65-17.921-9.064-86.045zm-148.497-55.985-128.345 143.792-89.186-89.186 21.213-21.213 66.734 66.734 107.203-120.104z"/></g></svg>
												</div>';

											} else {

												echo '<div class="icon account__approval-status account__not-approved">
												<svg id="Layer_1" enable-background="new 0 0 511.375 511.375" height="512" viewBox="0 0 511.375 511.375" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m511.375 255.687-57.89-64.273 9.064-86.045-84.65-17.921-43.18-75.011-79.031 35.32-79.031-35.32-43.18 75.011-84.65 17.921 9.063 86.045-57.89 64.273 57.889 64.273-9.063 86.045 84.65 17.921 43.18 75.011 79.031-35.321 79.031 35.321 43.18-75.011 84.65-17.921-9.064-86.045zm-148.497-55.985-128.345 143.792-89.186-89.186 21.213-21.213 66.734 66.734 107.203-120.104z"/></g></svg>
												</div>';

											}

										echo '</div>';

										echo '<div class="corner__decoration corner__decoration--right"></div>';

									echo '</div>';

								echo '</div>';

								echo profile_picture_uploader($user_post_id);

							echo '</div>';

							echo '<h3 class="account__user-fullname mb--2">'.$current_user_first_name.' '.$current_user_last_name.'</h3>';

							 echo '<div class="account__navigation">';


								echo '<ul>';

									echo '<li><a href="#profile-section-1" class="button button__outline--blue" data-profile-section="profile-section-1">Edycja Profilu</a></li>';
									echo '<li><a href="#profile-section-2" class="button button__outline--blue" data-profile-section="profile-section-2">Ustawienia</a></li>';
									// echo '<li><a href="#" class="button button__outline--blue" data-profile-section="profile-section-3">Płatności</a></li>';
									echo '<li><a href="#profile-section-3" class="button button__outline--blue" data-profile-section="profile-section-3">Materiały członkowskie</a></li>';
									echo '<li><a href="'.wp_logout_url().'" class="button button__outline--blue logout-link">Wyloguj</a></li>';
								

								echo '</ul>';

							 echo '</div>';

						echo '</div>';

						echo '<div class="account__main">';

							/* PROFILE SECTION 1 - EDIT PROFILE */

							echo '<div id="profile-section-1" class="profile-section profile-section--active account__edit-profile">';

								// WELCOME MESSAGE

								$user_nickname = $current_user->user_login;

								echo '<div class="info-box account__welcome-message">';

									echo '<div class="content-box">
											<div class="info-box">
												<h1>Cześć <span class="account__user-first-name">'.$current_user_first_name.'</span>!</h1>
											</div>';

										$completness_value_class = '';
										$account_fill_completeness_display = '';

										if (get_percent_value_of_account_fill_completness()) {

											echo '<div class="account__fill-completeness-wrapper mb--2'.$account_fill_completeness_display.'">';

												echo '<h3 class="fs--600 fw--500">';
													echo 'Witaj na swoim koncie PSTK.<br />';
													echo 'Twój profil jest kompletny w <span id="accountFillCompletness" class="'.$completness_value_class.'"><span class="text--turquoise" id="percentValueOfAccountFillCompletness">'.get_percent_value_of_account_fill_completness().'</span><span class="text--turquoise">%</span></span>.
													</h3>';

												if (get_percent_value_of_account_fill_completness() < 100) {
													echo '<div id="progressRing"></div>';
												} else {
													echo '<div id="progressRing" class="progress-ring--complete"></div>';
												}

											echo '</div>';

											$empty_fields_status = 'no-empty-fields';

											if (get_percent_value_of_account_fill_completness() < 100) {
												$empty_fields_status = 'empty-fields';
											}
											
											echo '<div id="emptyProfileFieldsLabels" class="empty-profile-fields-wrapper info-box '.$empty_fields_status.'">';

												echo '<span class="fs--600 fw--500 text--blue text--underline-turquoise mb--1" id="fillTheseFields">Uzupełnij go.</span>';

												$empty_field_labels = get_labels_of_empty_translator_fields();

												echo '<div class="empty-fields-labels">
													<p class="fw--500">Nieuzupełnione pola:</p>';
													foreach($empty_field_labels as $label) :
														echo '<p class="empty-field-label">'.$label.'</p>';
													endforeach;
												echo '</div>';

											echo '</div>';
										}

									echo '</div>';

								echo '</div>';

								/* BASIC INFO CONTAINER */

								echo '<div class="info-box basic-info-container">';

									echo '<div class="account__box-container ajax-content-wrapper">';

										/* TITLE & EDIT BUTTON */

										echo '<div class="info-box__header">';

											echo '<p>Podstawowe dane</p>';

											echo '<button data-profile-edit="edit-basic-info" id="button__edit-basic-info" class="button button__edit-account-content">Edytuj</button>';

										echo '</div>';

										/* AJAX LOADER */
										
										echo '<div class="my-ajax-loader">';

											echo '<div class="my-ajax-loader__spinner"></div>';
									
										echo '</div>';

										/* CONTENT BOX */

										echo '<div class="content-box">';

											echo '<div class="info-box__subbox mb--3">';

												echo '<p class="info-box__subbox-header mb--05">Imię</p>';
												echo '<p class="info-box__content account__user-first-name">'.$current_user_first_name .'</p>';

											echo '</div>';

											echo '<div class="info-box__subbox mb--3">';

												echo '<p class="info-box__subbox-header mb--05">Nazwisko</p>';
												echo '<p class="info-box__content account__user-last-name">'.$current_user_last_name .'</p>';

											echo '</div>';

											echo '<div class="info-box__subbox mb--3">';

												if (strlen($translator_about_short) > 0) {
													$placeholder_mode = '';
												} else {
													$translator_about_short = 'Napisz jedno zdanie o sobie';
													$placeholder_mode = 'placeholder_mode';
												}

												echo '<p class="info-box__subbox-header mb--05">Jedno zdanie o mnie</p>';
												echo '<p id="user_about_short_text" class="info-box__content '.$placeholder_mode.'">'.$translator_about_short.'</p>';

											echo '</div>';
											
											echo '<div class="info-box__subbox mb--3">';

												$translator_languages_taxonomy = get_taxonomy( 'translator_language' );

												$translator_languages = get_terms( array(
													'taxonomy' => 'translator_language',
													'hide_empty' => false,
												) );

												$current_user_languages_array_terms = wp_get_post_terms($user_post_id, 'translator_language', array('fields' => 'names'));

												echo '<p class="info-box__subbox-header mb--05">'.$translator_languages_taxonomy->label.'</p>';

												echo '<p id="user_languages_text" class="info-box__content lowercase">';
												
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

												echo '<p class="info-box__subbox-header mb--05">'.$translator_specializations_taxonomy->label.'</p>';

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

										echo '<div id="edit-basic-info" class="edit-box content-box">';

											echo basic_user_data_form();

										echo '</div>';

									echo '</div>';

								echo '</div>';

								/* END OF BASIC INFO CONTAINER */

								/* ABOUT INFO CONTAINER */

								echo '<div class="info-box about-info-container">';



									echo '<div class="account__box-container ajax-content-wrapper">';

										/* EDIT BUTTON */

										echo '<div class="info-box__header">
												<p>O mnie</p>
												<button data-profile-edit="edit-about-info" class="button button__edit-account-content">Edytuj</button>
											  </div>';

										/* AJAX LOADER */

										echo '<div class="my-ajax-loader">';

											echo '<div class="my-ajax-loader__spinner"></div>';
									
										echo '</div>';

										/* CONTENT BOX */

										echo '<div class="content-box ajax-content-wrapper">';

											echo '<div class="info-box__subbox">';

												if (!strlen($translator_about) > 0) {
													$translator_about = 'Napisz o sobie kilka zdań, które pozwolą potencjalnym klientom poznać Cię z najlepszej strony, zrozumieć, w czym masz doświadczenie i co Cię wyróżnia.';
												}

												echo '<p id="user_about_text" class="info-box__content">'.$translator_about.'</p>';

											echo '</div>';

										echo '</div>';

										/* EDIT BOX */

										echo '<div id="edit-about-info" class="edit-box content-box">';

											echo about_user_data_form();

										echo '</div>';

									echo '</div>';

								echo '</div>';

								/* END OF ABOUT INFO CONTAINER */


								/* CONTACT INFO CONTAINER */

								echo '<div class="info-box contact-info-container">';
					
									echo '<div class="account__box-container ajax-content-wrapper">';

										/* EDIT BUTTON */

										echo '<div class="info-box__header">
												<p>Dane kontaktowe</p>
												<button data-profile-edit="edit-contact-info" class="button button__edit-account-content">Edytuj</button>
											  </div>';
										
										/* AJAX LOADER */
										
										echo '<div class="my-ajax-loader">';
										
											echo '<div class="my-ajax-loader__spinner"></div>';
										
										echo '</div>';
										
										/* CONTENT BOX */
										
										echo '<div class="content-box ajax-content-wrapper">';

											echo '<div class="info-box__subbox mb--3">';

												echo '<p class="info-box__subbox-header mb--05">Numer telefonu</p>';
												echo '<p id="user_contact_phone_text" class="info-box__content">'.$translator_contact_phone.'</p>';

											echo '</div>';

											echo '<div class="info-box__subbox mb--3">';

													if (!strlen($translator_contact_email) > 0) {
														$translator_contact_email = $current_user_login_email;
													}

												echo '<p class="info-box__subbox-header mb--05">Adres e-mail</p>';
												echo '<p id="user_contact_email_text" class="info-box__content">'.$translator_contact_email.'</p>';

											echo '</div>';

											echo '<div class="info-box__subbox">';

											$translator_localizations_taxonomy = get_taxonomy( 'translator_localization' );

											//Exclude #user_city from being displayed in the list

											$excluded_term_ID = false;

											if ($translator_city && strlen($translator_city) > 0) {
												$excluded_term = get_term_by( 'name', $translator_city, 'translator_localization' );

												if ( $excluded_term ) {
													$excluded_term_ID = $excluded_term->term_id;
												}

											}

											$translator_localizations = get_terms( array(
												'taxonomy' => 'translator_localization',
												'hide_empty' => false,
												'orderby'    => 'ID',
												'exclude' => ($excluded_term_ID),
											) );

											$current_user_localizations_array_terms = wp_get_post_terms($user_post_id, 'translator_localization', array('fields' => 'names'));

											echo '<p class="info-box__subbox-header mb--05">'.$translator_localizations_taxonomy->label.'</p>';

											echo '<div class="info-box__subbox mb--3">';

												echo '<div class="wrapper-flex-drow-mcol">';

													echo '<p class="wrapper-flex-drow-mcol__first-element info-box__content">Miejsce zamieszkania:</p>';

													echo '<p id="user_city_text" class="info-box__content">'.$translator_city.'</p>';

												echo '</div>';

											echo '</div>';

											echo '<div class="wrapper-flex-drow-mcol">';

												echo '<p class="wrapper-flex-drow-mcol__first-element">Inne lokalizacje:</p>';
										
												echo '<div class="user_localizations__column">';

													if ( $translator_localizations ) {
														foreach( $translator_localizations as $term ) :
																if ($current_user_localizations_array_terms && in_array($term->name, $current_user_localizations_array_terms)) {
																	echo '<p class="user_localization info-box__content mb--1">'.$term->name.'</p>';
																} 
														endforeach;
													}

												echo '</div>';

											echo '</div>';

											echo '</div>';
										
										echo '</div>';
										
										/* EDIT BOX */
										
										echo '<div id="edit-contact-info" class="edit-box content-box">';
										
											echo contact_user_data_form();
										
										echo '</div>';
									
									echo '</div>';

								echo '</div>';

								/* END OF CONTACT INFO CONTAINER */

								/* SOUND GALLERY CONTAINER */

								echo '<div class="info-box sound-gallery-container">';

									echo '<div class="account__box-container">';

										echo '<div class="info-box__header"><p>Próbka głosu</p></div>';

										/* AJAX LOADER */

										echo '<div class="my-ajax-loader">';

											echo '<div class="my-ajax-loader__spinner"></div>';

										echo '</div>';

										/* CONTENT BOX */

										echo '<div class="content-box">';

											echo '<div class="info-box__subbox">';

												$sound_icon = file_get_contents(get_stylesheet_directory_uri().'/dist/dist/svg/radio-waves.svg');

												echo '<div class="my-sounds__wrapper ajax-content-wrapper">';


													echo '<div class="my-sounds__gallery">';

													// var_dump($sounds_to_gallery_array);

													/* DYNAMIC MESSAGES CONTENT HOLDER */

													echo '<div class="is-gallery-empty__messages" style="display: none">';
													echo '<p class="is-gallery-empty__yes mb--2">Aktualnie nie masz dodanych żadnych próbek głosu.</p>';
													echo '<p class="is-gallery-empty__no">Dodane nagrania:</p>';
													echo '</div>';

													if ($sounds_to_gallery_array) {

														echo '<p class="info-box__subbox-header mb--2 is-gallery-empty__status-text-holder">Dodane nagrania:</p>';

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

																echo '<div class="row-wrapper my-sounds__gallery-row-wrapper wrapper-flex-drow-mcol pb--2 mb--2">';
																
																	echo '<a class="remove-item" href="#" data-id="'.$i.'"></a>';

																	echo '<div class="my-sounds__gallery-text-wrapper col-m100-d50 pr--2">';

																		echo '<div class="my-sounds__gallery-attachment--label mb--1">';

																			echo '<p class="fw--500">'.$translator_single_voice_recording_label.'</p>';

																		echo '</div>';

																		echo '<div class="my-sounds__gallery-attachment--description">';

																			echo '<p>'.$translator_single_voice_recording_text.'</p>';

																		echo '</div>';

																	echo '</div>';
																
														
																if($sound_link) {

																	$sound_id = attachment_url_to_postid($sound_link);

																	echo '<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info col-m100-d50">';

																		echo $sound_icon;

																		$sound_name = basename(get_attached_file( $sound_id ));

																		echo '<p class="sound-title">'.$sound_name.'</p>';

																	echo '</div>';
																} 
															
																echo '</div>';

															}

															$i++;

														endforeach;

													} else {

														echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder mb--2">Aktualnie nie masz dodanych żadnych próbek głosu.</p>';
														
													};

													echo '</div>';

													echo gallery_sound_uploader($user_post_id);

													echo '<div id="newSoundInGalleryPlaceholder" class="" style="display:none;" >';

														echo '<a class="remove-item remove" data-id="clear-input" href="#"></a>';

														echo $sound_icon;

														echo '<p></p>';

													echo '</div>';

												echo '</div>';

											echo '</div>';

										echo '</div>';

									echo '</div>';

								echo '</div>';

								/* END OF SOUND GALLERY CONTAINER */


								/* LINKEDIN INFO CONTAINER */

								echo '<div class="info-box linkeding-info-container">';



									echo '<div class="account__box-container ajax-content-wrapper">';

										/* TITLE & EDIT BUTTON */

										echo '<div class="info-box__header">
												<p>Profil LinkedIn</p>
												<button data-profile-edit="edit-linkedin-info" class="button button__edit-account-content">Edytuj</button>
											</div>';

										/* AJAX LOADER */

										echo '<div class="my-ajax-loader">';

											echo '<div class="my-ajax-loader__spinner"></div>';

										echo '</div>';

										/* CONTENT BOX */

										echo '<div class="content-box ajax-content-wrapper">';



											echo '<div class="info-box__subbox mb--3">';

												$linkedin_subheader_text = "Wpisz lub wklej link do profilu LinkedIn";
												$linkedin_subheader_note = "Jeśli nie podasz adresu swojego profilu na LinkedIn, to link do niej nie będzie widoczny na Twoim profilu PSTK.";

												echo '<p class="info-box__content mb--1">'.$linkedin_subheader_text.'</p>';

												echo '<p class="info-box__note">'.$linkedin_subheader_note.'</p>';

											echo '</div>';

											echo '<div class="info-box__subbox">';

												if (strlen($translator_linkedin_link) > 0) {
													$placeholder_mode = '';
												} else {
													$translator_linkedin_link = 'linkedin.com/';
													$placeholder_mode = 'placeholder_mode';
												}

												echo '<p id="user_linkedin_text" class="info-box__content '.$placeholder_mode.'">'.$translator_linkedin_link.'</p>';

											echo '</div>';

										echo '</div>';

										/* EDIT BOX */

										echo '<div id="edit-linkedin-info" class="edit-box content-box">';

											echo '<div class="info-box__subbox mb--2">';

												$linkedin_subheader_text = "Wpisz lub wklej link do profilu LinkedIn";
												$linkedin_subheader_note = "Jeśli nie podasz adresu swojego profilu na LinkedIn, to link do niej nie będzie widoczny na Twoim profilu PSTK.";

												echo '<p class="info-box__content mb--1">'.$linkedin_subheader_text.'</p>';

												echo '<p class="info-box__note">'.$linkedin_subheader_note.'</p>';

											echo '</div>';

											echo linkedin_user_data_form();

										echo '</div>';

									echo '</div>';

								echo '</div>';

								/* END OF LINKEDIN INFO CONTAINER */

								/* WORK INFO CONTAINER */

								echo '<div class="info-box work-info-container">';

									echo '<div class="account__box-container ajax-content-wrapper">';

										/* TITLE & EDIT BUTTON */

										echo '<div class="info-box__header">
												<p>Gdzie najczęściej pracuję?</p>
												<button data-profile-edit="edit-work-info" class="button button__edit-account-content">Edytuj</button>
											</div>';

										/* AJAX LOADER */

										echo '<div class="my-ajax-loader">';

											echo '<div class="my-ajax-loader__spinner"></div>';

										echo '</div>';

										/* CONTENT BOX */

										echo '<div class="content-box ajax-content-wrapper">';

											echo '<div class="info-box__subbox">';

												if (strlen($translator_work) > 0) {
													$placeholder_mode = '';
												} else {
													$translator_work = 'Napisz kilka zdań o tym gdzie najczęściej pracujesz';
													$placeholder_mode = 'placeholder_mode';
												}

												echo '<p id="user_work_text" class="info-box__content '.$placeholder_mode.'">'.$translator_work.'</p>';

											echo '</div>';

										echo '</div>';

										/* EDIT BOX */

										echo '<div id="edit-work-info" class="edit-box content-box">';

											echo work_user_data_form();

										echo '</div>';

									echo '</div>';

								echo '</div>';

								/* END OF work INFO CONTAINER */

								/* PICTURES CONTAINER */

								echo '<div class="info-box pictures-container">';

									echo '<div class="account__box-container">';

										echo '<div class="info-box__header"><p>Zdjęcia</p></div>';
										
										/* AJAX LOADER */

										echo '<div class="my-ajax-loader">
												<div class="my-ajax-loader__spinner"></div>
												<div class="progress">
													<div class="progress-bar"></div>
													<div class="progress-percents"></div>
												</div>
											</div>';

										/* CONTENT BOX */

										echo '<div class="content-box">';

											echo '<div class="info-box__subbox wrapper-flex-drow-mcol w--full">';

											/* IMAGES GALLERY PANEL */

												echo '<div class="my-pictures__wrapper ajax-content-wrapper">';
													
													echo '<div class="my-pictures__gallery">';

														/* DYNAMIC MESSAGES CONTENT HOLDER */

														echo '<div class="is-gallery-empty__messages" style="display: none">';
														echo '<p class="is-gallery-empty__yes">Aktualnie nie masz dodanych żadnych zdjęć.</p>';
														echo '<p class="is-gallery-empty__no">Dodane:</p>';
														echo '</div>';

													if ($images_to_gallery_array) {

														echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder">Dodane:</p>';

														foreach ($images_to_gallery_array as $image) :

																if(wp_get_attachment_image_url(attachment_url_to_postid($image))) {

																	echo '<div class="my-pictures__gallery-attachment pb--2 mb--2">';

																		echo '<div class="image-holder content-center relative">
																				<a class="remove-item" href="#" data-id="'.attachment_url_to_postid($image).'"></a>
																				<img src="'.wp_get_attachment_image_url(attachment_url_to_postid($image), 'full').'" width="" loading="lazy">
																			</div>
																				';

																	echo '</div>';
																} 

														endforeach;

													} else {

														echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder">Aktualnie nie masz dodanych żadnych zdjęć.</p>';
														
													};

													echo '</div>';

													echo gallery_image_uploader($user_post_id);


												echo '</div>';

											echo '</div>';

										echo '</div>';

									echo '</div>';

								echo '</div>';

								/* END OF PICTURES CONTAINER */

								/* VIDEOS CONTAINER */

								echo '<div class="info-box pictures-container">';

									echo '<div class="account__box-container">';

										echo '<div class="info-box__header"><p>Filmy</p></div>';
									
									/* AJAX LOADER */

									echo '<div class="my-ajax-loader">
											<div class="my-ajax-loader__spinner"></div>
											<div class="progress">
												<div class="progress-bar"></div>
												<div class="progress-percents"></div>
											</div>
										</div>';

									/* CONTENT BOX */

									echo '<div class="content-box">';

										echo '<div class="info-box__subbox wrapper-flex-drow-mcol w--full">';

											/* VIDEO GALLERY PANEL */

											echo '<div class="my-videos__wrapper ajax-content-wrapper w--full">';

												echo '<div class="my-videos__gallery">';

													/* DYNAMIC MESSAGES CONTENT HOLDER */

													echo '<div class="is-gallery-empty__messages" style="display: none">';
													echo '<p class="is-gallery-empty__yes">Aktualnie nie masz dodanych żadnych filmów.</p>';
													echo '<p class="is-gallery-empty__no">Dodane:</p>';
													echo '</div>';

												// var_dump($videos_to_gallery_array);

												if ($videos_to_gallery_array) {

													echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder">Dodane:</p>';

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

													echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder">Aktualnie nie masz dodanych żadnych filmów.</p>';
													
												};

												echo '</div>';

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

												echo gallery_video_uploader($user_post_id);

											echo '</div>';

										echo '</div>';

									echo '</div>';

								echo '</div>';

							echo '</div>';

								/* END OF VIDEOS CONTAINER */

							echo '</div>';

							/* END OF PROFILE SECTION 1 */

							/* PROFILE SECTION 2 - SETTINGS */

							echo '<div id="profile-section-2" class="profile-section profile-section--not-active account__settings">';

								echo '<div class="info-box">';
								
									echo '<p class="fw--700 fs--1200 mb--2">Ustawienia</p>';

									echo '<p>Znajdziesz tu ustawienia związane ze swoim kontem</p>';

								echo '</div>';


								/* UPDATE LOGIN EMAIL ADDRESS FORM */

								?>

								<div class="info-box">

									<div class="info-box__header mb--2">
										<p>Adres e-mail</p>
									</div>

									<p class="info-box__tip mb--2">Adres ten służy do logowania do konta PSTK </p>
				
									<div class="info-box__subbox info-box__subbox--max-width account__box-container ajax-content-wrapper mb--3">

										<div class="my-ajax-loader">

											<div class="my-ajax-loader__spinner"></div>

										</div>
				
										<button data-profile-edit="edit-settings-login-email-address" id="button__edit-login_email" class="button button__edit-account-content">Edytuj</button>
				
										<p id="user_current_login_email" class="content-box info-box__content">
											<?php
												echo $current_user_login_email;
											?>
										</p>

										<div id="edit-settings-login-email-address" class="edit-box info-box content-box">

											<?php echo settings_user_login_email_form(); ?>
				
										</div>
				
									</div>
				
								</div>

								<?php
								
								/* UPDATE LOGIN EMAIL ADDRESS FORM  */

								?>

								<div class="info-box">

									<div class="info-box__header mb--2">
										<p>Hasło</p>
									</div>

									<p class="info-box__tip mb--2">Hasło służy do logowania do konta PSTK. Musi zawierać minimum 8 znaków, w tym jedną wielką literę i jeden znak specjalny.</p>


									<div class="info-box__subbox mb--3 info-box__subbox--max-width mb--3 account__box-container ajax-content-wrapper">

										<div class="my-ajax-loader">

											<div class="my-ajax-loader__spinner"></div>

										</div>

										<button data-profile-edit="edit-settings-password" id="button__edit-basic-info" class="button button__edit-account-content">Edytuj</button>

										<div id="user_current_password" class="content-box info-box__content">
											<?php

												// show any error messages after form submission

													$errors = vicode_errors()->get_error_messages();

													// var_dump($errors);
													
													if (isset( $_POST['submit_user_new_password']) && empty($errors)) {
														echo '<p class="php-success__text">Hasło zostało zmienione</p>';
													} 


													if(!empty($errors)) {

														echo '<div class="php-error__content show__only-in-modal">';

														foreach($errors as $error) :

															echo '<p class="php-error__text show-in-modal">'.$error.'</p>';

														endforeach;

														echo '</div>';

														//clear $_POST so ajax forms can still work after error occured
														$_POST = array();
													}

												echo '<p>***********</p>';
											?>
										</div>

										<div id="edit-settings-password" class="edit-box content-box">

											<?php echo settings_user_password_form(); ?>

										</div>

									</div>

								</div>

								<?php
								
								/* UPDATE VISIBILITY SETTINGS  */

								?>

								<div class="info-box">

									<div class="info-box__header mb--2"><p>Widoczność profilu</p></div>

									<div class="info-box__subbox mb--3 content-box account__box-container info-box__subbox--max-width mb--3 ajax-content-wrapper">

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

							/* END OF PROFILE SECTION 2 */

							/* PROFILE SECTION 3 - DOWNLOADS */

							echo '<div id="profile-section-3" class="profile-section profile-section--not-active account__downloads">';

								echo '<div class="info-box">';

									echo '<div>';
									
										echo '<p class="fw--700 fs--1200 mb--2">Materiały członkowskie</p>';

									echo '</div>';

									echo '<div class="account__subheader">';
									
										echo '<p>Znajdziesz tu materiały bonusowe tylko dla członków oraz materiały poufne, których zasięg ograniczamy do osób zrzeszonych w PSTK.</p>';

									echo '</div>';

								echo '</div>';

								if ( !$is_approved ) :

									echo '<p class="text--blue fw--500">Materiały pojawią się gdy Twoje konto zostanie zweryfikowane.</p>';

								endif;

								if ( $is_approved ) :

								/* UPDATE LOGIN EMAIL ADDRESS FORM */

								?>

								<div class="info-box membership_package">

									<div class="info-box__header mb--2">
										<p class="fw--700 fs--800">Pakiet członkowski</p>
									</div>
									<!-- <p class="info-box__tip"></p> -->
				
									<div class="info-box__subbox mb--3">

									<ul class="membership_package__list">

										<?php

										/* Query membership_package posts in given order  */

										$membership_package_args = array(
										'post_type' => 'membership_package',
										'orderby' => 'date',
										);

										// var_dump($membership_package_args);

										$membership_package_query = new WP_Query($membership_package_args);

										if ($membership_package_query->have_posts()) {
											while ($membership_package_query->have_posts()) {
												$membership_package_query->the_post();

												$membership_package_file = get_field('membership_package_file', $post->ID);

												if ($membership_package_file) {

													echo '<li class="mb--2">';

														echo '<div class="membership_package__label">'.get_the_title().'</div>';

														echo '<a href="'.$membership_package_file['url'].'" class="button button__filled--blue button--download fs--200" download>Pobierz</a>';

													echo '</li>';

												}

											}
										}

										?>

									</ul>

									</div>
				
								</div>

								<div class="info-box">

									<div class="info-box__header mb--2">
										<p class="fw--700 fs--800">Poufne materiały - tylko dla członków</p>
									</div>

									<!-- <p class="info-box__tip"></p> -->

									<div class="info-box__subbox mb--3 wrapper-flex-wrap">

											<?php

											/* Query membership_package posts in given order  */

											$secret_posts_args = array(
											'post_type' => 'secret_posts',
											'orderby' => 'date',
											);

											// var_dump($membership_package_args);

											$secret_posts_query = new WP_Query($secret_posts_args);

											if ($secret_posts_query->have_posts()) {

												echo '<div class="blog-posts-grid">';

													while ($secret_posts_query->have_posts()) {
														$secret_posts_query->the_post();

														get_template_part( 'template-parts/content', 'post-in-archive' );

													}

												echo '</div>';
											}

											?>
									</div>

								</div>

								<div class="info-box">

									<div class="info-box__header mb--2">
										<p class="fw--700 fs--800">Wsparcie marketingowe</p>
									</div>

									<!-- <p class="info-box__tip"></p> -->

									<div class="info-box__subbox mb--3 wrapper-flex-wrap">

									<?php

									/* Query membership_package posts in given order  */

									$marketing_support_args = array(
									'post_type' => 'marketing_support',
									'orderby' => 'date',
									);

									// var_dump($membership_package_args);

									$marketing_support_query = new WP_Query($marketing_support_args);

									if ($marketing_support_query->have_posts()) {

										echo '<div class="blog-posts-grid">';

										while ($marketing_support_query->have_posts()) {
											$marketing_support_query->the_post();

											get_template_part( 'template-parts/content', 'post-in-archive' );

										}

										echo '</div>';
									}

									?>
									</div>

								</div>

								<?php

								endif;
								
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