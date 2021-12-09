<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */

$file = get_field('file', $post->ID);

echo '<article class="tile">';

	if (!$file) {
		echo '<a class="w--full" href="'.get_the_permalink().'">';
	}

		echo '<div class="thumbnail" style="background-image: url('.get_the_post_thumbnail_url().')"></div>';

	if (!$file) {
		echo '</a>';
	}

	// <span class="text--blue">'.get_the_date().'</span>

	echo '<div class="wrapper-flex-col-center blog-post-box">';

			if (!$file) {
				echo '<a class="w--full" href="'.get_the_permalink().'">';
			}

					echo '<div class="w--full mb--2">
						<div class="flex flex-row w--full wrap content-between items-center fs--200 mb--2">
							<p class="fs--600 fw--700 lh--125">'.mb_strimwidth( get_the_title(), 0, 90, '...' ).'</p>

						</div>

						<p class="w--full blog-post-excerpt">'.mb_strimwidth( get_the_excerpt(), 0, 220, '...' ).'</p>
					</div>';

			if (!$file) {
				echo '</a>';
			}

			echo '<div class="flex flex-row w--full wrap content-between fs--200">';

				if ($file) {
					echo '<a class="button button__filled--turquoise button--download" href="'.$file['url'].'" download>Pobierz</a>';
				} 

				if (!$file) {
					echo '<a class="button button__filled--blue button--readmore" href="'.get_the_permalink().'">Czytaj więcej</a>';
				}
			
	 echo '</div>';
  echo '</div>';

echo '</article>';
