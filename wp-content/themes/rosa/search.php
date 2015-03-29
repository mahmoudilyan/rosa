<?php 
get_header() ;?>

<div id="content">
    <div class="row">
        
        <div class="col-md-9">
            
           

            <?php if(have_posts()) : ?>
             <h3><?php _e('Search results: ', 'rosa') ;?></h3>
            <ul class="lists">
                <?php while(have_posts()) : the_post() ;?>
                <li>
<!--                     <div class="img-post">
                        <?php if( has_post_thumbnail() ){
                                //the_post_thumbnail('single');
                            }
                        ?>                        
                    </div> -->
                    <h6><a href="<?php the_permalink() ;?>"><?php the_title() ;?></a></h6>
                    <?php the_excerpt() ;?>
                    <a href="<?php the_permalink() ;?>"><?php _e('Read More ','rosa') ;?></a>
                </p>
                <hr>

                <?php endwhile ;?>
                <?php global $wp_query; ?>
                </li>

            </ul>
            <?php fespal_content_nav("pagination", $wp_query); ?>
            <?php else :?> 
             <h3><?php _e('No results found', 'rosa') ;?></h3>
            
        <?php endif; ?>
        

        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar('fow') ;?>                
                

            </div>
        </div>

    </div>


</div>    
<?php get_footer() ;?>
