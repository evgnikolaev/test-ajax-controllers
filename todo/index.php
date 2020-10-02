<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetPageProperty("title", "Список дел");
$APPLICATION->SetTitle("Список дел");
?>

<div class="container mt-32 mx-auto">

	<div data-container="component-container" class="w-full text-center">
		<button id="get-component"class="bg-white hover:bg-grey-lightest text-grey-darkest font-semibold py-2 px-4 border border-grey-light rounded shadow">
			<span>Показать список дел</span>
		</button>
	</div>

</div>

<script>
    BX.bindDelegate(document, 'click', {attribute: {'id': 'get-component'}}, function (ev) {
        ev.preventDefault();

        const container = BX.findChild(document, {
            attribute: {
                'data-container': 'component-container'
            }
        }, true);

		// uplab:demo — модуль uplab.demo, где точку заменили на двоеточие
		// api — неймспейс который мы зарегистрировали в .settings.php модуля
		// democontroller — название файла и класса в папке lib/controller
		// getComponent — метод getComponentAction в классе democontroller, без суффикса action

        BX.ajax.runAction('uplab:demo.api.democontroller.getComponent', {})
            .then(function (response) {
                BX.adjust(container, {
                    html: response.data.html
                });
            })
            .catch(function (response) {
                console.log('catch: ', response);
            });
    });
</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
