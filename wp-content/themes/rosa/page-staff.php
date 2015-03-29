<?php 
/*
Template Name: Staff page
*/
get_header() ;?>

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

            
            <!-- Staff[Begins] -->
            <div class="row staff-container">
                <?php $the_query = new WP_Query('post_type=staff&posts_per_page=-1&orderby=menu_order&order=ASC') ;
                $i = 3;                
                while($the_query->have_posts()) : $the_query->the_post() ; $i++?>
                <?php 
                    $position = get_post_meta(get_the_ID(),'employee_position',true) ;
                    $location = get_post_meta(get_the_ID(),'employee_location',true) ;
                ?> 
                <div class="col-md-12">
                    <div class="single-staff">
                        <div class="img-staff">
                            <?php if(has_post_thumbnail()){
                                the_post_thumbnail('staff');
                            }
                            ?>
                        </div>
                
                        <h4 class="employee-title"><?php the_title() ;?></h4>
                        <span class="staff-position"><?php echo $position ;?></span>
                        <span class="staff-location"><?php echo $location ;?></span>

                        <div class="bio">
                            <?php the_content() ;?>
                        </div>

                    </div>
                </div>

                <?php //if( $i % 3  === 0) { echo '<div class="clearfix"></div>';} ?>
                <?php endwhile;  ?>                

            </div>            
            <!-- Staff[Ends] -->

        </div>
        

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar('single') ;?>
                

            </div>
                
        </div>


    </div>
</div>

<?php get_footer() ;?>