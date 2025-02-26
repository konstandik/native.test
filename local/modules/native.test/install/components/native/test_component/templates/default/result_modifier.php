<?
if(CModule::IncludeModule('native.test')){
    // Получаем путь к текущей папке
    $currentPath = \Bitrix\Main\Application::getDocumentRoot() . '/local/components/native/test_component/templates/.default/';
    native\test\ModuleTest::log($currentPath);
}

// Добавляем текущую дату и время в результирующий массив
$arResult['CURRENT_DATE'] = date('Y-m-d H:i:s');