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
                    <?php if( has_post_thumbnail() ) { ?>

                    <div class="img-post">

                                <?php 
                                $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                                echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute( 'echo=0' ) . '">';
                                the_post_thumbnail( 'single-event' );                        
                                echo '</a>';
                                echo '</div>';

                            } else {

                                echo '<div class="border"></div>
                                      <div class="fow-sep"></div>';
                            }
                        ?>                        

                    <div class="post-details">

                    <span class="date"><?php echo $date ;?>, <?php echo  $location ;?>
                    </span>
                    <?php if($organizer) : ?>

                        <span class="organization"><?php _e('Organizer: ', 'rosa'); echo '<span class="author">'. $organizer.'</span>' ;?></span>

                    <?php endif ;?>
                    <h6><?php the_title() ;?></h6>
                    <span class="type"> <?php echo $type ;?></span>
                    <?php the_content() ;?>
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
