<?php get_header(); ?>
<!-- Begin Content -->
<div id="content">

<div class="row">
    
    <div class="col-md-9">
    <h1><?php _e('Events','rosa') ;?></h1>
    <?php 
        $categories = get_terms(array('name' => 'events_categories'));
    ?>
    <div class="publication-container row">
        <?php foreach ($categories as $cat) : 
            echo "<div class='col-md-12'><h4 class='highlight year-name'><a class='highligt' href='".get_term_link($cat)."'>". $cat->name ."</a></h4></div>";
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'events_categories',
                        'field' => 'id',
                        'terms' => $cat->term_id
                    )
                 ),                
                'post_type' => 'event',
                'showposts' => 4
            );

            $events = get_posts($args);
            foreach($events as $post) : setup_postdata($post);
                $location = get_post_meta(get_the_ID(),'event_location',true) ;
                $organizer = get_post_meta(get_the_ID(), 'event_organizer', true);

        
        ?>   
        
                <div class="post-single publication col-md-3">
                    
                    <div class="img-post">
                    <?php if(has_post_thumbnail()){
                        the_post_thumbnail('staff');
                        }
                    ?>
                    </div>
            
                    <h5><a href="<?php the_permalink() ;?>"><?php the_title() ;?></a></h5>

                    <?php if ($organizer) :?>

                        <h6>Organizer: <span class="highlight"><?php echo $organizer ;?></span></h6>
                    <?php endif ;?>

                    <a href="<?php the_permalink() ;?>"><?php _e('More','fespal') ;?></a>
                </div> 
        
                <?php endforeach; ?>
                <?php echo "<div class='col-md-12 year-link'><h4 class='highlight'><a class='highligt' href='".get_term_link($cat)."'>". __('See More Events in: ', 'rosa'). $cat->name ."<i class='glyphicon glyphicon-circle-arrow-right'></i></a></h4></div>" ;?>

                <div class="clearfix"></div>


                <hr/>
        <?php endforeach; ?>



    </div>

</div>

    <div class="col-md-3">
        
            <div class="sidebar">
                <?php get_sidebar('single') ;?>

            </div>        
    </div>
</div>
  
<?php get_footer() ;?>