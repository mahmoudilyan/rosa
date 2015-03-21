<?php

get_header() ;

?>


<!-- Begin Content -->
<div id="content">

    <div class="row">
        
        <div class="col-md-9">

            <div class="article">
                <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post() ;
                $link = get_post_meta(get_the_ID(),'publication_link',true) ;
                ?>


                <?php if( has_post_thumbnail() ){
                        the_post_thumbnail('single');
                    }
                ?>
                
                <h4><?php the_title() ;?></h4>
        
                <?php the_content() ;?>
                    <h5><a class='highlight' href="<?php echo $link ;?>"><?php _e('Link ', 'rosa');?></a></h5>
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