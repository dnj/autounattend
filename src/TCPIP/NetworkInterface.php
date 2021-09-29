<?php

namespace dnj\Autounattend\TCPIP;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Counter;
use dnj\Autounattend\Attributes\EachCast;
use dnj\Autounattend\Attributes\Order;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\TCPIP\NetworkInterface\IpAddress;
use dnj\Autounattend\TCPIP\NetworkInterface\IpSettings;
use dnj\Autounattend\TCPIP\NetworkInterface\Route;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-tcpip-interfaces-interface
 */
#[Attribute('wcm:action', 'add')]
#[Order('ipv4Settings', 'ipv6Settings', 'identifier', 'unicastIpAddresses', 'routes')]
#[Wrapper('Interface')]
class NetworkInterface implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the interface to apply to the other settings within Interface.
     */
    public string $identifier;

    /**
     * Specifies settings for the IP version 4 interface.
     */
    public ?IpSettings $ipv4Settings = null;

    /**
     * Specifies settings for the IP version 6 interface.
     */
    public ?IpSettings $ipv6Settings = null;

    /**
     * Specifies the unicast IP addresses for the IPv4 and IPv6 settings.
     *
     * @var string[]
     */
    #[EachCast(IpAddress::class)]
    #[Container]
    public ?array $unicastIpAddresses = null;

    /**
     * Specifies the IPv4 and IPv6 routes.
     *
     * @var Route[]
     */
    #[Counter('Identifier')]
    #[Container]
    public array $routes;

    /**
     * @param Route[]       $routes
     * @param string[]|null $unicastIpAddresses
     */
    public function __construct(
        string $identifier,
        array $routes,
        ?IpSettings $ipv4Settings = null,
        ?IpSettings $ipv6Settings = null,
        ?array $unicastIpAddresses = null
    ) {
        $this->identifier = $identifier;
        $this->routes = $routes;
        $this->ipv4Settings = $ipv4Settings;
        $this->ipv6Settings = $ipv6Settings;
        $this->unicastIpAddresses = $unicastIpAddresses;
    }
}
