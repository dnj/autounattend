<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;

#[Attribute('wcm:action', 'add')]
#[Wrapper]
class SynchronousCommand extends Command
{
    public function __construct(Command $command)
    {
        foreach (get_object_vars($command) as $k => $v) {
            $this->{$k} = $v;
        }
    }
}
