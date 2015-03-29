$('document').ready(function (){
	"use strict";

	$('#main-slider').owlCarousel({
      singleItem:true,
      autoPlay: true
  });


	$(".publication_fade").owlCarousel({
      singleItem:true,
      autoPlay: false,
      navigation: true,

	});

	//$('.nav-container .menu').dropdown();

  $('.nav-container .menu > li > ul .current-menu-item').parent().addClass("active");

	$(".nav-container .menu > li > a").on("click", function(){
		var $this = $(this),
			$dropdown = $this.parent().find(".sub-menu");

    $this.parents(".nav-container").find(".sub-menu").removeClass("active");

		if($dropdown.length > 0){
			if ( $dropdown.hasClass("active") ){
          $dropdown.removeClass("active");
      } else {
        $dropdown.addClass("active");
      }
			//return false;
		}

	});

    // Initialize navgoco with default options
    $("#menu-fields-of-work").navgoco({
        caretHtml: '',
        accordion: true,
        openClass: 'open',
        save: true,
        slide: {
            duration: 400,
            easing: 'swing'
        },
        // Add Active class to clicked menu item
        //onClickAfter: active_menu_cb,
    });

});