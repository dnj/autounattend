<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Name;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-TerminalServices-LocalSessionManager')]
#[Wrapper('component')]
class LocalSessionManager implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether remote desktop connections are enabled.
     * The default value is true.
     */
    #[Name('fDenyTSConnections')]
    public ?bool $fDenyTSConnections = null;
}
