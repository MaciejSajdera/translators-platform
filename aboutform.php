<?php
/* ADD LINKEDIN USER DATA FORM */
function linkedin_user_data_form() {

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
		linkedin_user_data_form_messages(); ?>
		
		<form name="linkedin_user_data_form" id="linkedin_user_data_form" class="vicode_form" action="" method="POST">

			<fieldset>

				<p>
					<input name="user_linkedin" id="user_linkedin" class="user_linkedin" type="text"><?php echo get_field("translator_linkedin_link", $user_post_id) ?></textarea>
				</p>

				<p>
					<input type="submit" name="submit_linkedin_user_data" value="<?php _e('Zaktualizuj informacje o sobie'); ?>"/>
					<?php wp_nonce_field( 'add_linkedin_user_data', 'add_linkedin_user_data_nonce' ); ?>
				</p>

			</fieldset>
		</form>
	<?php
	return ob_get_clean();
}