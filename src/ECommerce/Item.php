<?php

namespace NAttreid\GoogleApi\ECommerce;

use InvalidArgumentException;
use Nette\SmartObject;

/**
 * Class Item
 *
 * @property string $name
 * @property string $sku
 * @property string $category
 * @property float $price
 * @property int $quantity
 *
 * @author Attreid <attreid@gmail.com>
 */
class Item
{

	use SmartObject;

	private $name;
	private $sku;
	private $category;
	private $price;
	private $quantity;

	/**
	 * @return string
	 */
	protected function getName()
	{
		if (empty($this->name)) {
			throw new InvalidArgumentException('Item name must be set');
		}
		return $this->name;
	}

	/**
	 * Product name
	 * @param string $name
	 */
	protected function setName($name)
	{
		$this->name = (string)$name;
	}

	/**
	 * @return string
	 */
	protected function getSku()
	{
		return $this->sku ?: '';
	}

	/**
	 * SKU/code
	 * @param string $sku
	 */
	protected function setSku($sku)
	{
		$this->sku = (string)$sku;
	}

	/**
	 * @return string
	 */
	protected function getCategory()
	{
		return $this->category ?: '';
	}

	/**
	 * Category or variation
	 * @param string $category
	 */
	protected function setCategory($category)
	{
		$this->category = (string)$category;
	}

	/**
	 * @return float
	 */
	protected function getPrice()
	{
		return $this->price ?: '';
	}

	/**
	 * Unit price
	 * @param float $price
	 */
	protected function setPrice($price)
	{
		$this->price = floatval($price);
	}

	/**
	 * @return int
	 */
	protected function getQuantity()
	{
		return $this->quantity ?: '';
	}

	/**
	 * Quantity
	 * @param int $quantity
	 */
	protected function setQuantity($quantity)
	{
		$this->quantity = intval($quantity);
	}

}