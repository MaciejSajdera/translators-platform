<?php

/*
 * Template Name: Managemen Page Template
 * description: >-
  Page template without sidebar
 */

get_header();

$section_1 = get_field("section_1");
$h1 = $section_1['h1'];
$h2 = $section_1['h2'];

$card_1 = get_field("card_1");
$card_1_title = $card_1['title'];
$card_1_headline = $card_1['headline'];
$card_1_repeater_fields = $card_1['repeater_fields'];

$card_2 = get_field("card_2");
$card_2_title = $card_2['title'];
$card_2_headline = $card_2['headline'];
$card_2_repeater_fields = $card_2['repeater_fields'];

$card_3 = get_field("card_3");
$card_3_title = $card_3['title'];
$card_3_headline = $card_3['headline'];
$card_3_repeater_fields = $card_3['repeater_fields'];

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main management">


		<section class="management__section-1 management__welcome-view">

			<h1><?php echo $h1 ?></h1>

			<h2><?php echo $h2 ?></h2>

		</section>

		<section class="management__section-2">

			<p class="management__card-title"><?php echo $card_1_title ?></p>

			<div class="management__card-content management__card-content--card-1">

				<p><?php echo $card_1_headline?></p>

				<div class="management__squad">

				<?php
				if ($card_1_repeater_fields) {

					foreach($card_1_repeater_fields as $row) :

						$image = $row['image'];
						$title = $row['title'];
						$paragraph = $row['paragraph'];

						echo '<div class="management__person">';

							echo '<div class="management__person-wrapper">';

							if ($image['url']) {
								echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
							}
						
							if ($title) {
								echo '<p class="person-name">'.$title.'</p>';
							}

							if ($paragraph) {
								echo '<p class="person-role">'.$paragraph.'</p>';
							}

							echo '</div>';
						
						echo '</div>';

					endforeach;

				}
				?>
				</div>

			</div>


			<div class="management__card-content management__card-content--card-2">

				<p><?php echo $card_2_headline?></p>

				<div class="management__squad">

				<?php
				if ($card_2_repeater_fields) {

					foreach($card_2_repeater_fields as $row) :

						$image = $row['image'];
						$title = $row['title'];
						$paragraph = $row['paragraph'];

						echo '<div class="management__person">';

							echo '<div class="management__person-wrapper">';

							if ($image && $image['url']) {
								echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
							}
						
							if ($title) {
								echo '<p class="person-name">'.$title.'</p>';
							}

							if ($paragraph) {
								echo '<p class="person-role">'.$paragraph.'</p>';
							}

							echo '</div>';
						
						echo '</div>';

					endforeach;

				}
				?>
				</div>

			</div>

			<div class="management__card-content management__card-content--card-3">

				<p><?php echo $card_3_headline?></p>

				<div class="management__squad">

				<?php
				if ($card_3_repeater_fields) {

					foreach($card_3_repeater_fields as $row) :

						$image = $row['image'];
						$title = $row['title'];
						$paragraph = $row['paragraph'];

						echo '<div class="management__person">';

							echo '<div class="management__person-wrapper">';

							if ($image && $image['url']) {
								echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
							}
						
							if ($title) {
								echo '<p class="person-name">'.$title.'</p>';
							}

							if ($paragraph) {
								echo '<p class="person-role">'.$paragraph.'</p>';
							}

							echo '</div>';
						
						echo '</div>';

					endforeach;
				}
				?>
				</div>
			</div>

		</section>

		<?php get_template_part( 'template-parts/blog-new-posts' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();