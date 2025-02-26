<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

$arModuleVersion = [
    'VERSION' => '1.1.1',
    'VERSION_DATE' => date('Y-m-d H:i:s'), // Дата создания модуля
];

class native_test extends CModule {
    var $MODULE_ID = 'native.test';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME = 'Тестовый модуль';
    var $MODULE_DESCRIPTION = 'Тестовый модуль для выполнения задания';
    var $PARTNER_NAME = 'Звенящие кедры';
    var $PARTNER_URI = 'https://megre.ru/';



    function __construct() {
        $arModuleVersion = [];
        include(__DIR__ . '/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }

    /**
     * Метод установки модуля
     */
    function DoInstall() {
        global $APPLICATION;
        $this->InstallFiles();
        ModuleManager::registerModule($this->MODULE_ID);
    }


    function InstallFiles($arParams = []){
        if (is_dir($p = $_SERVER["DOCUMENT_ROOT"]."/local/modules/".$this->MODULE_ID."/install/components")){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == ".." || $item == ".")
                        continue;
                    CopyDirFiles($p."/".$item, $_SERVER["DOCUMENT_ROOT"]."/local/components/".$item, $ReWrite = True, $Recursive = True);
                }
                closedir($dir);
            }
        }
        return true;
    }

    public function UnInstallFiles(){
        //удаляем компоненты
        if (is_dir($p = $_SERVER["DOCUMENT_ROOT"]."/local/modules/".$this->MODULE_ID."/install/components"))
        {
            if ($dir = opendir($p))
            {
                while (false !== $item = readdir($dir))
                {
                    if ($item == ".." || $item == "." || !is_dir($p0 = $p."/".$item))
                        continue;

                    $dir0 = opendir($p0);
                    while (false !== $item0 = readdir($dir0))
                    {
                        if ($item0 == ".." || $item0 == ".")
                            continue;
                        DeleteDirFilesEx("/local/components/".$item."/".$item0);
                    }
                    closedir($dir0);
                }
                closedir($dir);
            }
        }
        return true;
    }

    /**
     * Метод удаления модуля
     */
    function DoUninstall() {
        global $APPLICATION;

        // Вызов удаления компонента
        $this->UnInstallFiles();

        // Удаление модуля
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}