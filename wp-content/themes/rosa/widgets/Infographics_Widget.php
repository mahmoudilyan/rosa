<?php

/**
 * Publication Widget
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Infographics_Widget extends WP_Widget {

    public function __construct() {
        $params = array(
            'description' => __('This will display your InfoGraphics','rosa'),
            'name' => __('Rosa Infographics Widget','rosa')
        );
        parent::__construct('Infographics_Widget','',$params);
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


            $posts_args = array(
                'showposts' => 1,
                'post_type' => 'infographic',
                'suppress_filters'=> 0
            );
            $infographic_posts = get_posts($posts_args);


            echo $before_widget;
            if (!empty($title))
                echo $before_title . "<h3>{$title}</h3>" . $after_title;

            echo '<div class="infographics">';

            foreach($infographic_posts as $infographic) :

                ?>

                <div class="infographic-single">
                    <a href="<?php echo get_permalink($infographic->ID) ;?>">
                        <?php echo get_the_post_thumbnail($infographic->ID, 'publication'); ?>
                    </a>
                    <h2>
                        <a  href="<?php echo get_post_meta($infographic->ID,'infographic_link',true);?>">
                            <?php echo $infographic->post_title ;?>
                        </a>
                    </h2>
                    <p><?php echo $infographic->post_excerpt ;?></p>
                </div>
            <?php
            endforeach;
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
        $instance['language'] = strip_tags($new_instance['language']);
        return $instance;
    }


}


// Register Publication_Widget on widgets_init hook
add_action('widgets_init','register_infographics_widget');

function register_infographics_widget(){
    register_widget('Infographics_Widget');
}
