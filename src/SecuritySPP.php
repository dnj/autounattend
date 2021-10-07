<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-Security-SPP-UX')]
#[Wrapper('component')]
class SecuritySPP implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether to skip auto-activation of the Microsoft Windows license.
     * The default value is false.
     */
    public ?bool $skipAutoActivation = null;
}
