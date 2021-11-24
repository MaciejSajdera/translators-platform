<div class="blog-new-posts">

    <h2 class="text--big-header text--blue">
        <?php echo get_the_title( get_option('page_for_posts', true) ); ?>
        <br />
        <p class="fs--800 fw--700 text--turquoise mt--1 lh--125"><?php echo get_field('h2', get_option( 'page_for_posts' )) ?></p>
    </h2>

    <p class="title-paragraph mb--5">
        <?php echo get_field('paragraph', get_option( 'page_for_posts' )) ?>
    </p>

    <div class="blog-posts-grid">

        <?php
        $args = array( 'numberposts' => 4, 'order'=> 'ASC', 'orderby' => 'date' );
        $postslist = get_posts( $args );
        foreach ($postslist as $post) :  setup_postdata($post); 

                get_template_part( 'template-parts/content', 'post-in-archive' );

        endforeach; ?>
    </div>

</div>
