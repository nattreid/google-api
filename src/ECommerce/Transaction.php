<?php

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
	protected function getAffiliation()
	{
		return $this->affiliation;
	}

	/**
	 * Affiliation or store name
	 * @param string $affiliation
	 */
	protected function setAffiliation($affiliation)
	{
		$this->affiliation = (string)$affiliation;
	}

	/**
	 * @return mixed
	 */
	protected function getRevenue()
	{
		return $this->revenue ?: '';
	}

	/**
	 * Grand total
	 * @param float $revenue
	 */
	protected function setRevenue($revenue)
	{
		$this->revenue = floatval($revenue);
	}

	/**
	 * @return float
	 */
	protected function getShipping()
	{
		return $this->shipping ?: '';
	}

	/**
	 * Shipping
	 * @param float $shipping
	 */
	protected function setShipping($shipping)
	{
		$this->shipping = floatval($shipping);
	}

	/**
	 * @return float
	 */
	protected function getTax()
	{
		return $this->tax ?: '';
	}

	/**
	 * Tax
	 * @param float $tax
	 */
	protected function setTax($tax)
	{
		$this->tax = floatval($tax);
	}

	/**
	 * @return int
	 */
	protected function getId()
	{
		if (empty($this->id)) {
			throw new InvalidArgumentException('Transaction id must be set');
		}
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	protected function setId($id)
	{
		$this->id = intval($id);
	}

	/**
	 * @return Item[]
	 */
	public function getItems()
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