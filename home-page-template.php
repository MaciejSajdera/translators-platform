<?php

/*
 * Template Name: Home Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

$section_1 = get_field("section_1");
$h1 = $section_1['h1'];
$h2 = $section_1['h2'];

$section_2 = get_field("section_2");
$section_2_title = $section_2['title'];
$section_2_repeater_fields = $section_2['repeater_fields'];

$section_3 = get_field("section_3");
$section_3_title = $section_3['title'];
$section_3_repeater_fields = $section_3['repeater_fields'];

$section_4 = get_field("section_4");
$section_4_title = $section_4['title'];
$section_4_paragraph = $section_4['paragraph'];
$section_4_link = $section_4['link'];

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


		<section class="home__section-1 home__welcome-view">

			<h1><?php echo $h1 ?></h1>

			<div class="home-search__container">

				<h2><?php echo $h2 ?></h2>

				<!--
				Example of multidropdown checkbox select
				https://codepen.io/elmahdim/embed/hlmri?height=565&theme-id=0&slug-hash=hlmri&default-tab=result&user=elmahdim&embed-version=2&pen-title=Dropdown%20with%20Multiple%20checkbox%20select%20with%20jQuery -->

				<?php
					get_template_part( 'template-parts/searchfilter-basic' );
				?>

			</div>

		</section>

		<section class="home__section-2">
			<div class="section-2__title">
				<h3><?php echo $section_2_title ?></h3>
			</div>

			<div class="section-2__mission_statements">
				<?php

				if ($section_2_repeater_fields) {

					echo '<ul>';

					foreach($section_2_repeater_fields as $row) :

						$textarea = $row['textarea'];

						echo '<li>'.$textarea.'</li>';

					endforeach;

					echo '</ul>';
				}

				?>
			</div>

		</section>

		<section class="home__section-3">

			<div class="section-3__title">
				<h3><?php echo $section_3_title ?></h3>
			</div>

			<div class="section-3__our_translators">
				<?php

				if ($section_3_repeater_fields) {

					foreach($section_3_repeater_fields as $row) :

						$icon = $row['icon'];
						$title = $row['title'];
						$paragraph = $row['paragraph'];

						echo '<div class="wrapper-flex-col-center">';
						
							echo '<img src="'.$icon["url"].'" alt="'.$icon["alt"].'">';
							echo '<p>'.$title.'</p>';
							echo '<p>'.$paragraph.'</p>';
						
						echo '</div>';

					endforeach;

				}

				?>
			</div>

		</section>

		<section class="home__section-4">

			<div class="section-4__title">
				<h3><?php echo $section_4_title ?></h3>
			</div>

			<div class="section-4__paragraph-wrapper">
				<p><?php echo $section_4_paragraph ?></p>
			</div>

			<a href="<?php echo $section_4_link ?>" class="read-more">Czytaj więcej</a>

		</section>

		<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();