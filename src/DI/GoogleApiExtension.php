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
use Nette\InvalidStateException;

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
		'webMasterHash' => null
	];

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults, $this->getConfig());

		$hook = $builder->getByType(HookService::class);
		if ($hook) {
			$builder->addDefinition($this->prefix('googleApiHook'))
				->setClass(GoogleApiHook::class);

			$this->setTranslation(__DIR__ . '/../lang/', [
				'webManager'
			]);

			$config['gaClientId'] = new Statement('?->googleAnalyticsClientId', ['@' . Configurator::class]);
			$config['webMasterHash'] = new Statement('?->webMasterHash', ['@' . Configurator::class]);
		}

		if ($config['gaClientId'] === null) {
			throw new InvalidStateException("GoogleApi: 'gaClientId' does not set in config.neon");
		}
		if ($config['webMasterHash'] === null) {
			throw new InvalidStateException("GoogleApi: 'webMasterHash' does not set in config.neon");
		}

		$builder->addDefinition($this->prefix('factory'))
			->setImplement(IGoogleApiFactory::class)
			->setFactory(GoogleApi::class)
			->setArguments([$config['gaClientId'], $config['webMasterHash']]);
	}
}