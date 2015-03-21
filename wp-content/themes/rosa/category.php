<?php 
get_header() ;?>

    <div class="row">
        
        <div class="col-md-9">


<?php $last_update = ''; ?>    
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post() ;?>
    <?php if($last_update == '') {
      $last_update  = get_post_modified_time('d-m-Y') ;
    }
    ?>
 
    <p><strong><?php the_title() ;?></strong>
        <?php the_content() ;?>
        <a href="<?php the_permalink() ;?>"><?php _e('Read More ','fespal') ;?></a>
    </p>
    <hr>

    <?php endwhile ;?>
    <?php global $wp_query; ?>
    <?php fespal_content_nav("pagination", $wp_query); ?>
    <?php endif ;?> 



        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar() ;?>
                

            </div>
        </div>

    </div>


    
<?php get_footer() ;?>
