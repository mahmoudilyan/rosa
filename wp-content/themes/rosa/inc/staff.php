<?php 
/**
 * New Custom Post type (staff) in the wordpress wp_posts table
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Staff {
    
    public function __construct() {

        // Changing Default `Enter Your Title Here in Title Box`
        add_filter('enter_title_here', array($this, 'change_default_title'));


        //Adding publication post type
        add_action('init',array($this,'add_staff_post_type'));
        
        //Saving Meta Boxes
        add_action( 'save_post', array($this,'save_staff_meta_box') );        

        //Adding question-contest taxonomy for question post type
        add_action('add_meta_boxes',array($this,'add_staff_meta_boxes'));        
    }
    
    /**
     * 
     */
    public function add_staff_post_type(){
          $labels = array(
            'name' => __('Staff','fespal'),
            'singular_name' => __('Staff','fespal'),
            'add_new' => __('Add new','fespal'),
            'add_new_item' => __('Add New Staff','fespal'),
            'edit_item' => __('Edit Staff','fespal'),
            'new_item' => __('New Staff','fespal'),
            'all_items' => __('All Staff','fespal'),
            'view_item' => __('View Staff','fespal'),
            'search_items' => __('Search Staff','fespal'),
            'not_found' => __('No Staff found','fespal'),
            'not_found_in_trash' => __('No Staff found in Trash','fespal'),
            'parent_item_colon' => '',
            'menu_name' => __('Staff','fespal')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'staff', 'with_front' => true),
            'capability_type' => 'post',
            'exclude_from_search' => false,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_position' => 25,
            'menu_icon' => get_bloginfo('template_url').'/img/staff.png',
            'supports' => array('title', 'thumbnail','editor','excerpt')
        );

        register_post_type('staff', $args);
    }
    
    
    /**
     * 
     */
    function change_default_title($title) {
        // Changin Enter Your Title Here Placeholder
        $screen = get_current_screen();

        if ('staff' == $screen->post_type) {
            $title = __('Enter Employee Name Here', 'fespal');
        }
        return $title;
    }
    
    /**
     * 
     */
    public function add_staff_meta_boxes(){
        add_meta_box( 'staff_meta_box', 'Staff Details', array($this, 'show_details_form'), 'staff', 'normal', 'high' );  
    }
    
    /**
     * 
     */
    public function show_details_form($post){
        $position = get_post_meta($post->ID,'employee_position', true);
        $location = get_post_meta($post->ID,'employee_location', true);
        ?>

            <div class="formContainer">
                <div class="textWrap">
                    
                    <input type="hidden" name="staff_meta_box_nonce" value="<?php echo wp_create_nonce('staff_meta_box') ;?>" />
                    

                    
                    <div class="emplyee-details">
                        <label for="position"><?php _e('Position','fespal') ;?></label>
                        <input type="text" class="employee-position" value="<?php if(!empty($position)){echo $position;}?>"  id="employee-position" name="employee_position" />
                        <br />
                        
                        <label for="location"><?php _e('Location','fespal') ;?></label>
                        <input type="text" class="employee-location" value="<?php if(!empty($location)){echo $location;}?>"  id="employee-position" name="employee_location" />
                        <br />
                        
                    </div>
                </div>
           </div>
        <?php
    }
    
    /**
     * 
     */
    public function save_staff_meta_box($post_id){
        if (!isset($_POST['staff_meta_box_nonce']) || !wp_verify_nonce($_POST['staff_meta_box_nonce'], 'staff_meta_box')) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        
        if(isset($_POST['employee_position']) && isset($_POST['employee_location'])){
            update_post_meta($post_id,'employee_position', $_POST['employee_position']);
            update_post_meta($post_id,'employee_location', $_POST['employee_location']);

        }
        
    }    
    
}

return new Staff();