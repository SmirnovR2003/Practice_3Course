<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

// Проверка наличия необходимых параметров
if (!isset($arParams["CATALOG_IBLOCK_ID"]) || !isset($arParams["NEWS_IBLOCK_ID"]) || !isset($arParams["CATALOG_SECTION_PROPERTY_CODE"])) {
	ShowError("Не заданы все необходимые параметры");
	return;
}
if (!\Bitrix\Main\Loader::includeModule("iblock"))
return;

$arSectionsIDS = [];
// Получение разделов каталога и привязанных новостей
$arFilter = array("IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"], "ACTIVE" => "Y", "!UF_NEWS_LINK" => false);
$arSelect = array("ID", "NAME", "UF_NEWS_LINK");
$res = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
while ($ob = $res->GetNext()) {
	$arResult["SECTIONS"][$ob["ID"]] = $ob;
	$arSectionsIDS[] = $ob["ID"];
	foreach ($ob["UF_NEWS_LINK"] as $newsId) {
		$arResult["NEWS"][$newsId]["SECTIONS"][] = $ob["ID"];
	}
}

// Получение новостей
$arFilter = array("IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"], "ACTIVE" => "Y");
$arSelect = array("ID", "NAME", "ACTIVE_FROM");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arResult["NEWS"][$arFields["ID"]]["INFO"] = $arFields;
}

// Получение элементов каталога
$arFilter = array("IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"], "ACTIVE" => "Y", "IBLOCK_SECTION_ID" => $arSectionsIDS);
$arSelect = array("ID", "NAME", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER", "PROPERTY_PRICE", "IBLOCK_SECTION_ID");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNextElement()) {
	$arFields = $ob->GetFields();
	$arResult["ITEMS"][$arFields["ID"]] = $arFields;
}

// Установка заголовка страницы
$APPLICATION->SetTitle("В каталоге товаров представлено товаров: " . count($arResult["ITEMS"]));

// Подключение шаблона
$this->IncludeComponentTemplate();