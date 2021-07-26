<?php

/*
 * Template Name: User Account Page Template
 * description: >-
  Page template without sidebar
 */

get_header();
do_action("my_test_action");
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

					echo '<div class="account__container">';

						echo '<div class="account__side-menu">';

							echo '<div class="profile-pricture__wrapper">';

								if(wp_get_attachment_image_url(get_post_thumbnail_id($user_post_id))) {
									pstk_post_thumbnail($user_post_id);
								} else {
									echo '<div class="post-thumbnail">';
									echo '<img src="'.get_avatar_url($current_user_id).'">';
									echo '</div>';
								}

								echo misha_uploader_callback($user_post_id);

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

								echo '<div class="account__basic-info info-box">';

									echo '<div><p class="info-box__header">Podstawowe dane</p></div>';

								echo '</div>';

								echo '<div class="edit-account__basic-info info-box ajax-content-wrapper">';

									echo '<div><p class="info-box__header">Podstawowe dane - edycja</p></div>';

									echo basic_user_data_form();

									echo '<div class="my-ajax-loader">';

											echo '<div class="my-ajax-loader__spinner"></div>';
										
									echo '</div>';

								echo '</div>';

							echo '</div>';

							echo '<div id="profile-section-2" class="profile-section profile-section--not-active account__settings">';

								echo '<div class="account__header">';
								
								echo '<p>Edycja ustawień</p>';
								
								echo '</div>';

								echo '<div class="info-box">';

									echo '<div><p class="info-box__header">Adres e-mail</p></div>';
									echo '<div><p class="info-box__subheader">Adres ten wyświetla się na profilu i służy do logowania do konta PSTK</p></div>';

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