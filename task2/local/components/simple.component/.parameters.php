<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    "PARAMETERS" => array(
        "CATALOG_IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока с каталогом товаров",
            "TYPE" => "STRING",
        ),
        "NEWS_IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "ID инфоблока с новостями",
            "TYPE" => "STRING",
        ),
        "CATALOG_SECTION_PROPERTY_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => "Код пользовательского свойства разделов каталога",
            "TYPE" => "STRING",
        ),
        "CACHE_TYPE" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => "Типовые настройки кеширования",
            "TYPE" => "LIST",
            "VALUES" => array(
                "A" => "авто+управляемое",
                "Y" => "кешировать",
                "N" => "некешировать",
            ),
        ),
        "CACHE_TIME" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => "Время кеширования",
            "TYPE" => "STRING",
            "DEFAULT" => "3600",
        ),
    ),
);