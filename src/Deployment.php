<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Counter;
use dnj\Autounattend\Attributes\EachCast;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-Deployment')]
#[Attribute('processorArchitecture', 'amd64')]
#[Attribute('publicKeyToken', '31bf3856ad364e35')]
#[Attribute('language', 'neutral')]
#[Attribute('versionScope', 'nonSxS')]
#[Attribute('xmlns:wcm', 'http://schemas.microsoft.com/WMIConfig/2002/State')]
#[Attribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance')]
#[Wrapper('component')]
class Deployment implements \JsonSerializable
{
    use ExportTrait;

    /**
     * Specifies one or more commands to run asynchronously on the operating system during the specified configuration pass.
     *
     * @var Command[]|null
     */
    #[EachCast(AsynchronousCommand::class)]
    #[Container]
    public ?array $runAsynchronous = null;

    /**
     * Specifies one or more commands to run synchronously on the operating system during the specified configuration pass.
     *
     * @var Command[]|null
     */
    #[EachCast(SynchronousCommand::class)]
    #[Counter('Order', 1)]
    #[Container]
    public ?array $runSynchronous = null;
}
