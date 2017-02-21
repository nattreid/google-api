<?php

namespace NAttreid\GoogleApi\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\ExtensionTranslatorTrait;
use NAttreid\GoogleApi\GoogleApi;
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

	public function loadConfiguration()
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

			$config['gaClientId'] = new Statement('?->googleAnalyticsClientId', ['@' . Configurator::class]);
			$config['webMasterKey'] = new Statement('?->googleWebMasterKey', ['@' . Configurator::class]);
			$config['merchantKey'] = new Statement('?->googleMerchantKey', ['@' . Configurator::class]);
			$config['adWordsConversionId'] = new Statement('?->googleAdWordsConversionId', ['@' . Configurator::class]);
			$config['adWordsConversionLabel'] = new Statement('?->googleAdWordsConversionLabel', ['@' . Configurator::class]);
		}

		$builder->addDefinition($this->prefix('factory'))
			->setImplement(IGoogleApiFactory::class)
			->setFactory(GoogleApi::class)
			->setArguments([
				$config['gaClientId'],
				$config['adWordsConversionId'],
				$config['adWordsConversionLabel'],
				[
					$config['webMasterKey'],
					$config['merchantKey']
				]
			]);
	}
}