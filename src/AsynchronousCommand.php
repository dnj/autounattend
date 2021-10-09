<?php

namespace dnj\Autounattend;

use dnj\Autounattend\Attributes\Attribute;
use dnj\Autounattend\Attributes\Wrapper;

class AsynchronousCommand extends Command
{
    public function __construct(Command $command)
    {
        foreach (get_object_vars($command) as $k => $v) {
            $this->{$k} = $v;
        }
    }
}
