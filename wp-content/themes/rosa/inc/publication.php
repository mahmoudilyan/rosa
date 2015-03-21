<?php 
/**
 * New Custom Post type (publication) in the wordpress wp_posts table
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Publiction {
    
    public function __construct() {

        // Changing Default `Enter Your Title Here in Title Box`
        add_filter('enter_title_here', array($this, 'change_default_title'));
        
        //Adding All JS scripts
        add_action( 'admin_enqueue_scripts', array($this,'add_publication_js') );
        
        //Adding All CSS files
        add_action( 'admin_enqueue_scripts', array($this,'add_publication_css') );
        
        // Removing Parent From Years Form
        add_action('admin_head', array($this, 'remove_parent_from_years'));

        //Adding publication post type
        add_action('init',array($this,'add_publication_post_type'));
        
        //Adding years taxonomy for publication custom post type
        add_action('init',array($this,'add_organization_publication_taxonomy')); 

        //Adding years taxonomy for publication custom post type
        add_action('init',array($this,'add_years_publication_taxonomy')); 


        //Saving Meta Boxes
        add_action( 'save_post', array($this,'save_publication_meta_box') );        

        //Adding question-contest taxonomy for question post type
        add_action('add_meta_boxes',array($this,'add_publication_meta_boxes'));          
        
    }
    
    /**
     * 
     */
    public function add_publication_post_type(){
          $labels = array(
            'name' => __('Publications','fespal'),
            'singular_name' => __('Publication','fespal'),
            'add_new' => __('Add new','fespal'),
            'add_new_item' => __('Add New Publication','fespal'),
            'edit_item' => __('Edit Publication','fespal'),
            'new_item' => __('New Publication','fespal'),
            'all_items' => __('All Publication','fespal'),
            'view_item' => __('View Publication','fespal'),
            'search_items' => __('Search publications','fespal'),
            'not_found' => __('No Publications found','fespal'),
            'not_found_in_trash' => __('No Publications found in Trash','fespal'),
            'parent_item_colon' => '',
            'menu_name' => __('Publications','fespal')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'publication'),
            'capability_type' => 'post',
            'exclude_from_search' => false,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_position' => 25,
            'menu_icon' => get_bloginfo('template_url').'/img/publication.png',
            'supports' => array('title', 'thumbnail','editor','excerpt')
        );

        register_post_type('publication', $args);
    }
    
    /**
     * 
     */
    public function add_organization_publication_taxonomy(){
          $labels = array(
            'name' => _x('Organizations', 'taxonomy general name'),
            'singular_name' => _x('Organization', 'taxonomy singular name'),
            'search_items' => __('Search Organizations','fespal'),
            'all_items' => __('All Organizations','fespal'),
            'parent_item' => __('Parent','fespal'),
            'parent_item_colon' => __('Parent ','fespal'),
            'edit_item' => __('Edit Organization','fespal'),
            'update_item' => __('Update Organization','fespal'),
            'add_new_item' => __('Add New Organization','fespal'),
            'new_item_name' => __('New Organization Name','fespal'),
            'menu_name' => __('Organizations','fespal')
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'organization')
        );

        register_taxonomy('organization', array('publication'), $args);
    }

    /**
     * 
     */
    public function add_years_publication_taxonomy(){
          $labels = array(
            'name' => _x('Publications Years', 'taxonomy general name'),
            'singular_name' => _x('Publications Years', 'taxonomy singular name'),
            'search_items' => __('Search Publications Yearss','fespal'),
            'all_items' => __('All Publications Yearss','fespal'),
            'parent_item' => __('Parent','fespal'),
            'parent_item_colon' => __('Parent ','fespal'),
            'edit_item' => __('Edit Publications Years','fespal'),
            'update_item' => __('Update Publications Years','fespal'),
            'add_new_item' => __('Add New Publications Years','fespal'),
            'new_item_name' => __('New Publications Years Name','fespal'),
            'menu_name' => __('Years','fespal')
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'publications_years')
        );

        register_taxonomy('publications_years', array('publication'), $args);
    }    
    
    /**
     * 
     */
    function change_default_title($title) {
        // Changin Enter Your Title Here Placeholder
        $screen = get_current_screen();

        if ('publication' == $screen->post_type) {
            $title = __('Enter Your Publication Title Here', 'fespal');
        }
        return $title;
    }

    /**
     * 
     */
    public function add_publication_meta_boxes(){
        add_meta_box( 'publication_meta_box', 'Publication Details', array($this, 'show_details_form'), 'publication', 'normal', 'high' );  
    }
    
    /**
     * 
     */
    public function show_details_form($post){
        $link = get_post_meta($post->ID,'publication_link', true);
        $date = get_post_meta($post->ID,'publication_date', true);
        ?>

            <div class="formContainer">
                <div class="textWrap">
                    
                    <input type="hidden" name="publication_meta_box_nonce" value="<?php echo wp_create_nonce('publication_meta_box') ;?>" />
                    

                    
                    <div class="link">
                        <label for="publication-link"><?php _e('Publication Link','fespal') ;?></label>
                        <input type="text" class="publication-link" value="<?php if(!empty($link)){echo $link;}?>"  id="publication-link" name="publication_link" />
                        <br />
                    </div>
                    
                    <div class="date">
                        <label for="publication-date"><?php _e('Publication Date','fespal') ;?></label>
                        <input type="text" class="publication-date" value="<?php if(!empty($date)){echo $date;}?>"  id="publication-date" name="publication_date" />
                        <br />
                    </div>
                </div>
           </div>
        <?php
    }
    
    /**
     * 
     */
    public function save_publication_meta_box($post_id){
        if (!isset($_POST['publication_meta_box_nonce']) || !wp_verify_nonce($_POST['publication_meta_box_nonce'], 'publication_meta_box')) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        
        if(isset($_POST['publication_link']) &&
           isset($_POST['publication_date'])
          ){
            update_post_meta($post_id,'publication_link', $_POST['publication_link']);
            update_post_meta($post_id,'publication_date', $_POST['publication_date']);
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

return new Publiction();