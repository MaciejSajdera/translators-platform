<?php
$check_success = file_get_contents(get_template_directory() . "/dist/dist/svg/check_success.svg");
$cross_error = file_get_contents(get_template_directory() . "/dist/dist/svg/cross_error.svg");
?>


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


            if ($login === "failed" ) {
                    echo '<p class="php-error__text flex show-in-modal fw--500">
                    <span class="svg-holder">'.$cross_error.'</span>
                    Niepoprawny login lub hasło
                    </p>';
                    // Invalid username and/or password.
            }

            if ( $login === "empty" ) {
                    echo '<p class="php-error__text flex show-in-modal fw--500">
                    <span class="svg-holder">'.$cross_error.'</span>
                     Pole z nazwą lub hasłem jest puste
                    </p>';
            }

            if ($login === "logged-out" ) {
                    echo '<p class="php-success__text php-success__text--in-modal text--center fw--500">
                            <span class="svg-holder block">'.$check_success.'</span>
                            Zostałeś pomyślnie wylogowany
                            </p>';
            }


            //Additional messages to be displayed when user is redirected from the lost-password page

            /* Check if email with reset password link has been sent */
            $lost_password_sent = isset( $_REQUEST['checkemail'] ) && $_REQUEST['checkemail'] == 'confirm';

            if ( $lost_password_sent ) :
                echo '<p class="php-success__text php-success__text--in-modal text--center fw--500">
                            <span class="svg-holder block">'.$check_success.'</span>
                            Link dzięki któremu zresetujesz hasło został wysłany na podany adres e-mail
                        </p>';
            endif;

            /* Check if user just updated password */
            $password_updated = isset( $_REQUEST['password'] ) && $_REQUEST['password'] == 'changed';

            if ( $password_updated ) :
                echo '<p class="php-success__text php-success__text--in-modal text--center fw--500">
                            <span class="svg-holder block">'.$check_success.'</span>
                            Twoje hasło zostało zmienione, zapraszamy do zalogowania się z użycien nowego hasła
                        </p>';
            endif;

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