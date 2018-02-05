<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\DI\ExtensionTranslatorTrait;
use NAttreid\GoogleApi\Hooks\GoogleApiConfig;
use NAttreid\GoogleApi\Hooks\GoogleApiHook;
use NAttreid\WebManager\Services\Hooks\HookService;
use Nette\DI\Statement;

if (trait_exists('NAttreid\Cms\DI\ExtensionTranslatorTrait')) {
	class GoogleApiExtension extends AbstractGoogleApiExtension
	{
		use ExtensionTranslatorTrait;

		protected function prepareHook(array $config)
		{
			$builder = $this->getContainerBuilder();
			$hook = $builder->getByType(HookService::class);
			if ($hook) {
				$builder->addDefinition($this->prefix('hook'))
					->setType(GoogleApiHook::class);

				$this->setTranslation(__DIR__ . '/../lang/', [
					'webManager'
				]);

				return new Statement('?->googleApi \?: new ' . GoogleApiConfig::class, ['@' . Configurator::class]);
			} else {
				return parent::prepareHook($config);
			}
		}
	}
} else {
	class GoogleApiExtension extends AbstractGoogleApiExtension
	{
	}
}