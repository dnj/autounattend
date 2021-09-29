<?php

namespace dnj\Autounattend\TCPIP\NetworkInterface;

use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-tcpip-interfaces-interface-ipv4settings
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-tcpip-interfaces-interface-ipv6settings
 */
class IpSettings implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether the Dynamic Host Configuration Protocol (DHCP) is enabled for the IPv4 protocol.
     * The default value is true.
     */
    public ?bool $dhcpEnabled;

    /**
     * Specifies the interface metric used to distinguish between multiple matching routes of the same prefix length.
     */
    public ?int $metric = null;

    /**
     * Specifies whether the router discovery protocol, which informs hosts of the existence of routers, is enabled for the IPv4 protocol.
     */
    public ?bool $routerDiscoveryEnabled = null;

    public function __construct(
        ?bool $dhcpEnabled,
        ?int $metric = null,
        ?bool $routerDiscoveryEnabled = null
    ) {
        $this->dhcpEnabled = $dhcpEnabled;
        $this->metric = $metric;
        $this->routerDiscoveryEnabled = $routerDiscoveryEnabled;
    }
}
