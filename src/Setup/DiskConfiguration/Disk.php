<?php

namespace dnj\Autounattend\Setup\DiskConfiguration;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Counter;
use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\Setup\DiskConfiguration\Disk\CreatePartition;
use dnj\Autounattend\Setup\DiskConfiguration\Disk\ModifyPartition;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-setup-diskconfiguration-disk
 */
#[Attribute('wcm:action', 'add')]
class Disk implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies a list of CreatePartition items.
     *
     * @var CreatePartition[]
     */
    #[Counter('Order', 1)]
    #[Container]
    public ?array $createPartitions = null;

    /**
     * Specifies the identification number of the disk to edit.
     */
    public int $diskID;

    /**
     * Specifies a list of ModifyPartition items.
     *
     * @var ModifyPartition[]
     */
    #[Counter('Order', 1)]
    #[Container]
    public ?array $modifyPartitions = null;

    /**
     * Specifies whether to reformat the disk.
     */
    public ?bool $willWipeDisk = null;

    public function __construct(int $diskID)
    {
        $this->diskID = $diskID;
    }
}
