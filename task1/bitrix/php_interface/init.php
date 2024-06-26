<?php
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");


AddEventHandler('main', 'OnBeforeEventSend', array("MyForm", "my_OnBeforeEventSend"));
class MyForm
{
    public static function my_OnBeforeEventSend(&$arFields, &$arTemplate)
    {
        if ($arTemplate['EVENT_NAME'] == "FEEDBACK_FORM") {
            global $USER;
            if ($USER->IsAuthorized()) {
                $author = "Пользователь авторизован: " . $USER->GetID() . " (" . $USER->GetLogin() . ") "
                    . $USER->GetFirstName() . ", данные из формы: " . $arFields['AUTHOR'];
            } else {
                $author = "Пользователь не авторизован, данные из формы: " . $arFields['AUTHOR'];
            }
            $arFields['AUTHOR'] = $author;

            AddMessage2Log("Замена данных в отсылаемом письме - " . $arFields['AUTHOR']);
        }
    }
}
