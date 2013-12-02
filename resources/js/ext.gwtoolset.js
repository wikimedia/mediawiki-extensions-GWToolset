/*global jQuery, mediaWiki */
/*jslint browser: true, plusplus: true, regexp: true, white: true */
(function ( mw, $ ) {
	'use strict';

	var gwtoolset,
		digitTest = /^\d+$/,
		keyBreaker = /([^\[\]]+)|(\[\])/g,
		paramTest = /([^?#]*)(#.*)?$/,
		plus = /\+/g;

	/**
	 * @add jQuery.String
	 * @author justinbmeyer
	 * @see https://github.com/jupiterjs/jquerymx/blob/master/lang/string/deparam/deparam.js
	 */
	$.String = $.extend( $.String || {}, {
		/**
		 * @function deparam
		 *
		 * Takes a string of name value pairs and returns a Object literal that represents those params.
		 *
		 * @param {string} params a string like <code>"foo=bar&person[age]=3"</code>
		 * @return {Object} A JavaScript Object that represents the params:
		 *
		 *     {
		 *       foo: "bar",
		 *       person: {
		 *         age: "3"
		 *       }
		 *     }
		 */
		deparam: function ( params ) {
			if ( !params || !paramTest.test( params ) ) {
				return {};
			}

			var current,
				i,
				j,
				key,
				lastPart,
				pair,
				part,
				parts,
				value,
				data = {},
				pairs = params.split( '&' );

			for ( i = 0; i < pairs.length; i++ ) {
				current = data;
				pair = pairs[i].split( '=' );

				// if we find foo=1+1=2
				if ( pair.length !== 2 ) {
					pair = [ pair[0], pair.slice( 1 ).join( '=' ) ];
				}

				key = decodeURIComponent( pair[0].replace( plus, ' ' ) );
				value = decodeURIComponent( pair[1].replace( plus, ' ' ) );
				parts = key.match( keyBreaker );

				for ( j = 0; j < parts.length - 1; j++ ) {
					part = parts[ j ];

					if ( !current[ part ] ) {
						// if what we are pointing to looks like an array
						current[ part ] = digitTest.test( parts[ j + 1 ] ) || parts[ j + 1 ] === '[]' ? [] : {};
					}

					current = current[ part ];
				}

				lastPart = parts[ parts.length - 1 ];

				if ( lastPart === '[]' ) {
					current.push( value );
				} else {
					current[lastPart] = value;
				}
			}

			return data;
		}
	} );

	gwtoolset = {

		$ajaxLoader: $( '<div>' )
			.attr( 'id', 'gwtoolset-loader' )
			.append(
				$( '<p>' )
					.text( mw.message( 'gwtoolset-loading' ).text() )
					.append( $.createSpinner( { size: 'large', type: 'block' } ) )
			),
		$backText: $( '#back-text' ),
		$buttons: {
			$add: $( '<img>' )
				.attr(
					'src',
					mw.config.get( 'wgExtensionAssetsPath' ) + '/GWToolset/resources/images/b_snewtbl.png'
				)
				.addClass( 'gwtoolset-metadata-button' ),
			$subtract: $( '<img>' )
				.attr(
					'src',
					mw.config.get( 'wgExtensionAssetsPath' ) + '/GWToolset/resources/images/b_drop.png'
				)
				.addClass( 'gwtoolset-metadata-button' )
		},
		cookieName: 'gwtoolset.cookie',
		$dialog: $( '<div>' )
			.attr( 'id', 'dialog' )
			.dialog( {
				autoOpen: false,
				modal: true,
				resizable: false,
				close: function () {
					gwtoolset.closeDialog();
				}
			} ),
		$form: $( '#gwtoolset-form' ),
		formName: $( 'input[name=gwtoolset-form]' ).val(),
		$globalCategoriesTableTbody: $( '#global-categories-table')
			.children( 'tbody' )
			.eq( 0 ),
		$itemSpecificCategoriesTableTbody: $( '#item-specific-categories-table' )
			.children( 'tbody' )
			.eq( 0 ),
		$saveMappingButton: $( '<tr>' )
			.append(
				$( '<td>' )
					.attr( 'colspan', 3 )
					.css( 'text-align', 'right' )
					.append(
						$( '<span>' )
							.attr( {
								id: 'save-mapping',
								title: mw.message( 'gwtoolset-save-mapping' ).text()
							} )
							.text( mw.message( 'gwtoolset-save-mapping' ).text() )
					)
			),
		$step2Link: $( '#step2-link' ),
		$templateTableTbody: $( '#template-table' ).children( 'tbody' ).eq( 0 ),

		addAjaxLoader: function () {
			this.$ajaxLoader.hide();
			this.$form.prepend( this.$ajaxLoader );
		},

		addBackLinks: function () {
			this.$backText
				.replaceWith(
					this.createBackLink( { title: mw.message( 'gwtoolset-back-text-link' ).text() } )
				);
			this.$step2Link
				.replaceWith(
					this.createBackLink( { title: mw.message( 'gwtoolset-step-2-heading' ).text() } )
				);
		},

		addButtons: function () {
			$( '.button-add' )
				.append( this.$buttons.$add.clone().on( 'click', this.handleButtonAddClick ) );
			$( '.button-subtract' )
				.append( this.$buttons.$subtract.clone().on( 'click', this.handleButtonSubtractClick ) );
		},

		addFormListener: function () {
			if ( this.$form.length < 1 ) {
				return;
			}

			this.addAjaxLoader();
			this.$form.on( 'submit', this.handleFormSubmit );
		},

		addSaveMappingButton: function () {
			if ( this.$templateTableTbody.length === 1 ) {
				this.$templateTableTbody.append( this.$saveMappingButton );
				this.$saveMappingButton.on( 'click', this.handleSaveMappingClick );
			}
		},

		closeDialog: function () {
			this.$dialog.dialog( {
				buttons: null,
				dialogClass: null,
				title: null
			} );
		},

		/**
		 * creates an <a> link that will take the user back one page in the browser history
		 * the method uses options.title for the link title and text, yet also allows
		 * you to specify unique values if desired
		 *
		 * @param {Object} options
		 */
		createBackLink: function ( options ) {
			return $( '<a>' )
				.attr( 'href', '#' )
				.attr( 'title', options.title || 'back link' )
				.text( options.text || options.title || 'back link' )
				.on( 'click', function ( evt ) {
					evt.preventDefault();
					evt.stopPropagation();
					history.back();
				} );
		},

		/**
		 * creates/adds to the document.cookie
		 *
		 * @param {Object} options
		 *
		 * @param {string} options.name
		 * name of the cookie
		 *
		 * @param {Object} options.options
		 * $.cookie, cookie options
		 *
		 * @param {mixed} options.value
		 */
		createCookie: function ( options ) {
			var optionsDefault = {
				name: this.cookieName,
				options: {
					path: '/'
				}
			};

			options = $.extend( true, {}, optionsDefault, options );

			$.cookie(
				options.name,
				( typeof options.value === 'object' ) ? $.toJSON( options.value ) : options.value,
				options.options
			);
		},

		/**
		 * @param {Object} $elm
		 * a jQuery object
		 *
		 * @returns {Object}
		 */
		findTarget: function ( $elm ) {
			if ( $elm.next().children( 'td.button-subtract' ).length > 0 ) {
				return this.findTarget( $elm.next() );
			}

			return $elm;
		},

		/**
		 * creates an Object that contains the form section fields the application tracks
		 *
		 * @returns {Object}
		 */
		getFieldsOnForm: function () {
			return {
				$globalCategoriesTableTbody:
					this.getFormSectionValues( this.$globalCategoriesTableTbody, 'input' ),
				$itemSpecificCategoriesTableTbody:
					this.getFormSectionValues( this.$itemSpecificCategoriesTableTbody, 'input, select' ),
				$templateTableTbody:
					this.getFormSectionValues( this.$templateTableTbody, 'select' )
			};
		},

		/**
		 * given a jQuery element representing a section within the html, finds and returns
		 * the fields and values serialized and deparamed
		 *
		 * @param {Object} $elm
		 * a jQuery object representing a section that contains the fields and values to be
		 * serialized and deparamed
		 *
		 * @param {string} find
		 * the specific element(s) to find within the $elm, e.g., 'input, select'
		 *
		 * @returns {string}
		 */
		getFormSectionValues: function ( $elm, find ) {
			var result;

			result = $elm.find( find ).serialize();
			result = $.String.deparam( result );

			return result;
		},

		handleAjaxError: function () {
			gwtoolset.openDialog( {
				msg: mw.message( 'gwtoolset-developer-issue', '' ).text()
			} );

			mw.log( arguments );
		},

		/**
		 * @param {Object} data
		 */
		handleAjaxSuccess: function ( data ) {
			if ( !data.edit || !data.edit.result || data.edit.result !== 'Success' ) {
				if ( data.error && data.error.info ) {
					gwtoolset.openDialog( {
						msg: mw.message( 'gwtoolset-save-mapping-failed', data.error.info ).escaped()
					} );
				} else {
					gwtoolset.openDialog( {
						msg: mw.message( 'gwtoolset-save-mapping-failed', '' ).escaped()
					} );
				}
			} else {
				gwtoolset.openDialog( {
					msg: mw.message( 'gwtoolset-save-mapping-succeeded' ).text()
				} );
			}
		},

		/**
		 * @param {Event} evt
		 * @param {Object} data
		 */
		handleButtonAddClick: function ( evt, data ) {
			var $target = gwtoolset.findTarget( $( this ).closest( 'tr' ) ),
				$tdButton = $( '<td>' )
					.addClass( 'button-subtract' )
					.append( gwtoolset.$buttons.$subtract.clone()
						.on( 'click', gwtoolset.handleButtonSubtractClick )
					),
				$row = $( '<tr>' );

			evt.preventDefault();

			$target.children().each( function () {
				var $tdElm,
					$elm = $( this );

				if ( $elm.find('label').length === 1 ) {
					$row.append( $( '<td>' ) );
				} else if ( $elm.hasClass( 'button-add' ) || $elm.hasClass( 'button-subtract' ) ) {
					$row.append( $tdButton );
				} else {
					$tdElm = $elm.clone();

					if ( data && data.value ) {
						$tdElm.find( 'input' ).val( data.value );
					} else {
						$tdElm.find( 'input' ).val( '' );
					}

					if ( data && data.option ) {
						$.each( $tdElm.find( 'option' ), function () {
							var $optionElm = $( this );

							if ( $optionElm.text() === data.option ) {
								$optionElm.prop( 'selected', true );
								return false;
							}

							return true;
						} );
					} else {
						$tdElm.find( 'option' ).prop( 'selected', false );
					}

					$row.append( $tdElm );
				}
			});

			$row.insertAfter( $target );
		},

		/**
		 * @param {Event} evt
		 */
		handleButtonSubtractClick: function ( evt ) {
			evt.preventDefault();
			$( this ).closest( 'tr' ).remove();
		},

		/**
		 * remove cookies on step-1 submit, we don’t want previously stored values to be used.
		 * store cookies on step-2 submit
		 */
		handleFormSubmit: function () {
			if ( gwtoolset.formName === 'metadata-detect' ) {
				gwtoolset.removeCookies();
			} else if ( gwtoolset.formName === 'metadata-mapping' ) {
				gwtoolset.createCookie(
					{ value: gwtoolset.getFieldsOnForm() }
				);
			}

			gwtoolset.$ajaxLoader.fadeIn();
		},

		/**
		 * @param {Event} evt
		 */
		handleSaveMappingClick: function ( evt ) {
			var $form = $( '<form>' )
					.on( 'submit', gwtoolset.saveMapping ),
				$input = $( '<input>' )
					.attr( 'type', 'text' )
					.attr( 'id', 'gwtoolset-mapping-name-to-use' )
					.attr( 'value', $( '#gwtoolset-metadata-mapping-name' ).val() );

			evt.preventDefault();

			gwtoolset.openDialog( {
				options: {
					title: mw.message( 'gwtoolset-save-mapping-name' ).text(),
					dialogClass: 'no-close',
					buttons : [
						{
							text: mw.message( 'gwtoolset-save' ).text(),
							click: function () {
								$( this ).dialog( 'close' );
								gwtoolset.saveMapping();
							},
							id: 'button-save-mapping'
						},
						{
							text: mw.message( 'gwtoolset-cancel' ).text(),
							click: function () {
								$( this ).dialog( 'close' );
							}
						}
					]
				},
				msg: $form.append( $input )
			} );
		},

		init: function () {
			this.addBackLinks();
			this.addFormListener();
			this.addSaveMappingButton();
			this.addButtons();
			this.restoreJsFormFields();
		},

		removeCookies: function () {
			$.cookie( this.cookieName, null );
		},

		/**
		 * restores js added input and select fields using the document.cookie
		 * - the document.cookie should contain a cookie value named this.cookieName
		 * - that cookie should be a JSON stringified
		 */
		restoreJsFormFields: function () {
			var buttonAdd,
			fieldsInCookie,
			fieldsOnForm,
			formSectionFieldIndex;

			if ( this.formName !== 'metadata-mapping' ) {
				return;
			}

			fieldsOnForm = this.getFieldsOnForm();
			fieldsInCookie = $.secureEvalJSON( $.cookie( this.cookieName ) );

			if ( !fieldsInCookie ) {
				return;
			}

			$.each( fieldsInCookie, function ( section, cookieSectionFields ) {
				$.each( cookieSectionFields, function ( cookieSectionField ) {
					if ( fieldsOnForm[section][cookieSectionField].length !==
						cookieSectionFields[cookieSectionField].length
					) {
						formSectionFieldIndex = fieldsOnForm[section][cookieSectionField].length - 1;
						$.each( cookieSectionFields[cookieSectionField],
							function( cookieSectionFieldIndex, value
						) {
							// when this is true the cookie contains a field and value that was added with js
							if ( cookieSectionFieldIndex > formSectionFieldIndex ) {
								switch ( section ) {
									case '$globalCategoriesTableTbody':
										buttonAdd = gwtoolset[section].find( '.button-add img' );
										buttonAdd.trigger( 'click', { value: value } );
										break;
									case '$templateTableTbody':
										buttonAdd = $( '#' + cookieSectionField.replace( ' ', '_' ) )
											.closest( 'tr' )
											.find('.button-add img');
										buttonAdd.trigger( 'click', { option: value } );
										break;
									case '$itemSpecificCategoriesTableTbody':
										// only want to trigger buttonAdd once
										if ( cookieSectionField === 'gwtoolset-category-metadata' ) {
											buttonAdd = gwtoolset[section].find( '.button-add img' );
											buttonAdd.trigger( 'click', {
												option: cookieSectionFields['gwtoolset-category-metadata'][cookieSectionFieldIndex],
												value: cookieSectionFields['gwtoolset-category-phrase'][cookieSectionFieldIndex]
											} );
										}
										break;
								}
							}
						} );
					}
				} );
			} );
		},

		/**
		 * @param {Object} options
		 */
		openDialog: function ( options ) {
			gwtoolset.$dialog.html( options.msg );

			if ( options.options !== undefined ) {
				gwtoolset.$dialog.dialog( options.options );
			}

			gwtoolset.$dialog.dialog( 'open' );
		},

		/**
		 * sends the appropriate data to the server for the mapping to be created/updated
		 *
		 * @param {Event} evt
		 */
		saveMapping: function ( evt ) {
			var Api = new mw.Api(),
				mappingNameToUse = $( '#gwtoolset-mapping-name-to-use' ).val(),
				metadataMappings = gwtoolset
					.getFormSectionValues(
						gwtoolset.$templateTableTbody,
						'select'
					),
				summary = mw.message(
					'gwtoolset-create-mapping',
					'GWToolset',
					mw.user.getName()
					)
					.text(),
				title = $( '#gwtoolset-metadata-namespace' ).val() +
					$( '#gwtoolset-metadata-mapping-subpage' ).val() + '/' +
					mw.user.getName() + '/' +
					mappingNameToUse + '.json',
				wpEditToken = mw.user.tokens.get( 'editToken' );

			if ( evt ) {
				gwtoolset.$dialog.dialog( 'close' );
				evt.preventDefault();
			}

			if ( mappingNameToUse === null || mappingNameToUse.length < 3 ) {
				return;
			}

			Api.post(
				{
					action: 'edit',
					summary: summary,
					text: $.toJSON( metadataMappings ),
					title: title,
					token: wpEditToken
				},
				{
					error: gwtoolset.handleAjaxError,
					success: gwtoolset.handleAjaxSuccess,
					timeout: 5000
				}
			);
		}

	};

	gwtoolset.init();

}( mediaWiki, jQuery ));
