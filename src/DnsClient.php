<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-DNS-Client')]
#[Attribute('processorArchitecture', 'amd64')]
#[Attribute('publicKeyToken', '31bf3856ad364e35')]
#[Attribute('language', 'neutral')]
#[Attribute('versionScope', 'nonSxS')]
#[Attribute('xmlns:wcm', 'http://schemas.microsoft.com/WMIConfig/2002/State')]
#[Attribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')]
#[Wrapper('component')]
class DnsClient implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the primary DNS suffix of the network connection across all adapters. If DNSDomain is specified in two places as a global parameter (x) and as an interface-specific parameter (y), the two values are concatenated appropriately for each interface (as x, y) and used.
     */
    public ?string $dnsDomain = null;

    /**
     * Specifies whether to use domain-name devolution when the DNS-caching resolver resolves an unqualified query.
     * Default value is true.
     */
    public ?bool $useDomainNameDevolution = null;

    /**
     * Specifies an interface collection.
     *
     * @var DnsClient\NetworkInterface[]|null
     */
    #[Container]
    public ?array $interfaces = null;
}
