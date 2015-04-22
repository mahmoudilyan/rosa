<?php

get_header() ;

?>


<!-- Begin Content -->
<div id="content">

    <div class="row">
        
        <div class="col-md-9">

            <div class="article row single-special">
                <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post() ;
                $location = get_post_meta(get_the_ID(),'event_location',true) ;
                $organizer = get_post_meta(get_the_ID(), 'event_organizer', true);
                $type = get_post_meta(get_the_ID(), 'event_type', true);
                $date = get_post_meta(get_the_ID(), 'event_date', true);
                ?>

                <div class="col-md-8">
                    <h4><?php the_title() ;?></h4>
            
                    <?php the_content() ;?>



                </div>


                <div class="col-md-4 single-image">
                <?php if( has_post_thumbnail() ){
                        the_post_thumbnail('staff');
                    }
                ?>

                    <span class="date"><?php echo $date ;?></span>

                        <span class="organization"><?php _e('Organizer: ', 'rosa'); echo '<span class="author">'. $organizer.'</span>' ;?></span>


                    <span class="type"><?php echo  $type ;?></span>
                    <span class="location"> <?php echo  $location ;?></span>


                </div>

                <?php endwhile; ?>
                <?php endif ;?>

                
            </div>

        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar('single') ;?>
                

            </div>
        </div>

    </div>

</div>

<?php get_footer() ; ?>