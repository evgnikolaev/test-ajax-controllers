<?php

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Response;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\SystemException;


class DemoComponent extends CBitrixComponent implements Controllerable
{
	/**
	 * @return mixed|void|null
	 * @throws ArgumentException
	 * @throws LoaderException
	 * @throws SystemException
	 */
	public function executeComponent()
	{
		$this->prepareResult();

		$this->includeComponentTemplate();
	}

	protected function prepareResult()
	{
		Loader::includeModule("highloadblock");

		$entity = HighloadBlockTable::compileEntity("Todos");
		$iterator = $entity->getDataClass()::getList(
			[
				"select" => ["*"],
				"order"  => [
					"UF_COMPLETED" => "ASC",
					"ID"           => "DESC",
				],
				"cache"  => [],
			]
		);

		$this->arResult["ITEMS"] = [];
		while ($item = $iterator->fetch()) {
			$this->arResult["ITEMS"][] = $item;
		}
	}

	/**
	 * @return array
	 */
	public function configureActions()
	{
		return [
			"addItem"    => [
				"prefilters"  => [],
				"postfilters" => [],
			],
			"deleteItem" => [
				"prefilters"  => [],
				"postfilters" => [],
			],
			"toggleItem" => [
				"prefilters"  => [],
				"postfilters" => [],
			],
		];
	}

	public function listKeysSignedParameters()
	{
		return [
			"GG",
		];
	}

	/**
	 * @param $name
	 *
	 * @return Response\Component
	 * @throws SystemException
	 * @throws Exception
	 */
	public function addItemAction($name)
	{
		Loader::includeModule("highloadblock");

		$entity = HighloadBlockTable::compileEntity("Todos");
		$result = $entity->getDataClass()::add(
			[
				"UF_NAME"      => $name,
				"UF_COMPLETED" => false,
			]
		);

		return $this->ajaxResponse();
	}

	/**
	 * @param $id
	 *
	 * @return Response\Component
	 * @throws LoaderException
	 * @throws SystemException
	 */
	public function deleteItemAction($id)
	{
		Loader::includeModule("highloadblock");

		$entity = HighloadBlockTable::compileEntity("Todos");
		$result = $entity->getDataClass()::delete($id);

		return $this->ajaxResponse();
	}

	/**
	 * @param $id
	 *
	 * @return Response\Component
	 * @throws LoaderException
	 * @throws SystemException
	 */
	public function toggleItemAction($id)
	{
		Loader::includeModule("highloadblock");

		$entity = HighloadBlockTable::compileEntity("Todos");
		$iterator = $entity->getDataClass()::getById($id);
		if ($item = $iterator->fetch()) {
			$result = $entity->getDataClass()::update(
				$id,
				[
					"UF_COMPLETED" => !$item["UF_COMPLETED"],
				]
			);
		}

		return $this->ajaxResponse();
	}

	protected function ajaxResponse($additionalResponseParams = [])
	{
		return [
			"html"             => $this->getHtml(),
			"additionalParams" => $additionalResponseParams,
		];
	}

	protected function getHtml()
	{
		ob_start();

		$this->executeComponent();

		return ob_get_clean();
	}
}
