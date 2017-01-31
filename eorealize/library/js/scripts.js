/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w = window, d = document, e = d.documentElement, g = d.getElementsByTagName('body')[0], x = w.innerWidth || e.clientWidth || g.clientWidth, y = w.innerHeight || e.clientHeight || g.clientHeight;
	return { width: x, height: y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {
    
    //open and close header nav
	function toggleNav() {
		$(".menu-toggle").click(function(e){
                    
			if ($(".header-nav-wrap").hasClass("open")){
				$(".header-nav-wrap").removeClass("open");
				$(".primary-navigation").removeClass("open");
				$(".menu-toggle").removeClass("open");
                        } else {
				$(".header-nav-wrap").addClass("open");
				$(".primary-navigation").addClass("open");
				$(".menu-toggle").addClass("open");
                        }
			
		});
	}
	toggleNav();
    
     // MENU ARIA
    // Properly update the ARIA states on focus (keyboard) and mouse over events
      $( '[role="menubar"]' ).on( 'focus.aria click.aria', '[aria-haspopup="true"]', function ( ev ) {
          $( 'li' ).attr( 'aria-expanded', false );
          $( 'li' ).removeClass('open');
          $( 'li' ).children('.sub-menu').removeClass('open');
          
          $( ev.currentTarget ).attr( 'aria-expanded', true );
          $( ev.currentTarget ).addClass('open');
          $( ev.currentTarget ).children('.sub-menu').addClass('open');
      } );

      // Properly update the ARIA states on blur (keyboard) and mouse out events
      $( '[role="menubar"]' ).on( 'blur.aria', '[aria-haspopup="true"]', function ( ev ) {
          $( ev.currentTarget ).attr( 'aria-expanded', false );
          $( ev.currentTarget ).removeClass('open');
          $( ev.currentTarget ).children('.sub-menu').removeClass('open');
      } );
    
    //open and close header nav
	/*function toggleSubmenu() {
        $(".nav-trigger").click(function() {
            if ($(this).children('.sub-menu').length > 0) {
                if ($(this).children('.sub-menu').hasClass('open')) {
                    $(this).children('.sub-menu').removeClass('open');
                    $(this).removeClass('open');
                } else {
                    $(this).children('.sub-menu').addClass('open');
                    $(this).addClass('open');
                }
            }
        });
	}
    toggleSubmenu();*/
    
    // function to close all .sub-menu when user clicks anywhere else on page
    function closeallmenu() {
        $('body').click(function() {
          $('.sub-menu').removeClass('open');
            $('ul.nav-menu > li').removeClass('open');
        });

        $('#menu-main-menu').click(function(event){
            event.stopPropagation();
        });
    }
    closeallmenu();
    
    // open search bar in mobile
	function toggleSearch() {
        function focuss(){
            $("#s").focus();
        }
		$(".search-toggle").click(function(){
			if ($(".search-box").hasClass("open")){
				$(".search-box").removeClass("open");
				$(".search-toggle").removeClass("open");
                
                } else {
				$(".search-box").addClass("open");
				$(".search-toggle").addClass("open");
                    setTimeout(focuss,400);
                        }
		});
	}
	toggleSearch();
    
    

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();
    
// popup windows (add class .popup to html container ) from http://stackoverflow.com/questions/1328723/how-to-generate-a-simple-popup-using-jquery
	function deselect(e) {
			$('.popup').slideFadeToggle(function() {
			  e.removeClass('selected');
			});    
		}
	      
		$(function() {
			$('.poptrigger').on('click', function() {
			  if($(this).hasClass('selected')) {
				deselect($(this));
                  $(this).attr( 'aria-expanded', false );
                  $('#profile-toggle').removeClass('open');
                  $('.poptrigger').removeClass('open');
			  } else {
                $(this).attr( 'aria-expanded', true );
				$(this).addClass('selected');
                $('#profile-toggle').addClass('open');
                  $('.poptrigger').addClass('open');
				$('.popup').slideFadeToggle();
			  }
			  return false;
			});
			  
			$('.close').on('click', function() {
			  deselect($('.poptrigger'));
			  return false;
			});
		});
	      
	    $.fn.slideFadeToggle = function(easing, callback) {
			return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
	    };
    
    // accordion
    
    function accordion() {
		$(".accordion-toggle").click(function(){
			if ($(this).hasClass("open")){
                $(this).parent('.accordion').removeClass("open");
				$(this).parent('.accordion').children(".accordion-box").removeClass("open");
				$(this).removeClass("open");
                
            } else {
                $(this).parent('.accordion').addClass("open");
				$(this).parent('.accordion').children(".accordion-box").addClass("open");
				$(this).addClass("open");
            }
		});
	}
	$(".accordion-box").onload = accordion();
    
    // smooth scroll
    $(function() {
          $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
              var target = $(this.hash);
              target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
              if (target.length) {
                $('html,body').animate({
                  scrollTop: target.offset().top
                }, 1000);
                return false;
              }
            }
          });
        });

}); /* end of as page load scripts */