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

	public function init()
	{
		$this->latte = __DIR__ . '/googleApiHook.latte';
	}

	/** @return Component */
	public function create(): Component
	{
		$form = $this->formFactory->create();
		$form->setAjaxRequest();

		$form->addGroup('webManager.web.hooks.googleApi.analytics.title');
		$form->addText('clientId', 'webManager.web.hooks.googleApi.analytics.clientId')
			->setDefaultValue($this->configurator->googleAnalyticsClientId);

		$form->addGroup('webManager.web.hooks.googleApi.webMaster.title');
		$form->addText('webMasterKey', 'webManager.web.hooks.googleApi.webMaster.key')
			->setDefaultValue($this->configurator->googleWebMasterKey);

		$form->addGroup('webManager.web.hooks.googleApi.merchant.title');
		$form->addText('merchantKey', 'webManager.web.hooks.googleApi.merchant.key')
			->setDefaultValue($this->configurator->googleMerchantKey);

		$form->addGroup('webManager.web.hooks.googleApi.adWords.title');
		$form->addText('conversionId', 'webManager.web.hooks.googleApi.adWords.conversionId')
			->setDefaultValue($this->configurator->googleAdWordsConversionId);
		$form->addText('conversionLabel', 'webManager.web.hooks.googleApi.adWords.conversionLabel')
			->setDefaultValue($this->configurator->googleAdWordsConversionLabel);

		$form->addSubmit('save', 'form.save');

		$form->onSuccess[] = [$this, 'googleApiFormSucceeded'];

		return $form;
	}

	public function googleApiFormSucceeded(Form $form, ArrayHash $values)
	{
		$this->configurator->googleAnalyticsClientId = $values->clientId;
		$this->configurator->googleWebMasterKey = $values->webMasterKey;
		$this->configurator->googleMerchantKey = $values->merchantKey;
		$this->configurator->googleAdWordsConversionId = $values->conversionId;
		$this->configurator->googleAdWordsConversionLabel = $values->conversionLabel;

		$this->flashNotifier->success('default.dataSaved');
	}
}