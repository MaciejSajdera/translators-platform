<?php

$cat_terms = get_terms(
    array('category'),
    array(
            'hide_empty'    => false,
            'orderby'       => 'name',
            'order'         => 'ASC',
        )
);

if( $cat_terms ) :

foreach( $cat_terms as $term ) :

    echo '<div>';

        //var_dump( $term );
        echo '<h3>'. $term->name .'</h3>';

        $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => -1, //specify yours
                'post_status'           => 'publish',
                'order' => 'ASC',
                'tax_query'             => array(
                                            array(
                                                'taxonomy' => 'category',
                                                'field'    => 'slug',
                                                'terms'    => $term->slug,
                                                
                                            ),
                                        ),
                'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
            );
            
        $posts = new WP_Query( $args );

        echo '<div class="wrapper-flex-drow-mcol">';

        if( $posts->have_posts() ) :
            while( $posts->have_posts() ) : $posts->the_post();

                echo '<div class="tile">';

                echo '<a href="'.get_permalink().'">

                    '. get_the_title() .'

                        <div>

                        '.the_excerpt().'

                        </div>
                
                     </a>';



                echo '</div>';

            endwhile;
        endif;
        wp_reset_postdata(); //important

    echo '</div>';

endforeach;

endif;

the_posts_navigation();