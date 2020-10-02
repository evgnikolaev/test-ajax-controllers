<?

/**
 * @var array $arParams
 * @var array $arResult
 */

defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED === true || die();

?>

<div data-container="todo">

	<h1 class="text-xl my-5 font-bold uppercase">Список дел</h1>

	<form data-action="addItem">
		<div class="flex flex-row">
			<div class="mx-2 w-full">
				<input type="text" name="name" class="py-2 px-4 rounded w-full" placeholder="Купить хлебушка..." autofocus>
			</div>
		</div>
	</form>

	<div>
		<? foreach ($arResult["ITEMS"] as $item): ?>
			<div class="flex flex-row items-center my-4 <?= $item["UF_COMPLETED"] ? "opacity-50" : "" ?>">
				<div class="mx-2">
					<div class="w-4 h-4 rounded-full bg-white flex items-center justify-center cursor-pointer"
					     data-action="toggleItem" data-id="<?= $item["ID"] ?>">
						<div class="w-3 h-3 rounded-full <?= $item["UF_COMPLETED"] ? "bg-green-400" : "bg-gray-200" ?>"></div>
					</div>
				</div>
				<div class="mx-2 <?= $item["UF_COMPLETED"] ? "line-through" : "" ?>">
					<?= $item["UF_NAME"] ?>
				</div>
				<div class="mx-2 flex items-center justify-center">
					<button class="w-3 h-3"
					        data-action="deleteItem" data-id="<?= $item["ID"] ?>">
						<svg class="text-red-700" fill="currentColor" viewBox="0 0 20 20">
							<path fill-rule="evenodd"
							      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
							      clip-rule="evenodd"></path>
						</svg>
					</button>
				</div>
			</div>
		<? endforeach; ?>
	</div>

</div>
