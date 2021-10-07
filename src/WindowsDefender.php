<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Security-Malware-Windows-Defender')]
#[Wrapper('component')]
class WindowsDefender implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies whether to disable Microsoft Defender Antivirus.
     * The default value is false.
     */
    public ?bool $disableAntiSpyware = null;
}
