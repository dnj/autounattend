<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\SetupInternational\SetupUILanguage;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-international-core-winpe
 */
#[Attribute('name', 'Microsoft-Windows-International-Core-WinPE')]
#[Attribute('processorArchitecture', 'amd64')]
#[Attribute('publicKeyToken', '31bf3856ad364e35')]
#[Attribute('language', 'neutral')]
#[Attribute('versionScope', 'nonSxS')]
#[Attribute('xmlns:wcm', 'http://schemas.microsoft.com/WMIConfig/2002/State')]
#[Attribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')]
#[Wrapper('component')]
class SetupInternational implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the system input locale and the keyboard layout.
     */
    public ?string $inputLocale = null;

    /**
     * Specifies the keyboard driver to use for Japanese or Korean keyboards.
     */
    public ?int $layeredDriver = null;

    /**
     * Specifies the default language to use during Windows Setup or Windows Deployment Services.
     */
    public ?SetupUILanguage $setupUILanguage = null;

    /**
     * Specifies the default system user interface (UI) language.
     */
    public ?string $uiLanguage = null;

    /**
     * Specifies the fallback language if the system default UI language is only partially localized.
     */
    public ?string $uiLanguageFallback = null;

    /**
     * Specifies the per-user settings used for formatting dates, times, currency, and numbers.
     */
    public ?string $userLocale = null;

    /**
     * Specifies the per-user settings used for formatting dates, times, currency, and numbers.
     */
    public ?string $systemLocale = null;
}
