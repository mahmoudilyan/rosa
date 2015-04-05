<?php 
get_header() ;?>

<div id="content">
    <div class="row">
        
        <div class="col-md-9">
            
            <h3><?php _e('Partners & Projects ', 'rosa') ;?><span class="highlight"><?php echo $_GET['fow_palestine_years'] ;?></span></h3>

            <?php if(have_posts()) : ?>
            
            <ul class="lists">
                <?php while(have_posts()) : the_post() ;?>
                <li>
                        <?php if( has_post_thumbnail() ) :  ?>

                            <div class="img-post">

                                <?php the_post_thumbnail('single-event'); ?>

                            </div>

                    <?php else : ?>

                        <div class="border"></div>
                        <div class="fow-sep"></div>
                        
                    <?php endif;?> 

                    <h6><a href="<?php the_permalink() ;?>"> <?php the_title() ;?> </a></h6>
                    <?php the_excerpt() ;?>
                    <a href="<?php the_permalink() ;?>"><?php _e('Read More ','fespal') ;?></a>
                </p>
                <hr>

                </li>

                <?php endwhile ;?>
                <?php global $wp_query; ?>


            </ul>
            <?php fespal_content_nav("pagination", $wp_query); ?>
            <?php endif ;?> 


        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar('fow') ;?>                
                

            </div>
        </div>

    </div>


</div>    
<?php get_footer() ;?>
