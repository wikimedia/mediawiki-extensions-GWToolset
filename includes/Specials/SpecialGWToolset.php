<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;
use GWToolset\Constants,
	GWToolset\GWTException,
	GWToolset\Utils,
	GWToolset\Handlers\Forms\FormHandler,
	GWToolset\Helpers\FileChecks,
	GWToolset\Helpers\WikiChecks,
	Html,
	Linker,
	MWException,
	PermissionsError,
	SpecialPage,
	Title;

class SpecialGWToolset extends SpecialPage {

	/**
	 * @var {string}
	 */
	public $module_key;

	/**
	 * @var {GWToolset\Handlers\Forms\FormHandler}
	 */
	protected $_Handler;

	/**
	 * @var {array}
	 */
	protected $_registered_modules = array(
		'metadata-detect' => array(
			'allow-get' => true,
			'handler' => '\GWToolset\Handlers\Forms\MetadataDetectHandler',
			'form' => '\GWToolset\Forms\MetadataDetectForm'
		),
		'metadata-mapping' => array(
			'allow-get' => false,
			'handler' => '\GWToolset\Handlers\Forms\MetadataMappingHandler',
			'form' => '\GWToolset\Forms\MetadataMappingForm'
		),
		'metadata-preview' => array(
			'allow-get' => false,
			'handler' => '\GWToolset\Handlers\Forms\MetadataMappingHandler',
			'form' => '\GWToolset\Forms\MetadataMappingForm'
		)
	);

	public function __construct() {
		parent::__construct(
			Constants::EXTENSION_NAME,
			Config::$special_page_restriction,
			Config::$special_page_listed
		);
	}

	/**
	 * entry point
	 * a control method that acts as an entry point for the SpecialPage
	 */
	public function execute( $par ) {
		$this->setHeaders();
		$this->outputHeader();

		if ( $this->wikiChecks() ) {
			$this->setModuleAndHandler();
			$this->processRequest();
		}
	}

	/**
	 * @return {string}
	 */
	public function getBackToFormLink() {
		return Html::rawElement(
			'span',
			array( 'id' => 'back-text' ),
			Html::rawElement(
				'noscript',
				array(),
				wfMessage( 'gwtoolset-back-text' )->escaped() . ' '
			)
		);
	}

	/**
	 * @return {array}
	 */
	public function getRegisteredModules() {
		return $this->_registered_modules;
	}

	/**
	 * a control method that processes a SpecialPage request
	 * SpecialPage->getOutput()->addHtml() present the end result of the request
	 *
	 * @throws {GWTException|MWException|PermissionsError}
	 */
	protected function processRequest() {
		$html = null;

		if ( !$this->getRequest()->wasPosted() ) {
			if ( $this->module_key === null
				|| !$this->_registered_modules[$this->module_key]['allow-get']
			) {
				$html .= wfMessage( 'gwtoolset-intro' )->parseAsBlock();
			} else {
				try {
					$html .= $this->_Handler->getHtmlForm( $this->module_key );
				} catch ( GWTException $e ) {
					$html .=
						Html::rawElement(
							'h2', array(),
							wfMessage( 'gwtoolset-technical-error' )->escaped()
						) .
						Html::rawElement( 'p', array( 'class' => 'error' ), $e->getMessage() );
				}
			}
		} else {
			try {
				FileChecks::checkContentLength();
				$html .= $this->_Handler->execute();
			} catch ( GWTException $e ) {
				$html .=
					Html::rawElement(
						'h2', array(),
						wfMessage( 'gwtoolset-file-interpretation-error' )->escaped()
					) .
					Html::rawElement( 'p', array( 'class' => 'error' ), $e->getMessage() );
			}
		}

		$this->getOutput()->addModules( 'ext.GWToolset' );
		$this->getOutput()->addHtml(
			wfMessage( 'gwtoolset-menu' )->rawParams(
				Linker::link(
					Title::newFromText( 'Special:' . Constants::EXTENSION_NAME ),
					wfMessage( 'gwtoolset-menu-1' )->escaped(),
					array(),
					array( 'gwtoolset-form' => 'metadata-detect' )
				)
			)->parse()
		);
		$this->getOutput()->addHtml( $html );
	}

	/**
	 * @throws {MWException}
	 */
	protected function setModuleAndHandler() {
		$this->module_key = null;
		$gwtoolset_form = $this->getRequest()->getVal( 'gwtoolset-form' );

		if ( key_exists( $gwtoolset_form, $this->_registered_modules ) ) {
			$this->module_key = $gwtoolset_form;
		}

		if ( $this->module_key !== null ) {
			$handler = $this->_registered_modules[$this->module_key]['handler'];
			$this->_Handler = new $handler( array( 'SpecialPage' => $this ) );

			if ( !( $this->_Handler instanceof FormHandler ) ) {
				$msg = wfMessage( 'gwtoolset-developer-issue' )
				->params(
					__METHOD__ . ': ' .
					wfMessage( 'gwtoolset-incorrect-form-handler' )
					->params( $this->module_key )
					->escaped()
				)
				->escaped();

				throw new MWException( $msg );
			}
		} else if ( $this->getRequest()->wasPosted() ) {
			// a posted form must have a registered module key
			$msg = wfMessage( 'gwtoolset-developer-issue' )
				->params(
					__METHOD__ . ': ' .
					wfMessage( 'gwtoolset-no-form-handler' )->escaped()
				)
				->escaped();

				throw new MWException( $msg );
		}
	}

	/**
	 * @return {bool}
	 */
	protected function wikiChecks() {
		$Status = WikiChecks::pageIsReadyForThisUser( $this );

		if ( !$Status->ok ) {
			$this->getOutput()->addHTML(
				Html::rawElement(
					'h2',
					array(),
					wfMessage( 'gwtoolset-wiki-checks-not-passed' )->escaped()
				) .
				Html::rawElement(
					'span',
					array( 'class' => 'error' ),
					$Status->getMessage()
				)
			);
			return false;
		}

		return true;
	}
}
