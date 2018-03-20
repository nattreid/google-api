<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi\ECommerce;

use InvalidArgumentException;
use Nette\SmartObject;

/**
 * Class Transaction
 *
 * @property string $id
 * @property string|null $affiliation
 * @property string|null $currency
 * @property float|null $value
 * @property float|null $shipping
 * @property float|null $tax
 * @property Item[] $items
 *
 * @author Attreid <attreid@gmail.com>
 */
class Transaction
{

	use SmartObject;

	/** @var string */
	private $id;

	/** @var string|null */
	private $affiliation;

	/** @var string|null */
	private $currency;

	/** @var float|null */
	private $value;

	/** @var float|null */
	private $shipping;

	/** @var float|null */
	private $tax;

	/** @var Item[] */
	private $items = [];

	/**
	 * @return string|null
	 */
	protected function getAffiliation(): ?string
	{
		return $this->affiliation;
	}

	/**
	 * Affiliation or store name
	 * @param string $affiliation
	 */
	protected function setAffiliation(string $affiliation): void
	{
		$this->affiliation = $affiliation;
	}

	protected function getCurrency(): ?string
	{
		return $this->currency;
	}

	protected function setCurrency(?string $currency): void
	{
		$this->currency = $currency;
	}

	protected function getValue(): ?float
	{
		return $this->value;
	}

	protected function setValue(?float $value): void
	{
		$this->value = $value;
	}

	/**
	 * @return float|null
	 */
	protected function getShipping(): ?float
	{
		return $this->shipping;
	}

	/**
	 * Shipping
	 * @param float $shipping
	 */
	protected function setShipping(float $shipping): void
	{
		$this->shipping = $shipping;
	}

	/**
	 * @return float|null
	 */
	protected function getTax(): ?float
	{
		return $this->tax;
	}

	/**
	 * Tax
	 * @param float $tax
	 */
	protected function setTax(float $tax): void
	{
		$this->tax = $tax;
	}

	/**
	 * @return string
	 */
	protected function getId(): string
	{
		if (empty($this->id)) {
			throw new InvalidArgumentException('Transaction id must be set');
		}
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	protected function setId(string $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return Item[]
	 */
	protected function getItems(): array
	{
		return $this->items;
	}

	/**
	 * @param Item $item
	 */
	public function addItem(Item $item): void
	{
		$this->items[] = $item;
	}
}