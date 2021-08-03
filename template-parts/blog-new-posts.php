<div class="wrapper-flex-tiles">
    <?php
    $args = array( 'numberposts' => 3, 'order'=> 'ASC', 'orderby' => 'date' );
    $postslist = get_posts( $args );
    foreach ($postslist as $post) :  setup_postdata($post); ?> 
        <div class="tile">
            <?php the_title(); ?>   
            <?php the_excerpt(); ?>
        </div>
    <?php endforeach; ?>
</div>