<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Response;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;

class DemoController extends Controller
{
	/**
	 * @return array
	 */
	public function configureActions()
	{
		return [
			"test" => [
				"prefilters"  => [],
				"postfilters" => [],
			],
			"test1" => [
				"prefilters"  => [],
				"postfilters" => [],
			],
			"test2" => [
				"prefilters"  => [],
				"postfilters" => [],
			],
			"test3" => [
				"prefilters"  => [],
				"postfilters" => [],
			],
		];
	}

	public function test1Action()
	{
		return [
			"action" => __METHOD__,
		];
	}

	public function test2Action()
	{
		$this->addError(new Bitrix\Main\Error('Неизвестная ошибка'));

		return [
			"action" => __METHOD__,
		];
	}

	public function test3Action()
	{
		throw new Exception("Какое-то исключение");

		return [
			"action" => __METHOD__,
		];
	}
}
