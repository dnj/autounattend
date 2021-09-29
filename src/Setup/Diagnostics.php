<?php

namespace dnj\Autounattend\Setup;

use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-diagnostics
 */
class Diagnostics implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether to send installation statistic information to Microsoft.
     * Default value is false.
     */
    public ?bool $optIn = null;
}
