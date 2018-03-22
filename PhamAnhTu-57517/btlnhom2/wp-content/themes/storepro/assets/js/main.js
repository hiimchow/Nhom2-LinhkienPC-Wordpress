var $ = jQuery.noConflict();
$(document).ready(function() {

	// Responsive video
	$(".hentry, .widget").fitVids();

	  $("#main-slider").owlCarousel({
	 
		  navigation : true, // Show next and prev buttons
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem:true,
		  autoPlay: true
	 
		  // "singleItem:true" is a shortcut for:
		  // items : 1, 
		  // itemsDesktop : false,
		  // itemsDesktopSmall : false,
		  // itemsTablet: false,
		  // itemsMobile : false
	 
	  });

	var owl = $("#product-slider");
 
		  owl.owlCarousel({
			 
			  itemsCustom : [
				[0, 1],
				[450, 1],
				[600, 1],
				[700, 2],
				[1000, 3],
				[1200, 3],
				[1400, 3],
				[1600, 3]
			  ],
			  navigation : true
		 
		  });
		  
		  var owl = $("#recent-product");
 
		  owl.owlCarousel({
			 
			  itemsCustom : [
				[0, 1],
				[450, 1],
				[600, 1],
				[700, 2],
				[1000, 3],
				[1200, 3],
				[1400, 3],
				[1600, 3]
			  ],
			  navigation : true
		 
		  });
		  
		  var owl = $("#product-category");
 
		  owl.owlCarousel({
			 
			  itemsCustom : [
				[0, 2],
				[450, 2],
				[600, 2],
				[700, 3],
				[1000, 4],
				[1200, 4],
				[1400, 4],
				[1600, 4]
			  ],
			  navigation : true
		 
		  });
		  
		  var owl = $("#blog-post");
 
		  owl.owlCarousel({
			 
			  itemsCustom : [
				[0, 1],
				[450, 1],
				[600, 1],
				[700, 1],
				[1000, 2],
				[1200, 2],
				[1400, 2],
				[1600, 2]
			  ],
			  navigation : true
		 
		  });
	
	var owl = $("#blog-post");

	  owl.owlCarousel({
		 
		  itemsCustom : [
			[0, 1],
			[450, 1],
			[600, 1],
			[700, 1],
			[1000, 2],
			[1200, 2],
			[1400, 2],
			[1600, 2]
		  ],
		  navigation : true
	 
	  });
  
	  var owl = $("#popular-product");

	  owl.owlCarousel({
		 
		  itemsCustom : [
			[0, 1],
			[450, 1],
			[600, 1],
			[700, 1],
			[1000, 1],
			[1200, 1],
			[1400, 1],
			[1600, 1]
		  ],
		  navigation : true
	 
	  });

 
});