<?php

namespace dnj\Autounattend\TCPIP\NetworkInterface;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Name;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ExportTrait;

#[Attribute('wcm:action', 'add')]
#[Wrapper]
class IpAddress implements \JsonSerializable
{
    use ExportTrait;

    #[Name('#')]
    public string $address;

    public function __construct(string $address)
    {
        $this->address = $address;
    }
}
