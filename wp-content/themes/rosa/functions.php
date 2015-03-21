<?php
    //error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Include Library
    include_once ('widgets/News_Widget.php'); 
    include_once ('widgets/Contact_Details_Widget.php'); 
    include_once ('widgets/Publication_Widget.php'); 
    include_once ('widgets/Infographics_Widget.php');
    include_once ('widgets/Company_Info_Widget.php');
    include_once 'inc/publication.php';
    include_once 'inc/infographics.php';
    include_once 'inc/partner.php';
    include_once 'inc/staff.php';
    include_once 'inc/fow_jordan.php';
    include_once 'inc/fow_palestine.php';

    // Category For Home Page
    $home_page_category = get_cat_ID('home');
    $home_page_id = icl_object_id(16, 'page', false);
    
    // Adding Image thumbnail Sizes
    add_image_size('year_activities','120','80',true);
    add_image_size('month_activities','120','130',true);
    add_image_size('publication','130','178',true);
    add_image_size('single','400','178' ,true );
    add_image_size('staff','150','200',true);
    add_image_size('yearly_archive','150','200',true);
    add_image_size('single_staff','150','150',true);
    add_image_size('partner','150','150',true);
    add_image_size('home_slider','500','300', true);

	
	// Add RSS links to <head> section
	automatic_feed_links();
	load_theme_textdomain('rosa', get_template_directory().'/languages/');
    
    
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://code.jquery.com/jquery-1.7.2.min.js"), false);
	   wp_enqueue_script('jquery');
	}
    
    // function excerpt_read_more_link($output) {
    //  global $post;
    //  $output .= '<a href="'. get_permalink($post->ID) . '">'.__('Read More ...','fespal').'</a>';
    //  return $output;
    // }
    // add_filter('the_excerpt', 'excerpt_read_more_link');    
	
    // Adding Featured Image
    add_theme_support( 'post-thumbnails' ); 
    
//    if (function_exists('register_sidebar')) {
//    	register_sidebar(array(
//    		'name' => 'Sidebar Widgets Main Home',
//    		'id'   => 'sidebar-widgets',
//    		'description'   => 'These are widgets for the sidebar.',
//    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
//    		'after_widget'  => '</div>',
//    		'before_title'  => '<h2>',
//    		'after_title'   => '</h2>'
//    	));
//    }
    

    if ( function_exists( 'register_nav_menus' ) ) {
      register_nav_menus(
        array (
          'top_menu' => __( 'Primary Menu' , 'rosa' ),
        )
      );
    }    

    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Home Page Sidebar',
    		'id'   => 'homepage-sidebar-widget',
    		'description'   => 'These are widgets for the home-pagesidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h3>',
    		'after_title'   => '</h3>'
    	));
    }

    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => 'Fields Of Work Page Sidebar',
            'id'   => 'fields-of-work-sidebar-widget',
            'description'   => 'These are widgets for the Fields Of Work Page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));
    }    
    
    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => 'Single Post',
            'id'   => 'single-post',
            'description'   => 'These are widgets for Single Post,Page,..',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ));
    }       
//    if (function_exists('register_sidebar')) {
//    	register_sidebar(array(
//    		'name' => 'Contact Page Sidebar',
//    		'id'   => 'contactpage-sidebar-widget',
//    		'description'   => 'These are widgets for the contact-sidebar.',
//    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
//    		'after_widget'  => '</div>',
//    		'before_title'  => '<h3>',
//    		'after_title'   => '</h3>'
//    	));
//    }
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Home page footer 1',
    		'id'   => 'homepage-sidebar-widget1',
    		'description'   => 'These are widgets for the homepage footer -sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h3>',
    		'after_title'   => '</h3>'
    	));
    }
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Home page footer 2',
    		'id'   => 'homepage-sidebar-widget2',
    		'description'   => 'These are widgets for the homepage footer -sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h3>',
    		'after_title'   => '</h3>'
    	));
    }

    function array_checked($array,$value){
        $status = false;
        for($i=0; $i < sizeof($array);$i++){
            if($array[$i] == $value){
                $status = true;
            }
        }
        if($status){
            echo "checked";
        }
    }
    
    
    function get_languages(){
        global $wpdb;
        $table_name = $wpdb->prefix.'icl_languages';
        return  $wpdb->get_results("SELECT * FROM $table_name WHERE active =  '1'");
    }

    function languages_list_header(){
        $languages = icl_get_languages('skip_missing=0&orderby=code');
        if(!empty($languages)){
            echo '<ul class="lang-links">';
            foreach($languages as $l){
                ?>
                <li>
                    <a href="<?php echo $l['url']; ?>" <?php if($l['active']) {echo 'class="active" ';} ?>
                        >
                    <?php echo icl_disp_language($l['translated_name']); ?>
                    </a>
                </li>
                <?php
            }
            echo '</ul>';
        }
    }    

    // Adding Shortcode
    add_shortcode('half_column_first','half_column_first');
    add_shortcode('half_column_last','half_column_last');

    function half_column_first($atts,$content = null){
        return "<div class=\"half_column\"> $content </div>";
    }

    function half_column_last($atts,$content = null){
        return "<div class=\"half_column last\"> $content </div>";
    }


function fespal_content_nav($html_id, $the_query)
{

    if ($the_query->max_num_pages > 1) : ?>
        <div id="<?php echo esc_attr($html_id); ?>">
            <div
                class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'fespal'), $the_query->max_num_pages ); ?></div>
            <div
                class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'fespal'), $the_query->max_num_pages ); ?></div>
        </div><!-- #nav-above -->
    <?php endif;
}
