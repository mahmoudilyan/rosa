<?php
/*
Template Name: Home Page
*/

get_header() ;

?>


<!-- Begin Content -->
<div id="content">

    <div class="row">
        
        <div class="col-md-9">

            <div class="article">
                <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post() ;?>
                <?php if( has_post_thumbnail() ){
                        the_post_thumbnail('single');
                    }
                ?>
                
                <h4><?php the_title() ;?></h4>

                <?php the_content() ;?>
                <?php endwhile; ?>
                <?php endif ;?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar() ;?>
                

            </div>
        </div>

    </div>


    
<?php get_footer() ; ?>