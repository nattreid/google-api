<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi;

use NAttreid\GoogleApi\ECommerce\Transaction;
use NAttreid\GoogleApi\Hooks\GoogleApiConfig;
use Nette\Application\UI\Control;
use Nette\Utils\ArrayHash;

/**
 * Class GoogleApiClient
 *
 * @author Attreid <attreid@gmail.com>
 */
class GoogleApi extends Control
{

	/** @var GoogleApiConfig */
	private $config;

	public function __construct(GoogleApiConfig $config)
	{
		parent::__construct();
		$this->config = $config;
	}

	/**
	 * Conversion event (adwords)
	 * @param float $value
	 * @param string $currency
	 */
	public function conversion(float $value = null, string $currency = null): void
	{
		$conversion = new ArrayHash;
		if ($value !== null) {
			$conversion->price = floatval($value);
		}
		if ($currency !== null) {
			$conversion->currency = $currency;
		}

		$this->template->conversion = $conversion;
	}

	/**
	 * Ecommerce remarketing
	 * @param int|null $id
	 * @param float|null $value
	 * @param string|null $type home, searchresults, category, product, cart, purchase, other
	 */
	public function remarketingEcomm(int $id = null, float $value = null, string $type = null): void
	{
		$data = new ArrayHash;
		if ($id !== null) {
			$data->ecomm_prodid = $id;
		}
		if ($value !== null) {
			$data->ecomm_totalvalue = $value;
		}
		if ($type !== null) {
			$data->ecomm_pagetype = $type;
		}
		$this->template->remarketing = $data;
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
		$this->template->adWordsConversionId = $this->config->adWordsConversionId;
		$this->template->adWordsConversionLabel = $this->config->adWordsConversionLabel;
		$this->template->gaClientId = $this->config->gaClientId;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}

	public function renderHead(): void
	{
		$this->template->authenticationKeys = [
			$this->config->webMasterKey,
			$this->config->merchantKey
		];
		$this->template->setFile(__DIR__ . '/templates/head.latte');
		$this->template->render();
	}

	public function renderAdWords(): void
	{
		$this->template->setFile(__DIR__ . '/templates/adWords.latte');
		$this->template->render();
	}
}

interface IGoogleApiFactory
{
	public function create(): GoogleApi;
}