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

	$(".nav-container .menu > li > a").on("click", function(){
		var $this = $(this),
			$dropdown = $this.parent().find(".sub-menu");

		if($dropdown.length > 0){
			$dropdown.toggleClass("active");
			return false;


		}
	});

});