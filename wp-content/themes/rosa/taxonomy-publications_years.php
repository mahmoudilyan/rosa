<?php 
get_header() ;?>

<div id="content">
    <div class="row">
        
        <div class="col-md-9">
            
            <h3><?php _e('Publications ', 'rosa') ;?></h3>

            <?php if(have_posts()) : ?>
            
            <ul class="lists publications-list">
                <?php while(have_posts()) : the_post() ;
                $link = get_post_meta(get_the_ID(),'publication_link',true) ;
                $lang = get_post_meta(get_the_ID(), 'publication_lang', true);
                $type = get_post_meta(get_the_ID(), 'publication_type', true);
                $date = get_post_meta(get_the_ID(), 'publication_date', true);
                $organization = get_the_terms(get_the_ID(), 'organization');


                ?>

                <li>
                    <div class="img-post">
                        <a href="<?php echo $link ;?>">
                        <?php if( has_post_thumbnail() ){
                                the_post_thumbnail('staff');
                            }
                        ?>                        
                        </a>
                    </div>

                    <div class="post-details">

                    <span class="date"><?php echo $date ;?></span>
                    <?php if($organization) : ?>

                        <span class="organization"><?php _e('Organization/Author: ', 'rosa'); echo '<span class="author">'. reset($organization)->name .'</span>' ;?></span>

                    <?php endif ;?>
                    <span class="type"><?php echo $type ;?></span>
                    <h6><a href="<?php echo $link; ?>" target="_blank"><?php the_title() ;?></a></h6>
                    <?php the_excerpt() ;?>

                
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
