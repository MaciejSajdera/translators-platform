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

//get fields from contact page

$section_2 = get_field("section_2", 1141);
$section_2_title = $section_2['title'];
$section_2_paragraph = $section_2['paragraph'];
$section_2_repeater_fields = $section_2['repeater_fields'];
$section_2_image = $section_2['image'];

$section_5 = get_field("section_5", 1141);
$section_5_link = $section_5['link'];
$section_5_image = $section_5['image'];


$ellipses_footer = file_get_contents(get_template_directory() . "/dist/dist/svg/ellipses_footer.svg");
$ellipses_footer_four = file_get_contents(get_template_directory() . "/dist/dist/svg/ellipses_footer_four.svg");


?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer site-content">

		<div class="footer-top wrapper-flex-drow-mcol content-between w--full mb--4">

			<div class="footer-top__element-wrapper relative menu-holder">

				<!-- <div class="svg-holder absolute z-index-behind">
					<?php echo $ellipses_footer_four ?>
				</div> -->

			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-menu',
						'menu_id'        => 'footer-menu',
						'orderby' => 'menu_order',
						'container'            => 'nav',
						'menu_class' => 'menu flex-mcol-drow wrap',
					)
				);
			?>

			</div>


			<div class="footer-top__element-wrapper flex flex-col">

				<div class="social-media-info mb--4 relative">
					<div class="svg-holder absolute z-index-behind">
						<?php echo $ellipses_footer; ?>
					</div>
					<p class="text fs--800 fw--700 mb--1">Obserwuj nas</p>
					<div class="icons-wrapper">
					<a href="<?php echo $section_5_link ?>" class="w--full text--right mt--7 mb--4"><img src="<?php echo $section_5_image['url'] ?>" /></a>
					</div>
				</div>

				<div class="contact-info">
					<p class="text--left fs--800 fw--700 mb--1 border--standard">Kontakt</p>
				<?php

					if ($section_2_repeater_fields) {

						echo '<ul>';

						foreach($section_2_repeater_fields as $row) :

							$contact_icon = $row['contact_icon'];
							$contact_type = $row['contact_type'];
							$contact_data = $row['contact_data'];

							$contact_type_href;

							if ($contact_type == 'phone number') {
								$contact_type_href = 'href="tel:'.$contact_data.'"';
							}

							if ($contact_type == 'e-mail') {
								$contact_type_href = 'href="mailto:'.$contact_data.'"';
							}

							if ($contact_type == 'other') {
								$contact_type_href = 'href="#"';
							}

							echo '<li class="info-tile wrapper-flex-row">
									<span class="icon mr--1"><img src="'.$contact_icon['url'].'" /></span>
									<p><a '.$contact_type_href.'>'.$contact_data.'</a></p>
								</li>';

						endforeach;

						echo '</ul>';
					}

				?>

				</div>

			</div>

		</div>

		<div class="footer-bottom text--blue fw--700">
			<?php echo footer_copyright(); ?> Copyright © <?php echo get_bloginfo( 'name' ); ?>
			<!-- <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
		</div>

		<div class="scrollToTopBtn">
			<div class="scrollToTopBtn__svg-wrapper">
				<svg xmlns="http://www.w3.org/2000/svg" height="42" viewBox="0 0 24 24" width="36"><path d="M0 0h24v24H0z" fill="none"/><path fill="#fff" d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>
			</div>
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
