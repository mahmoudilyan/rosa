<?php get_header(); ?>

<!-- Begin Content -->
<div id="content">

    <div class="row">
        
        <div class="col-md-9">


<!-- Content Text -->
    <?php 
        $fow_palestine_years = get_terms(array('name' => 'fow_palestine_years')); 
        $last_update = '';
    ?>
    <div class="fow-container">
        <?php foreach ($fow_palestine_years as $year) : 
            echo "<h2><a href='".get_term_link($year)."'>".strtoupper($year->name) ."</a></h2>";
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'fow_palestine_years',
                        'field' => 'id',
                        'terms' => $year->term_id
                    )
                 ),                
                'post_type' => 'fow_palestine',
                'showposts' => 3
            );
            
            $fow_palestine = get_posts($args);
            foreach($fow_palestine as $post) : setup_postdata($post);        
        ?>   
        
                <div class="post-single">
                    
                    <?php if(has_post_thumbnail()){
                        the_post_thumbnail('staff');
                        }
                    ?>
            
                    <h4><a href="<?php echo $link ;?>"><?php the_title() ;?></a></h3>
                    <span class="post-location"><?php echo $date ;?></span>
                    <a href="<?php the_permalink() ;?>"><?php _e('More','fespal') ;?></a>
                </div> 
        
            <?php endforeach; ?>
                <div class="clear"></div>
                <a class="button" href="<?php echo get_term_link($year);?>">  
                    <?php _e('See More','fespal') ;?>
                </a>  
                <hr/>
        <?php endforeach; ?>
    </div>



        </div>

        <div class="col-md-3">
            <div class="sidebar">
                <?php get_sidebar('fow') ;?>
                

            </div>
        </div>

    </div>

        
<?php get_footer() ;?>