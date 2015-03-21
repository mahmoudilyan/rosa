<?php
/**
 * Contact Details Widget
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Company_Details_Widget extends WP_Widget {
    
    public function __construct() {
        $params = array(
            'description' => __('Company Widget Details for Rosa','rosa'),
            'name' => __('Rosa Company Details','rosa')
        );
        
        parent::__construct('Company_Details_Widget','',$params);
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
            
            <label for="<?php echo $this->get_field_id('company_details') ;?>"><?php _e('Company Details','rosa') ;?></label>
            <textarea 
                   name="<?php echo $this->get_field_name('company_details') ;?>" 
                   id="<?php echo $this->get_field_id('company_details') ;?>" 
                   class="widefat"><?php if(isset($company_details)){echo $company_details ;} ?></textarea>
            
          
                   
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
        if($language == ICL_LANGUAGE_CODE) :
        echo $before_widget;
        ?>

        <p><?php echo $company_details ;?></p>

    <?php
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
        return $new_instance;
    }
    
   
}


// Register News_Widget on widgets_init hook
add_action('widgets_init','register_company_details_widget');

function register_company_details_widget(){
    register_widget('Company_Details_Widget');
}
