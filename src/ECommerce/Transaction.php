<?php

declare(strict_types = 1);

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
	 * @return string
	 */
	protected function getAffiliation(): string
	{
		return $this->affiliation;
	}

	/**
	 * Affiliation or store name
	 * @param string $affiliation
	 */
	protected function setAffiliation(string $affiliation)
	{
		$this->affiliation = $affiliation;
	}

	/**
	 * @return float|''
	 */
	protected function getRevenue()
	{
		return $this->revenue ?: '';
	}

	/**
	 * Grand total
	 * @param float $revenue
	 */
	protected function setRevenue(float $revenue)
	{
		$this->revenue = $revenue;
	}

	/**
	 * @return float|''
	 */
	protected function getShipping()
	{
		return $this->shipping ?: '';
	}

	/**
	 * Shipping
	 * @param float $shipping
	 */
	protected function setShipping(float $shipping)
	{
		$this->shipping = $shipping;
	}

	/**
	 * @return float|''
	 */
	protected function getTax()
	{
		return $this->tax ?: '';
	}

	/**
	 * Tax
	 * @param float $tax
	 */
	protected function setTax(float $tax)
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
	protected function setId(int $id)
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
	public function addItem(Item $item)
	{
		$this->items[] = $item;
	}
}