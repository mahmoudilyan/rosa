<?php get_header() ;?>


<!-- Begin Content -->
<div id="content">

    <div class="row">
        
        <div class="col-md-9">


            <!-- Slider[Begins] -->
            <div id="main-slider" class="owl-carousel">

            <?php 
            $last_update = '';
            $category_lang_id = icl_object_id($home_page_category,'category',false,ICL_LANGUAGE_CODE);
            $wp_query = new WP_Query('cat='.$category_lang_id);
            if($wp_query->have_posts()) : ?>
                
                    <?php while($wp_query->have_posts()) : $wp_query->the_post() ; ?>

                        
                        <div class="slider-item"> 
                            <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail('home_slider');
                            }
                            if($last_update == ''){
                                $last_update = get_the_time('d-m-Y');
                            }
                            ?>
                            <div class="inner-post hidden">
                                <h3><a href="<?php the_permalink() ;?>"><?php the_title() ;?></a></h3>
                                <?php the_excerpt() ;?>
                            </div>
                        </div>

                    
                    <?php endwhile; ?>
            <?php endif ;?>
            </div> 
            <!-- Slide[Ends] -->

        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar() ;?>
                

            </div>
        </div>

    </div>

</div>
    
<?php get_footer() ;?>