<?php

namespace NAttreid\GoogleApi\Hooks;

use NAttreid\Form\Form;
use NAttreid\WebManager\Services\Hooks\HookFactory;

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

	/** @return Form */
	public function create()
	{
		$form = $this->formFactory->create();
		$form->setAjaxRequest();

		$form->addGroup('webManager.web.hooks.googleApi.analytics.title');
		$form->addText('clientId', 'webManager.web.hooks.googleApi.analytics.clientId')
			->setDefaultValue($this->configurator->googleAnalyticsClientId);

		$form->addGroup('webManager.web.hooks.googleApi.webMaster.title');
		$form->addText('hash', 'webManager.web.hooks.googleApi.webMaster.hash')
			->setDefaultValue($this->configurator->webMasterHash);

		$form->addSubmit('save', 'form.save');

		$form->onSuccess[] = [$this, 'googleApiFormSucceeded'];

		return $form;
	}

	public function googleApiFormSucceeded(Form $form, $values)
	{
		$this->configurator->googleAnalyticsClientId = $values->clientId;
		$this->configurator->webMasterHash = $values->hash;

		$this->flashNotifier->success('default.dataSaved');
	}
}