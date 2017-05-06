//$( function() {
//    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
//    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
//  } );
//






$(document).ready(function() {

	// SideBar
	$('#category-menu').click(function() {
		$('.ui.sidebar').sidebar('toggle');
	});

	// semantic modal sign in
	$('#signin-modal').click(function () {
		$('.small.modal.sign-in-modal').modal('show');
	});
	// semantic modal sign up
	$('#regest-modal').click(function () {
		$('.ui.modal.sign-up-modal').modal('show');
	});

	// Accourdion
	$('.ui.accordion').accordion();

	// hover dropdown
	$('.dropdown-btn').mouseenter(function (){
		$('.sub-menu').css('display','block');
	});
	$('.dropdown-btn').mouseleave(function (){
		$('.sub-menu').css('display','none');
	});

	// HEADER owl carousel
	$('.header-carousel').owlCarousel({
	    rtl:false,
	    loop:true,
	    margin:0,
	    nav:false,
		autoplay:true,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	})

	// OFFERS owl carousel
	$('.offers-carousel').owlCarousel({
	    rtl:false,
	    loop:true,
	    margin:11,
	    nav:false,
		autoplay:true,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:4
	        }
	    }
	})

	//most recent carousel
	$('.most-recent-carousel').owlCarousel({
	    rtl:false,
	    loop:true,
	    margin:11,
	    nav:false,
		autoplay:true,
		autoplayTimeout:4000,
		autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:2
	        },
	        1000:{
	            items:4
	        }
	    }
	})


 });

