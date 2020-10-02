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
			"testErrors"     => [
				"prefilters"  => [],
				"postfilters" => [],
			],
			"testExceptions" => [
				"prefilters"  => [],
				"postfilters" => [],
			],
		];
	}

	public function testErrorsAction()
	{
		$this->addError(new Bitrix\Main\Error('Неизвестная ошибка'));
		$this->addError(new Bitrix\Main\Error('Неизвестная ошибка 2'));

		return [
			"method" => __METHOD__,
		];
	}

	public function testExceptionsAction()
	{
		throw new Exception("Какое-то исключение");

		return [
			"method" => __METHOD__,
		];
	}
}
