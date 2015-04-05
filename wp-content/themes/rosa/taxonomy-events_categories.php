<?php 
get_header() ;?>

<div id="content">
    <div class="row">
        
        <div class="col-md-9">
            
            <h3><span class="highlight"><?php echo strtoupper($_GET['events_categories']) ;?></span></h3>

            <?php if(have_posts()) : ?>
            
            <ul class="lists publications-list events-list">
                <?php while(have_posts()) : the_post() ;
                $location = get_post_meta(get_the_ID(),'event_location',true) ;
                $organizer = get_post_meta(get_the_ID(), 'event_organizer', true);
                $type = get_post_meta(get_the_ID(), 'event_type', true);
                $date = get_post_meta(get_the_ID(), 'event_date', true);


                ?>

                <li>
                    <div class="img-post">


                        <?php if( has_post_thumbnail() ){
                                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute( 'echo=0' ) . '">';
                                the_post_thumbnail( 'single-event' );                        
                                echo '</a>';
                            }
                        ?>                        
                    </div>

                    <div class="post-details">

                    <span class="date"><?php echo $date ;?></span>
                    <?php if($organizer) : ?>

                        <span class="organization"><?php _e('Organization/Author: ', 'rosa'); echo '<span class="author">'. $organizer.'</span>' ;?></span>

                    <?php endif ;?>
                    <span class="type"><strong><?php _e('Type: ','rosa'); echo '</strong>'. $type ;?></span>
                    <h6><?php the_title() ;?></h6>
                    <?php the_excerpt() ;?>
                    <span class="location"><strong><?php _e('Location: ','rosa'); echo '</strong>' . $location ;?></span>
                    </div>

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
