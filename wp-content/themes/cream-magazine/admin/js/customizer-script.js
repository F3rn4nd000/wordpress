( function( $ ) {
	
	jQuery(document).ready(function($) { 

		/**
		 * Alpha Color Picker Custom Control
		 *
		 * @author Braad Martin <http://braadmartin.com>
		 * @license http://www.gnu.org/licenses/gpl-3.0.html
		 * @link https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker
		 */
		// Loop over each control and transform it into our color picker.
		$('.alpha-color-control').each(function () {

			// Scope the vars.
			var $control, startingColor, paletteInput, showOpacity, defaultColor, palette,
				colorPickerOptions, $container, $alphaSlider, alphaVal, sliderOptions;

			// Store the control instance.
			$control = $(this);

			// Get a clean starting value for the option.
			startingColor = $control.val().replace(/\s+/g, '');

			// Get some data off the control.
			paletteInput = $control.attr('data-palette');
			showOpacity = $control.attr('data-show-opacity');
			defaultColor = $control.attr('data-default-color');

			// Process the palette.
			if (paletteInput.indexOf('|') !== -1) {
				palette = paletteInput.split('|');
			} else if ('false' == paletteInput) {
				palette = false;
			} else {
				palette = true;
			}

			// Set up the options that we'll pass to wpColorPicker().
			colorPickerOptions = {
				change: function (event, ui) {
					var key, value, alpha, $transparency;

					key = $control.attr('data-customize-setting-link');
					value = $control.wpColorPicker('color');

					// Set the opacity value on the slider handle when the default color button is clicked.
					if (defaultColor == value) {
						alpha = getAlphaValueFromColor(value);
						$alphaSlider.find('.ui-slider-handle').text(alpha);
					}

					// Send ajax request to wp.customize to trigger the Save action.
					wp.customize(key, function (obj) {
						obj.set(value);
					});

					$transparency = $container.find('.transparency');

					// Always show the background color of the opacity slider at 100% opacity.
					$transparency.css('background-color', ui.color.toString('no-alpha'));
				},
				palettes: palette // Use the passed in palette.
			};

			// Create the colorpicker.
			$control.wpColorPicker(colorPickerOptions);

			$container = $control.parents('.wp-picker-container:first');

			// Insert our opacity slider.
			$('<div class="alpha-color-picker-container">' +
				'<div class="min-click-zone click-zone"></div>' +
				'<div class="max-click-zone click-zone"></div>' +
				'<div class="alpha-slider"></div>' +
				'<div class="transparency"></div>' +
				'</div>').appendTo($container.find('.wp-picker-holder'));

			$alphaSlider = $container.find('.alpha-slider');

			// If starting value is in format RGBa, grab the alpha channel.
			alphaVal = getAlphaValueFromColor(startingColor);

			// Set up jQuery UI slider() options.
			sliderOptions = {
				create: function (event, ui) {
					var value = $(this).slider('value');

					// Set up initial values.
					$(this).find('.ui-slider-handle').text(value);
					$(this).siblings('.transparency ').css('background-color', startingColor);
				},
				value: alphaVal,
				range: 'max',
				step: 1,
				min: 0,
				max: 100,
				animate: 300
			};

			// Initialize jQuery UI slider with our options.
			$alphaSlider.slider(sliderOptions);

			// Maybe show the opacity on the handle.
			if ('true' == showOpacity) {
				$alphaSlider.find('.ui-slider-handle').addClass('show-opacity');
			}

			// Bind event handlers for the click zones.
			$container.find('.min-click-zone').on('click', function () {
				updateAlphaValueOnColorControl(0, $control, $alphaSlider, true);
			});
			$container.find('.max-click-zone').on('click', function () {
				updateAlphaValueOnColorControl(100, $control, $alphaSlider, true);
			});

			// Bind event handler for clicking on a palette color.
			$container.find('.iris-palette').on('click', function () {
				var color, alpha;

				color = $(this).css('background-color');
				alpha = getAlphaValueFromColor(color);

				updateAlphaValueOnAlphaSlider(alpha, $alphaSlider);

				// Sometimes Iris doesn't set a perfect background-color on the palette,
				// for example rgba(20, 80, 100, 0.3) becomes rgba(20, 80, 100, 0.298039).
				// To compensante for this we round the opacity value on RGBa colors here
				// and save it a second time to the color picker object.
				if (alpha != 100) {
					color = color.replace(/[^,]+(?=\))/, (alpha / 100).toFixed(2));
				}

				$control.wpColorPicker('color', color);
			});

			// Bind event handler for clicking on the 'Clear' button.
			$container.find('.button.wp-picker-clear').on('click', function () {
				var key = $control.attr('data-customize-setting-link');

				// The #fff color is delibrate here. This sets the color picker to white instead of the
				// defult black, which puts the color picker in a better place to visually represent empty.
				$control.wpColorPicker('color', '#ffffff');

				// Set the actual option value to empty string.
				wp.customize(key, function (obj) {
					obj.set('');
				});

				updateAlphaValueOnAlphaSlider(100, $alphaSlider);
			});

			// Bind event handler for clicking on the 'Default' button.
			$container.find('.button.wp-picker-default').on('click', function () {
				var alpha = getAlphaValueFromColor(defaultColor);

				updateAlphaValueOnAlphaSlider(alpha, $alphaSlider);
			});

			// Bind event handler for typing or pasting into the input.
			$control.on('input', function () {
				var value = $(this).val();
				var alpha = getAlphaValueFromColor(value);

				updateAlphaValueOnAlphaSlider(alpha, $alphaSlider);
			});

			// Update all the things when the slider is interacted with.
			$alphaSlider.slider().on('slide', function (event, ui) {
				var alpha = parseFloat(ui.value) / 100.0;

				updateAlphaValueOnColorControl(alpha, $control, $alphaSlider, false);

				// Change value shown on slider handle.
				$(this).find('.ui-slider-handle').text(ui.value);
			});

		});

		/**
		 * Override the stock color.js toString() method to add support for outputting RGBa or Hex.
		 */
		Color.prototype.toString = function (flag) {

			// If our no-alpha flag has been passed in, output RGBa value with 100% opacity.
			// This is used to set the background color on the opacity slider during color changes.
			if ('no-alpha' == flag) {
				return this.toCSS('rgba', '1').replace(/\s+/g, '');
			}

			// If we have a proper opacity value, output RGBa.
			if (1 > this._alpha) {
				return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
			}

			// Proceed with stock color.js hex output.
			var hex = parseInt(this._color, 10).toString(16);
			if (this.error) { return ''; }
			if (hex.length < 6) {
				for (var i = 6 - hex.length - 1; i >= 0; i--) {
					hex = '0' + hex;
				}
			}

			return '#' + hex;
		};

		/**
		 * Given an RGBa, RGB, or hex color value, return the alpha channel value.
		 */
		function getAlphaValueFromColor(value) {
			var alphaVal;

			// Remove all spaces from the passed in value to help our RGBa regex.
			value = value.replace(/ /g, '');

			if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
				alphaVal = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]).toFixed(2) * 100;
				alphaVal = parseInt(alphaVal);
			} else {
				alphaVal = 100;
			}

			return alphaVal;
		}

		/**
		 * Force update the alpha value of the color picker object and maybe the alpha slider.
		 */
		function updateAlphaValueOnColorControl(alpha, $control, $alphaSlider, update_slider) {
			var iris, colorPicker, color;

			iris = $control.data('a8cIris');
			colorPicker = $control.data('wpWpColorPicker');

			// Set the alpha value on the Iris object.
			iris._color._alpha = alpha;

			// Store the new color value.
			color = iris._color.toString();

			// Set the value of the input.
			$control.val(color);

			// Update the background color of the color picker.
			colorPicker.toggler.css({
				'background-color': color
			});

			// Maybe update the alpha slider itself.
			if (update_slider) {
				updateAlphaValueOnAlphaSlider(alpha, $alphaSlider);
			}

			// Update the color value of the color picker object.
			$control.wpColorPicker('color', color);
		}

		/**
		 * Update the slider handle position and label.
		 */
		function updateAlphaValueOnAlphaSlider(alpha, $alphaSlider) {
			$alphaSlider.slider('value', alpha);
			$alphaSlider.find('.ui-slider-handle').text(alpha.toString());
		}

		let customizeBody = jQuery('body');

		function responsiveSwitcher() {

			// Responsive switchers
			customizeBody.on('click', '.responsive-switchers button', function (event) {

				// Set up variables				var ,
				var $device = jQuery(this).data('device'),
					$body = jQuery('.wp-full-overlay'),
					$footer_devices = jQuery('.wp-full-overlay-footer .devices');
				var $devices = jQuery('.responsive-switchers');
				// Button class

				if ($device == 'desktop') {
					jQuery(this).parents(".responsive-switchers").toggleClass("responsive-switchers-open");

					jQuery(this).parents('li').siblings('.has-switchers').find('.responsive-switchers').toggleClass('responsive-switchers-open');
				}

				$devices.find('button').removeClass('active');
				$devices.find('button.preview-' + $device).addClass('active');

				var controls = jQuery('.responsive-control-wrap');
				controls.each(function () {
					if ($device != 'normal') {
						if (jQuery(this).hasClass($device)) {
							jQuery(this).addClass('active');
						} else {
							jQuery(this).removeClass('active');
						}
					}
				});

				// Wrapper class
				$body.removeClass('preview-desktop preview-tablet preview-mobile').addClass('preview-' + $device);

				// Panel footer buttons
				$footer_devices.find('button').removeClass('active').attr('aria-pressed', false);
				$footer_devices.find('button.preview-' + $device).addClass('active').attr('aria-pressed', true);

			});

			jQuery('#customize-footer-actions .devices button').on('click', function (event) {
				event.preventDefault();
				var device = jQuery(this).data('device');
				var queries = jQuery('.responsive-switchers');

				// Button class
				if (device == 'desktop') {
					if (queries.hasClass('responsive-switchers-open')) {
						queries.removeClass('responsive-switchers-open');
					} else {
						queries.addClass('responsive-switchers-open')
					}
				} else {
					if (!queries.hasClass('responsive-switchers-open')) {
						queries.addClass('responsive-switchers-open');
					}
				}

				queries.find('button').removeClass('active');
				queries.find('button.preview-' + device).addClass('active');

				var controls = jQuery('.responsive-control-wrap');
				controls.each(function () {
					if ($device != 'normal') {
						if (jQuery(this).hasClass($device)) {
							jQuery(this).addClass('active');
						} else {
							jQuery(this).removeClass('active');
						}
					}
				});
			});
		}

		responsiveSwitcher();

		var footerWidgetAreaSectionLinks = jQuery('.customize-section-link');
		footerWidgetAreaSectionLinks.each(function (i, o) {
			jQuery(this).on('click', function (event) {
				event.preventDefault();
				var sectionID = jQuery(this).attr('data-attr');
				wp.customize.section('sidebar-widgets-' + sectionID).focus();
			})
		});

		// @since 1.0.2
		customizeBody.on('click', '.unit-dropdown-toggle-button', function (event) {
			event.preventDefault();
			let thisButton = jQuery(this);
			thisButton.next('.cream-magazine-unit-dropdown').toggleClass('dropdown-open');
		});

		// @since 1.0.2
		customizeBody.on('click', '.cream-magazine-control-toggle-button', function (event) {
			event.preventDefault();
			let thisButton = jQuery(this);
			let associatedControlModal = thisButton.parent().parent().find('.cream-magazine-control-modal');
			let allControlModal = jQuery('.cream-magazine-control-modal');
			allControlModal.each(function () {
				let thisControlModal = jQuery(this);
				if (thisControlModal.hasClass('modal-open') && thisButton.data('control') !== thisControlModal.data('control')) {
					thisControlModal.removeClass('modal-open');
				}
			});
			thisButton.parent().parent().find('.cream-magazine-control-modal').toggleClass('modal-open');
		});

		// @since 1.0.2
		customizeBody.on('click', '.cream-magazine-unit-button', function (event) {
			event.preventDefault();
			let thisButton = jQuery(this);
			let thisButtonVal = thisButton.val();
			let unitButton = thisButton.parent().prev('.cream-magazine-unit-button');
			// Change the unit toggle button's text.
			unitButton.find('span').html(thisButtonVal);
			// Update the unit input field's value.
			unitButton.find('.cream-magazine-unit-input').val(thisButtonVal).trigger('change');
			// Remove 'dropdown-open' classname from unit dropdown element.
			thisButton.parent().removeClass('dropdown-open');
		});

		// @since 1.0.2
		customizeBody.on('click', '.cream-magazine-typography-font-style-button, .cream-magazine-typography-text-transform-button', function (event) {
			event.preventDefault();
			let thisButton = jQuery(this);
			// Remove classname 'active' from sibling buttons.
			thisButton.siblings().removeClass('active');
			// Add classname 'active' to current button;
			thisButton.addClass('active');
			// Update the input field's value.
			thisButton.parent().prev('input').val(thisButton.val()).trigger('change');
		});


		
	});

} ) ( jQuery );