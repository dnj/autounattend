<?php

namespace dnj\Autounattend\NetBT;

use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Counter;
use dnj\Autounattend\Attributes\EachCast;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ExportTrait;
use dnj\Autounattend\NetBT\NetworkInterface\IpAddress;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-dns-client-interfaces-interface
 */
#[Wrapper('Interface')]
class NetworkInterface implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the interface identifier.
     */
    public string $identifier;

    /**
     * Specifies the list of name servers.
     *
     * @var string[]
     */
    #[EachCast(IpAddress::class)]
    #[Counter('@wcm:keyValue', 1)]
    #[Container]
    public ?array $nameServerList = null;

    /**
     * @param string[]|null $nameServerList
     */
    public function __construct(string $identifier, ?array $nameServerList = null)
    {
        $this->identifier = $identifier;
        $this->nameServerList = $nameServerList;
    }
}
