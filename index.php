<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/**
 * @global CMain $APPLICATION
 */

$APPLICATION->SetPageProperty("title", "Примеры запросов");
$APPLICATION->SetTitle("Примеры запросов");

?>

<div class="container mt-16 mx-auto">

	<h1 class="my-5 mx-2 uppercase text-xl font-bold">Примеры запросов</h1>

	<? $APPLICATION->IncludeComponent(
		"uplab:demo-actions",
		".default",
		array(
			"PARAM_1" => "1",
			"PARAM_2" => "2",
		)
	); ?>

</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
