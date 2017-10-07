<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GNU General Public License 3.0 http://www.gnu.org/licenses/gpl.html
 */

namespace GWToolset;

use GWToolset\Handlers\Forms\FormHandler;
use GWToolset\Helpers\FileChecks;
use GWToolset\Helpers\WikiChecks;
use Html;
use MWException;
use SpecialPage;
use Title;

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
	protected $_registered_modules = [
		'metadata-detect' => [
			'allow-get' => true,
			'handler' => '\GWToolset\Handlers\Forms\MetadataDetectHandler',
			'form' => '\GWToolset\Forms\MetadataDetectForm'
		],
		'metadata-mapping' => [
			'allow-get' => false,
			'handler' => '\GWToolset\Handlers\Forms\MetadataMappingHandler',
			'form' => '\GWToolset\Forms\MetadataMappingForm'
		],
		'metadata-preview' => [
			'allow-get' => false,
			'handler' => '\GWToolset\Handlers\Forms\MetadataMappingHandler',
			'form' => '\GWToolset\Forms\MetadataMappingForm'
		]
	];

	public function __construct() {
		parent::__construct(
			Constants::EXTENSION_NAME,
			'gwtoolset'
		);
	}

	public function doesWrites() {
		return true;
	}

	/**
	 * entry point
	 * a control method that acts as an entry point for the SpecialPage
	 * @param string|null $par
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
			[ 'id' => 'back-text' ],
			Html::rawElement(
				'noscript',
				[],
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
	 */
	protected function processRequest() {
		$html = '';

		if ( !$this->getRequest()->wasPosted() ) {
			try {
				$html .= $this->_Handler->getHtmlForm( $this->module_key );
			} catch ( GWTException $e ) {
				$html .=
					Html::rawElement(
						'h2', [],
						wfMessage( 'gwtoolset-technical-error' )->escaped()
					) .
					Html::rawElement( 'p', [ 'class' => 'error' ], $e->getMessage() );
			}
		} else {
			try {
				FileChecks::checkMaxPostSize();
				$html .= $this->_Handler->execute();
			} catch ( GWTException $e ) {
				$html .=
					Html::rawElement(
						'h2', [],
						wfMessage( 'gwtoolset-file-interpretation-error' )->escaped()
					) .
					Html::rawElement( 'p', [ 'class' => 'error' ], $e->getMessage() );
			}
		}

		$this->getOutput()->addModules( 'ext.GWToolset' );

		$this->getOutput()->addHtml(
			wfMessage( 'gwtoolset-menu' )->rawParams(
				$this->getLinkRenderer()->makeLink(
					Title::newFromText( 'Special:' . Constants::EXTENSION_NAME ),
					wfMessage( 'gwtoolset-menu-1' )->text(),
					[]
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

		$gwtoolset_form =
			$this->getRequest()->getVal( 'gwtoolset-form' )
			? $this->getRequest()->getVal( 'gwtoolset-form' )
			: 'metadata-detect';

		if ( array_key_exists( $gwtoolset_form, $this->_registered_modules ) ) {
			$this->module_key = $gwtoolset_form;
		}

		if ( $this->module_key !== null ) {
			$handler = $this->_registered_modules[$this->module_key]['handler'];
			$this->_Handler = new $handler( [ 'SpecialPage' => $this ] );

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
		} elseif ( $this->getRequest()->wasPosted() ) {
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
					[],
					wfMessage( 'gwtoolset-wiki-checks-not-passed' )->escaped()
				) .
				Html::rawElement(
					'span',
					[ 'class' => 'error' ],
					$Status->getMessage()
				)
			);
			return false;
		}

		return true;
	}

	protected function getGroupName() {
		return 'media';
	}
}
