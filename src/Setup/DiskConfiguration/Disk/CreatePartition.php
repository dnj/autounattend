<?php

namespace dnj\Autounattend\Setup\DiskConfiguration\Disk;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-diskconfiguration-disk-createpartitions-createpartition
 */
#[Attribute('wcm:action', 'add')]
#[Wrapper]
class CreatePartition implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the type of partition to create. For example, you can specify a primary partition type or an extended partition type.
     */
    public string $type;

    /**
     * Specifies the size of the partition to create, in megabytes.
     */
    public ?int $size = null;

    /**
     * Specifies whether to extend the partition to fill the disk.
     */
    public ?bool $extend = null;

    public function __construct(string $type, ?int $size = null, ?bool $extend = null)
    {
        $this->type = $type;
        $this->size = $size;
        $this->extend = $extend;
    }
}
