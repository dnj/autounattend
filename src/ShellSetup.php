<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Counter;
use dnj\Autounattend\Attributes\EachCast;
use dnj\Autounattend\Attributes\Name;
use dnj\Autounattend\Attributes\Pass;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\ShellSetup\AutoLogon;
use dnj\Autounattend\ShellSetup\OOBE;
use dnj\Autounattend\ShellSetup\UserAccounts;

#[Attribute('name', 'Microsoft-Windows-Shell-Setup')]
#[Wrapper('component')]
class ShellSetup implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies credentials for an account that is used to automatically log on to the computer.
     */
    #[Pass('oobeSystem')]
    public ?AutoLogon $autoLogon = null;

    /**
     * Specifies local accounts to be created or domain accounts to be added during installation.
     */
    #[Pass('oobeSystem')]
    public ?UserAccounts $userAccounts = null;

    /**
     * Specifies the computer's time zone.
     */
    #[Pass('specialize')]
    public ?string $timeZone = null;

    /**
     * Specifies values that suppress certain pages of OOBE.
     */
    #[Pass('oobeSystem')]
    #[Name('OOBE')]
    public ?OOBE $oobe = null;

    /**
     * Specifies commands to run the first time that an end user logs on to the computer. This setting is not supported in Windows 10 in S mode.
     *
     * @var Command[]
     */
    #[Pass('oobeSystem')]
    #[EachCast(ShellSetup\SynchronousCommand::class)]
    #[Counter('Order', 1)]
    #[Container]
    public ?array $firstLogonCommands = null;

    /**
     * Specifies commands to run when an end user logs on to the computer.
     *
     * @var Command[]
     */
    #[Pass('specialize')]
    #[EachCast(ShellSetup\AsynchronousCommand::class)]
    #[Counter('Order', 1)]
    #[Container]
    public ?array $logonCommands = null;

    /**
     * Specifies values that suppress certain pages of OOBE.
     */
    #[Pass('specialize')]
    #[Name('OEMName')]
    public ?string $oemName = null;

    /**
     * Specifies the product key for the Windows edition.
     */
    #[Pass('specialize')]
    public ?string $productKey = null;

    /**
     * Specifies information about the computer's owner.
     */
    #[Pass('specialize')]
    public ?string $registeredOrganization = null;

    /**
     * Specifies information about the organization of the computer's owner.
     */
    #[Pass('specialize')]
    public ?string $registeredOwner = null;

    /**
     * Specifies that the Power Options button is visible on the Start screen.
     * The default value of ShowWindowsStoreAppsOnTaskbar depends on the selected power platform role.
     */
    #[Pass('specialize')]
    public ?bool $showPowerButtonOnStartScreen = null;

    /**
     * Specifies whether users switch to tablet mode by default after signing in.
     */
    #[Pass('specialize')]
    public ?int $signInMode = null;

    /**
     * Specifies the name of the computer.
     */
    #[Pass('specialize')]
    public ?string $computerName = null;

    /**
     * Specifies whether to enable the destination computer to automatically change between daylight saving time and standard time.
     * The default value is false.
     */
    #[Pass('specialize')]
    public ?bool $disableAutoDaylightTimeSet = null;
}
