<?php

namespace dnj\Autounattend\Deployment;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\SynchronousCommand as ParentClass;

#[Attribute('wcm:action', 'add')]
#[Wrapper('RunSynchronousCommand')]
class SynchronousCommand extends ParentClass
{
}
