<?php
/*
 * Template Name: Registration Page Template
 * description: >-
  Page template without sidebar
 */

if (is_user_logged_in()) {
	//redirect to my account page
	nocache_headers();
	wp_safe_redirect( get_page_url('user-account-page-template') );
}

get_header();

$fields_for_login_page = get_field("fields_for_login_page", 1705);
$fields_for_login_page_image = $fields_for_login_page['image'];
$fields_for_login_page_paragraph = $fields_for_login_page['paragraph'];

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main account">

		<?php

			vicode_error_messages();

			?>

			<div class="wrapper-flex-drow-mcol login-and-registration login-and-registration__welcome-view">

				<div class="login-and-registration__forms">

					<div class="registration-panel sign-up-wrapper form-active form-activated">
						<?php echo do_shortcode("[register_form]"); ?>
						<p id="switch-sign-in"><a class="text--turquoise fw--500" href="<?php echo get_page_url('user-account-page-template'); ?>">Masz już konto? Zaloguj się</a></p>
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

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
