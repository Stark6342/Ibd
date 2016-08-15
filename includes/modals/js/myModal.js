(function($) {
	$.fn.extend({
		upvOpenModal: function(options) {
			$('body').css('overflow','hidden');
			$target = $(this).attr('target');
			$($target).show();
	    }
	});
	$.fn.extend({
		upvCloseModal: function(options) {
			$target = $(this).attr('target');
			$($target).hide();
			$('body').css('overflow','scroll');
	    }
	});
	$.fn.extend({
		OpenModal: function(options) {
			$('body').css('overflow','hidden');
			$(this).show();
	    }
	});
	$.fn.extend({
		CloseModal: function(options) {
			$(this).hide();
			$('body').css('overflow','scroll');
	    }
	});
})(jQuery);

$(document).ready(function(){
	$('.upv-modal-open').click(function(){
		$(this).upvOpenModal();
	});
	$('.upv-modal-close').click(function(){
		$(this).upvCloseModal();
	});
	$('.btn-modal-close').click(function(){
		$(this).upvCloseModal();
	});
	/*
	$('.modal-black-screen').click(function(){
		$(this).hide();
		$('body').css('overflow','scroll');
	}).children().click(function(e){return false;});
	*/
});