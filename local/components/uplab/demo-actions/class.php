<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Response;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;


class DemoActionsComponent extends CBitrixComponent implements Controllerable
{
	public function executeComponent()
	{
		$this->includeComponentTemplate();
	}

	//обязательный метод, описываем, какие action будут
	public function configureActions()
	{
		return [
			"testSimple"       => [
				"prefilters"  => [],
				"-prefilters"  => [new ActionFilter\Authentication(),], // вычитаем из стандартного набора
				"postfilters" => [],
			],
			"testFilters"      => [

				//ajax-запрос сперва проходит по prefilters, после по postfilters

				"prefilters"  => [
					new ActionFilter\HttpMethod(
						[
							ActionFilter\HttpMethod::METHOD_GET,
							// ActionFilter\HttpMethod::METHOD_POST,
						]
					),
					// new ActionFilter\Csrf(),
					new ActionFilter\Authentication(),
				],
				"postfilters" => [],
			],
			"testArguments"    => [
				"prefilters" => [],
				"postfilters" => [],
			],
			"testParameters" => [
				"prefilters"  => [],
				"postfilters" => [],
			],
		];
	}



	//Если нам нужно параметры компонента передать в ajax-обработчик, определяем, какие параметры нужно передать
	public function listKeysSignedParameters()
	{
		return [
			"PARAM_1",
			"PARAM_2",
		];
	}

	// расписываем эти методы с суффиксом Action
	public function testSimpleAction()
	{
		return [
			"arParams" => $this->arParams,
			"hello"  => "world",
			"method" => __METHOD__,
		];
	}

	public function testFiltersAction()
	{
		return [
			"method" => __METHOD__,
		];
	}

	public function testArgumentsAction($argtt, $arg2 = null)
	{
		return [
			"argtt"   => $argtt,
			"arg2"   => $arg2,
			"method" => __METHOD__,
		];
	}

	public function testParametersAction()
	{
		return [
			"arParams" => $this->arParams,
			"method"   => __METHOD__,
		];
	}
}
