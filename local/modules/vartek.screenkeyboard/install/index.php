<?php

use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
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

        /** @var <string> $arModuleVersion */
        $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME         = Loc::getMessage('VSK_MODULE_NAME');
        $this->MODULE_DESCRIPTION  = Loc::getMessage('VSK_MODULE_DESC');
    }

    public function DoInstall(): void
    {
        global $APPLICATION;

        RegisterModule($this->MODULE_ID);

        $this->InstallFiles();
        $this->InstallEvents();

        $APPLICATION->IncludeAdminFile(Loc::getMessage('VSK_INSTALL_TITLE'), __DIR__ . '/step.php');
    }

    public function InstallFiles(): bool
    {
        $root = Application::getDocumentRoot();
        CopyDirFiles(__DIR__ . '/files/components/', $root . '/files/components/', true, true);
        CopyDirFiles(__DIR__ . '/files/js/', $root . '/local/js/', true, true);

        return true;
    }

    public function InstallEvents(): bool
    {
        EventManager::getInstance()->registerEventHandler(
            'main',
            'OnEndBufferContent',
            $this->MODULE_ID,
            "\\Vartek\\ScreenKeyboard\\EventManager",
            'injectScript'
        );

        return true;
    }
}