<?php

namespace dnj\Autounattend\Setup;

use dnj\Autounattend\Attributes\Name;
use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\HasUITrait;
use dnj\Autounattend\Setup\DiskConfiguration\Disk;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-diagnostics
 */
class DiskConfiguration implements \JsonSerializable
{
    use ExportTrait;
    use HasUITrait;

    /**
     * Specifies the disk configurations to apply to a disk on the destination computer.
     *
     * @var Disk[]|null
     */
    #[Name('Disk')]
    public ?array $disks = null;

    /**
     * Specifies whether Windows activates encryption on blank drives that are capable of hardware-based encryption.
     */
    public ?bool $disableEncryptedDiskProvisioning = null;
}
