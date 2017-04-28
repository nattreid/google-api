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

	protected function getGaClientId(): ?string
	{
		return $this->gaClientId;
	}

	protected function setGaClientId(?string $gaClientId)
	{
		$this->gaClientId = $gaClientId;
	}

	protected function getWebMasterKey(): ?string
	{
		return $this->webMasterKey;
	}

	protected function setWebMasterKey(?string $webMasterKey)
	{
		$this->webMasterKey = $webMasterKey;
	}

	protected function getMerchantKey(): ?string
	{
		return $this->merchantKey;
	}

	protected function setMerchantKey(?string $merchantKey)
	{
		$this->merchantKey = $merchantKey;
	}

	protected function getAdWordsConversionId(): ?int
	{
		return $this->adWordsConversionId;
	}

	protected function setAdWordsConversionId(?int $adWordsConversionId)
	{
		$this->adWordsConversionId = $adWordsConversionId;
	}

	protected function getAdWordsConversionLabel(): ?string
	{
		return $this->adWordsConversionLabel;
	}

	protected function setAdWordsConversionLabel(?string $adWordsConversionLabel)
	{
		$this->adWordsConversionLabel = $adWordsConversionLabel;
	}
}