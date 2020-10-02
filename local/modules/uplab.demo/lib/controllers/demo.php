<?php

namespace Uplab\Demo\Controllers;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Context;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Error;
use Bitrix\Main\ObjectNotFoundException;
use Bitrix\Main\Result;
use Bitrix\Main\Engine\Response;

class DemoController extends Controller
{
	public function configureActions()
	{
		return [
			"getComponent" => [
				"prefilters" => [],
			],
		];
	}

	public function getComponentAction()
	{
		return new Response\Component(
			"uplab:demo-component",
			".default",
			array()
		);
	}
}
