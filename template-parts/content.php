<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pstk
 */
$subheader = get_field('subheader');
$author = get_field('author');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header flex wrap mb--4">

		<div class="entry-header__text-holder">

			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title fs--1200 fw--700 mb--2">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ($subheader) {
				echo '<h2 class="fs--600 fw--500 mb--2 text--blue">'.$subheader.'</h2>';
			}

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta flex column">

					<div class="metadata-wrapper fw--300 fs--200">

						<div class="wrapper-flex-drow-mcol mb--2">

							<?php if ($author) : ?>

								<p class="author">
									Autor:
									<a class="text--blue fw--500" href="<?php echo get_permalink($author->ID) ?>"><?php echo $author->post_title ?></a>
									<?php
									
									// $tags = get_the_tags($post->ID);
									// $i = 0;
									// if ($tags) {
									// 	foreach($tags as $my_tag) {

									// 		echo $my_tag->name;
									// 		if (count($tags) > $i && count($tags) > 1 ) {
									// 			echo ", ";
									// 		}
									// 		$i++;
									// 	}
									// }
									?>
								</p>

							<?php endif ?>

							<p class="date">
								<?php
								the_date();
								?>
							</p>

							<p class="time">
								<?php
								the_time()
								?>
							</p>
						</div>

						<?php
						echo do_shortcode('[Sassy_Social_Share]');
						?>

					</div>

				</div><!-- .entry-meta -->
			<?php endif; ?>

		</div>

		<div class="entry-header__image-holder image-holder w--full">

			<?php 
				$thumbnail_id = get_post_thumbnail_id( $post->ID );
				$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
				echo '<img class="image-border-shadow" src="'.get_the_post_thumbnail_url().'" alt="'.$alt.'" loading="lazy" />';
			?>
			
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pstk' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pstk' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php pstk_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
