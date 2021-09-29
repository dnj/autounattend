<?php

namespace dnj\Autounattend\Setup\ImageInstall\Image;

use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-imageinstall-osimage-installto
 */
class InstallTo implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the disk identifier of the hard disk on which to install Windows.
     */
    public int $diskID;

    /**
     * Specifies the partition identifier of the partition on which to install Windows.
     */
    public int $partitionID;

    public function __construct(int $diskID, int $partitionID)
    {
        $this->diskID = $diskID;
        $this->partitionID = $partitionID;
    }
}
