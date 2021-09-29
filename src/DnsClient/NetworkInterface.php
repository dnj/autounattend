<?php

namespace dnj\Autounattend\DnsClient;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-dns-client-interfaces-interface
 */
#[Attribute('wcm:action', 'add')]
#[Wrapper('Interface')]
class NetworkInterface implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether to register the host (A) and pointer (PTR) resource records dynamically.
     */
    public ?bool $disableDynamicUpdate = null;

    /**
     * Specifies whether to register the host (A) and pointer (PTR) resource records for this adapter. If it is not specified, only the DNSDomain value specified in the global parameters is used.
     */
    public ?bool $enableAdapterDomainNameRegistration = null;

    /**
     * Specifies the interface identifier.
     */
    public string $identifier;

    /**
     * Specifies a list of addresses to use when searching for the DNS server on the network.
     *
     * @var IpAddress[]
     */
    #[Container]
    public ?array $dnsServerSearchOrder = null;

    public function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }
}
