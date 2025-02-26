<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

class TestComponent extends \CBitrixComponent
{
    public function executeComponent()
    {
        if ($this->StartResultCache()) {
            // Здесь можно добавить логику получения данных
            $this->arResult = [];
            $this->IncludeComponentTemplate();
            $this->EndResultCache();
        } else {
            $this->IncludeComponentTemplate();
        }
    }
}