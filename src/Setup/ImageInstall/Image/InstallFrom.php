<?php

namespace dnj\Autounattend\Setup\ImageInstall\Image;

use dnj\Autounattend\Credentials;
use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\Setup\ImageInstall\Image\InstallFrom\MetaData;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-imageinstall-osimage-installfrom
 */
class InstallFrom implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the credentials used to access the .wim file.
     */
    public ?Credentials $credentials = null;

    /**
     * Specifies a unique Windows image in the .wim file to install.
     *
     * @var MetaData[]|null
     */
    public ?array $metaData = null;

    /**
     * Specifies the path to the .wim file.
     */
    public ?string $path = null;
}
