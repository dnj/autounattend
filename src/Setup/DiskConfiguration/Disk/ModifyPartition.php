<?php

namespace dnj\Autounattend\Setup\DiskConfiguration\Disk;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-diskconfiguration-disk-modifypartitions-modifypartition
 */
#[Attribute('wcm:action', 'add')]
#[Wrapper]
class ModifyPartition implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether the partition is active.
     */
    public ?bool $active = null;

    /**
     * Specifies whether to extend the partition to use the remainder of the contiguous space on the hard disk.
     */
    public ?bool $extend = null;

    /**
     * Specifies the file-system format to apply to the partition.
     */
    public ?string $format = null;

    /**
     * Specifies the name to apply to the partition.
     */
    public ?string $label = null;

    /**
     * Specifies the drive letter to assign to the partition.
     */
    public ?string $letter = null;

    /**
     * Specifies the identification number of the partition to modify.
     */
    public int $partitionID;

    /**
     * Specifies the hard drive partition type.
     */
    public ?string $typeID = null;

    public function __construct(int $partitionID)
    {
        $this->partitionID = $partitionID;
    }
}
