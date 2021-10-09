<?php

namespace dnj\Autounattend\Deployment;

use dnj\Autounattend\AsynchronousCommand as ParentClass;
use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('wcm:action', 'add')]
#[Wrapper('RunAsynchronousCommand')]
class AsynchronousCommand extends ParentClass
{
}
