<?php

namespace dnj\Autounattend\ShellSetup;

use dnj\Autounattend\AsynchronousCommand as ParentClass;
use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Name;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('wcm:action', 'add')]
#[Wrapper]
class AsynchronousCommand extends ParentClass
{
    #[Name('CommandLine')]
    public string $path;
}
