<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset\Models;
use Html,
	GWToolset\Adapters\DataAdapterInterface,
	GWToolset\Config,
	GWToolset\GWTException,
	GWToolset\Helpers\FileChecks,
	MWException,
	Php\Filter,
	ReflectionClass,
	ReflectionProperty,
	ResultWrapper;

class MediawikiTemplate implements ModelInterface {

	/**
	 * @var {string}
	 * a raw representation of the original metadata
	 */
	public $metadata_raw;

	/**
	 * @var {string}
	 * the mediawiki template name
	 */
	public $mediawiki_template_name;

	/**
	 * @var {string}
	 * a json representation of the mediawiki template parameters
	 */
	public $mediawiki_template_json;

	/**
	 * @var {array}
	 * the $mediawiki_template_json converted to a php array
	 */
	public $mediawiki_template_array = array();

	/**
	 * @var {DataAdapterInterface}
	 */
	protected $_DataAdapater;

	/**
	 * @var {array}
	 */
	protected $_sub_templates = array(
		'language' => '{{%s|%s}}',
		'institution' => '{{Institution:%s}}',
		'creator' => '{{Creator:%s}}'
	);

	/**
	 * @param {DataAdapterInterface} $DataAdapter
	 */
	public function __construct( DataAdapterInterface $DataAdapter ) {
		$this->_DataAdapater = $DataAdapter;
	}

	public function create( array $options = array() ) {
	}

	public function delete( array &$options = array() ) {
	}

	/**
	 * create an array that represents the mapping of mediawiki template attributes
	 * to metadata elements based on the given array.
	 *
	 * the array is expected to be in an array format for each mediawiki parameter
	 * e.g. accession_number[], artist[]
	 *
	 * @throws {MWException}
	 *
	 * @return {array}
	 * the keys and values in the array are sanitized
	 */
	public function getMappingFromArray( array $array = array() ) {
		$result = array();
		$parameter_as_id = null;
		$metadata_element = null;

		if ( empty( $array ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params(
						__METHOD__ . ': ' .
						wfMessage( 'gwtoolset-no-source-array' )->escaped()
					)
					->parse()
			);
		}

		foreach ( $this->mediawiki_template_array as $parameter => $value ) {
			$parameter_as_id = Filter::evaluate( \GWToolset\normalizeSpace( $parameter ) );

			if ( isset( $array[$parameter_as_id] ) ) {
				foreach ( $array[$parameter_as_id] as $metadata_element ) {
					$result[$parameter_as_id][] = Filter::evaluate( $metadata_element );
				}
			}
		}

		return $result;
	}

	/**
	 * a decorator method that creates html <option>s based on keys
	 * returned from a data adapter. these keys are the names of
	 * the mediawiki templates handled by the extension.
	 *
	 * @return {string}
	 * the keys within the <option>s are filtered
	 */
	public function getModelKeysAsOptions() {
		$result = Html::rawElement( 'option', array( 'value' => '' ), ' ' );

		foreach ( $this->_DataAdapater->getKeys() as $option ) {
			$result .= Html::rawElement( 'option', array(), Filter::evaluate( $option ) );
		}

		return $result;
	}

	/**
	 * creates wiki text for a given mediawiki template.
	 * creates the mediawiki template section of the template.
	 * this does not include categories, raw metadata, or raw
	 * mapping information, which are added via other methods.
	 *
	 * @param {array} $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @return {string}
	 * the resulting wiki text is filtered
	 */
	public function getTemplate( array &$user_options ) {
		$result = '<!-- Mediawiki Template -->' . PHP_EOL;
		$sections = null;
		$template = '{{' . $this->mediawiki_template_name . PHP_EOL . '%s}}';

		foreach ( $this->mediawiki_template_array as $parameter => $content ) {
			if ( empty( $content ) ) {
				continue;
			}

			$sections .= ' | ' . Filter::evaluate( $parameter ) . ' = ';

			/**
			 * sometimes the metadata element has several "shared" metadata
			 * elements with the same element name. at the moment the
			 * application will add elements that use lang= attribute to an
			 * associative array element 'language' indicating that the mediawiki
			 * template should use the language subtemplate
			 */
			if ( is_array( $content ) ) {
				foreach ( $content as $sub_template_name => $sub_template_content ) {
					// currently only language is handled as a sub-template
					if ( $sub_template_name === 'language' ) {
						foreach ( $sub_template_content as $language => $language_content ) {
							$sections .= sprintf(
									$this->_sub_templates['language'],
									Filter::evaluate( $language ),
									Filter::evaluate( $language_content )
								) . PHP_EOL;
						}
						/**
						 * sometimes the "shared" metadata element will indicate lang,
						 * sometimes not this section handles those "shared" metadata
						 * elements that do not specify a lang attribute
						 */
					} else {
						$sections .= Filter::evaluate( $sub_template_content ) . PHP_EOL;
					}
				}
			} else {
				$content = trim( $content );

				if ( $parameter === 'institution' ) {
					$sections .= sprintf(
							$this->_sub_templates['institution'],
							Filter::evaluate( $content )
						) . PHP_EOL;
				} elseif ( $parameter === 'artist' ) {
					// assumes that there could be more than one creator and uses the
					// configured metadata separator to determine that
					$creators = explode( Config::$metadata_separator, $content );

					foreach ( $creators as $creator ) {
						// assumes that a creator entry could be last name, first
						// no other assumptions are made other than this one
						$creator = explode( ',', $creator, 2 );

						if ( count( $creator ) === 2 ) {
							$creator = trim( $creator[1] ) . ' ' . trim( $creator[0] );
						} else {
							$creator = trim( $creator[0] );
						}

						$sections .= sprintf(
								$this->_sub_templates['creator'],
								Filter::evaluate( $creator )
							) . PHP_EOL;
					}
				} elseif ( $parameter === 'permission' ) {
					// http://commons.wikimedia.org/wiki/Category:Creative_Commons_licenses
					$permission = strtolower( $content );

					if ( strstr( $permission, 'creativecommons.org/' ) ) {
						$patterns = array(
							'/(http|https):\/\/(www\.|)creativecommons.org\/publicdomain\/mark\/1.0\//',
							'/(http|https):\/\/(www\.|)creativecommons.org\/publicdomain\/zero\/1.0\//',
							'/(http|https):\/\/(www\.|)creativecommons.org\/licenses\//',
							'/deed\.*/'
						);

						$replacements = array(
							'{{PD-US}}{{PD-old}}', // Public Domain Mark 1.0
							'{{Cc-zero}}', // CC0 1.0 Universal (CC0 1.0) Public Domain Dedication
							'',
							''
						);

						$permission = preg_replace( $patterns, $replacements, $permission );
						$permission = explode( '/', $permission );

						if ( count( $permission ) > 1 ) {
							$i = 0;
							$string = '{{Cc-';

							foreach ( $permission as $piece ) {
								if ( !empty( $piece ) ) {
									$string .= $piece . '-';
								}

								$i++;

								// limit licenses path depth to 3
								if ( $i == 3 ) {
									break;
								}
							}

							$string = substr( $string, 0, strlen( $string ) - 1 );
							$string .= '}}';
							$permission = $string;
						} else {
							$permission = $permission[0];
						}
					} else {
						$permission = $content;
					}

					$sections .= Filter::evaluate( $permission ) . PHP_EOL;
				} elseif ( $parameter === 'source' ) {
					if ( !empty( $user_options['partner-template-name'] ) ) {
						$sections .= Filter::evaluate( $content ) .
							'{{' .
							Filter::evaluate( $user_options['partner-template-name'] ) .
							'}}' .
							PHP_EOL;
					} else {
						$sections .= Filter::evaluate( $content ) . PHP_EOL;
					}
				} else {
					$sections .= Filter::evaluate( $content ) . PHP_EOL;
				}
			}
		}

		$result .= sprintf( $template, $sections );

		return $result;
	}

	/**
	 * a decorator method that returns an html <select> the
	 * user can use to select a mediawiki template to use
	 * when mapping their metadata with a mediawiki template
	 *
	 * the options in the select are populated from a hard-coded
	 * list of mediawiki templates handled by the extension that
	 * come from a data adapter.
	 *
	 * @param {string} $name
	 * an html form name that should be given to the select.
	 * the param is filtered.
	 *
	 * @param {string} $id
	 * an html form id that should be given to the select.
	 * the param is filtered.
	 *
	 * @return {string}
	 * the select values within the <option>s are filtered
	 */
	public function getTemplatesAsSelect( $name = null, $id = null ) {
		$result = null;
		$attribs = array();

		if ( !empty( $name ) ) {
			$attribs['name'] = Filter::evaluate( $name );
		}

		if ( !empty( $id ) ) {
			$attribs['id'] = Filter::evaluate( $id );
		}

		$result =
			Html::openElement( 'select', $attribs ) .
			$this->getModelKeysAsOptions() .
			Html::closeElement( 'select' );

		return $result;
	}

	/**
	 * creates a title string that will be used to create a wiki title for a media file.
	 * the title string is based on :
	 *
	 *   - title
	 *   - title identifier
	 *   - url to the media file’s extension
	 *
	 * the title length is limited to Config::$title_max_length
	 * @see https://commons.wikimedia.org/wiki/Commons:File_naming
	 *
	 * @param {array} $options
	 * @throws {GWTException}
	 * @return {string} the string is not filtered.
	 */
	public function getTitle( array &$options ) {
		$result = null;

		if ( empty( $this->mediawiki_template_array['gwtoolset-title-identifier'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-mapping-no-title-identifier' )
					->escaped()
			);
		}

		if ( empty( $options['evaluated-media-file-extension'] ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-mapping-media-file-url-extension-bad' )
					->rawParams( Filter::evaluate( $options['gwtoolset-url-to-the-media-file'] ) )
					->escaped()
				);
		}

		if ( !empty( $this->mediawiki_template_array['title'] ) ) {
			$title_length = strlen( $this->mediawiki_template_array['title'] );
			$title_identifier_length =
				strlen( $this->mediawiki_template_array['gwtoolset-title-identifier'] );
			$file_extension_length = strlen( $options['evaluated-media-file-extension'] ) + 1;

			if ( ( $title_length + $title_identifier_length + $file_extension_length + 1 )
				> Config::$title_max_length
			) {
				$result = substr(
					$this->mediawiki_template_array['title'],
					0,
					( Config::$title_max_length - $title_identifier_length - $file_extension_length - 1 )
				);
			} else {
				$result = $this->mediawiki_template_array['title'];
			}

			$result .= Config::$title_separator;
		}

		$result .= $this->mediawiki_template_array['gwtoolset-title-identifier'];
		$result .= '.' . $options['evaluated-media-file-extension'];

		if ( $result > Config::$title_max_length ) {
			$result = substr(
				$this->mediawiki_template_array['gwtoolset-title-identifier'],
				0,
				( Config::$title_max_length - $file_extension_length - 1 )
			);

			$result .= '.' . $options['evaluated-media-file-extension'];
		}

		return $result;
	}

	/**
	 * a control method that retrieves a mediawiki template model using the data adapter
	 * provided at class instantiation and populates this model class with the result
	 *
	 * @param {string} $mediawiki_template_name
	 * @throws {GWTException|MWException}
	 */
	public function getMediaWikiTemplate( $mediawiki_template_name = null ) {
		if ( empty( $mediawiki_template_name ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->param( wfMessage( 'gwtoolset-no-mediawiki-template' )->parse() )
					->parse()
				);
		}

		if ( in_array( $mediawiki_template_name, Config::$allowed_templates ) ) {
			$this->mediawiki_template_name = $mediawiki_template_name;
			$this->retrieve();
		} else {
			throw new GWTException(
				wfMessage( 'gwtoolset-metadata-invalid-template' )->escaped()
			);
		}
	}

	public function populateFromArray( array &$metadata = array() ) {
		foreach ( $this->mediawiki_template_array as $parameter => $value ) {
			$this->mediawiki_template_array[$parameter] = null;
			$parameter_as_id = \GWToolset\normalizeSpace( $parameter );

			if ( isset( $metadata[$parameter_as_id] ) ) {
				$this->mediawiki_template_array[$parameter] = $metadata[$parameter_as_id];
			}
		}
	}

	/**
	 * a control method that retrieves the hard-coded mediawiki
	 * template format fro the data adapter, which is used to populate
	 * this mediawiki template model
	 *
	 * @param {array} $options
	 * @throws {GWTException}
	 */
	public function retrieve( array &$options = array() ) {
		$result = $this->_DataAdapater->retrieve(
			array( 'mediawiki_template_name' => $this->mediawiki_template_name )
		);

		if ( empty( $result ) ) {
			throw new GWTException(
				wfMessage( 'gwtoolset-mediawiki-template-not-found' )
					->rawParams( Filter::evaluate( $this->mediawiki_template_name ) )
						->escaped()
				);
		}

		$this->mediawiki_template_json = $result['mediawiki_template_json'];
		$this->mediawiki_template_array = json_decode( $this->mediawiki_template_json, true );

		ksort( $this->mediawiki_template_array );

		// add aditional mediawiki template fields that the extension needs
		$this->mediawiki_template_array['gwtoolset-title-identifier'] = null;
		$this->mediawiki_template_array['gwtoolset-url-to-the-media-file'] = null;
	}

	public function update( array &$options = array() ) {
	}
}
