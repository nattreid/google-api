<?php

declare(strict_types=1);

namespace NAttreid\GoogleApi\Hooks;

use NAttreid\Form\Form;
use NAttreid\WebManager\Services\Hooks\HookFactory;
use Nette\ComponentModel\Component;
use Nette\Utils\ArrayHash;

/**
 * Class GoogleApiHook
 *
 * @author Attreid <attreid@gmail.com>
 */
class GoogleApiHook extends HookFactory
{
	/** @var IConfigurator */
	protected $configurator;

	public function init(): void
	{
		$this->latte = __DIR__ . '/googleApiHook.latte';

		if (!$this->configurator->googleApi) {
			$this->configurator->googleApi = new GoogleApiConfig;
		}
	}

	/** @return Component */
	public function create(): Component
	{
		$form = $this->formFactory->create();
		$form->setAjaxRequest();

		$form->addGroup('webManager.web.hooks.googleApi.analytics.title');
		$form->addText('clientId', 'webManager.web.hooks.googleApi.analytics.clientId')
			->setDefaultValue($this->configurator->googleApi->gaClientId);

		$form->addGroup('webManager.web.hooks.googleApi.webMaster.title');
		$form->addText('webMasterKey', 'webManager.web.hooks.googleApi.webMaster.key')
			->setDefaultValue($this->configurator->googleApi->webMasterKey);

		$form->addGroup('webManager.web.hooks.googleApi.merchant.title');
		$form->addText('merchantKey', 'webManager.web.hooks.googleApi.merchant.key')
			->setDefaultValue($this->configurator->googleApi->merchantKey);

		$form->addGroup('webManager.web.hooks.googleApi.adWords.title');
		$form->addInteger('conversionId', 'webManager.web.hooks.googleApi.adWords.conversionId')
			->setDefaultValue($this->configurator->googleApi->adWordsConversionId);
		$form->addText('conversionLabel', 'webManager.web.hooks.googleApi.adWords.conversionLabel')
			->setDefaultValue($this->configurator->googleApi->adWordsConversionLabel);

		$form->addSubmit('save', 'form.save');

		$form->onSuccess[] = [$this, 'googleApiFormSucceeded'];

		return $form;
	}

	public function googleApiFormSucceeded(Form $form, ArrayHash $values): void
	{
		$config = $this->configurator->googleApi;

		$config->gaClientId = $values->clientId ?: null;
		$config->webMasterKey = $values->webMasterKey ?: null;
		$config->merchantKey = $values->merchantKey ?: null;
		$config->adWordsConversionId = $values->conversionId ?: null;
		$config->adWordsConversionLabel = $values->conversionLabel ?: null;

		$this->configurator->googleApi = $config;

		$this->flashNotifier->success('default.dataSaved');
	}
}