/* -------------------------------------------------------

	Custom Front-end Javascript

------------------------------------------------------- */

$(document).ready(function() {

/* -------------------------------------------------------

	Gentle Scrolling


          $('#menu-item-678 a').click(function(e) {
                    e.preventDefault();
		$('html, body').stop().animate({scrollTop:672}, 700);
		return false;
	});

------------------------------------------------------- */

/* -------------------------------------------------------

	Portfolio Thumbnails

------------------------------------------------------- */

	$(".thumbnail").hover(
		function() {
		     $(this).css( {'cursor': 'pointer'});
		     $(this).find('img').stop().animate({"opacity": "0.25"}, "slow");
		},
		function() {
		     $(this).find('img').stop().animate({"opacity": "1"}, "slow");
		}
	);

/* -------------------------------------------------------

	Netflix Overlay

------------------------------------------------------- */

	$("#netflix_recommended").stop().mouseenter(function() {
		$("#details").fadeTo(800, 0.9);
	});
	$("#netflix_recommended").stop().mouseleave(function(){
		$("#details").fadeOut(500);
	});

/* -------------------------------------------------------

	Dynamic Sorting
	
------------------------------------------------------- */
	
	$(function() {
	          var $examples = $('#examples');
	          $examples.isotope({
	                    animationEngine : 'best-available',
	                    containerClass  : 'isotope',
	                    hiddenClass     : 'isotope-hidden',
	                    layoutMode      : 'fitRows'
	          });
	          
	          $('#filter a').click(function(){
	                    var selector = $(this).attr('data-filter');
	                    console.log(selector);
	                    $examples.isotope({ filter: selector });
	                    return false;
	          });
	});

});






















