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
		'adWordsConversionLabel' => null,
		'anonymizeIp' => false,
	];

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults, $this->getConfig());

		$googleApi = $this->prepareConfig($config);

		$builder->addFactoryDefinition($this->prefix('factory'))
			->setImplement(IGoogleApiFactory::class)
			->getResultDefinition()
			->setFactory(GoogleApi::class)
			->setArguments([$googleApi, $config['anonymizeIp']]);
	}

	protected function prepareConfig(array $config)
	{
		$builder = $this->getContainerBuilder();
		return $builder->addDefinition($this->prefix('config'))
			->setFactory(GoogleApiConfig::class)
			->addSetup('$gaClientId', [$config['gaClientId']])
			->addSetup('$adWordsConversionId', [$config['adWordsConversionId']])
			->addSetup('$adWordsConversionLabel', [$config['adWordsConversionLabel']])
			->addSetup('$webMasterKey', [$config['webMasterKey']])
			->addSetup('$merchantKey', [$config['merchantKey']]);
	}
}