<?php 
get_header() ;?>

<div id="content">

    <div class="row">
        
        <div class="col-md-9">
            <h3><span class="highlight"><?php echo get_cat_name( $_GET['cat'] ) ;?></span></h3>
            <?php if(have_posts()) : ?>
            
            <ul class="lists">
                <?php while(have_posts()) : the_post() ;?>
                <li>
                        <?php if( has_post_thumbnail() ) :  ?>

                            <div class="img-post">

                                <a href="<?php the_permalink() ;?>">

                                <?php the_post_thumbnail('single-event'); ?>
                                </a>

                            </div>

                    <?php else : ?>

                        <div class="border"></div>
                        <div class="fow-sep"></div>
                        
                    <?php endif;?> 

                    <h6><a href="<?php the_permalink() ;?>"> <?php the_title() ;?> </a></h6>
                    <?php the_excerpt() ;?>
                    <a href="<?php the_permalink() ;?>"><?php _e('Read More ','rosa') ;?></a>

                </li>
                <?php endwhile ;?>
                <?php global $wp_query; ?>

            </ul>
            <?php fespal_content_nav("pagination", $wp_query); ?>
            <?php endif ;?> 



        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar('single') ;?>
                

            </div>
        </div>

    </div>

</div>

    
<?php get_footer() ;?>
