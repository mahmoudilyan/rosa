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
                    $position = get_post_meta(get_the_ID(),'employee_position',true) ;
                    $location = get_post_meta(get_the_ID(),'employee_location',true) ;

                ?>

                <div class="col-md-8">
                    <h4><?php the_title() ;?></h4>
                    <span class="position"><?php _e('Position: ','rosa') ;?><?php echo $position ;?></span>

                    <div class="gap"></div>
            
                    <?php the_content() ;?>



                </div>


                <div class="col-md-4 single-image">
                <?php if( has_post_thumbnail() ){
                        the_post_thumbnail('staff');
                    }
                ?>



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