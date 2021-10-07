<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\Setup\Diagnostics;
use dnj\Autounattend\Setup\DiskConfiguration;
use dnj\Autounattend\Setup\ImageInstall;
use dnj\Autounattend\Setup\UserData;

#[Attribute('name', 'Microsoft-Windows-Setup')]
#[Wrapper('component')]
class Setup implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Diagnostics specifies whether installation statistics, such as status reports and failures, are sent to Microsoft.
     */
    public ?Diagnostics $diagnostics = null;

    /**
     * Specifies the disk configurations to apply to a disk on the destination computer.
     */
    public ?DiskConfiguration $diskConfiguration = null;

    /**
     * Specifies user data, such as the user name and the product key to apply to the Windows installation.
     */
    public ?UserData $userData = null;

    /**
     * Specifies the Windows image to install.
     */
    public ?ImageInstall $imageInstall = null;

    /**
     * Specifies whether a network connection is enabled.
     */
    public ?bool $enableNetwork = null;

    /**
     * Specifies whether to enable Windows Firewall for Windows PE.
     */
    public ?bool $enableFirewall = null;
}
