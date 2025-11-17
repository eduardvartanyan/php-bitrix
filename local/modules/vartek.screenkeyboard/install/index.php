<?php

use Bitrix\Main\Localization\Loc;

class vartek_screenkeyboard extends CModule
{
    public $MODULE_ID = 'vartek.screenkeyboard';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $PARTNER_NAME = "Vartek";
    public $PARTNER_URI  = "";
    public function __construct()
    {
        include __DIR__ . '/version.php';

        $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME         = Loc::getMessage('VSK_MODULE_NAME');
        $this->MODULE_DESCRIPTION  = Loc::getMessage('VSK_MODULE_DESC');
    }
}