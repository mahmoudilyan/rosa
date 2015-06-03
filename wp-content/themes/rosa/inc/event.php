<?php 
/**
 * New Custom Post type (publication) in the wordpress wp_posts table
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Event {
    
    public function __construct() {

        // Changing Default `Enter Your Title Here in Title Box`
        add_filter('enter_title_here', array($this, 'change_default_title'));
        
        //Adding All JS scripts
        add_action( 'admin_enqueue_scripts', array($this,'add_publication_js') );
        
        //Adding All CSS files
        add_action( 'admin_enqueue_scripts', array($this,'add_publication_css') );
        
        // Removing Parent From Years Form
        add_action('admin_head', array($this, 'remove_parent_from_years'));

        //Adding Event post type
        add_action('init',array($this,'add_event_post_type'));
        
        //Adding years taxonomy for publication custom post type
        add_action('init',array($this,'add_events_categories_taxonomy')); 

        //Saving Meta Boxes
        add_action( 'save_post', array($this,'save_event_meta_box') );        

        //Adding question-contest taxonomy for question post type
        add_action('add_meta_boxes',array($this,'add_event_meta_boxes'));          
        
    }
    
    /**
     * 
     */
    public function add_event_post_type(){
          $labels = array(
            'name' => __('Events','fespal'),
            'singular_name' => __('Event','fespal'),
            'add_new' => __('Add new','fespal'),
            'add_new_item' => __('Add New Event','fespal'),
            'edit_item' => __('Edit Event','fespal'),
            'new_item' => __('New Event','fespal'),
            'all_items' => __('All Event','fespal'),
            'view_item' => __('View Event','fespal'),
            'search_items' => __('Search Events','fespal'),
            'not_found' => __('No Events found','fespal'),
            'not_found_in_trash' => __('No Events found in Trash','fespal'),
            'parent_item_colon' => '',
            'menu_name' => __('Events','fespal')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'event'),
            'capability_type' => 'post',
            'exclude_from_search' => false,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_position' => 25,
            //'menu_icon' => get_bloginfo('template_url').'/img/publication.png',
            'supports' => array('title', 'thumbnail','editor','excerpt')
        );

        register_post_type('event', $args);
    }
    
    /**
     * 
     */
    public function add_events_categories_taxonomy(){
          $labels = array(
            'name' => _x('Events Categories', 'taxonomy general name'),
            'singular_name' => _x('Event Category', 'taxonomy singular name'),
            'search_items' => __('Search Events Categories','fespal'),
            'all_items' => __('All Events Categories','fespal'),
            'parent_item' => __('Parent','fespal'),
            'parent_item_colon' => __('Parent ','fespal'),
            'edit_item' => __('Edit Event Category','fespal'),
            'update_item' => __('Update Event Category','fespal'),
            'add_new_item' => __('Add New Event Category','fespal'),
            'new_item_name' => __('New Event Category Name','fespal'),
            'menu_name' => __('Events Categories','fespal')
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'events-categories')
        );

        register_taxonomy('events_categories', array('event'), $args);
    }
   
    
    /**
     * 
     */
    function change_default_title($title) {
        // Changin Enter Your Title Here Placeholder
        $screen = get_current_screen();

        if ('event' == $screen->post_type) {
            $title = __('Enter Your Event Title Here', 'fespal');
        }
        return $title;
    }

    /**
     * 
     */
    public function add_event_meta_boxes(){
        add_meta_box( 'events_meta_box', 'Event Details', array($this, 'show_details_form'), 'event', 'normal', 'high' );  
    }
    
    /**
     * 
     */
    public function show_details_form($post){
        $organizer = get_post_meta($post->ID,'event_organizer', true);
        $date = get_post_meta($post->ID,'event_date', true);
        $location = get_post_meta($post->ID,'event_location', true);
        $type = get_post_meta($post->ID,'event_type', true);
        $event_single = get_post_meta($post->ID,'event_single', true);

        ?>

            <div class="formContainer">
                <div class="textWrap">
                    
                    <input type="hidden" name="event_meta_box_nonce" value="<?php echo wp_create_nonce('event_meta_box') ;?>" />
                    

                    
                    <div class="organizer">
                        <label for="event-organizer"><?php _e('Event Organizer','rosa') ;?></label>
                        <input type="text" class="event-organizer" value="<?php if(!empty($organizer)){echo $organizer;}?>"  id="event-organizer" name="event_organizer" />
                        <br />
                    </div>

                    
                    <div class="date">
                        <label for="event-date"><?php _e('Event Date','rosa') ;?></label>
                        <input type="text" class="event-date" value="<?php if(!empty($date)){echo $date;}?>"  id="event-date" name="event_date" />
                        <br />
                    </div>

                    <div class="location">
                        <label for="event-location"><?php _e('Event Location','rosa') ;?></label>
                        <input type="text" class="event-location" value="<?php if(!empty($location)){echo $location;}?>"  id="event-location" name="event_location" />
                        <br />
                    </div>

                    <div class="type">
                        <label for="event-type"><?php _e('Event Type','rosa') ;?></label>
                        <input type="text" class="event-type" value="<?php if(!empty($type)){echo $type;}?>"  id="event-type" name="event_type" />
                        <br />
                    </div>

                    <div class="single">
                        <label for="event-single"><?php _e('Event Single Page','rosa') ;?></label>
                        <input type="radio" class="event-single" value="on" <?php if(!empty($event_single) && $event_single === 'on' ){ echo 'checked';}?>  id="event-single" name="event_single" /> Yes
                        <input type="radio" class="event-single" value="off" <?php if(!empty($event_single) && $event_single === 'off' ){ echo 'checked';}?>  id="event-single" name="event_single" /> No
                        <br />
                    </div>





                </div>
           </div>
        <?php
    }
    
    /**
     * 
     */
    public function save_event_meta_box($post_id){
        if (!isset($_POST['event_meta_box_nonce']) || !wp_verify_nonce($_POST['event_meta_box_nonce'], 'event_meta_box')) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        
        if(isset($_POST['event_organizer']) &&
           isset($_POST['event_date']) &&
           isset($_POST['event_location']) &&
           isset($_POST['event_type']) 
           //isset($_POST['event_single'])
          ){
            update_post_meta($post_id,'event_organizer', $_POST['event_organizer']);
            update_post_meta($post_id,'event_date', $_POST['event_date']);
            update_post_meta($post_id,'event_location', $_POST['event_location']);
            update_post_meta($post_id,'event_type', $_POST['event_type']);
            update_post_meta($post_id,'event_single', $_POST['event_single']);
        }
        
    }     
    
    /**
     * 
     */
    function remove_parent_from_years() {
        // Changin Enter Your Title Here Placeholder
        $screen = get_current_screen();
        //echo $screen;
        global $pagenow;
        if(isset($_GET['post_type']) && $_GET['post_type'] =='publication') :
        //echo $pagenow;
            if (in_array($pagenow,array('edit-tags.php'))) :
            ?>

                <script>
                   jQuery(document).ready(function(){
                       jQuery("#parent").parent().remove();
                       jQuery("label[for='parent']").parent().remove();
                       jQuery("label[for='tag-name']").text("Organization").parent().find("p").html("Enter the organization as a text");
                       jQuery("label[for='name']").text("Organization");
                       jQuery("#name + p.description").html("Enter The organization name as a text");
                   });
                </script>
            <?php 
            endif;
        endif;
        
        
    }

 

    /**
     * 
     */
    function add_publication_js(){
        wp_enqueue_script('contest_admin_area', get_bloginfo('template_url') . '/js/adminArea.js', __FILE__);
        wp_enqueue_script('jquery-ui-datepicker');
    }
    
    
    public function add_publication_css(){
        wp_register_style('jquery-ui-css', 'http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_style('jquery-ui-css');
    }
}

return new Event();