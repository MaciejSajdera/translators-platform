<?php

/*
 * Template Name: User Account Page Template
 * description: >-
  Page template without sidebar
 */

get_header();
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

					echo '<div class="account__container">';

						echo '<div class="account__side-menu">';

							ptsk_post_thumbnail($user_post_id);

							echo misha_uploader_callback($user_post_id);

							echo '<h3 class="account__user-name">'.$translator_first_name.' '.$translator_last_name.'</h3>';

						echo '</div>';


						echo '<div class="account__main">';

							echo '<div class="account__welcome-message">';

								$user_nickname = $current_user->user_login;

								echo '<h1>Cześć '.$user_nickname.'</h1>';

							echo '</div>';

							echo '<div class="account__basic-info info-box">';

								echo '<div><p class="info-box__header">Podstawowe dane</p></div>';

							echo '</div>';


							echo '<div class="edit-account__basic-info info-box">';

								echo '<div><p class="info-box__header">Podstawowe dane - edycja</p></div>';

								echo do_shortcode("[display_basic_user_data_form]");

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