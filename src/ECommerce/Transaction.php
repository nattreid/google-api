<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi\ECommerce;

use InvalidArgumentException;
use Nette\SmartObject;

/**
 * Class Transaction
 *
 * @property int $id
 * @property string $affiliation
 * @property float $revenue
 * @property float $shipping
 * @property float $tax
 * @property Item[] $items
 *
 * @author Attreid <attreid@gmail.com>
 */
class Transaction
{

	use SmartObject;

	/** @var int */
	private $id;

	/** @var string */
	private $affiliation;

	/** @var float */
	private $revenue;

	/** @var float */
	private $shipping;

	/** @var float */
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

	/**
	 * @return float|null
	 */
	protected function getRevenue(): ?float
	{
		return $this->revenue;
	}

	/**
	 * Grand total
	 * @param float $revenue
	 */
	protected function setRevenue(float $revenue): void
	{
		$this->revenue = $revenue;
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
	 * @return int
	 */
	protected function getId(): int
	{
		if (empty($this->id)) {
			throw new InvalidArgumentException('Transaction id must be set');
		}
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	protected function setId(int $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return Item[]
	 */
	public function getItems(): array
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