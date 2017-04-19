<?php

declare(strict_types=1);

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

	public function __construct(string $gaClientId, string $adWordsConversionId, string $adWordsConversionLabel, array $authenticationKeys)
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
	public function conversion(float $value = null, string $currency = null): void
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
	public function transaction(Transaction $transaction): void
	{
		$this->template->transaction = $transaction;
	}

	public function render(): void
	{
		$this->template->gaClientId = $this->gaClientId;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}

	public function renderHead(): void
	{
		$this->template->authenticationKeys = $this->authenticationKeys;
		$this->template->setFile(__DIR__ . '/templates/head.latte');
		$this->template->render();
	}

	public function renderAdWords(): void
	{
		$this->template->adWordsConversionId = $this->adWordsConversionId;
		$this->template->adWordsConversionLabel = $this->adWordsConversionLabel;
		$this->template->setFile(__DIR__ . '/templates/adWords.latte');
		$this->template->render();
	}
}

interface IGoogleApiFactory
{
	public function create(): GoogleApi;
}