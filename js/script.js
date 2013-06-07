/* -------------------------------------------------------

	Custom Front-end Javascript

------------------------------------------------------- */

$(document).ready(function() {
	$(".thumbnail").hover(
		function() {
		     $(this).css( {'cursor': 'pointer'});
		     $(this).find('img').stop().animate({"opacity": "0.25"}, "slow");
		},
		function() {
		     $(this).find('img').stop().animate({"opacity": "1"}, "slow");
		}
	);

	$("#netflix_recommended").stop().mouseenter(function() {
		$("#details").fadeTo(800, 0.9);
	});
	$("#netflix_recommended").stop().mouseleave(function(){
		$("#details").fadeOut(500);
	});
	
	// Custom sorting plugin
	(function($) {
		$.fn.sorted = function(customOptions) {
			var options = {
		 		reversed: false,
		 		by: function(a) { return a.text(); }
			};
			$.extend(options, customOptions);
			$data = $(this);
			arr = $data.get();
			arr.sort(function(a, b) {
		 		var valA = options.by($(a));
		 		var valB = options.by($(b));
		 		if (options.reversed) {
		   			return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;
		 		} else {
		   			return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;
		 		}
			});
			return $(arr);
		};
	})(jQuery);
	
	$(function() {

	  	var $filterType = $('#filter input[name="type"]');
	  	var $filterSort = $('#filter input[name="sort"]');
	  	var $examples = $('#examples');
	  	var $data = $examples.clone();

	  	// attempt to call Quicksand on every click
		$filterType.add($filterSort).change(function(e) {
			if ($($filterType+':checked').val() == 'all') {
				var $filteredData = $data.find('li');
			} else {
				var $filteredData = $data.find('li[data-id=' + $($filterType+":checked").val() + ']');
			}

	      		var $sortedData = $filteredData.sorted({
	        			by: function(v) {
	          			return $(v).find('a img').attr('alt').toLowerCase();
	        			}
	      		});

		    	// finally, call quicksand
		    	$examples.quicksand($sortedData, {
		    	          useScaling: false,
		    	          adjustHeight: false,
		      		duration: 1000,
		      		easing: 'swing'
		    	}, function () { // callback
                                        $(".thumbnail").hover(
					function() {
					     $(this).css( {'cursor': 'pointer'});
					     $(this).find('img').stop().animate({"opacity": "0.25"}, "slow");
					},
					function() {
					     $(this).find('img').stop().animate({"opacity": "1"}, "slow");
					}
				);
			});

  		});

	});

});






















