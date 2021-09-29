<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-TCPIP')]
#[Attribute('processorArchitecture', 'amd64')]
#[Attribute('publicKeyToken', '31bf3856ad364e35')]
#[Attribute('language', 'neutral')]
#[Attribute('versionScope', 'nonSxS')]
#[Attribute('xmlns:wcm', 'http://schemas.microsoft.com/WMIConfig/2002/State')]
#[Attribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')]
#[Wrapper('component')]
class TCPIP implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies settings for TCP/IP interfaces.
     *
     * @var TCPIP\NetworkInterface[]
     */
    #[Container]
    public array $interfaces;

    /**
     * Specifies whether the IPv4 and IPv6 path caches are updated in response to Internet Control Message Protocol (ICMP) redirect messages.
     */
    public ?bool $icmpRedirectsEnabled = null;

    /**
     * @param TCPIP\NetworkInterface[] $interfaces
     */
    public function __construct(array $interfaces)
    {
        $this->interfaces = $interfaces;
    }
}
