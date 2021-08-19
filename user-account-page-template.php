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

											if (strlen(get_field('translator_bio_acf')) > 0) {
												$translator_bio = get_field('translator_bio_acf');
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
												$translator_contact_email = 'przykladowy@mail.pl';
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

								/* work INFO CONTAINER */

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

								echo '<div class="account__box-container ajax-content-wrapper">';

									/* EDIT BUTTON */

									echo '<button data-profile-edit="edit-gallery-info" class="button button__edit-account-content"></button>';

									/* AJAX LOADER */

									echo '<div class="my-ajax-loader">';

										echo '<div class="my-ajax-loader__spinner"></div>';

									echo '</div>';

									/* CONTENT BOX */

									echo '<div class="content-box info-box">';

										echo '<div><p class="info-box__header">Zdjęcia i filmy</p></div>';

										echo '<div class="info-box__subbox wrapper-flex-drow-mcol">';

										$images_to_gallery_array = get_field('translator_gallery');

											echo '<div class="my-pictures__wrapper">';

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

												echo '<div id="newImageInGalleryPlaceholder" class="my-pictures__gallery-attachment" style="display:none;" >';

													echo '<a class="remove-item remove" data-id="clear-input" href="#"></a>';

													echo '<img src="" width=""/>';

												echo '</div>';

											echo '</div>';

											echo '<div class="my-videos__wrapper">';

												echo '<p class="info-box__subbox-header ">Filmy</p>';

												//Video gallery panel

											echo '</div>';

										echo '</div>';

									echo '</div>';

									/* EDIT BOX */

									// echo '<div id="edit-gallery-info" class="edit-box info-box">';

									// 	echo '<div><p class="info-box__header">Zdjęcia i filmy - edycja</p></div>';

									// 	echo gallery_image_uploader($user_post_id);

									// echo '</div>';

								echo '</div>';

								/* END OF PICTURES AND VIDEOS CONTAINER */




							echo '</div>';
							/* END OF profile-section-1 */

							echo '<div id="profile-section-2" class="profile-section profile-section--not-active account__settings">';

								echo '<div class="account__header">';
								
								echo '<p>Edycja ustawień</p>';
								
								echo '</div>';

								echo '<div class="content-box info-box">';

									echo '<div><p class="info-box__header">Adres e-mail</p></div>';
									echo '<div><p class="info-box__subheader">Adres ten wyświetla się na profilu i służy do logowania do konta PSTK</p></div>';

								echo '</div>';

								echo '<div class="content-box info-box">';

									echo '<div><p class="info-box__header">Widoczność profilu</p></div>';

									echo '<div class="info-box__subbox">';

											echo '<ul class="options">';

												echo '<li>';

													echo '<form name="settings_user_data_form" id="settings_user_data_form" class="vicode_form" action="" method="POST">';

													echo '<div class="options__position">Mój profil tłumacza</div>';
													
													echo '<div class="options__switch">';

													?>
													<label for="switch">
														<input name="user_options_visibility" type="checkbox" class="switch"/>
													</label>

													<?php
													
													echo '</div>';

													echo '</form>';

												echo '</li>';

											echo '</ul>';

									echo '</div>';

								echo '</div>';

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