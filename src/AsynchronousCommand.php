<?php

namespace dnj\Autounattend;

class AsynchronousCommand extends Command
{
    public function __construct(Command $command)
    {
        foreach (get_object_vars($command) as $k => $v) {
            $this->{$k} = $v;
        }
    }
}
