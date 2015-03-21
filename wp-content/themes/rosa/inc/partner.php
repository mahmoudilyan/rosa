<?php
/**
 * New Custom Post type (partner) in the wordpress wp_posts table
 *
 * @author Mahmoud Ilyan <mahmoudilyan@gmail.com>
 */
class Partner {

    public function __construct() {

        // Changing Default `Enter Your Title Here in Title Box`
        add_filter('enter_title_here', array($this, 'change_default_title'));


        //Adding publication post type
        add_action('init',array($this,'add_partner_post_type'));

        //Saving Meta Boxes
        add_action( 'save_post', array($this,'save_partner_meta_box') );

        //Adding question-contest taxonomy for question post type
        add_action('add_meta_boxes',array($this,'add_partner_meta_boxes'));
    }

    /**
     *
     */
    public function add_partner_post_type(){
          $labels = array(
            'name' => __('Partners','fespal'),
            'singular_name' => __('Partner','fespal'),
            'add_new' => __('Add new','fespal'),
            'add_new_item' => __('Add New Partner','fespal'),
            'edit_item' => __('Edit Partner','fespal'),
            'new_item' => __('New Partner','fespal'),
            'all_items' => __('All Partners','fespal'),
            'view_item' => __('View Partners','fespal'),
            'search_items' => __('Search partners','fespal'),
            'not_found' => __('No Partners found','fespal'),
            'not_found_in_trash' => __('No Partners found in Trash','fespal'),
            'parent_item_colon' => '',
            'menu_name' => __('Partners','fespal')
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'partner'),
            'capability_type' => 'post',
            'exclude_from_search' => false,
            'hierarchical' => false,
            'has_archive' => true,
            'menu_position' => 25,
            'menu_icon' => get_bloginfo('template_url').'/img/partner.png',
            'supports' => array('title', 'thumbnail','editor','excerpt')
        );

        register_post_type('partner', $args);
    }


    /**
     *
     */
    function change_default_title($title) {
        // Changin Enter Your Title Here Placeholder
        $screen = get_current_screen();

        if ('partner' == $screen->post_type) {
            $title = __('Enter Your Partner Name Here', 'fespal');
        }
        return $title;
    }

    /**
     *
     */
    public function add_partner_meta_boxes(){
        add_meta_box( 'partner_meta_box', 'Partner Link', array($this, 'show_link_form'), 'partner', 'normal', 'high' );
    }

    /**
     *
     */
    public function show_link_form($post){
        $link = get_post_meta($post->ID,'partner_link', true);
        ?>

            <div class="formContainer">
                <div class="textWrap">

                    <input type="hidden" name="partner_meta_box_nonce" value="<?php echo wp_create_nonce('partner_meta_box') ;?>" />



                    <div class="link">
                        <label for="partner-link"><?php _e('Partner Link','fespal') ;?></label>
                        <input type="text" class="partner-link" value="<?php if(!empty($link)){echo $link;}?>"  id="partner-link" name="partner_link" />
                        <br />
                    </div>
                </div>
           </div>
        <?php
    }

    /**
     *
     */
    public function save_partner_meta_box($post_id){
        if (!isset($_POST['partner_meta_box_nonce']) || !wp_verify_nonce($_POST['partner_meta_box_nonce'], 'partner_meta_box')) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        if(isset($_POST['partner_link'])){
            update_post_meta($post_id,'partner_link', $_POST['partner_link']);
        }

    }

}

return new Partner();