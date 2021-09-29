<?php

namespace dnj\Autounattend\TCPIP\NetworkInterface;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ExportTrait;

/**
 * @see https://docs.microsoft.com/en-us/windows-hardware/customize/desktop/unattend/microsoft-windows-tcpip-interfaces-interface-routes-route
 */
#[Attribute('wcm:action', 'add')]
#[Wrapper]
class Route implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies the metric used to distinguish between multiple matching routes of the same prefix length.
     */
    public int $metric;

    /**
     * Specifies the IP address of the next hop in the route.
     */
    public ?string $nextHopAddress = null;

    /**
     * Specifies the prefix to match to each route.
     *
     * @var string|int
     */
    public $prefix;

    /**
     * @param string|int $prefix
     */
    public function __construct($prefix, int $metric, ?string $nextHopAddress = null)
    {
        $this->prefix = $prefix;
        $this->metric = $metric;
        $this->nextHopAddress = $nextHopAddress;
    }
}
