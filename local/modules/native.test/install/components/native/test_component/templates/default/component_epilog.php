<?
if(CModule::IncludeModule('native.test')){
    // Получаем путь к текущему файлу
    $currentFile = __FILE__;
    native\test\ModuleTest::log($currentFile);
}