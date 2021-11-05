<div class="common-box">

    <p class="text--big-header text--outline-blue">Aktualności</p>

    <div class="wrapper-flex-drow-mcol common-box__new-posts">

        <?php
        $args = array( 'numberposts' => 4, 'order'=> 'ASC', 'orderby' => 'date' );
        $postslist = get_posts( $args );
        foreach ($postslist as $post) :  setup_postdata($post); ?> 
            <div class="tile">

                <?php 
                    echo '<a href="'.get_the_permalink().'">';

                    echo '<div class="thumbnail" style="background-image: url('.get_the_post_thumbnail_url().')"></div>

                        <div class="wrapper-flex-col-center common-box__text">
                            <p class="mb--2">'.get_the_title().'</p>
                            <div class="flex flex-row w-full items-center wrap content-between xl:red fs--200">
                                <button class="button button__filled--blue fs--200">Czytaj więcej</button>
                                '.get_the_date().'
                            </div>
                         </div>
                         '
                         
                         
                         ;

                    echo '</a>';
                ?>   

            </div>
        <?php endforeach; ?>
    </div>

</div>
