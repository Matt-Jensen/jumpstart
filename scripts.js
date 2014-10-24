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
;(function ( $, window, document, undefined ) {

		// undefined is used here as the undefined global variable in ECMAScript 3 is
		// mutable (ie. it can be changed by someone else). undefined isn't really being
		// passed in so we can ensure the value of it is truly undefined. In ES5, undefined
		// can no longer be modified.

		// window and document are passed through as local variable rather than global
		// as this (slightly) quickens the resolution process and can be more efficiently
		// minified (especially when both are regularly referenced in your plugin).

		// Create the defaults once
		var pluginName = "defaultPluginName",
				defaults = {
				propertyName: "value"
		};

		// The actual plugin constructor
		function Plugin ( element, options ) {
				this.element = element;
				// jQuery has an extend method which merges the contents of two or
				// more objects, storing the result in the first object. The first object
				// is generally empty as we don't want to alter the default options for
				// future instances of the plugin
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

})( jQuery, window, document );
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

;(function( $ ) {
    // Custom js code goes here ...

    // Enable Foundation JS ...
    $( document ).foundation();
    
    // Disable 300ms double tap watch on touch devices
    FastClick.attach(document.body);

    // Only runs if the browser does not natively support placeholders
    $('input, textarea').placeholder();

})(jQuery);

;(function() {
	
	var namespace = 'jumpstart';

	var init = function() {
		console.log('Let\'s get started!');
	};

	// Module reveal pattern
	var reveal = {
		initialize: init
	};

	// Make available on the global scope
	if( window[ namespace ] ) throw new Error('The apps global namespace: '+ namespace +' is already taken.');
	window[ namespace ] = reveal;

})();

;(function($) {
	'use strict';

	// Prevent navigation jump due to interchange logo stagard loading
	$(document).on('replace', '#logo', function (e, new_path, original_path) {
		var $this = $(this);

		window.setTimeout(function() { $this.removeClass('hide'); });
	});

})(jQuery);
/* 
 * toggler.js
 * 
 * Select elements on your site to toggle open and close.
 */
jQuery( document ).ready( function( $ ) {
    $( "#toggle-button" ).click( function() {
        $( "#toggle-container" ).slideToggle( 'fast', function() {
            $( "#toggle-button" ).toggleClass( 'active' );
        });
    });
});