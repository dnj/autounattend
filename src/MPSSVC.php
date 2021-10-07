<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\MPSSVC\FirewallGroup;

#[Attribute('name', 'Networking-MPSSVC-Svc')]
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
