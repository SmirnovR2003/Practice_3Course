<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Вывод новостей и связанных с ними разделов и товаров
foreach ($arResult["NEWS"] as $newsId => $newsData) {
    echo "<h3>" . $newsData["INFO"]["NAME"] . " - " . $newsData["INFO"]["ACTIVE_FROM"] . " (";
    $cnt = count($newsData["SECTIONS"]);
    $i = 0;
    foreach ($newsData["SECTIONS"] as $sectionId) {
        $i++;
        $section = $arResult["SECTIONS"][$sectionId];
        echo $section["NAME"];
        if($i != $cnt)echo ", ";
    }
    echo ")</h3>";
    echo "<ul>";
    foreach ($newsData["SECTIONS"] as $sectionId) {
        $section = $arResult["SECTIONS"][$sectionId];
        foreach ($arResult["ITEMS"] as $itemId => $item) {
            if (in_array($newsId, $section["UF_NEWS_LINK"]) && $item["IBLOCK_SECTION_ID"] == $sectionId) {
                echo "<li>" . $item["NAME"] . " (Материал: " . $item["PROPERTY_MATERIAL_VALUE"] . ", Артикул: " . $item["PROPERTY_ARTNUMBER_VALUE"] . ", Цена: " . $item["PROPERTY_PRICE_VALUE"] . ")</li>";
            }
        }
    }
    echo "</ul>";
}
