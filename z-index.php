<?/*

https://wiki.uplab.ru/pages/viewpage.action?pageId=9732103
https://verstaem.com/ajax/new-bitrix-ajax/

index.php (компонент demo-actions) - пример




Краткое описание процесса работы:
	1)	Контроллер описывается в компоненте или в модуле
		(контроллер в компоненте может реализовываться двумя способами - в классе компонента class.php или в файле ajax.php в папке компонента)


			a)  если контроллер в классе компонента - то класс должен реализовывать интерфейс - Bitrix\Main\Engine\Contract\Controllerable
				(в этом случае доступны методы компонента)

			b)  если контроллер в ajax.php - то создается класс унаследованный от Bitrix\Main\Engine\Controller
				(в этом случае не доступны методы компонента, для этого придется создавать объект компонента)



					configureActions() - обязательный метод, описываем, какие action будут
					ajax-запрос сперва проходит по prefilters, после по postfilters


					// набор филтьтров по умолчанию
						"prefilters"  => [
							new ActionFilter\HttpMethod(
								[
									ActionFilter\HttpMethod::METHOD_GET,    - принимает get параметры
									ActionFilter\HttpMethod::METHOD_POST,
								]
							),
							new ActionFilter\Csrf(),                csrf - защита от вызова метода на сторонних сайтах ( использование  bitrix_sessid() ).
							new ActionFilter\Authentication(),      -   запрос только для авторизованных пользователей
						],




				в) если контроллер в модуле - то создается класс унаследованный от Bitrix\Main\Engine\Controller,
					в корне модуля создается файл .settings.php, в котором регистрируется неймспейс, в котором будут располагаться классы контроллеров, пример:
						<?php

						return [
						   "controllers" => [
						      "value" => [
						         "namespaces" => [
						            "\\Uplab\\Demo\\Controllers" => "api"
						         ]
						      ],
						      "readonly" => true
						   ]
						];


		2)	На стороне фронтенда экшены описанные в контроллерах вызываются с помощью
				BX.ajax.runComponentAction - для контроллеров в компонентах
				BX.ajax.runAction - для контроллеров в модулях
						по умолчанию ajax отправляется на  - /bitrix/services/main/ajax.php
						Ответ приходит всегда по структуре одинаковой структуры


			 Также можно возвращать html, файлы и даже компоненты:
				/папкаtodo/ - пример с модулем (возвращается сразу компонент demo-component)








*/?>