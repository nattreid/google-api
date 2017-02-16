<?php

namespace NAttreid\GoogleApi;

use Nette\Application\UI\Control;

/**
 * Class GoogleApiClient
 *
 * @author Attreid <attreid@gmail.com>
 */
class GoogleApi extends Control
{

	/** @var string */
	private $gaClientId;

	/** @var string */
	private $webMasterHash;

	public function __construct($gaClientId, $webMasterHash)
	{
		parent::__construct();
		$this->gaClientId = $gaClientId;
		$this->webMasterHash = $webMasterHash;
	}

	public function render()
	{
		$this->template->gaClientId = $this->gaClientId;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}

	public function renderWebMaster()
	{
		$this->template->webMasterHash = $this->webMasterHash;
		$this->template->setFile(__DIR__ . '/templates/webMaster.latte');
		$this->template->render();
	}
}

interface IGoogleApiFactory
{
	/** @return GoogleApi */
	public function create();
}