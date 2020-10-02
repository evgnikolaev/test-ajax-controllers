<?

/**
 * @var array $arParams
 * @var array $arResult
 */

defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true || die();

?>

<!-- передаем параметры для ajax запроса-->
<script>
    window.signedParameters = '<?= $this->getComponent()->getSignedParameters() ?>';
</script>

<div class="m-2">

	<div class="flex flex-row items-center justify-between my-2">
		<div class="mr-10">Простой запрос</div>
		<button id="action-1"
		        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
			<span>Отправить</span>
		</button>
	</div>

	<div class="flex flex-row items-center justify-between my-2">
		<div class="mr-10">Запрос с фильтрами</div>
		<button id="action-2"
		        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
			<span>Отправить</span>
		</button>
	</div>

	<div class="flex flex-row items-center justify-between my-2">
		<div class="mr-10">Запрос с передачей данных</div>
		<button id="action-3"
		        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
			<span>Отправить</span>
		</button>
	</div>

	<div class="flex flex-row items-center justify-between my-2">
		<div class="mr-10">Запрос с параметрами</div>
		<button id="action-4"
		        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
			<span>Отправить</span>
		</button>
	</div>

	<div class="flex flex-row items-center justify-between my-2">
		<div class="mr-10">Запрос с ошибкой</div>
		<button id="action-5"
		        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
			<span>Отправить</span>
		</button>
	</div>
	<div class="flex flex-row items-center justify-between my-2">
		<div class="mr-10">Запрос с исключениями</div>
		<button id="action-6"
		        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
			<span>Отправить</span>
		</button>
	</div>
	<div class="h-64 rounded my-5 bg-gray-300 overflow-y-auto">
		<code id="response" class="whitespace-pre text-xs font-mono"></code>
	</div>

</div>
