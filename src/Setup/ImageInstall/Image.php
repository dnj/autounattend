<?php

namespace dnj\Autounattend\Setup\ImageInstall;

use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\HasUITrait;
use dnj\Autounattend\Setup\ImageInstall\Image\InstallFrom;
use dnj\Autounattend\Setup\ImageInstall\Image\InstallTo;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-imageinstall-osimage
 */
class Image implements \JsonSerializable
{
    use ExportTrait;
    use HasUITrait;

    /**
     * Specifies the path of the .wim file.
     */
    public ?InstallFrom $installFrom = null;

    /**
     * Specifies the disk and the partition to install the image to.
     */
    public ?InstallTo $installTo = null;

    /**
     * Specifies whether to install to the first available bootable partition on a computer that does not already have an installation of Windows.
     */
    public ?bool $installToAvailablePartition = null;
}
