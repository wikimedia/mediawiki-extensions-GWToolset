/*global jQuery, mw */
/*jslint browser: true, white: true, devel: true, regexp: true */
(function ( $ ) {
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
		$ajaxLoader: $( '<div>' )
			.attr( 'id', 'gwtoolset-loader' )
			.html(
				$( '<p>' )
					.text( mw.message( 'gwtoolset-loading' ).text() )
					.append( $.createSpinner( { size: 'large', type: 'block' } ) )
			),
		$templateTableTbody: $( '#template-table > tbody' ),
		$saveMappingButton: $( '<tr>' )
			.html(
				$( '<td>' )
					.attr( 'colspan', 3 )
					.css( 'text-align', 'right' )
					.html(
						$( '<span>' )
							.attr( {
								id: 'save-mapping',
								title: mw.message( 'gwtoolset-save-mapping' ).text()
							} )
							.text( mw.message( 'gwtoolset-save-mapping' ).text() )
					)
			),
		$buttons: {
			$add: $( '<img>' )
				.attr( 'src', mw.config.get('wgExtensionAssetsPath') + '/GWToolset/resources/images/b_snewtbl.png' )
				.addClass( 'gwtoolset-metadata-button' ),
			$subtract: $( '<img>' )
				.attr( 'src', mw.config.get('wgExtensionAssetsPath') + '/GWToolset/resources/images/b_drop.png' )
				.addClass( 'gwtoolset-metadata-button' )
		},
		$backText: $( '#back-text' ),
		$step2Link: $( '#step2-link' ),

		addAjaxLoader: function () {
			this.$ajaxLoader.hide();
			this.$form.prepend( this.$ajaxLoader );
		},

		addBackLinks: function () {
			this.$backText.replaceWith( this.createBackLink( { title: mw.message( 'gwtoolset-back-text-link' ).text() } ) );
			this.$step2Link.replaceWith( this.createBackLink( { title: mw.message( 'gwtoolset-step-2-heading' ).text() } ) );
		},

		addButtons: function () {
			$( '.button-add' ).html( this.$buttons.$add.clone().on( 'click', this.handleButtonAddClick ) );
			$( '.button-subtract' ).html( this.$buttons.$subtract.clone().on( 'click', this.handleButtonSubtractClick ) );
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

		handleAjaxError: function () {
			gwtoolset.openDialog( { msg: mw.message( 'gwtoolset-developer-issue' ).text() } );
			mw.log( arguments );
		},

		/**
		 * @param {Object} data
		 * @param {string} textStatus
		 * @param {Object} jqXHR
		 */
		handleAjaxSuccess: function ( data, textStatus, jqXHR ) {
			if ( data.ok !== true || !textStatus || !jqXHR ) {
				gwtoolset.openDialog( { msg: mw.message( 'gwtoolset-save-mapping-failed' ).text() } );
			} else {
				gwtoolset.openDialog( { msg: mw.message( 'gwtoolset-save-mapping-succeeded' ).text() } );
			}
		},

		/**
		 * @param {Event} evt
		 */
		handleButtonAddClick: function ( evt ) {
			var $target = $( this ).closest( 'tr' ),
				$tdButton = $( '<td>' )
					.addClass( 'button-subtract' )
					.html( gwtoolset.$buttons.$subtract.clone().on( 'click', gwtoolset.handleButtonSubtractClick ) ),
				$row = $( '<tr>' );

			evt.preventDefault();

			$target.children().each( function () {
				var $tdElm,
				$elm = $( this );

				if ( $elm.find('label').length === 1 ) {
					$row.append( $( '<td>' ) );
				} else if ( $elm.hasClass( 'button-add' ) ) {
					$row.append( $tdButton );
				} else {
					$tdElm = $elm.clone();
					$tdElm.find( 'input' ).val( '' );
					$tdElm.find( 'option' ).prop( 'selected', false );
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

		handleFormSubmit: function () {
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
					.attr( 'id', 'mapping-name-to-use' )
					.attr( 'value', $( '#metadata-mapping-name' ).val() );

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
			gwtoolset.addBackLinks();
			gwtoolset.addFormListener();
			gwtoolset.addSaveMappingButton();
			gwtoolset.addButtons();
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
			var mappingNameToUse = $( '#mapping-name-to-use' ).val(),
				mediawikiTemplateName = $( '#mediawiki-template-name' ).val(),
				wpEditToken = mw.user.tokens.get( 'editToken' ),
				metadataMappings = gwtoolset.$form.find( 'select' ).serialize();

			if ( evt ) {
				gwtoolset.$dialog.dialog( 'close' );
				evt.preventDefault();
			}

			metadataMappings = $.String.deparam( metadataMappings );

			if ( mappingNameToUse === null || mappingNameToUse.length < 3 ) {
				return;
			}

			$.ajax( {
				type: 'POST',
				url: mw.util.wikiGetlink( 'Special:GWToolset' ),
				data: {
					'gwtoolset-form': 'metadata-mapping-save',
					'mapping-name-to-use': mappingNameToUse,
					'metadata-mappings': metadataMappings,
					'mediawiki-template-name': mediawikiTemplateName,
					'wpEditToken': wpEditToken
				},
				error: gwtoolset.handleAjaxError,
				success: gwtoolset.handleAjaxSuccess,
				complete: gwtoolset.handleAjaxComplete,
				timeout: 5000
			} );
		}

	};

	gwtoolset.init();

}( jQuery ));
