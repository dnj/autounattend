<?php

namespace dnj\Autounattend\Deployment;

use dnj\Autounattend\Attributes\Wrapper;
use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\AsynchronousCommand as ParentClass;

#[Attribute('wcm:action', 'add')]
#[Wrapper("RunAsynchronousCommand")]
class AsynchronousCommand extends ParentClass
{
}
