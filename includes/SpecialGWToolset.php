<?php
/**
 * GWToolset
 *
 * @file
 * @ingroup Extensions
 * @license GPL-3.0-or-later
 */

namespace GWToolset;

use GWToolset\Forms\MetadataDetectForm;
use GWToolset\Forms\MetadataMappingForm;
use GWToolset\Handlers\Forms\FormHandler;
use GWToolset\Handlers\Forms\MetadataDetectHandler;
use GWToolset\Handlers\Forms\MetadataMappingHandler;
use GWToolset\Helpers\FileChecks;
use GWToolset\Helpers\WikiChecks;
use Html;
use MediaWiki\MediaWikiServices;
use MWException;
use SpecialPage;
use Title;

class SpecialGWToolset extends SpecialPage {

	/**
	 * @var string|null
	 */
	public $module_key;

	/**
	 * @var FormHandler
	 */
	protected $_Handler;

	/**
	 * @var array[]
	 */
	protected $_registered_modules = [
		'metadata-detect' => [
			'allow-get' => true,
			'handler' => MetadataDetectHandler::class,
			'form' => MetadataDetectForm::class,
		],
		'metadata-mapping' => [
			'allow-get' => false,
			'handler' => MetadataMappingHandler::class,
			'form' => MetadataMappingForm::class,
		],
		'metadata-preview' => [
			'allow-get' => false,
			'handler' => MetadataMappingHandler::class,
			'form' => MetadataMappingForm::class,
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

		$this->checkReadOnly();

		if ( $this->wikiChecks() ) {
			$this->setModuleAndHandler();
			$this->processRequest();
		}
	}

	/**
	 * @return string
	 */
	public function getBackToFormLink() {
		return Html::rawElement(
			'span',
			[ 'id' => 'back-text' ],
			Html::rawElement(
				'noscript',
				[],
				$this->msg( 'gwtoolset-back-text' )->escaped() . ' '
			)
		);
	}

	/**
	 * @return array[]
	 */
	public function getRegisteredModules() {
		return $this->_registered_modules;
	}

	/**
	 * a control method that processes a SpecialPage request
	 * SpecialPage->getOutput()->addHtml() present the end result of the request
	 * @suppress SecurityCheck-XSS Can't handle FormHandler::getHtmlForm()
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
						$this->msg( 'gwtoolset-technical-error' )->escaped()
					) .
					Html::element( 'p', [ 'class' => 'error' ], $e->getMessage() );
			}
		} else {
			try {
				FileChecks::checkMaxPostSize();
				$html .= $this->_Handler->execute();
			} catch ( GWTException $e ) {
				$html .=
					Html::rawElement(
						'h2', [],
						$this->msg( 'gwtoolset-file-interpretation-error' )->escaped()
					) .
					Html::element( 'p', [ 'class' => 'error' ], $e->getMessage() );
			}
		}

		$this->getOutput()->addModules( 'ext.GWToolset' );

		$this->getOutput()->addHTML(
			$this->msg( 'gwtoolset-menu' )->rawParams(
				$this->getLinkRenderer()->makeLink(
					Title::newFromText( 'Special:' . Constants::EXTENSION_NAME ),
					$this->msg( 'gwtoolset-menu-1' )->text(),
					[]
				)
			)->parse()
		);

		$this->getOutput()->addHTML( $html );
	}

	/**
	 * @throws MWException
	 */
	protected function setModuleAndHandler() {
		$this->module_key = null;

		$gwtoolset_form = $this->getRequest()->getVal( 'gwtoolset-form' ) ?: 'metadata-detect';

		if ( array_key_exists( $gwtoolset_form, $this->_registered_modules ) ) {
			$this->module_key = $gwtoolset_form;
		}

		if ( $this->module_key !== null ) {
			$handler = $this->_registered_modules[$this->module_key]['handler'];
			$this->_Handler = new $handler( [
				'SpecialPage' => $this,
				'HttpRequestFactory' => MediaWikiServices::getInstance()->getHttpRequestFactory()
			] );

			if ( !( $this->_Handler instanceof FormHandler ) ) {
				$msg = $this->msg( 'gwtoolset-developer-issue' )
				->params(
					__METHOD__ . ': ' .
					$this->msg( 'gwtoolset-incorrect-form-handler' )
						->params( $this->module_key )
						->escaped()
				)
				->escaped();

				throw new MWException( $msg );
			}
		} elseif ( $this->getRequest()->wasPosted() ) {
			// a posted form must have a registered module key
			$msg = $this->msg( 'gwtoolset-developer-issue' )
				->params(
					__METHOD__ . ': ' .
					$this->msg( 'gwtoolset-no-form-handler' )->escaped()
				)
				->escaped();

				throw new MWException( $msg );
		}
	}

	/**
	 * @return bool
	 */
	protected function wikiChecks() {
		$status = WikiChecks::pageIsReadyForThisUser( $this );

		if ( !$status->isOK() ) {
			$this->getOutput()->addHTML(
				Html::rawElement(
					'h2',
					[],
					$this->msg( 'gwtoolset-wiki-checks-not-passed' )->escaped()
				) .
				Html::rawElement(
					'span',
					[ 'class' => 'error' ],
					$status->getMessage()->parse()
				)
			);
			return false;
		}

		return true;
	}

	/** @inheritDoc */
	protected function getGroupName() {
		return 'media';
	}
}
