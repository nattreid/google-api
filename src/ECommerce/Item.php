<?php

declare(strict_types=1);

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
	protected function getName(): string
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
	protected function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return string|null
	 */
	protected function getSku(): ?string
	{
		return $this->sku;
	}

	/**
	 * SKU/code
	 * @param string $sku
	 */
	protected function setSku(string $sku): void
	{
		$this->sku = $sku;
	}

	/**
	 * @return string|null
	 */
	protected function getCategory(): ?string
	{
		return $this->category;
	}

	/**
	 * Category or variation
	 * @param string $category
	 */
	protected function setCategory(string $category): void
	{
		$this->category = $category;
	}

	/**
	 * @return float|null
	 */
	protected function getPrice(): ?float
	{
		return $this->price;
	}

	/**
	 * Unit price
	 * @param float $price
	 */
	protected function setPrice(float $price): void
	{
		$this->price = $price;
	}

	/**
	 * @return int|null
	 */
	protected function getQuantity(): ?int
	{
		return $this->quantity;
	}

	/**
	 * Quantity
	 * @param int $quantity
	 */
	protected function setQuantity(int $quantity): void
	{
		$this->quantity = $quantity;
	}

}