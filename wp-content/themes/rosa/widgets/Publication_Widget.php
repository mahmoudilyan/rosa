<?php

/**
 * Publication Widget
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Publication_Widget extends WP_Widget {
    
    public function __construct() {
        $params = array(
            'description' => __('This will display your publication','rosa'),
            'name' => __('Rosa Publication Widget','rosa')
        );
        parent::__construct('Publication_Widget','',$params);
    }
    
    
    /**
     * Showing Widget Form
     *  
     * @param array $instance
     */
    public function form($instance){
        extract($instance);
        $languages = get_languages();
        
        ?>
            <label for="<?php echo $this->get_field_id('language') ;?>"><?php _e('Language','rosa') ;?></label>
            <select name="<?php echo $this->get_field_name('language') ;?>" class="widefat" id="<?php echo $this->get_field_id('language') ;?>">
                <?php foreach ($languages as $lang) :?>
                <option value="<?php echo $lang->code ;?>" <?php selected($lang->code,$language) ;?>><?php echo $lang->english_name ;?></option>
                <?php endforeach ;?>
            </select>

            <label for="<?php echo $this->get_field_id('title') ;?>"><?php _e('Title','rosa') ;?></label>
            <input type="text" 
                   name="<?php echo $this->get_field_name('title') ;?>" 
                   value="<?php if(isset($title)) { echo $title ; } ?>" 
                   id="<?php echo $this->get_field_id('title') ;?>" />
            
            <?php $organizations =   get_terms('organization') ;?>
            <label for="<?php echo $this->get_field_id('organization_cats') ;?>"><?php _e('Organizations','rosa') ;?></label><br>
            <?php foreach ( $organizations as $organization ) : ;?>
            <?php global $organization_cats ; ?>
            <input type="checkbox"
                   name="<?php echo $this->get_field_name('organization_cats')."[]" ;?>" 
                   value="<?php echo $organization->term_id ;?>" 
                   <?php array_checked( $instance['organization_cats'], $organization->term_id ); ?> />
                   <?php echo $organization->name ;?> 
                   <?php echo $organization_cats; ?>
            <br>
            <?php endforeach ;?>
            
            <label for="<?php echo $this->get_field_id('publication_numbers') ;?>"><?php _e('How Many Publiations to show','rosa') ;?></label>
            <input type="text" 
                   name="<?php echo $this->get_field_name('publication_numbers') ;?>" 
                   value="<?php if(isset($publication_numbers)) { echo $publication_numbers ; } ?>" 
                   id="<?php echo $this->get_field_id('publication_numbers') ;?>" />            
            
        <?php
    }
    
    
    /** 
     * Viewing The Widget
     *  
     * @global stdObject $post
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        global $post;
        
        if($language == ICL_LANGUAGE_CODE) :
        $category_lang_id = icl_object_id($organization_cats,'organization',false,ICL_LANGUAGE_CODE);
        $tax_query = array();
        if(isset($organization_cats)) {
            $tax_query[] = array(
                'taxonomy' => 'organization',
                'field' => 'id',
                'terms' => $category_lang_id
            );
        }
        
        $posts_args = array(
            'posts_per_page' => $publication_numbers,
            'post_type' => 'publication',
            //'tax_query' => $tax_query,
		'orderby' => 'post_date',
		'suppress_filters'=>0 ,
		'order' => 'DESC',
        );
        $publication_posts = get_posts($posts_args);

        
        echo $before_widget;
        if (!empty($title))
            echo $before_title . "{$title}" . $after_title;

        echo '<div class="publication_fade owl-carousel">';
        
        foreach($publication_posts as $publication) : 
            ?>
            
            <div class="publication_single">
                <a href="<?php echo get_permalink($publication->ID);?>"><?php echo get_the_post_thumbnail($publication->ID, 'publication'); ?></a>
            

            </div>
            
            <?php
        endforeach;
        echo '</div>';
        
        //echo '<div class="publication_fade">';
        
        // foreach($publication_posts as $publication) : 
        //     ?>
            
<!--         //     <div class="publication_single_meta">

        //         <h2>
        //             <a  href="<?php echo get_bloginfo('url'). '/?post_type=publication' ?>">
        //                 <?php echo $publication->post_title ;?>
        //             </a>
        //         </h2>
        //         <span class="publication_date"><?php echo get_post_meta($publication->ID,'publication_date',true);?> </span>
        //     </div>
 -->            
             <?php
        // endforeach;
        
        // echo '</div>';
        echo $after_widget;
        endif;
    }
    
    /**
     * Sanitize input from user
     * 
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['organization_cats'] = $new_instance['organization_cats'];
        $instance['publication_numbers'] = $new_instance['publication_numbers'];
        $instance['language'] = strip_tags($new_instance['language']);
        return $instance;
    }
    
   
}


// Register Publication_Widget on widgets_init hook
add_action('widgets_init','register_publication_widget');

function register_publication_widget(){
    register_widget('Publication_Widget');
}