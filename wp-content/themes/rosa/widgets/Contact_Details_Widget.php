<?php
/**
 * Contact Details Widget
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Contact_Details_Widget extends WP_Widget {
    
    public function __construct() {
        $params = array(
            'description' => __('Contact Widget Details for Rosa','rosa'),
            'name' => __('Rosa Contact Details','rosa')
        );
        
        parent::__construct('Contact_Details_Widget','',$params);
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
            
            <label for="<?php echo $this->get_field_id('address') ;?>"><?php _e('Address','rosa') ;?></label>
            <textarea 
                   name="<?php echo $this->get_field_name('address') ;?>" 
                   id="<?php echo $this->get_field_id('address') ;?>" 
                   class="widefat"><?php if(isset($address)){echo $address ;} ?></textarea>
            
            
            <label for="<?php echo $this->get_field_id('phone') ;?>" ><?php _e('Phone','rosa'); ?> </label>
            <input type="text" 
                   name="<?php echo $this->get_field_name('phone') ;?>" 
                   value="<?php if(isset($phone)) { echo $phone ; } ?>" 
                   id="<?php echo $this->get_field_id('phone') ;?>"
                   class="widefat" />
            
            <label for="<?php echo $this->get_field_id('fax') ;?>" ><?php _e('fax','rosa'); ?> </label>
            <input type="text" 
                   name="<?php echo $this->get_field_name('fax') ;?>" 
                   value="<?php if(isset($fax)) { echo $fax ; } ?>" 
                   id="<?php echo $this->get_field_id('fax') ;?>"
                   class="widefat" />
            
            <label for="<?php echo $this->get_field_id('email') ;?>" ><?php _e('email','rosa'); ?> </label>
            <input type="text" 
                   name="<?php echo $this->get_field_name('email') ;?>" 
                   value="<?php if(isset($email)) { echo $email ; } ?>" 
                   id="<?php echo $this->get_field_id('email') ;?>"
                   class="widefat" />
            
            <label for="<?php echo $this->get_field_id('website') ;?>" ><?php _e('website','rosa'); ?> </label>
            <input type="text" 
                   name="<?php echo $this->get_field_name('website') ;?>" 
                   value="<?php if(isset($website)) { echo $website ; } ?>" 
                   id="<?php echo $this->get_field_id('website') ;?>"
                   class="widefat" />
            
            <label for="<?php echo $this->get_field_id('facebook') ;?>" ><?php _e('facebook page','rosa'); ?> </label>
            <input type="text" 
                   name="<?php echo $this->get_field_name('facebook') ;?>" 
                   value="<?php if(isset($facebook)) { echo $facebook ; } ?>" 
                   id="<?php echo $this->get_field_id('facebook') ;?>"
                   class="widefat" />
                   
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
        
        <div id="contact">
<!--             <p><?php echo $address; ?></p>
 -->            <p><?php _e('Phone:','rosa') ;?> <?php echo $phone; ?><br />
               <?php _e('Fax:','rosa') ;?> <?php echo $fax ;?></p>
            <p>
        <?php _e('E-Mail:','rosa') ;?> <a href="mailto:<?php echo $email ;?>" title="Mail to <?php echo $email ;?>"><?php echo $email ;?></a><br />
        <?php echo $website ;?>
        </p>
<!--             <div class="social-media">
                <a href="http://www.facebook.com/<?php echo $facebook ;?>" class="sb embossed facebook">Facebook</a>
            </div>
 -->        </div>
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
add_action('widgets_init','register_contact_details_widget');

function register_contact_details_widget(){
    register_widget('Contact_Details_Widget');
}
