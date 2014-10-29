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