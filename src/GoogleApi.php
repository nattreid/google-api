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
 * @property string|null $gaClientId Id google analytics
 * @property int|null $adWordsConversionId adWords conversion id
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

	protected function getGaClientId(): ?string
	{
		return $this->config->gaClientId;
	}

	protected function getAdWordsConversionId(): ?int
	{
		return $this->config->adWordsConversionId;
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
	 * @param string|null $type home, searchresults, category, product, cart, purchase, other
	 * @param float|null $value
	 * @param int|null $id
	 */
	public function remarketingEcomm(string $type = null, float $value = null, int $id = null): void
	{
		$data = new ArrayHash;
		if ($type !== null) {
			$data->ecomm_pagetype = $type;
		}
		if ($value !== null) {
			$data->ecomm_totalvalue = $value;
		}
		if ($id !== null) {
			$data->ecomm_prodid = $id;
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