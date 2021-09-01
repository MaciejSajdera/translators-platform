<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pstk
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
//  get_template_part( 'template-parts/preloader', 'page' );
?>

<div class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
		<div class="modal-message-holder"></div>
    </div>
</div>
 
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pstk' ); ?></a>

	<header id="masthead" class="site-header">

				<div class="site-branding">

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>
						<?php the_custom_logo(); ?>
					</a>

				</div><!-- .site-branding -->

				<div class="desktop-menu-container">

						<div class="dropdownBackground">
							<span class="arrow"></span>
						</div>

						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_id'        => 'desktop-menu',
									'orderby' => 'menu_order',
									'container'            => 'nav',
								)
							);
						?>
						
				</div>


				<div class="mobile-menu-container">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_id'        => 'mobile-menu',
								'orderby' => 'menu_order',
								'container'            => 'nav',
							)
						);
					?>
				</div>


				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'pstk' ); ?></button>


	</header><!-- #masthead -->

	<div id="content" class="site-content">
