<?php

use Bitrix\Main\Application;
use Bitrix\Main\Entity;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;


Loc::loadMessages(__FILE__);

class uplab_demo extends CModule
{
	protected $entities = [];

	public function __construct()
	{
		$arModuleVersion = array();

		include __DIR__ . "/version.php";

		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}

		$this->MODULE_ID = "uplab.demo";
		$this->MODULE_NAME = Loc::getMessage("{$this->MODULE_ID}_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("{$this->MODULE_ID}_MODULE_DESCRIPTION");
		$this->MODULE_GROUP_RIGHTS = "N";
		$this->PARTNER_NAME = Loc::getMessage("{$this->MODULE_ID}_MODULE_PARTNER_NAME");
		$this->PARTNER_URI = Loc::getMessage("{$this->MODULE_ID}_MODULE_PARTNER_URI");
	}

	/**
	 * Устанавливает модуль
	 * @throws LoaderException
	 */
	public function doInstall()
	{
		ModuleManager::registerModule($this->MODULE_ID);
		$this->installDb();
		$this->installAgents();
		$this->installEvents();
		$this->installFiles();
	}

	/**
	 * Отключает модуль
	 * @throws LoaderException
	 */
	public function doUninstall()
	{
		$this->uninstallFiles();
		$this->uninstallEvents();
		$this->uninstallAgents();
		$this->uninstallDb();
		ModuleManager::unRegisterModule($this->MODULE_ID);
	}

	/**
	 * Создает необходимые таблицы в бд
	 * @return bool|void
	 * @throws LoaderException
	 */
	public function installDb()
	{
		if (Loader::includeModule($this->MODULE_ID)) {
			foreach ($this->entities as $entityName) {
				$instance =  Entity\Base::getInstance($entityName);
				$tableName = $instance->getDBTableName();
				if (!Application::getConnection()->isTableExists($tableName)) {
					$instance->createDbTable();
				}
			}
		}
	}

	/**
	 * Удаляет созданные при установке модуля таблицы из бд
	 * @throws LoaderException
	 */
	public function uninstallDb()
	{
		if (Loader::includeModule($this->MODULE_ID)) {
			foreach ($this->entities as $entityName) {
				$instance =  Entity\Base::getInstance($entityName);
				$tableName = $instance->getDBTableName();

				Application::getConnection()->queryExecute("DROP TABLE IF EXISTS {$tableName}");
			}
		}
	}

	/**
	 * Регистрирует функии-агенты модуля в таблице зарегистрированных агентов
	 */
	public function installAgents()
	{
		/**
		 * Пример:
		 *
		 * 	CAgent::AddAgent(
		 * 		"CSaleRecurring::AgentCheckRecurring();",
		 * 		$this->MODULE_ID,
		 * 		"N",
		 * 		7200,
		 * 		"",
		 * 		"Y"
		 * 	);
		 */
	}

	/**
	 * Удаляет все функции-агенты модуля из таблицы зарегистрированных агентов
	 */
	public function uninstallAgents()
	{
		CAgent::RemoveModuleAgents($this->MODULE_ID);
	}

	/**
	 * Регистрирует обработчики событий
	 */
	public function installEvents()
	{
		$eventManager = EventManager::getInstance();

		/**
		 * Пример:
		 *
		 * 	$eventManager->registerEventHandler(
		 * 		"main",
		 * 		"OnProlog",
		 * 		$this->MODULE_ID,
		 * 		"",
		 * 		"",
		 * 		"",
		 * 		"",
		 * 		""
		 * 	);
		 */
	}

	/**
	 * Удаляет регистрационные запись обработчиков событий
	 */
	public function uninstallEvents()
	{
		$eventManager = EventManager::getInstance();

		/**
		 * Пример:
		 *
		 * 	$eventManager->unRegisterEventHandler(
		 * 		"main",
		 * 		"OnProlog",
		 * 		$this->MODULE_ID,
		 * 		"",
		 * 		"",
		 * 		"",
		 * 		""
		 * 		);
		 */
	}

	/**
	 * Копирует файлы
	 * @return bool|void
	 */
	public function installFiles()
	{
		CopyDirFiles(
			Loader::getLocal("modules/{$this->MODULE_ID}/install/admin"),
			Application::getDocumentRoot() . "/bitrix/admin",
			true,
			true
		);
		CopyDirFiles(
			Loader::getLocal("modules/{$this->MODULE_ID}/install/components"),
			Application::getDocumentRoot() . "/bitrix/components",
			true,
			true
		);
	}

	/**
	 * Удаляет скопированные при установке файлы
	 * @return bool|void
	 */
	public function uninstallFiles()
	{
		DeleteDirFiles(
			Loader::getLocal("modules/{$this->MODULE_ID}/install/admin"),
			Application::getDocumentRoot() . "/bitrix/admin"
		);
		DeleteDirFiles(
			Loader::getLocal("modules/{$this->MODULE_ID}/install/components"),
			Application::getDocumentRoot() . "/bitrix/components"
		);
	}
}
