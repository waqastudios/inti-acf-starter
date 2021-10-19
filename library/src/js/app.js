import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';


// Initialize Foundation
$(document).foundation();



// Hamburger Menu active state
$(document).on( "opened.zf.offCanvas", function(){
	$('.hamburger').addClass('is-active');
});
$(document).on( "closed.zf.offCanvas", function(){
	$('.hamburger').removeClass('is-active');
});
	


// scroll to back top button
$(window).scroll(function() {
		var sd = $(window).scrollTop();
		if ( sd > 200 ) 
			$('#inti-scroll-to-top').fadeIn(600);
		else 
			$('#inti-scroll-to-top').fadeOut(400);
});



// Detect if the scrollbar is visible, perform actions
$(document).ready(function(){
	// say it
	function addPaddingGutenbergFull() {
		if ($(document).height() > $(window).height()) {
			$('.alignfull').addClass('withscroll');
			$('.inti-content-block').addClass('withscroll');
			console.log('Added padding for gutenberg blocks set to full');
		} else {
			$('.alignfull').removeClass('withscroll');
			$('.inti-content-block').removeClass('withscroll');
			console.log('removed');
		}
	}

	// do it
	addPaddingGutenbergFull();

	// do it again
	$( window ).resize(function() {
		addPaddingGutenbergFull();
	});
});



// In View Animations
import inview from 'jquery-inview';
$('.to-animate').css('opacity', '0');
$('.to-animate').one('inview', function(event, isInView) {
	$(this).addClass('animated');
	if (isInView) {
		// element is now visible in the viewport
		
	} else {
		// element has gone out of viewport
	}
});


// Hide Menu on Scroll
$(document).ready(function(){
	var hasScrolled;
	var lastScrollTop = 0;
	var delta = 10;
	var navbarHeight = $('.site-banner').outerHeight();

	// Add the correct classes to begin - nav is down and shown
	$('.site-banner').removeClass('nav-up').addClass('nav-down');
	$('.site-header').removeClass('nav-up').addClass('nav-down');

	$(window).scroll(function(event){
		hasScrolled = true;
	});

	// Check condition every 250ms
	setInterval(function() {
		if (hasScrolled) {
			yhasScrolled();
			hasScrolled = false;
		}
	}, 250);

	function yhasScrolled() {
		var st = $(window).scrollTop();
		
		// Make sure they scroll more than delta, which may fix Safari scenario
		if (Math.abs(lastScrollTop - st) <= delta)
			return;
		
		// If they scrolled down and are past the navbar, add class .nav-up.
		if (st > lastScrollTop && st > navbarHeight){
			// Scroll Down
			$('.site-banner').removeClass('nav-down').addClass('nav-up');
			$('.site-header').removeClass('nav-down').addClass('nav-up');
		} else {
			// Scroll Up
			if(st + $(window).height() < $(document).height()) {
				$('.site-banner').removeClass('nav-up').addClass('nav-down');
				$('.site-header').removeClass('nav-up').addClass('nav-down');
			}
		}
		
		lastScrollTop = st;
	}
});


/** import Cookies from 'js-cookie';

// Cookie policy
$(document).ready(function(){

	// Create the Reveal modal for the initial cookie message
	var $cookiemodal = new Foundation.Reveal($('#inti-cookie-policy'), {
		vOffset: 'auto',
		// overlay: false,
		closeOnClick: false

	});

	// Next, check to see if the visitor has been here before, if they have,
	// they'll have the needed-cookies cookie, if not it'll be undefined
	if (typeof Cookies.get('needed-cookies') === "undefined") {
		// First time visitor
		// Open cookie message modal
		$cookiemodal.open();

		// Set initial recommended cookie settings for 1 minute
		Cookies.set('needed-cookies', true, { expires: 1/24/60 });
		Cookies.set('functional-cookies', true, { expires: 1/24/60 });
		Cookies.set('optional-cookies', true, { expires: 1/24/60 });

		// Warning: this loads cookies on first visit, with the option to
		// remove them shortly thereafter in the options, which is not strictly
		// how it should be done. 
		// In the future we'll need to load all cookie types asychronously AFTER
		// settings have been accepted by the client.
	}
		
	// Open instances of visible link to open cookie manager, i.e. from cookie manager shortcode
	$('.inti-cookie-manager.open').on( "click", function(){
		// close programatically created Reveal modal
		$cookiemodal.open();
	});
	
	// Vistor's Manage Options page has controls to change the three default cookie types
	$('.switch-input#needed-cookies').on( "change", function(){
		// Needed-cookies has been toggled, check to see if it's on or off
		if ($('.switch-input#needed-cookies').is(":checked")) {
			Cookies.set('needed-cookies', true, { expires: 90 });
		} else {
			Cookies.set('needed-cookies', false, { expires: 90 });
		}
	});
	$('.switch-input#functional-cookies').on( "change", function(){
		// Functional-cookies has been toggled, check to see if it's on or off
		if ($('.switch-input#functional-cookies').is(":checked")) {
			Cookies.set('functional-cookies', true, { expires: 90 });
			console.log("TRUE");
		} else {
			Cookies.set('functional-cookies', false, { expires: 90 });
			console.log("FALSE");
		}
	});
	$('.switch-input#optional-cookies').on( "change", function(){
		// Optional-cookies has been toggled, check to see if it's on or off
		if ($('.switch-input#optional-cookies').is(":checked")) {
			Cookies.set('optional-cookies', true, { expires: 90 });
			console.log("TRUE");
		} else {
			Cookies.set('optional-cookies', false, { expires: 90 });
			console.log("FALSE");
		}
	});


	// Site owner has the option of forcing the use of the most needed cookies
	// and when this option is set the first checkbox is replaced by a disabled
	// button stating that these cookies are always on. If that button is visible
	// rather than the checkbox, set the needed-cookies cookie to true
	if ( $('button#needed-cookies-forced').length ) {
		Cookies.set('needed-cookies', true, { expires: 90 });
	};


	// If on any of the screens the visitor clicks to accept all cookies then
	// we set all cookies as true and close everything
	$('.accept-all-cookies').on( "click", function(){
		$('.switch-input#needed-cookies').prop('checked', true);
		$('.switch-input#functional-cookies').prop('checked', true);
		$('.switch-input#optional-cookies').prop('checked', true);

		Cookies.set('needed-cookies', true, { expires: 90 });
		Cookies.set('functional-cookies', true, { expires: 90 });
		Cookies.set('optional-cookies', true, { expires: 90 });

		// close programatically created Reveal modal
		$cookiemodal.close();
		// close Reveal created with data-reveal properties in HTML
		$('.reveal').foundation('close');
	});


	// If the vistor clicks to keep the settings as displayed we close all the modals,
	// but not before checking to see if they turned all cookies off, in whichs case
	// we display the #inti-cookie-block modal
	$('.keep-these-settings').on( "click", function(){
		// are all cookies turned off?
		if ( !$('.switch-input#needed-cookies').is(":checked") && !$('.switch-input#functional-cookies').is(":checked") && !$('.switch-input#optional-cookies').is(":checked") ) {
			// yes
			// close programatically created Reveal modal
			$cookiemodal.close();
			// close Reveal created with data-reveal properties in HTML
			$('.reveal').foundation('close');
			// open modal about all cookies blocked
			$('#inti-cookie-block').foundation('open');
		} else {
			// no, all good, close everything
			// close programatically created Reveal modal
			$cookiemodal.close();
			// close Reveal created with data-reveal properties in HTML
			$('.reveal').foundation('close');
		}
	});


	// If the visitor chooses to block ALL cookies, we remove all cookies generated from their browser
	// close the open modals and display the cookie-block modal.
	$('.block-all-cookies').on( "click", function(){
		$('.switch-input#needed-cookies').prop('checked', false);
		$('.switch-input#functional-cookies').prop('checked', false);
		$('.switch-input#optional-cookies').prop('checked', false);

		// Remove all cookies
		Cookies.remove('needed-cookies');
		Cookies.remove('functional-cookies');
		Cookies.remove('optional-cookies');

		// close programatically created Reveal modal
		$cookiemodal.close();
		// close Reveal created with data-reveal properties in HTML
		$('.reveal').foundation('close');
		// open modal about all cookies blocked
		$('#inti-cookie-block').foundation('open');
	});

}); */



import slick from 'slick-carousel';

//default example carousel
$('.inti-carousel').slick({
	accessibility: true,
	adaptiveHeight: false,
	autoplay: true,
	autoplaySpeed: 6000,
	arrows: true,
	asNavFor: null,
	centerMode: true,
	centerPadding: '0px',
	cssEase: 'ease',
	dots: false,
	draggable: true,
	fade: false,
	infinite: true,
	initialSlide: 0,
	pauseOnHover: true,
	pauseOnDotsHover: false,
	variableWidth: false,
	slidesToShow: 5, 
	slidesToScroll: 1,
	speed: 600,
	swipe: true,
	// prevArrow: '<button type="button" class="slick-prev arrows"><i class="fas fa-chevron-left"></i></button>',
	// nextArrow: '<button type="button" class="slick-next arrows"><i class="fas fa-chevron-right"></i></button>',
	responsive: [
		{
			breakpoint: 768,
			settings: {
				arrows: false,
				slidesToShow: 3, 
			}
		},
		{
			breakpoint: 512,
			settings: {
				arrows: false,
				slidesToShow: 2, 
			}
		}
	],
});

// default example slider
$('.inti-slider').slick({
	accessibility: true,
	adaptiveHeight: false,
	autoplay: true,
	autoplaySpeed: 9000,
	arrows: true,
	asNavFor: null,
	centerMode: true,
	centerPadding: '0px',
	cssEase: 'ease',
	dots: false,
	draggable: true,
	fade: true,
	infinite: true,
	initialSlide: 0,
	pauseOnHover: true,
	pauseOnDotsHover: false,
	variableWidth: false,
	slidesToShow: 1, 
	slidesToScroll: 1,
	speed: 600,
	swipe: true,
	// prevArrow: '<button type="button" class="slick-prev arrows"><i class="fas fa-chevron-left"></i></button>',
	// nextArrow: '<button type="button" class="slick-next arrows"><i class="fas fa-chevron-right"></i></button>',
	responsive: [
		{
			breakpoint: 1024,
			settings: {
				arrows: false,
			}
		}
	],
});

// main slider JS for part-header-slide-hero.php
$('.inti-main-slider').slick({
	accessibility: true,
	adaptiveHeight: false,
	autoplay: true,
	autoplaySpeed: 4000,
	arrows: false,
	asNavFor: null,
	centerMode: true,
	centerPadding: '0px',
	cssEase: 'ease',
	dots: false,
	draggable: true,
	fade: true,
	infinite: true,
	initialSlide: 0,
	pauseOnHover: true,
	pauseOnDotsHover: false,
	variableWidth: false,
	slidesToShow: 1, 
	slidesToScroll: 1,
	speed: 600,
	swipe: true,
	// prevArrow: '<button type="button" class="slick-prev arrows"><i class="fas fa-chevron-left"></i></button>',
	// nextArrow: '<button type="button" class="slick-next arrows"><i class="fas fa-chevron-right"></i></button>',
	responsive: [
		{
			breakpoint: 1024,
			settings: {
				arrows: false,
			}
		}
	],
});

$('.inti-testimonial-widget').slick({
	accessibility: true,
	adaptiveHeight: false,
	autoplay: true,
	autoplaySpeed: 9000,
	arrows: false,
	asNavFor: null,
	centerMode: true,
	centerPadding: '0px',
	cssEase: 'ease',
	dots: true,
	draggable: true,
	fade: true,
	infinite: true,
	initialSlide: 0,
	pauseOnHover: true,
	pauseOnDotsHover: false,
	variableWidth: false,
	slidesToShow: 1, 
	slidesToScroll: 1,
	speed: 600,
	swipe: true,
	// prevArrow: '<button type="button" class="slick-prev arrows"><i class="fas fa-chevron-left"></i></button>',
	// nextArrow: '<button type="button" class="slick-next arrows"><i class="fas fa-chevron-right"></i></button>',
	responsive: [
		{
			breakpoint: 1024,
			settings: {
				arrows: false,
			}
		}
	]
});

//instagram block carousel
$('.inti-instagram-carousel').slick({
	accessibility: true,
	adaptiveHeight: false,
	autoplay: true,
	autoplaySpeed: 6000,
	arrows: true,
	asNavFor: null,
	centerMode: true,
	centerPadding: '0px',
	cssEase: 'ease',
	dots: false,
	draggable: true,
	fade: false,
	infinite: true,
	initialSlide: 0,
	pauseOnHover: true,
	pauseOnDotsHover: false,
	variableWidth: false,
	slidesToShow: 5, 
	slidesToScroll: 1,
	speed: 600,
	swipe: true,
	// prevArrow: '<button type="button" class="slick-prev arrows"><i class="fas fa-chevron-left"></i></button>',
	// nextArrow: '<button type="button" class="slick-next arrows"><i class="fas fa-chevron-right"></i></button>',
	responsive: [
		{
			breakpoint: 768,
			settings: {
				arrows: false,
				slidesToShow: 3, 
			}
		},
		{
			breakpoint: 512,
			settings: {
				arrows: false,
				slidesToShow: 2, 
			}
		}
	],
});