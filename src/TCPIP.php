<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-TCPIP')]
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
