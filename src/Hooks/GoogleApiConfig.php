<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi\Hooks;

use Nette\SmartObject;

/**
 * Class GoogleApiConfig
 *
 * @property string $gaClientId Id google analytics
 * @property string $webMasterKey overovaci klic pro webmaster tools
 * @property string $merchantKey overovaci klic pro google merchant
 * @property int $adWordsConversionId adWords conversion id
 * @property string $adWordsConversionLabel adWords conversion label
 *
 * @author Attreid <attreid@gmail.com>
 */
class GoogleApiConfig
{
	use SmartObject;

	/** @var string */
	private $gaClientId;

	/** @var string */
	private $webMasterKey;

	/** @var string */
	private $merchantKey;

	/** @var int */
	private $adWordsConversionId;

	/** @var string */
	private $adWordsConversionLabel;

	public function getGaClientId(): ?string
	{
		return $this->gaClientId;
	}

	public function setGaClientId(?string $gaClientId)
	{
		$this->gaClientId = $gaClientId;
	}

	public function getWebMasterKey(): ?string
	{
		return $this->webMasterKey;
	}

	public function setWebMasterKey(?string $webMasterKey)
	{
		$this->webMasterKey = $webMasterKey;
	}

	public function getMerchantKey(): ?string
	{
		return $this->merchantKey;
	}

	public function setMerchantKey(?string $merchantKey)
	{
		$this->merchantKey = $merchantKey;
	}

	public function getAdWordsConversionId(): ?int
	{
		return $this->adWordsConversionId;
	}

	public function setAdWordsConversionId(?int $adWordsConversionId)
	{
		$this->adWordsConversionId = $adWordsConversionId;
	}

	public function getAdWordsConversionLabel(): ?string
	{
		return $this->adWordsConversionLabel;
	}

	public function setAdWordsConversionLabel(?string $adWordsConversionLabel)
	{
		$this->adWordsConversionLabel = $adWordsConversionLabel;
	}
}