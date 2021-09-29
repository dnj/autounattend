<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\NetBT\NetworkInterface;

#[Attribute('name', 'Microsoft-Windows-NetBT')]
#[Attribute('processorArchitecture', 'amd64')]
#[Attribute('publicKeyToken', '31bf3856ad364e35')]
#[Attribute('language', 'neutral')]
#[Attribute('versionScope', 'nonSxS')]
#[Attribute('xmlns:wcm', 'http://schemas.microsoft.com/WMIConfig/2002/State')]
#[Attribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')]
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
