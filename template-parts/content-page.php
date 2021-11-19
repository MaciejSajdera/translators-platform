<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php pstk_post_thumbnail(); ?>

	<div class="entry-content">
		<?php

		the_content();

		echo '<div class="child-pages__menu">';

			echo list_of_child_pages();

		echo '</div>';
		?>
	</div><!-- .entry-content -->

	<?php
		// get_template_part( 'template-parts/searchfilter-basic' );
	?>
	
</article><!-- #post-<?php the_ID(); ?> -->
