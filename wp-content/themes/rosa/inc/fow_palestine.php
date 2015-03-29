<?php 
/**
 * New Custom Post type (FOW Jordan) in the wordpress wp_posts table
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class FOWPalestine {
    
    public function __construct() {

        // Changing Default `Enter Your Title Here in Title Box`
        add_filter('enter_title_here', array($this, 'change_default_title'));
        
        //Adding All JS scripts
        add_action( 'admin_enqueue_scripts', array($this,'add_fowpalestine_js') );
        
        //Adding All CSS files
        add_action( 'admin_enqueue_scripts', array($this,'add_fowpalestine_css') );
        
        // Removing Parent From Years Form
        add_action('admin_head', array($this, 'remove_parent_from_years'));

        //Adding publication post type
        add_action('init',array($this,'add_fowpalestine_post_type'));
        
        //Adding years taxonomy for publication custom post type
        add_action('init',array($this,'add_fowpalestine_years_taxonomy')); 

        //Saving Meta Boxes
        //add_action( 'save_post', array($this,'save_publication_meta_box') );        

        //Adding question-contest taxonomy for question post type
        //add_action('add_meta_boxes',array($this,'add_publication_meta_boxes'));          
        
    }
    
    /**
     * 
     */
    public function add_fowpalestine_post_type(){
          $labels = array(
            'name' => __('Field Of Work palestine','fespal'),
            'singular_name' => __('Field Of Work palestine','fespal'),
            'add_new' => __('Add new','fespal'),
            'add_new_item' => __('Add New FOW palestine','fespal'),
            'edit_item' => __('Edit FOW palestine','fespal'),
            'new_item' => __('New FOW palestine','fespal'),
            'all_items' => __('All FOW palestine','fespal'),
            'view_item' => __('View FOW palestine','fespal'),
            'search_items' => __('Search FOW palestine','fespal'),
            'not_found' => __('No FOW palestine found','fespal'),
            'not_found_in_trash' => __('No FOW found in Trash','fespal'),
            'parent_item_colon' => '',
            'menu_name' => __('FOW palestine','fespal')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'fow_palestine'),
            'capability_type' => 'post',
            'exclude_from_search' => false,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_position' => 25,
            //'show_in_nav_menus' => true,
            //'menu_icon' => get_bloginfo('template_url').'/img/publication.png',
            'supports' => array('title', 'thumbnail','editor','excerpt')
        );

        register_post_type('fow_palestine', $args);
    }
    
    /**
     * 
     */
    public function add_fowpalestine_years_taxonomy(){
          $labels = array(
            'name' => _x('FOW Palestine Years', 'taxonomy general name'),
            'singular_name' => _x('Years', 'taxonomy singular name'),
            'search_items' => __('Search Years','fespal'),
            'all_items' => __('All Years','fespal'),
            'parent_item' => __('Parent','fespal'),
            'parent_item_colon' => __('Parent ','fespal'),
            'edit_item' => __('Edit Year','fespal'),
            'update_item' => __('Update Year','fespal'),
            'add_new_item' => __('Add New Year','fespal'),
            'new_item_name' => __('New Year Name','fespal'),
            'menu_name' => __('FOW Palestine Years','fespal')
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'fow_palestine_years')
        );

        register_taxonomy('fow_palestine_years', array('fow_palestine'), $args);
    }
    
    /**
     * 
     */
    function change_default_title($title) {
        // Changin Enter Your Title Here Placeholder
        $screen = get_current_screen();

        if ('fow_palestine' == $screen->post_type) {
            $title = __('Enter Field Of Work palestine Title Here', 'fespal');
        }
        return $title;
    }

    
    /**
     * 
     */

    
    /**
     * 
     */
    // public function save_publication_meta_box($post_id){
    //     if (!isset($_POST['publication_meta_box_nonce']) || !wp_verify_nonce($_POST['publication_meta_box_nonce'], 'publication_meta_box')) {
    //         return $post_id;
    //     }
    //     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    //         return $post_id;
    //     }
        
    //     if(isset($_POST['publication_link']) &&
    //        isset($_POST['publication_date'])
    //       ){
    //         update_post_meta($post_id,'publication_link', $_POST['publication_link']);
    //         update_post_meta($post_id,'publication_date', $_POST['publication_date']);
    //     }
        
    // }     
    
    /**
     * 
     */
    function remove_parent_from_years() {
        // Changin Enter Your Title Here Placeholder
        $screen = get_current_screen();
        //echo $screen;
        global $pagenow;
        if(isset($_GET['post_type']) && $_GET['post_type'] =='fow_palestine') :
        //echo $pagenow;
            if (in_array($pagenow,array('edit-tags.php'))) :
            ?>

                <script>
                   jQuery(document).ready(function(){
                       jQuery("#parent").parent().remove();
                       jQuery("label[for='parent']").parent().remove();
                       jQuery("label[for='tag-name']").text("Year").parent().find("p").html("Enter the Year as a text");
                       jQuery("label[for='name']").text("Year");
                       jQuery("#name + p.description").html("Enter The Year name as a text");
                   });
                </script>
            <?php 
            endif;
        endif;
        
        
    }

 

    /**
     * 
     */
    function add_fowpalestine_js(){
        wp_enqueue_script('contest_admin_area', get_bloginfo('template_url') . '/js/adminArea.js', __FILE__);
        wp_enqueue_script('jquery-ui-datepicker');
    }
    
    
    public function add_fowpalestine_css(){
        wp_register_style('jquery-ui-css', 'http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_style('jquery-ui-css');
    }
}

return new FOWPalestine();