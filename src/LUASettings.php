<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-LUA-Settings')]
#[Wrapper('component')]
class LUASettings implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether the windows User Account Controls (UAC) notify the user when programs try to make changes to the computer.
     */
    public ?bool $enableLUA = null;
}
