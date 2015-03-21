<?php
/**
 * Created by
 * User: Mahmoud
 * Date: 4/9/13
 * Time: 12:55 AM
 * To change this template use File | Settings | File Templates.
 */

/**
 * New Custom Post type (infographics) in the wordpress wp_posts table
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Infographics {

    public function __construct() {

        // Changing Default `Enter Your Title Here in Title Box`
        add_filter('enter_title_here', array($this, 'change_default_title'));


        //Adding infographics post type
        add_action('init',array($this,'add_infographics_post_type'));

        //Saving Meta Boxes
        add_action( 'save_post', array($this,'save_infographics_meta_box') );

        //Adding Meta Boxes
        add_action('add_meta_boxes',array($this,'add_infographics_meta_boxes'));
    }

    /**
     *
     */
    public function add_infographics_post_type(){
        $labels = array(
            'name' => __('Infographic','fespal'),
            'singular_name' => __('Infographic','fespal'),
            'add_new' => __('Add new','fespal'),
            'add_new_item' => __('Add New Infographic','fespal'),
            'edit_item' => __('Edit Infographic Fact','fespal'),
            'new_item' => __('New Infographic Fact','fespal'),
            'all_items' => __('All Infographic','fespal'),
            'view_item' => __('View Infographic','fespal'),
            'search_items' => __('Search Infographic','fespal'),
            'not_found' => __('No Infographic found','fespal'),
            'not_found_in_trash' => __('No Infographic found in Trash','fespal'),
            'parent_item_colon' => '',
            'menu_name' => __('Infographics','fespal')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'fridayfact'),
            'capability_type' => 'post',
            'exclude_from_search' => false,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_position' => 25,
            'menu_icon' => get_bloginfo('template_url').'/img/infographic.png',
            'supports' => array('title', 'thumbnail','editor','excerpt')
        );

        register_post_type('infographic', $args);
    }


    /**
     *
     */
    function change_default_title($title) {
        // Changin Enter Your Title Here Placeholder
        $screen = get_current_screen();

        if ('infographic' == $screen->post_type) {
            $title = __('Enter Your Infographic Title Here', 'fespal');
        }
        return $title;
    }

    /**
     *
     */
    public function add_infographics_meta_boxes(){
        add_meta_box( 'infographics_meta_box', 'Infographic Link', array($this, 'show_link_form'), 'infographic', 'normal', 'high' );
    }

    /**
     *
     */
    public function show_link_form($post){
        $link = get_post_meta($post->ID,'infographic_link', true);
        ?>

        <div class="formContainer">
            <div class="textWrap">

                <input type="hidden" name="infographics_meta_box_nonce" value="<?php echo wp_create_nonce('infographics_meta_box') ;?>" />



                <div class="link">
                    <label for="infographic-link"><?php _e('Infographic Link','fespal') ;?></label>
                    <input type="text" class="infographic-link" value="<?php if(!empty($link)){echo $link;}?>"  id="infographic-link" name="infographic_link" />
                    <br />
                </div>
            </div>
        </div>
    <?php
    }

    /**
     *
     */
    public function save_infographics_meta_box($post_id){
        if (!isset($_POST['infographics_meta_box_nonce']) || !wp_verify_nonce($_POST['infographics_meta_box_nonce'], 'infographics_meta_box')) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        if(isset($_POST['infographic_link'])){
            update_post_meta($post_id,'infographic_link', $_POST['infographic_link']);
        }

    }

}

return new Infographics();