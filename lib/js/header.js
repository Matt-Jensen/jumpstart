// Header Display
;(function($) {
	'use strict';

	// Prevent navigation jump due to interchange logo stagard loading
	$(document).on('replace', '#logo', function (e, new_path, original_path) {
		var $this = $(this);

		window.setTimeout(function() { 
			$this.removeClass('hide');
			$this.parent().find('.top-bar-section:first').removeClass('hide');
		});
	});

})(jQuery);