<?php 
get_header() ;?>

<div id="content">
    <div class="row">
        
        <div class="col-md-9">
            
            <h3><?php _e('Fields of Work Jordan: ', 'rosa') ;?><span class="highlight">(<?php echo $_GET['fow_jordan_years'] ;?>)</span></h3>


            <?php if(have_posts()) : ?>
            
            <ul class="lists">
                <?php while(have_posts()) : the_post() ;?>
                <li>
                    <div class="img-post">
                        <?php if( has_post_thumbnail() ){
                                the_post_thumbnail('single',array('class' => 'img-single-staff'));
                            }
                        ?>                        
                    </div>
                    <h6><?php the_title() ;?></h6>
                    <?php the_excerpt() ;?>
                    <a href="<?php the_permalink() ;?>"><?php _e('Read More ','fespal') ;?></a>
                </p>
                <hr>

                <?php endwhile ;?>
                <?php global $wp_query; ?>
                </li>

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
