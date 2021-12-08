<div class="blog-promo-posts">

    <!-- <h3 class="text--center text--blue">
        Proponowane posty
    </h3> -->

    <div class="blog-posts-grid">

        <?php
        $args = array( 'numberposts' => 4, 'category_name' => 'wyroznione', 'order'=> 'DESC', 'orderby' => 'date' );
        $postslist = get_posts( $args );
        foreach ($postslist as $post) :  setup_postdata($post); 

                get_template_part( 'template-parts/content', 'post-in-archive' );

        endforeach; ?>
    </div>

</div>
