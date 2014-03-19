(function ($) {
	
	'use strict';
	
	$.fn.veuseFaqToggle = function(options) {
	
		var defaults = {
			handle: '.veuse-faq-toggle .veuse-faq-toggle-title',
			speed: 2000,
			activeClass: '.active'
		}
			
		var options = $.extend({}, defaults,options);
			
		var contentHolder = $(this).find('dd'); 

		$(this).find(options.handle).click(function() {
			contentHolder.slideUp(options.speed);
			$(this).find(options.handle).removeClass(options.activeClass);
			$(this).toggleClass(options.activeClass).next().stop().slideDown(options.speed);
			return false;
		});
	}


	$(document).ready(function($){
		
		$('.veuse-faq-list').veuseFaqToggle({ 
			handle: '.veuse-faq-toggle .veuse-faq-toggle-title', 
			activeClass: '.active', 
			speed: 300 
		});
	});
	
}( jQuery ));


		