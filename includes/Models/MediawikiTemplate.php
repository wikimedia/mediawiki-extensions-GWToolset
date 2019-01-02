<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset\Models;

use Html;
use GWToolset\Adapters\DataAdapterInterface;
use GWToolset\Config;
use GWToolset\GWTException;
use GWToolset\Utils;
use MWException;

class MediawikiTemplate implements ModelInterface {

	/**
	 * @var string
	 * a raw representation of the original metadata
	 */
	public $metadata_raw;

	/**
	 * @var string
	 * the mediawiki template name
	 */
	public $mediawiki_template_name;

	/**
	 * @var string
	 * a json representation of the mediawiki template parameters
	 */
	public $mediawiki_template_json;

	/**
	 * @var array
	 * the $mediawiki_template_json converted to a php array
	 */
	public $mediawiki_template_array = [];

	/**
	 * @var DataAdapterInterface
	 */
	protected $_DataAdapater;

	/**
	 * @var array
	 */
	protected $_sub_templates = [
		'language' => '{{%s|%s}}',
		'creator' => [
			'template' => '{{Creator:%s}}',
			'parameters' => [
				'artist',
				'author',
				'Author',
				'composer',
				'lyrics_writer',
				'performer',
				'photographer',
				'printer',
				'publisher'
			]
		]
	];

	/**
	 * @param DataAdapterInterface $DataAdapter
	 */
	public function __construct( DataAdapterInterface $DataAdapter ) {
		$this->_DataAdapater = $DataAdapter;
	}

	public function create( array $options = [] ) {
	}

	public function delete( array &$options = [] ) {
	}

	/**
	 * determines the MediaWiki template creator parameter
	 * evaluates whether or not the user has chosen to:
	 *
	 * - use the metadata value mapped to the institution parameter as is
	 * - or wrap the metadata value in an institution template
	 *
	 * @param string $content
	 * @param array $user_options
	 * @return string
	 */
	protected function getCreator( $content, array $user_options ) {
		$result = '';

		// assumes that there could be more than one creator in the string
		// and uses the configured metadata separator for evaluation
		$creators = explode( Config::$metadata_separator, $content );

		foreach ( $creators as $creator ) {
			// assumes that a creator entry could be last name, first
			if ( $user_options['gwtoolset-reverse-creator'] ) {
				$creator = explode( ',', $creator, 2 );
			} else {
				$creator = [ $creator ];
			}

			// handle empty string
			if ( count( $creator ) === 1 && trim( $creator[0] ) === '' ) {
				return $result;
			} else {
				// only consider the first 2 pieces of a reversed name
				// e.g. Motzart, Wolfgang Amadeus = Wolfgang Amadeus Motzart
				// e.g. Motzart, Wolfgang, Amadeus = Wolfgang Motzart
				if ( count( $creator ) === 2 ) {
					$creator = trim( $creator[1] ) . ' ' . trim( $creator[0] );
				} else {
					$creator = $creator[0];
				}

				if ( $user_options['gwtoolset-wrap-creator'] ) {
					$result .= sprintf(
						$this->_sub_templates['creator']['template'],
						$creator
					) . PHP_EOL;
				} else {
					$result .= $creator . PHP_EOL;
				}
			}
		}

		return $result;
	}

	/**
	 * creates wiki text for the GWToolset parameters
	 *
	 * @todo move this into a GWToolsetTemplate model
	 *
	 * @return string
	 * the result is sanitized
	 */
	public function getGWToolsetTemplateAsWikiText() {
		return '{{Uploaded with GWToolset' . PHP_EOL .
			' | gwtoolset-title = ' .
					Utils::sanitizeString(
						$this->mediawiki_template_array['gwtoolset-title']
					) . PHP_EOL .
			' | gwtoolset-url-to-the-media-file = ' .
					Utils::sanitizeString(
						$this->mediawiki_template_array['gwtoolset-url-to-the-media-file']
					) . PHP_EOL .
			'}}' .
			PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL;
	}

	/**
	 * determines the MediaWiki template institution parameter
	 * evaluates whether or not the user has chosen to:
	 *
	 * - use the metadata value mapped to the institution parameter as is
	 * - or wrap the metadata value in an institution template
	 *
	 * @param string $content
	 * @param array $user_options
	 * @return string
	 */
	protected function getInstitution( $content, array $user_options ) {
		if (
			trim( $content ) === ''
			|| !$user_options['gwtoolset-wrap-institution']
		) {
			return $content;
		}

		return sprintf( '{{Institution:%s}}', $content );
	}

	/**
	 * create an array that represents the mapping of mediawiki template attributes
	 * to metadata elements based on the given array.
	 *
	 * the array is expected to be in an array format for each mediawiki parameter
	 * e.g. accession_number[], artist[]
	 *
	 * @param array $array
	 * @throws MWException
	 *
	 * @return array
	 * the keys and values in the array are sanitized
	 */
	public function getMappingFromArray( array $array = [] ) {
		$result = [];
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
			$parameter_as_id = Utils::sanitizeString( Utils::normalizeSpace( $parameter ) );

			if ( isset( $array[$parameter_as_id] ) ) {
				foreach ( $array[$parameter_as_id] as $metadata_element ) {
					$result[$parameter_as_id][] = Utils::sanitizeString( $metadata_element );
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
	 * @return string
	 * the keys within the <option>s are filtered
	 */
	public function getModelKeysAsOptions() {
		$result = Html::rawElement( 'option', [ 'value' => '' ], ' ' );

		foreach ( $this->_DataAdapater->getKeys() as $option ) {
			$result .= Html::rawElement( 'option', [], Utils::sanitizeString( $option ) );
		}

		return $result;
	}

	/**
	 * determines the MediaWiki template permission parameter
	 * evaluates whether or not the user has chosen to:
	 *
	 * - use a free text global license
	 * - detect and create a license template based on a cc license URL
	 * - use the metadata value mapped to the permission parameter
	 *
	 * e.g. https://creativecommons.org/licenses/by-sa/3.0/ corresponds with
	 * the MediaWiki license template  {{Template:Cc-by-sa-3.0}}
	 *
	 * @see http://commons.wikimedia.org/wiki/Category:Creative_Commons_licenses
	 *
	 * @param string $content
	 * @param array $user_options
	 * @return string
	 */
	protected function getPermission( $content, array $user_options ) {
		if ( !empty( $user_options['gwtoolset-global-license'] ) ) {
			return $user_options['gwtoolset-global-license'];
		} elseif ( $user_options['gwtoolset-detect-license'] ) {
			$permission = strtolower( $content );
		} else {
			return $content;
		}

		if ( !strstr( $permission, 'creativecommons.org/' ) ) {
			return $content;
		}

		$licenses = [
			'/(http|https):\/\/(www\.|)creativecommons.org\/publicdomain\/mark\/1.0\//' =>
				'{{PD-US}}{{PD-old}}', // Public Domain Mark 1.0
			'/(http|https):\/\/(www\.|)creativecommons.org\/publicdomain\/zero\/1.0\//' =>
				'{{Cc-zero}}', // CC0 1.0 Universal (CC0 1.0) Public Domain Dedication
			'/(http|https):\/\/(www\.|)creativecommons.org\/licenses\//' =>
				'',
			'/deed\.*/' =>
				''
		];

		$permission = preg_replace(
			array_keys( $licenses ),
			array_values( $licenses ),
			$permission
		);

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

		return $permission;
	}

	/**
	 * determines the MediaWiki template source parameter
	 * evaluates whether or not the user has chosen to:
	 *
	 * - use a free text source template
	 *   adds the metadata value mapped to the source parameter
	 *   and adds the free text value
	 *   assumes that the free text value must be wrapped in {{}}
	 * - use the metadata value mapped to the source parameter
	 *
	 * @param string $content
	 * @param array $user_options
	 * @return string
	 */
	protected function getSource( $content, array $user_options ) {
		if ( !empty( $user_options['gwtoolset-partner-template-url'] ) ) {
			$partnerTemplateName = Utils::getTitle(
				$user_options['gwtoolset-partner-template-url'],
				NS_TEMPLATE,
				[ 'must-be-known' => false ]
			);

			return $content .
				'{{' .
				Utils::sanitizeString( $partnerTemplateName ) .
				'}}';
		} else {
			return $content;
		}
	}

	/**
	 * creates wiki text for a given mediawiki template.
	 * creates the mediawiki template section of the template.
	 * this does not include categories, raw metadata, or raw
	 * mapping information, which are added via other methods.
	 *
	 * @todo move the $parameter['gwtoolset-title']
	 * and $parameter['gwtoolset-url-to-the-media-file'] out of the
	 * $this->mediawiki_template_array and into their own
	 * gwtoolset_template_array
	 *
	 * @param array $user_options
	 * an array of user options that was submitted in the html form
	 *
	 * @return string
	 * the resulting wiki text is filtered
	 */
	public function getTemplateAsWikiText( array $user_options ) {
		$result = '';
		$sections = null;
		$template = '{{' . $this->mediawiki_template_name . PHP_EOL . '%s}}';

		foreach ( $this->mediawiki_template_array as $parameter => $content ) {
			if ( $parameter === 'gwtoolset-title'
				|| $parameter === 'gwtoolset-url-to-the-media-file'
			) {
				continue;
			}

			$sections .= ' | ' . Utils::sanitizeString( $parameter ) . ' = ';

			/**
			 * sometimes a metadata element has an XML attribute that the tools
			 * looks for in order to possibly place the metadata into a
			 * sub-template, e.g., <dc:description lang="en">
			 *
			 * currently the application only looks for XML elements with the
			 * attribute lang; those elements are placed into an associative array
			 * 'language' and are processed here. no other array grouping is
			 * currently created.
			 *
			 * this section is meant to handle this current scenario and any future
			 * scenarios of this type.
			 */
			if ( is_array( $content ) ) {
				foreach ( $content as $sub_template_name => $sub_template_content ) {
					if ( $sub_template_name === 'language' ) {
						foreach ( $sub_template_content as $language => $language_content ) {
							$sections .= sprintf(
								$this->_sub_templates['language'],
								Utils::sanitizeString( $language ),
								Utils::sanitizeString( $language_content )
							) . PHP_EOL;
						}

					// sometimes there is more than one metadata element with the same
					// element name that falls into this sub-templating scenario; one
					// has an XML attribute the tool looks for, and another does not.
					// when one of those "shared" elements does not have the XML
					// attribute the tool is looking for, it falls into this section and
					// is not wrapped in a sub-template.
					} else {
						$sections .= Utils::sanitizeString( $sub_template_content ) . PHP_EOL;
					}
				}
			} else {
				// institution parameter
				if ( $parameter === 'institution' ) {
					$institution = $this->getInstitution( $content, $user_options );
					$sections .= Utils::sanitizeString( $institution ) . PHP_EOL;

				// creator parameter
				} elseif (
					in_array(
						$parameter,
						$this->_sub_templates['creator']['parameters']
					)
				) {
					$creator = $this->getCreator( $content, $user_options );
					$sections .= Utils::sanitizeString( $creator );

				// permission parameter
				} elseif ( $parameter === 'permission' ) {
					$permission = $this->getPermission( $content, $user_options );
					$sections .= Utils::sanitizeString( $permission ) . PHP_EOL;

				// source parameter
				} elseif ( $parameter === 'source' ) {
					$source = $this->getSource( $content, $user_options );
					$sections .= Utils::sanitizeString( $source ) . PHP_EOL;

				// all other parameters
				} else {
					$sections .= Utils::sanitizeString( $content ) . PHP_EOL;
				}
			}
		}

		$result .= sprintf( $template, $sections );
		$result .= PHP_EOL . PHP_EOL;

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
	 * @param string|null $name
	 * an html form name that should be given to the select.
	 * the param is filtered.
	 *
	 * @param string|null $id
	 * an html form id that should be given to the select.
	 * the param is filtered.
	 *
	 * @return string
	 * the select values within the <option>s are filtered
	 */
	public function getTemplatesAsSelect( $name = null, $id = null ) {
		$result = null;
		$attribs = [];

		if ( !empty( $name ) ) {
			$attribs['name'] = Utils::sanitizeString( $name );
		}

		if ( !empty( $id ) ) {
			$attribs['id'] = Utils::sanitizeString( $id );
		}

		$result =
			Html::openElement( 'select', $attribs ) .
			$this->getModelKeysAsOptions() .
			Html::closeElement( 'select' );

		return $result;
	}

	/**
	 * creates a title string that will be used to create a wiki title
	 * for a media file. the title string is evaluated using PHP’s strlen()
	 * function, which evaluates the number of bytes in a string. the
	 * title string is based on :
	 *
	 *   - gwtoolset title
	 *   - url to the media file’s extension
	 *
	 * the title length is limited to Config::$title_max_length
	 * @see https://commons.wikimedia.org/wiki/Commons:File_naming
	 *
	 * @param array $options
	 * @throws GWTException
	 *
	 * @return string
	 * the string is not sanitized
	 */
	public function getTitle( array $options ) {
		if (
			empty( $this->mediawiki_template_array['gwtoolset-title'] )
		) {
			throw new GWTException( 'gwtoolset-mapping-no-gwtoolset-title' );
		}

		if ( empty( $options['evaluated-media-file-extension'] ) ) {
			throw new GWTException( 'gwtoolset-no-extension' );
		}

		$result =
			$this->mediawiki_template_array['gwtoolset-title'] .
			'.' .
			$options['evaluated-media-file-extension'];

		$result_length = strlen( $result );

		if ( $result_length > Config::$title_max_length ) {
			throw new GWTException(
				[ 'gwtoolset-title-too-long' => [ $result_length, $result ] ]
			);
		}

		return $result;
	}

	/**
	 * a control method that retrieves a mediawiki template model using the data adapter
	 * provided at class instantiation and populates this model class with the result
	 *
	 * @param string|null $mediawiki_template_name
	 * @throws GWTException|MWException
	 */
	public function getMediaWikiTemplate( $mediawiki_template_name = null ) {
		if ( empty( $mediawiki_template_name ) ) {
			throw new MWException(
				wfMessage( 'gwtoolset-developer-issue' )
					->params( wfMessage( 'gwtoolset-no-mediawiki-template' )->parse() )
					->parse()
				);
		}

		$this->mediawiki_template_name = $mediawiki_template_name;
		$this->retrieve();
	}

	/**
	 * populate $this->mediawiki_template_array keys with matching values
	 * found in the provided metadata
	 *
	 * @param array $metadata
	 */
	public function populateFromArray( array $metadata = [] ) {
		foreach ( $this->mediawiki_template_array as $parameter => $value ) {
			$this->mediawiki_template_array[$parameter] = null;
			$parameter_as_id = Utils::normalizeSpace( $parameter );

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
	 * @param array &$options
	 * @throws GWTException
	 */
	public function retrieve( array &$options = [] ) {
		$result = $this->_DataAdapater->retrieve(
			[ 'mediawiki_template_name' => $this->mediawiki_template_name ]
		);

		if ( empty( $result ) ) {
			throw new GWTException(
				[
					'gwtoolset-mediawiki-template-not-found' =>
					[ $this->mediawiki_template_name ]
				]
			);
		}

		$this->mediawiki_template_json = $result['mediawiki_template_json'];
		$this->mediawiki_template_array = json_decode( $this->mediawiki_template_json, true );

		// add aditional mediawiki template fields that the extension needs
		$this->mediawiki_template_array['gwtoolset-title'] = null;
		$this->mediawiki_template_array['gwtoolset-url-to-the-media-file'] = null;
	}

	public function update( array &$options = [] ) {
	}
}
