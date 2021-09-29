<?php

namespace dnj\Autounattend\DnsClient;

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

    #[Name('@wcm:keyValue')]
    public string $keyValue;

    public function __construct(string $address, string $keyValue)
    {
        $this->address = $address;
        $this->keyValue = $keyValue;
    }
}
