<?php

/**
 * News Widget
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class News_Widget extends WP_Widget {
    
    public function __construct() {
        $params = array(
            'description' => __('Widget News','rosa'),
            'name' => __('Rosa News Widget','rosa')
        );
        parent::__construct('News_Widget','',$params);
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
                <option value="<?php echo $lang->code ;?>" <?php selected($lang->code, $language) ;?>><?php echo $lang->english_name ;?></option>
                <?php endforeach ;?>
            </select>

            <label for="<?php echo $this->get_field_id('title') ;?>"><?php _e('Title','rosa') ;?></label>
            <input type="text" 
                   name="<?php echo $this->get_field_name('title') ;?>" 
                   value="<?php if(isset($title)) { echo $title ; } ?>" 
                   id="<?php echo $this->get_field_id('title') ;?>" />
            
            
            <label for=<?php echo $this->get_field_name('news_category') ;?>" ><?php _e('Choose Your News Category','rosa'); ?> </label>
            <?php wp_dropdown_categories('class=widefat&selected='.$news_category.'&name='.$this->get_field_name('news_category').'id='.$this->get_field_id('news_category')); ?>
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
        $category_lang_id = icl_object_id($news_category,'category',false,ICL_LANGUAGE_CODE);
        if($language == ICL_LANGUAGE_CODE) :
        echo $before_widget;
        ?>
        <div class=newsboxes>
        <?php
        if (!empty($title))
            echo $before_title . $title . $after_title;
        
        $the_query = new WP_Query('nopagin=true&posts_per_page=3&cat='.$category_lang_id );
        ?>
        <?php
        if($the_query->have_posts()) : 
            echo '<ul>';
            while($the_query->have_posts()) : 
            $the_query->the_post(); 
            ?>
            <li>
                <span><?php the_time('F jS, Y') ;?></span>
                <a href="<?php  the_permalink(); ?>"><?php the_title();?></a>
            </li>
        <?php
        endwhile;
        echo '</ul>';
         endif;
        wp_reset_postdata();
        ?>
        <!-- 
        <a href="<?php //echo get_category_link($news_category);?>"><?php _e('Read More','rosa') ;?></a>
        -->
        <?php
        echo '</div>';
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
        $instance['news_category'] = strip_tags($new_instance['news_category']);
        $instance['language'] = strip_tags($new_instance['language']);
        return $instance;
    }
    
   
}


// Register News_Widget on widgets_init hook
add_action('widgets_init','register_news_widget');

function register_news_widget(){
    register_widget('News_Widget');
}