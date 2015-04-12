<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>
	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />

    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/bower_components/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/bower_components/owlCarousel/owl-carousel/owl.carousel.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/bower_components/owlCarousel/owl-carousel/owl.theme.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/bower_components/owlCarousel/owl-carousel/owl.transitions.css"/>


    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/main.css"/>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/print.css" media="print"/>

	<?php if(ICL_LANGUAGE_CODE === 'ar') : ;?>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/bower_components/bootstrap-rtl/dist/css/bootstrap-rtl.min.css"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/rtl.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/owl-rtl.css"/>
    <?php endif; ?>
    
    <!--[if lt IE 9]>
    <link type="text/css" href="<?php bloginfo('template_url') ;?>/css/movingboxes-ie.css" rel="stylesheet" media="screen" />
    <![endif]-->    
        
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>

</head>

<body>

    <div class="container" id="wrapper">

        <div class="row logo-container">
            <div class="col-md-10">
                <a href="<?php bloginfo('siteurl');?>"><img src="<?php bloginfo("template_url") ;?>/img/RLS-ROP.png" alt="ROSA Logo">
                </a>
            </div>
            <div class="col-md-2">

                <?php languages_list_header(); ?>

           </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="nav-container">
                    
                        <?php echo wp_nav_menu(array('theme_location' => 'top_menu')); ?> 
                </div>
            </div>
        </div>
            
