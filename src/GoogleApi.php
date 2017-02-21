<?php

namespace NAttreid\GoogleApi;

use NAttreid\GoogleApi\ECommerce\Transaction;
use Nette\Application\UI\Control;

/**
 * Class GoogleApiClient
 *
 * @author Attreid <attreid@gmail.com>
 */
class GoogleApi extends Control
{

	/** @var string */
	private $gaClientId;

	/** @var string[] */
	private $authenticationKeys;

	/** @var string */
	private $adWordsConversionId;

	/** @var string */
	private $adWordsConversionLabel;

	public function __construct($gaClientId, $adWordsConversionId, $adWordsConversionLabel, array $authenticationKeys)
	{
		parent::__construct();
		$this->gaClientId = $gaClientId;
		$this->adWordsConversionId = $adWordsConversionId;
		$this->adWordsConversionLabel = $adWordsConversionLabel;
		$this->authenticationKeys = $authenticationKeys;
	}

	/**
	 * Conversion event (adwords)
	 * @param float $value
	 * @param string $currency
	 */
	public function conversion($value = null, $currency = null)
	{
		if ($value !== null) {
			$this->template->price = floatval($value);
		}
		if ($currency !== null) {
			$this->template->currency = $currency;
		}
	}

	/**
	 * Transaction event (ecommerce)
	 * @param Transaction $transaction
	 */
	public function transaction(Transaction $transaction)
	{
		$this->template->transaction = $transaction;
	}

	public function render()
	{
		$this->template->gaClientId = $this->gaClientId;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}

	public function renderHead()
	{
		$this->template->authenticationKeys = $this->authenticationKeys;
		$this->template->setFile(__DIR__ . '/templates/head.latte');
		$this->template->render();
	}

	public function renderAdWords()
	{
		$this->template->adWordsConversionId = $this->adWordsConversionId;
		$this->template->adWordsConversionLabel = $this->adWordsConversionLabel;
		$this->template->setFile(__DIR__ . '/templates/adWords.latte');
		$this->template->render();
	}
}

interface IGoogleApiFactory
{
	/** @return GoogleApi */
	public function create();
}