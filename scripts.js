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
/*
 *  jQuery Boilerplate - v3.3.4
 *  A jump-start for jQuery plugins development.
 *  http://jqueryboilerplate.com
 *
 *  Made by Zeno Rocha
 *  Under MIT License
 */
// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;(function ( $, window, document, Foundation, undefined ) {

		// Create the defaults once
		var pluginName = "interchangeClass";
		var defaults = {};

		// The actual plugin constructor
		function Plugin ( element, options ) {
				this.element = element;
				this.settings = $.extend( {}, defaults, options );
				this._defaults = defaults;
				this._name = pluginName;
				this.init();
		}

		// Avoid Plugin.prototype conflicts
		$.extend(Plugin.prototype, {
				init: function () {
						// Place initialization logic here
						// You already have access to the DOM element and
						// the options via the instance, e.g. this.element
						// and this.settings
						// you can add more functions like the one below and
						// call them like so: this.yourOtherFunction(this.element, this.settings).
						console.log("xD");
				},
				yourOtherFunction: function () {
					// some logic
				}
		});

		// A really lightweight plugin wrapper around the constructor,
		// preventing against multiple instantiations
		$.fn[ pluginName ] = function ( options ) {
				this.each(function() {
						if ( !$.data( this, "plugin_" + pluginName ) ) {
								$.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
						}
				});

				// chain jQuery functions
				return this;
		};

})( jQuery, window, document, Foundation );