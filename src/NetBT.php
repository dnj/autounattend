<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\NetBT\NetworkInterface;

#[Attribute('name', 'Microsoft-Windows-NetBT')]
#[Wrapper('component')]
class NetBT implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies an interface collection.
     *
     * @var NetworkInterface[]|null
     */
    #[Container]
    public ?array $interfaces = null;

    /**
     * @param NetworkInterface[]|null $interfaces
     */
    public function __construct(?array $interfaces = null)
    {
        $this->interfaces = $interfaces;
    }
}
