<?php

namespace dnj\Autounattend\Setup\ImageInstall\Image\InstallFrom;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-imageinstall-osimage-installfrom-metadata
 */
#[Attribute('wcm:action', 'add')]
class MetaData implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether the image number, name, or description is used to select the image in a .wim file.
     */
    public string $key;

    /**
     * Specifies the value of the Key setting.
     */
    public string $value;

    public function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}
