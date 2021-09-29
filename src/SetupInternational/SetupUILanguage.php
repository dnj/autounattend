<?php

namespace dnj\Autounattend\SetupInternational;

use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\HasUITrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-international-core-winpe-setupuilanguage
 */
class SetupUILanguage implements \JsonSerializable
{
    use ExportTrait;
    use HasUITrait;

    /**
     * Specifies the language of the user interface (UI) to use during Windows Setup or Windows Deployment Services.
     */
    public ?string $uiLanguage = null;
}
