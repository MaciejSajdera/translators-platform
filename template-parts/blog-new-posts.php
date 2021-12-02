<div class="blog-new-posts">

    <h2 class="text--big-header text--center text--blue">
        <?php echo get_the_title( get_option('page_for_posts', true) ); ?>
    </h2>

    <div class="blog-posts-grid">

        <?php
        $args = array( 'numberposts' => 4, 'order'=> 'DESC', 'orderby' => 'date' );
        $postslist = get_posts( $args );
        foreach ($postslist as $post) :  setup_postdata($post); 

                get_template_part( 'template-parts/content', 'post-in-archive' );

        endforeach; ?>
    </div>

</div>
