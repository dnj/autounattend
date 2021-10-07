<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Container;
use dnj\Autounattend\Attributes\Counter;
use dnj\Autounattend\Attributes\EachCast;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('name', 'Microsoft-Windows-Deployment')]
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
