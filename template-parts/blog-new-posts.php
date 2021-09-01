<div class="common-box__new-posts">

    <h2>Aktualności PSTK</h2>

    <div class="wrapper-flex-drow-mcol">

        <?php
        $args = array( 'numberposts' => 3, 'order'=> 'ASC', 'orderby' => 'date' );
        $postslist = get_posts( $args );
        foreach ($postslist as $post) :  setup_postdata($post); ?> 
            <div class="tile">

                <?php 
                    echo '<a href="'.get_the_permalink().'">';
                    echo '<p>'.get_the_title().'</p>';
                    echo '<div class="thumbnail" style="background-image: url('.get_the_post_thumbnail_url().')"></div>';
                    echo '</a>';
                ?>   

            </div>
        <?php endforeach; ?>
    </div>

</div>


