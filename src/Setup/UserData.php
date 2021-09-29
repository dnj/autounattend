<?php

namespace dnj\Autounattend\Setup;

use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-userdata
 */
class UserData implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether to automatically accept the Microsoft Software License Terms.
     * Default value is false.
     */
    public ?bool $acceptEula = null;

    /**
     * Specifies the name of the end user.
     */
    public ?string $fullName = null;

    /**
     * Specifies the name of the organization that owns the computer.
     */
    public ?string $organization = null;

    /**
     * Specifies the product key to use, which determines the edition of Windows to install.
     */
    public ?string $productKey = null;
}
