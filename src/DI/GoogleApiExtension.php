<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\DI\ExtensionTranslatorTrait;
use NAttreid\GoogleApi\GoogleApi;
use NAttreid\GoogleApi\Hooks\GoogleApiConfig;
use NAttreid\GoogleApi\Hooks\GoogleApiHook;
use NAttreid\GoogleApi\IGoogleApiFactory;
use NAttreid\WebManager\Services\Hooks\HookService;
use Nette\DI\CompilerExtension;
use Nette\DI\Statement;

/**
 * Class GoogleApiExtension
 *
 * @author Attreid <attreid@gmail.com>
 */
class GoogleApiExtension extends CompilerExtension
{
	use ExtensionTranslatorTrait;

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

		$hook = $builder->getByType(HookService::class);
		if ($hook) {
			$builder->addDefinition($this->prefix('hook'))
				->setClass(GoogleApiHook::class);

			$this->setTranslation(__DIR__ . '/../lang/', [
				'webManager'
			]);

			$googleApi = new Statement('?->googleApi \?\? new' . GoogleApiConfig::class, ['@' . Configurator::class]);
		} else {
			$googleApi = new GoogleApiConfig;
			$googleApi->gaClientId = $config['gaClientId'];
			$googleApi->adWordsConversionId = $config['adWordsConversionId'];
			$googleApi->adWordsConversionLabel = $config['adWordsConversionLabel'];
			$googleApi->webMasterKey = $config['webMasterKey'];
			$googleApi->merchantKey = $config['merchantKey'];
		}

		$builder->addDefinition($this->prefix('factory'))
			->setImplement(IGoogleApiFactory::class)
			->setFactory(GoogleApi::class)
			->setArguments([$googleApi]);
	}
}