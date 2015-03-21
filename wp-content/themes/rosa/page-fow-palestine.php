<?php
/*
Template Name: Fields Of Work Palestine
*/

get_header() ;

?>


<!-- Begin Content -->
<div id="content">

    <div class="row">
        
        <div class="col-md-9">

        <?php 
            while(have_posts()) : the_post();

                the_content();

            endwhile; 

        ?>


        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar('fow') ;?>                
            </div>
        </div>

    </div>

</div>
    
<?php get_footer() ;?>