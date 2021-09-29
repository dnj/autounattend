<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\Setup\Diagnostics;
use dnj\Autounattend\Setup\DiskConfiguration;
use dnj\Autounattend\Setup\ImageInstall;
use dnj\Autounattend\Setup\UserData;

#[Attribute('name', 'Microsoft-Windows-Setup')]
#[Attribute('processorArchitecture', 'amd64')]
#[Attribute('publicKeyToken', '31bf3856ad364e35')]
#[Attribute('language', 'neutral')]
#[Attribute('versionScope', 'nonSxS')]
#[Attribute('xmlns:wcm', 'http://schemas.microsoft.com/WMIConfig/2002/State')]
#[Attribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')]
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
