<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Selva
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<div class="footer-bottom">
			<?php echo footer_copyright(); ?> Copyright © <?php echo get_bloginfo( 'name' ); ?>
		</div>

		<div class="cookie-law-notification">
			<button id="cookie-law-button">Akceptuję</button>
			<!-- <p><?php echo $cookie_info ?></p> -->
		</div>


	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
