<?php

namespace dnj\Autounattend\ShellSetup;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Name;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\SynchronousCommand as ParentClass;

#[Attribute('wcm:action', 'add')]
#[Wrapper]
class SynchronousCommand extends ParentClass
{
    #[Name('CommandLine')]
    public string $path;
}
