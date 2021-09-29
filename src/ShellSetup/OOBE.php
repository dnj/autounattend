<?php

namespace dnj\Autounattend\ShellSetup;

use dnj\Autounattend\ExportTrait;

class OOBE implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Hides the Microsoft Software License Terms page. OEMs and System Builders can use this setting only for testing prior to shipment.
     */
    public ?bool $hideEULAPage = null;

    /**
     * Hides the Administrator password screen. This setting applies only to the Windows Server editions.
     */
    public ?bool $hideLocalAccountScreen = null;

    /**
     * Hides the OEM registration page.
     */
    public ?bool $hideOEMRegistrationScreen = null;

    /**
     * Specifies whether the user will be required to sign-in during OOBE.
     */
    public ?bool $hideOnlineAccountScreens = null;

    /**
     * Hides the Join Wireless Network page.
     */
    public ?bool $hideWirelessSetupInOOBE = null;

    /**
     * Specifies the network type.
     */
    public ?string $networkLocation = null;

    /**
     * Enables the OEM to specify app information.
     */
    public ?string $oemAppID = null;

    /**
     * Hides the Help protect your computer and improve Windows automatically page. That page specifies whether updates are automatically downloaded and installed.
     */
    public ?int $protectYourPC = null;

    /**
     * Use to enable retail demo mode on the device.
     */
    public ?bool $unattendEnableRetailDemo = null;
}
