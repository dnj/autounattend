<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-SystemRestore-Main')]
#[Wrapper('component')]
class SystemRestore implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Enables and disables System Restore.
     * The default value is 0.
     */
    public ?int $disableSR = null;
}
