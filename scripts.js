/*
 *  Interchange Class - v0.01
 *  A declaritive way to add and remove classes to an element based on defined media queries
 *
 *  Made by Matt Jensen
 *  Under MIT License
 */
;(function ( $, window, document, Foundation, undefined ) {

		// Create the defaults once
		var pluginName = "interchangeClass";
		var defaults = {
			eventNamespace: 'interchange'
		};

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
				var _this = this;
				var rawClassList = this.element.getAttribute('data-interchange-class');
				
				// If invalid interchange-class
				if( rawClassList.indexOf(']') + rawClassList.indexOf(',') < 0 ) 
					throw new Error('Invalid data-interchange-class attribute');
				
				// get interchange-class list
				this.parseClasslist( rawClassList );

				$(window).on('resize.' + this.settings.eventNamespace, Foundation.utils.throttle(function(e){
					$('[data-interchange-class]').trigger('interchangeClass'); // Trigger interchange class update
				}, 300));

				// Update interchange class
				$(this.element).on('interchangeClass.'+ this.settings.eventNamespace, function() {
					_this.runClassList.call(_this);
				});

				this.runClassList();

				return this;
			},

			parseClasslist: function(rawClassList) {
				var result = {};
				var classArguement;
				var resultQuery;
				rawClassList = rawClassList.trim().replace(/\]\s+\,/g, '],').split('],');
				
				for(var i = 0; i < rawClassList.length; i++ ) {
					classArguement = rawClassList[i].replace(/\(+|\)+|\[+|\]+/gm, '').split(',');

					// If invalid interchange class argument
					if( classArguement.length < 2 ) continue;

					resultQuery = classArguement[1].trim();

					// If Foundation has the media query defined add it to the result
					if( Foundation.media_queries[ resultQuery ] ) {
						result[ resultQuery ] = classArguement[0].trim();
					}
					else {
						console.error('Please note the media query: "'+ resultQuery +'" is not defined within the Foundation.media_queries object');
					}
				}

				this.interClassList = result;

				return result;
			},

			// Remove all class names prefixed with `!`
			_rmInvalidClasses: function(classList) {
				var result = '';
				classList = classList.trim().split(' ');
				
				for( var i = 0; i < classList.length; i++ ) {
					if( classList[i].length && classList[i][0] !== '!' ) result += classList[i] + ' ';
				}

				return result.trimRight();
			},

			runClassList: function() {
				var acceptedQuery;
				var mediaQuery;
				var validQuery;
				var validQueryClasses;

				// Assume queries are ordered from smallest to largest.
				// Loop through all media aguments to find largest valid query
				for( var mediaArg in this.interClassList ) {

					mediaQuery = Foundation.media_queries[ mediaArg ];
					validQuery = !!(mediaQuery && window.matchMedia( mediaQuery ).matches);

					// If media query is defined by Foundation and is currently activated
					if( validQuery ) {
						acceptedQuery = mediaArg;
					}
					else {
						// Make sure each invalid media query's classList is removed (negative classes exempt)
						$(this.element).removeClass( this._rmInvalidClasses(this.interClassList[ mediaArg ]) );
					}
				}

				if( acceptedQuery ) {
					validQueryClasses = this.interClassList[ acceptedQuery ].trim().split(' ');

					for( var i = 0; i < validQueryClasses.length; i++ ) {
						if( validQueryClasses[i][0] !== '!') {
							$(this.element).addClass(validQueryClasses[i]);
						}
						// If negative class remove it
						else {
							$(this.element).removeClass( validQueryClasses[i].replace('!', '') );
						}
					}
				}

				return this;
			},
		});

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
/*
 *  Toggle Show Hide
 *  A jump-start for jQuery plugins development.
 *  http://jqueryboilerplate.com
 *
 *  Made by Zeno Rocha
 *  Under MIT License
 */

;(function ( $, window, document, undefined ) {

		// Create the defaults once
		var pluginName = "toggleShowHide",
			defaults = {
				eventNamespace: 'jumpstart',
				activeText: false,
				hideText: false
			};

		// The actual plugin constructor
		function Plugin ( element, options ) {
				this.element = element;
				this.$element = $(element);
				this.settings = $.extend( {}, defaults, options );
				this._defaults = defaults;
				this._name = pluginName;
				this.init();
		}

		// Avoid Plugin.prototype conflicts
		$.extend(Plugin.prototype, {
				init: function () {
					var _this = this;
					this.isActive = true;
					this.activeText = this.settings.activeText || this.$element.text();
					this.inactiveText = this.settings.hideText || 'Close';
					
					this.$element.on('click', function() {
						_this.isActive = !_this.isActive;
						_this.toggleSelf();
						_this.toggleSiblings();
					});
				},
				
				toggleSelf: function () {
					var toggleText = this.isActive ? this.activeText : this.inactiveText;
					this.$element
						.toggleClass('toggled')
						.text( toggleText );
					return this;
				},

				toggleSiblings: function() {
					var $parentContainer = this.$element.parents('[data-toggle-show-hide-container]:first');
					
					if( !$parentContainer.length ) return;
					$parentContainer
						.toggleClass('toggled')
						.find('[data-show-hide-target]')
						.each(function(i, el) {
							$(el).toggleClass('hide');
						});

					return this;
				}
		});

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

    $('[data-interchange-class]').interchangeClass();

    $('[data-toggle-show-hide]').toggleShowHide();

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