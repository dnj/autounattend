<?php

namespace dnj\Autounattend\Setup;

use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\Setup\ImageInstall\Image;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-imageinstall
 */
class ImageInstall implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the secondary data image to install.
     */
    public ?Image $dataImage = null;

    /**
     * Specifies the Windows operating system image to install.
     */
    public Image $osImage;

    public function __construct(Image $osImage)
    {
        $this->osImage = $osImage;
    }
}
