<div class="common-box common-box__blog">

    <h2 class="text--big-header text--blue">
        <?php echo get_the_title( get_option('page_for_posts', true) ); ?>
        <br />
        <p class="fs--800 fw--700 text--turquoise mt--1 lh--125"><?php echo get_field('h2', get_option( 'page_for_posts' )) ?></p>
    </h2>

    <p class="title-paragraph fs--600 fw--500 mb--5">
        <?php echo get_field('paragraph', get_option( 'page_for_posts' )) ?>
    </p>

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
                            <div class="flex flex-row w--full items-center wrap content-between xl:red fs--200">
                                <button class="button button__filled--blue fs--200">Czytaj więcej</button>
                                <span class="text--blue">'.get_the_date().'</span>
                            </div>
                         </div>
                         ';

                    echo '</a>';
                ?>   

            </div>
        <?php endforeach; ?>
    </div>

</div>
