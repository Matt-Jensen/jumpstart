/**
 * This is an example JS file.
 *
 * This is a description of the custom JS file.
 */

/**
 * This is a custom JS function.
 * 
 * The dollar sign must be passed into the jQuery function due to "no-conflict" mode.
 * See http://codex.wordpress.org/Function_Reference/wp_enqueue_script#jQuery_noConflict_Wrappers
 * 
 * @param {jQuery Library} $ Allow the dollar sign to be used as an alias for jQuery.
 * @returns {undefined}
 */

;(function() {
	'use strict';

	var namespace = 'FIRSTAM';

	var init = function() {
		console.log('Let\'s get started!');
	};

	var themeDirectory = jQuery('body').data('theme-dir');

	// Module reveal pattern
	var reveal = {
		initialize: init,
		themeDir: themeDirectory
	};

	// Make available on the global scope
	if( window[ namespace ] ) throw new Error('The apps global namespace: '+ namespace +' is already taken.');
	window[ namespace ] = reveal;

})();

// Polyfills
;(function(Modernizr, $) {
	'use strict';

    var addScript = function addScript(src) {
        var script = document.createElement('script');
        script.setAttribute('src', src);
        script.setAttribute('type', 'text/javascript');
        $('head:first').append(script);
    };

 	if( !window.matchMedia ) addScript( window.FIRSTAM.themeDir + '/bower_components/matchMedia/matchMedia.js');

})(Modernizr, jQuery);

// Instantiate
;(function( $ ) {
	'use strict';

    // Custom js code goes here ...

    // Enable Foundation JS ...
    $( document ).foundation();
    
    // Disable 300ms double tap watch on touch devices
    FastClick.attach(document.body);

    // Only runs if the browser does not natively support placeholders
    $('input, textarea').placeholder();

})(jQuery);