/*global jQuery, mw */
/*jslint browser: true, continue: true, white: true, devel: true, regexp: true, todo: true */
(function ( $ ) {
	'use strict';

	var digitTest = /^\d+$/,
		keyBreaker = /([^\[\]]+)|(\[\])/g,
		plus = /\+/g,
		paramTest = /([^?#]*)(#.*)?$/,
		gwtoolset;

	/**
	 * @add jQuery.String
	 * @see https://github.com/jupiterjs/jquerymx/blob/master/lang/string/deparam/deparam.js
	 */
	$.String = $.extend( $.String || {}, {
		/**
		 * @function deparam
		 *
		 * Takes a string of name value pairs and returns a Object literal that represents those params.
		 *
		 * @param {string} params a string like <code>"foo=bar&person[age]=3"</code>
		 * @return {json} A JavaScript Object that represents the params:
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
				data = {},
				i,
				j,
				key,
				lastPart,
				pair,
				pairs = params.split( '&' ),
				part,
				parts,
				value;

			for ( i = 0; i < pairs.length; i += 1 ) {
				current = data;
				pair = pairs[i].split( '=' );

				// if we find foo=1+1=2
				if ( pair.length !== 2 ) {
					pair = [ pair[0], pair.slice( 1 ).join( "=" ) ];
				}

				key = decodeURIComponent( pair[0].replace( plus, " " ) );
				value = decodeURIComponent( pair[1].replace( plus, " " ) );
				parts = key.match( keyBreaker );

				for ( j = 0; j < parts.length - 1; j += 1 ) {
					part = parts[ j ];

					if ( !current[ part ] ) {
						// if what we are pointing to looks like an array
						current[ part ] = digitTest.test( parts[ j + 1 ] ) || parts[ j + 1 ] === "[]" ? [] : {};
					}

					current = current[ part ];
				}

				lastPart = parts[ parts.length - 1 ];

				if ( lastPart === "[]" ) {
					current.push( value );
				} else {
					current[lastPart] = value;
				}
			}

			return data;
		}
	} );

	gwtoolset = {

		display_debug_output: true,
		$dialog: {},
		empty_console: {
			log: function () {
			}
		},
		$form: $( '#gwtoolset-form' ),
		$ajax_loader: $( '<div/>' ).attr( { 'id': 'gwtoolset-loader' } ),
		$template_table_tbody: $( '#template-table > tbody' ),
		$save_mapping_button: $( '<tr />' )
			.html(
				$( '<td/>' )
					.attr( 'colspan', 3 )
					.css( 'text-align', 'right' )
					.html(
						$( '<span/>' )
							.attr( { 'id': 'save-mapping', 'title': mw.message( 'gwtoolset-save-mapping' ).escaped() } )
							.text( mw.message( 'gwtoolset-save-mapping' ).escaped() )
					)
			),
		$buttons: {
			$add: $( '<img/>' ).attr( { 'src': mw.config.get('wgScriptPath') + '/extensions/GWToolset/resources/images/b_snewtbl.png', 'class': 'gwtoolset-metadata-button' } ),
			$subtract: $( '<img/>' ).attr( { 'src': mw.config.get('wgScriptPath') + '/extensions/GWToolset/resources/images/b_drop.png', 'class': 'gwtoolset-metadata-button' } )
		},
		$button_placeholders : $( '.button-add, .button-subtract' ),
		$back_text: $( '#back-text' ),
		$step2_link: $( '#step2-link' ),

		/**
		 * @returns {void}
		 */
		addAjaxLoader: function () {
			this.$ajax_loader
				.append( '<p><img src="' + mw.config.get('wgScriptPath') + '/skins/common/images/ajax-loader.gif"/><br />' + mw.msg( 'gwtoolset-loading' ) + '</p>' );
			this.$form.prepend( this.$ajax_loader );
		},

		/**
		 * @returns {void}
		 */
		addBackLink: function () {
			var $back_link_option = $( '<a/>' )
				.attr( { 'href': '#', 'title': mw.message( 'gwtoolset-back-link-option' )	} )
				.text( mw.message( 'gwtoolset-back-link-option' ) )
				.on( 'click', function ( evt ) { evt.preventDefault(); history.back(); } );
			gwtoolset.$back_text.replaceWith( $back_link_option );
		},

		/**
		 * @returns {void}
		 */
		addButtons: function () {
			gwtoolset.$button_placeholders.each( function() {
				var $elm = $( this );

				if ( $elm.hasClass( 'button-add' ) ) {
					$elm.html( gwtoolset.$buttons.$add.clone().on( 'click', gwtoolset.handleButtonAddClick ) );
				}

				if ( $elm.hasClass( 'button-subtract' ) ) {
					$elm.html( gwtoolset.$buttons.$subtract.clone().on( 'click', gwtoolset.handleButtonSubtractClick ) );
				}
			});
		},

		/**
		 * @returns {void}
		 */
		addDialog: function() {
			gwtoolset.$dialog = $( '<div/>' )
				.attr( 'id', 'dialog' )
				.dialog( {
					autoOpen: false,
					draggable: false,
					modal: true
				} );
		},

		/**
		 * @returns {void}
		 */
		addFormListener: function () {
			if ( this.$form.length < 1 ) {
				return;
			}

			this.addAjaxLoader();
			this.$form.on( 'submit', this.handleFormSubmit );
		},

		/**
		 * @returns {void}
		 */
		addSaveMappingButton: function () {
			if ( this.$template_table_tbody.length === 1 ) {
				this.$template_table_tbody.append( this.$save_mapping_button );
				this.$save_mapping_button.on( 'click', this.handleSaveMappingClick );
			}
		},

		/**
		 * @returns {void}
		 */
		addStepLinks: function () {
			var $step2_link = $( '<a/>' )
				.attr( { 'href': '#', 'title': mw.message( 'gwtoolset-step-2' ) } )
				.text( mw.message( 'gwtoolset-step-2' ) )
				.on( 'click', function ( evt ) { evt.preventDefault(); history.back(); } );
			gwtoolset.$step2_link.replaceWith( $step2_link );
		},

		/**
		 * @returns {void}
		 */
		handleAjaxComplete: function () {
			console.log( 'ajax complete' );
		},

		/**
		 * @returns {void}
		 */
		handleAjaxError: function () {
			gwtoolset.openDialog( mw.message( 'gwtoolset-developer-issue' ) );
			console.log( arguments );
		},

		/**
		 * @param {Status} data
		 * @param {string} textStatus
		 * @param {object} jqXHR
		 * @returns {void}
		 */
		handleAjaxSuccess: function ( data, textStatus, jqXHR ) {
			if ( !data.ok || data.ok !== true || !textStatus || !jqXHR ) {
				gwtoolset.openDialog( mw.message( 'gwtoolset-save-mapping-failed' ).escaped() );
			} else {
				gwtoolset.openDialog( mw.message( 'gwtoolset-save-mapping-succeeded' ).escaped() );
			}

			console.log( arguments );
		},

		/**
		 * @param {object} evt
		 * @returns {void}
		 */
		handleButtonAddClick: function ( evt ) {
			var $target = $( this ).closest( 'tr' ),
				$td_button = $( '<td/>' )
					.attr( {'class': 'button-subtract'} )
					.html( gwtoolset.$buttons.$subtract.clone().on( 'click', gwtoolset.handleButtonSubtractClick ) ),
				$row = $( '<tr/>' );

			evt.preventDefault();

			$target.children().each( function () {
				var $elm = $( this ),
					$td_elm;

				if ( $elm.find('label').length === 1 ) {
					$row.append( $( '<td/>' ).html( ' ' ) );
				} else if ( $elm.hasClass('button-add') ) {
					$row.append( $td_button );
				} else {
					$td_elm = $elm.clone();
					$td_elm.find( 'input' ).val( '' );
					$td_elm.find( 'option' ).prop( 'selected', false );
					$row.append( $td_elm );
				}
			});

			$row.insertAfter( $target );
		},

		/**
		 * @param {object} evt
		 * @returns {void}
		 */
		handleButtonSubtractClick: function ( evt ) {
			evt.preventDefault();
			$( this ).closest( 'tr' ).remove();
		},

		/**
		 * @returns {void}
		 */
		handleFormSubmit: function () {
			gwtoolset.$ajax_loader.fadeIn();
		},

		/**
		 * @param {object} evt
		 * @returns {void}
		 */
		handleSaveMappingClick: function ( evt ) {
			var mapping_name_to_use = prompt( mw.message( 'gwtoolset-save-mapping-name' ).escaped(), $( '#metadata-mapping-name' ).val() ),
				mediawiki_template_name = $( '#mediawiki-template-name' ).val(),
				wpEditToken = $( '#wpEditToken' ).val(),
				metadata_mappings = gwtoolset.$form.find( 'select' ).serialize();

			evt.preventDefault();
			metadata_mappings = $.String.deparam( metadata_mappings );

			if ( mapping_name_to_use !== null && mapping_name_to_use.length > 3 ) {
				gwtoolset.saveMapping( mapping_name_to_use, mediawiki_template_name, wpEditToken, metadata_mappings );
			}
		},

		/**
		 * @returns {void}
		 */
		init: function () {
			gwtoolset.setConsole();
			gwtoolset.addStepLinks();
			gwtoolset.addBackLink();
			gwtoolset.addFormListener();
			gwtoolset.addSaveMappingButton();
			gwtoolset.addButtons();
			gwtoolset.addDialog();
		},

		/**
		 * @param {string} msg
		 * @returns {void}
		 */
		openDialog : function ( msg ) {
			gwtoolset.$dialog.html( msg );
			gwtoolset.$dialog.dialog( 'open' );
		},

		/**
		 * sends the appropriate data to the server for the mapping to be created/updated
		 *
		 * @param {string} mapping_name_to_use a name for the mapping to be saved as
		 * @param {string} mediawiki_template the name of the mediawiki template the mapping applies to
		 * @param {string} the edit token that allows the user to amke edits to stored data
		 * @param {array} metadata_mappings a json array of the selected mappings
		 * @todo handle server error, timeout, etc.
		 */
		saveMapping: function ( mapping_name_to_use, mediawiki_template_name, wpEditToken, metadata_mappings ) {
			$.ajax( {
				type: 'POST',
				url: mw.util.wikiGetlink( 'Special:GWToolset' ),
				data: {
					'gwtoolset-form': 'metadata-mapping-save',
					'mapping-name-to-use': mapping_name_to_use,
					'metadata-mappings': metadata_mappings,
					'mediawiki-template-name': mediawiki_template_name,
					'wpEditToken': wpEditToken
				},
				error: gwtoolset.handleAjaxError,
				success: gwtoolset.handleAjaxSuccess,
				complete: gwtoolset.handleAjaxComplete,
				timeout: 5000
			} );
		},

		/**
		 * @returns {void}
		 */
		setConsole: function () {
			if ( window.console === undefined || !this.display_debug_output ) {
				window.console = this.empty_console;
			}
		}

	};

	gwtoolset.init();

}( jQuery ));
