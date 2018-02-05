<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi\DI;

use NAttreid\GoogleApi\GoogleApi;
use NAttreid\GoogleApi\Hooks\GoogleApiConfig;
use NAttreid\GoogleApi\IGoogleApiFactory;
use Nette\DI\CompilerExtension;

/**
 * Class AbstractGoogleApiExtension
 *
 * @author Attreid <attreid@gmail.com>
 */
abstract class AbstractGoogleApiExtension extends CompilerExtension
{
	private $defaults = [
		'gaClientId' => null,
		'webMasterKey' => null,
		'merchantKey' => null,
		'adWordsConversionId' => null,
		'adWordsConversionLabel' => null
	];

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults, $this->getConfig());

		$googleApi = $this->prepareHook($config);

		$builder->addDefinition($this->prefix('factory'))
			->setImplement(IGoogleApiFactory::class)
			->setFactory(GoogleApi::class)
			->setArguments([$googleApi]);
	}

	protected function prepareHook(array $config)
	{
		$googleApi = new GoogleApiConfig;
		$googleApi->gaClientId = $config['gaClientId'];
		$googleApi->adWordsConversionId = $config['adWordsConversionId'];
		$googleApi->adWordsConversionLabel = $config['adWordsConversionLabel'];
		$googleApi->webMasterKey = $config['webMasterKey'];
		$googleApi->merchantKey = $config['merchantKey'];
		return $googleApi;
	}
}