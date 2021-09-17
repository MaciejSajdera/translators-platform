<?php

/*
 * Template Name: Admission Criteria Page Template
 * description: >-
  Page template without sidebar
 */

get_header();
$admission_criteria_page_fields = get_field("admission_criteria_page_fields");
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
			the_content();
		?>

		<?php

		echo '<h2>'.$admission_criteria_page_fields['header_1'].'</h2>';

		echo '<p>'.$admission_criteria_page_fields['paragraph_1'].'</p>';

		echo '<h2>'.$admission_criteria_page_fields['header_2'].'</h2>';

		echo '<p>'.$admission_criteria_page_fields['paragraph_2'].'</p>';


		$criterias = $admission_criteria_page_fields["criterias"];

		if ($criterias) {
			foreach($criterias as $criterium) :

				echo '<p>'.$criterium['header'].'</p>';
				echo '<p>'.$criterium['description'].'</p>';

			endforeach;
		}

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();