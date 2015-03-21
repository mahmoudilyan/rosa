<?php get_header(); ?>
<!-- Begin Content -->
<div id="content">

<div class="row">
    
    <div class="col-md-9">
    <h1><?php _e('Publications','fespal') ;?></h1>
    <?php 
        $years = get_terms(array('name' => 'publications_years'));
    ?>
    <div class="publication-container row">
        <?php foreach ($years as $years) : 
            echo "<div class='col-md-12'><h4 class='highlight'><a class='highligt' href='".get_term_link($years)."'>".strtoupper($years->name) ."</a></h4></div>";
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'publications_years',
                        'field' => 'id',
                        'terms' => $years->term_id
                    )
                 ),                
                'post_type' => 'publication',
                'showposts' => 3
            );

            $publications = get_posts($args);
            foreach($publications as $post) : setup_postdata($post);
                $link = get_post_meta(get_the_ID(),'publication_link',true) ;
                $organizations = get_the_terms(get_the_ID(), 'organization');

        
        ?>   
        
                <div class="post-single publication col-md-3">
                    
                    <div class="img-post">
                    <?php if(has_post_thumbnail()){
                        the_post_thumbnail('staff');
                        }
                    ?>
                    </div>
            
                    <h5><a href="<?php echo $link ;?>"><?php the_title() ;?></a></h5>
                    <h6>Organization: <span class="highlight"><?php echo $organizations[11]->name ;?></span></h6>
                    <a href="<?php the_permalink() ;?>"><?php _e('More','fespal') ;?></a>
                </div> 
        
                <?php endforeach; ?>
                <div class="clearfix"></div>

                <hr/>
        <?php endforeach; ?>

    </div>

</div>

    <div class="col-md-3">
        
            <div class="sidebar">
                <?php get_sidebar() ;?>

            </div>        
    </div>
</div>
  
<?php get_footer() ;?>