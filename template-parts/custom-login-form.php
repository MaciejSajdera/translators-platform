
<div class="custom-login-form__container">

    <div class="login-branding">
        <div class="login-logo">
            <img height="auto" width="50" src="<?php echo get_site_icon_url() ?>" loading="lazy"/>
        </div>
    </div>

    <div class="login-form">
        <?php

            $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

            // var_dump( $_REQUEST );

            // https://code.tutsplus.com/tutorials/build-a-custom-wordpress-user-flow-part-3-password-reset--cms-23811

            vicode_error_messages();

            if ($login === "failed" ) {
                echo '<p class="login-msg php-error__text">Niepoprawny login lub hasło.</p>';
                // Invalid username and/or password.
            }

            if ( $login === "empty" ) {
                echo '<p class="login-msg php-error__text">Username and/or Password is empty.</p>';
            }

            if ($login === "logged-out" ) {
                echo '<p class="login-msg php-success__text">Zostałeś pomyślnie wylogowany.</p>';
            }


            //Additional messages to be displayed when user is redirected from the lost-password page

            /* Check if email with reset password link has been sent */
            $lost_password_sent = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';

            if ( $lost_password_sent ) : ?>
                <p class="login-info php-success__text">
                    <?php _e( 'Check your email for a link to reset your password.', 'personalize-login' ); ?>
                </p>
            <?php endif;

            /* Check if user just updated password */
            $password_updated = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';

            if ( $password_updated ) : ?>
                <p class="login-info php-success__text">
                    <?php _e( 'Your password has been changed. You can sign in now.', 'personalize-login' ); ?>
                </p>
            <?php endif;


            //Form
            $login_page  = get_permalink(18);

            $args = array(
                'redirect' => $login_page, 
                'id_username' => 'user',
                'id_password' => 'pass',
                'remember' => 'true',
            );

            wp_login_form( $args );

            echo '<a href="'.wp_lostpassword_url().'" class="forgot-password-link mb--2">Nie pamiętasz hasła?</a>';
        
        ?>
    </div>
</div>