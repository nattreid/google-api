<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi\ECommerce;

use InvalidArgumentException;
use Nette\SmartObject;

/**
 * Class Item
 *
 * @property string $id
 * @property string $name
 * @property string $category
 * @property float $price
 * @property int $quantity
 *
 * @author Attreid <attreid@gmail.com>
 */
class Item
{

	use SmartObject;

	private $id;
	private $name;
	private $category;
	private $price;
	private $quantity;

	/**
	 * @return string|null
	 */
	protected function getId(): ?string
	{
		if (empty($this->id)) {
			throw new InvalidArgumentException('Item id must be set');
		}
		return $this->id;
	}

	/**
	 * SKU/code
	 * @param string $id
	 */
	protected function setId(string $id): void
	{
		$this->id = $id;
	}

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