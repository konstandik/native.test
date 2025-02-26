<?php
namespace native\test;
//namespace ModuleTest;
abstract class ModuleTestAbstract {
    /**
     * Метод для записи в журнал событий
     *
     * @param string $description Описание события
     */
    public static function log($description) {
        global $APPLICATION;

        // Добавляем запись в системный журнал событий
        $eventLogID = 'NATIVE_TEST_MODULE_LOG';
        $eventSeverity = 'INFO'; // Можно использовать WARNING, ERROR и т.д.

        \CEventLog::Add([
            'AUDIT_TYPE_ID' => $eventLogID,
            'DESCRIPTION' => $description,
            'SEVERITY' => $eventSeverity,
            'SOURCE_ID' => 'native.test',
            'MODULE_ID' => 'native.test',
        ]);
    }
}