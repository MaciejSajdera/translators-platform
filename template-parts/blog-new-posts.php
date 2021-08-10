<div class="wrapper-flex-tiles">
    <?php
    $args = array( 'numberposts' => 3, 'order'=> 'ASC', 'orderby' => 'date' );
    $postslist = get_posts( $args );
    foreach ($postslist as $post) :  setup_postdata($post); ?> 
        <div class="tile">
            <?php 
                echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
            ?>   
        </div>
    <?php endforeach; ?>
</div>