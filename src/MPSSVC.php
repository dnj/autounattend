<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\MPSSVC\FirewallGroup;

#[Attribute('name', 'Networking-MPSSVC-Svc')]
#[Attribute('processorArchitecture', 'amd64')]
#[Attribute('publicKeyToken', '31bf3856ad364e35')]
#[Attribute('language', 'neutral')]
#[Attribute('versionScope', 'nonSxS')]
#[Attribute('xmlns:wcm', 'http://schemas.microsoft.com/WMIConfig/2002/State')]
#[Attribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')]
#[Wrapper('component')]
class MPSSVC implements \JsonSerializable
{
    use ExportTrait;
    /**
     * Specifies Windows Firewall groups.
     *
     * @var FirewallGroup[]
     */
    #[Container]
    public ?array $firewallGroups = null;
}
