<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi;

use NAttreid\GoogleApi\ECommerce\Transaction;
use NAttreid\GoogleApi\Hooks\GoogleApiConfig;
use Nette\Application\UI\Control;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;

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

	/** @var array */
	private $events = [];

	/** @var ArrayHash|null */
	private $data;

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

	private function data(string $name, $value): void
	{
		if ($this->data === null) {
			$this->data = new ArrayHash;
		}
		$this->data->$name = $value;
	}

	private function event(string $name, string $sendTo, ArrayHash $data): void
	{
		$data->send_to = $sendTo;
		$obj = new ArrayHash;
		$obj->name = $name;
		$obj->data = Json::encode($data);
		$this->events[] = $obj;
		$this->redrawControl('event');
	}

	/**
	 * Send PageView
	 * @param string $path
	 * @param string|null $title
	 */
	public function pageView(string $path, string $title = null): void
	{
		$this->data('page_path', $path);
		if ($title !== null) {
			$this->data('page_title', $title);
		}
		$this->redrawControl('init');
	}

	/**
	 * Conversion event (adwords)
	 * @param float|null $value
	 * @param string|null $currency
	 * @param int|null $transactionId
	 */
	public function conversion(float $value = null, string $currency = null, int $transactionId = null): void
	{
		if ($this->config->adWordsConversionId) {
			$data = new ArrayHash;
			$data->value = $value;
			$data->currency = $currency;
			$data->transaction_id = $transactionId ?? '';

			$this->event('conversion',
				'AW-' . $this->config->adWordsConversionId . '/' . $this->config->adWordsConversionLabel,
				$data);
		}
	}

	/**
	 * Ecommerce remarketing
	 * @param string|null $type home, searchresults, category, product, cart, purchase, other
	 * @param float|null $value
	 * @param int|null $id
	 */
	public function remarketingEcomm(string $type = null, float $value = null, int $id = null): void
	{
		if ($this->config->adWordsConversionId) {
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

			$this->event('page_view', 'AW-' . $this->config->adWordsConversionId, $data);
		}
	}

	/**
	 * Transaction event (ecommerce)
	 * @param Transaction $transaction
	 */
	public function transaction(Transaction $transaction): void
	{
		if ($this->config->gaClientId) {
			$data = new ArrayHash;
			$data->transaction_id = $transaction->id;
			if ($transaction->affiliation !== null) {
				$data->affiliation = $transaction->affiliation;
			}
			if ($transaction->value !== null) {
				$data->value = $transaction->value;
			}
			if ($transaction->currency !== null) {
				$data->currency = $transaction->currency;
			}
			if ($transaction->tax !== null) {
				$data->tax = $transaction->tax;
			}
			if ($transaction->shipping !== null) {
				$data->shipping = $transaction->shipping;
			}
			$data->items = [];
			foreach ($transaction->items as $item) {
				$itemData = new ArrayHash;
				$itemData->id = $item->id;
				$itemData->name = $item->name;
				if ($item->category !== null) {
					$itemData->category = $item->category;
				}
				if ($item->quantity !== null) {
					$itemData->quantity = $item->quantity;
				}
				if ($item->price !== null) {
					$itemData->price = $item->price;
				}
				$data->items[] = $itemData;
			}

			$this->event('purchase',
				$this->config->gaClientId,
				$data);
		}
	}

	private function getAdwordsID(): ?string
	{
		$id = $this->config->adWordsConversionId;
		if ($id) {
			$id = 'AW-' . $id;
		}
		return $id;
	}

	public function renderEvent(): void
	{
		$this->template->adWordsConversionId = $this->getAdwordsID();
		$this->template->adWordsConversionLabel = $this->config->adWordsConversionLabel;
		$this->template->gaClientId = $this->config->gaClientId;

		$this->template->view = (bool) ($this->config->gaClientId ?: $this->config->adWordsConversionId);

		$this->template->events = $this->events;

		if($this->config->anonymize){
			$this->data('anonymize_ip', true);
		}

		$this->template->setFile(__DIR__ . '/templates/event.latte');
		$this->template->render();
	}

	public function render(): void
	{
		$id = $this->config->gaClientId;
		if (!$id) {
			$id = $this->getAdwordsID();
		}
		$this->template->id = $id;
		$this->template->data = $this->data;

		$this->template->authenticationKeys = [
			$this->config->webMasterKey,
			$this->config->merchantKey
		];
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}
}

interface IGoogleApiFactory
{
	public function create(): GoogleApi;
}