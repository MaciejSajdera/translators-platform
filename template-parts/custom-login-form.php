
<div class="custom-login-form__container">

    <div class="login-branding">
        <a href="#" class="login-logo">PTSK Logo</a>
    </div>

    <div class="login-form">
        <?php

            $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

            if ( $login === "failed" ) {
                echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
              } elseif ( $login === "empty" ) {
                echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
              } elseif ( $login === "false" ) {
                echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
              }

            $args = array(
                'redirect' => home_url(), 
                'id_username' => 'user',
                'id_password' => 'pass',
            );

            wp_login_form( $args );
        
        ?>
    </div>
</div>