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
                $link = get_post_meta(get_the_ID(),'publication_link',true) ;
                $lang = get_post_meta(get_the_ID(), 'publication_lang', true);
                $type = get_post_meta(get_the_ID(), 'publication_type', true);
                $date = get_post_meta(get_the_ID(), 'publication_date', true);
                $organization = get_the_terms(get_the_ID(), 'organization');
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
                    <?php if($organization) : ?>

                        <span class="organization"><?php _e('Organization/Author: ', 'rosa'); echo '<span class="author">'. reset($organization)->name .'</span>' ;?></span>

                    <?php endif ;?>

                    <span class="type"><strong><?php _e('Type: ','rosa') ;?><?php echo '</strong>' . $type ;?></span>
                    <h5><a href="<?php echo $link ;?>" class="link"><?php _e('Link ', 'rosa');?></a></h5>

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